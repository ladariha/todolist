<?php

ini_set('display_errors', 'Off');
ini_set('display_startup_errors', 'Off');
ini_set('html_errors', 'Off');
ini_set('docref_root', 'Off');
ini_set('docref_ext', 'Off');
ini_set('error_reporting', E_ERROR);
ini_set('ignore_repeated_errors', 'On');
ini_set('ignore_repeated_source', 'On');
ini_set('error_log', '/var/www/todolist_errors/errors.log');

function autoload($class) {
    $path = array(
        '../' . $class . '.php',
        '../model/' . $class . '.php',
        '../dao/' . $class . '.php',
        '../utils/' . $class . '.php',
        '../ctrl/' . $class . '.php',
        '../db/' . $class . '.php',
    );
    foreach ($path as $v) {
        if (file_exists($v)) {
            require($v);
            break;
        }
    }
}


// SYNERGY DATABASE
// dev
define('DHOST', 'mysql:host=localhost;dbname=todolist;charset=UTF8');
define('DUSER', 'odbc');
define('DPASS', 'odbc');
define('DB', 'todolist');
define('DBHOST', 'localhost');

// SERVER ENDPOINTS - so they can be referrenced in REST API
define("ENDPOINT_TODOLIST", "http://localhost/todolist/src/rest/todolist.php");
define("ENDPOINT_TODO", "http://localhost/todolist/src/rest/todo.php");


spl_autoload_register('autoload');
session_start();

set_exception_handler('custom_handler');
set_error_handler('custom_error_handler', E_ERROR);

function custom_handler($exc) {
    $log = print_r($exc, true);
    error_log($log);
    $status_header = 'HTTP/1.1 500';
    header($status_header);
    echo "";
    // TODO add error page
}

function custom_error_handler($exc) {
    $log = print_r($exc, true);
    error_log($log);
    $status_header = 'HTTP/1.1 500';
    header($status_header);
    echo "";
}

function custom_error_handler_from_fatal($code, $msg, $file, $line) {
    error_log("Fatal error: " . $code . " :" . $msg . " @" . $file . ":" . $line);
    $status_header = 'HTTP/1.1 500';
    header($status_header);
    echo "Fatal error: " . $code . " :" . $msg . " @" . $file . ":" . $line;
}

function fatal_error_handler() {

    if (@is_array($e = @error_get_last())) {
        $code = isset($e['type']) ? $e['type'] : 0;
        $msg = isset($e['message']) ? $e['message'] : '';
        $file = isset($e['file']) ? $e['file'] : '';
        $line = isset($e['line']) ? $e['line'] : '';

        if ($code > 0)
            custom_error_handler_from_fatal($code, $msg, $file, $line);
    }
}

register_shutdown_function('handleShutdown');

function handleShutdown() {
    $error = error_get_last();
    if ($error !== NULL) {
        $info = "[SHUTDOWN] file:" . $error['file'] . " | ln:" . $error['line'] . " | msg:" . $error['message'] . PHP_EOL;
        error_log($info);
        $status_header = 'HTTP/1.1 500';
        header($status_header);
        echo $info;
    }
}

?>