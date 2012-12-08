<?php

function autoload($class) {
    $path = array(
        __DIR__.'/../src/' . $class . '.php',
        __DIR__.'/../src/model/' . $class . '.php',
        __DIR__.'/../src/dao/' . $class . '.php',
        __DIR__.'/../src/utils/' . $class . '.php',
        __DIR__.'/../src/ctrl/' . $class . '.php',
        __DIR__.'/../src/db/' . $class . '.php',
    );
    foreach ($path as $v) {
        if (file_exists($v)) {
            require($v);
            break;
        }
    }
}

spl_autoload_register('autoload');


//autoload('Todo');
//$a = new Todo(1, '', 'date');s
?>
