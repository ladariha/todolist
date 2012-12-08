<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HTTP
 *
 * @author vriha
 */
class HTTP {

    public static function MethodNotAllowed($msg) {
        $status_header = 'HTTP/1.1 405';
        header($status_header);
        header('Content-type: text/plain');
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "Method Not Allowed";
    }

    public static function OK($msg, $content_type = 'Content-type: text/plain', $setHeaders = true) {
        $status_header = 'HTTP/1.1 200';
        if ($setHeaders) {
            header($status_header);
            header($content_type);
        }
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "OK";
    }

    public static function Unauthorized($msg, $setHeaders = true) {
        $status_header = 'HTTP/1.1 401';
        if ($setHeaders) {
            header($status_header);
            header('Content-type: text/plain');
        }
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "Unauthorized";
    }

    public static function BadRequest($msg) {
        $status_header = 'HTTP/1.1 400';
        header($status_header);
        header('Content-type: text/plain');
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "Bad Request";
    }

    public static function PreconditionFailed($msg) {
        $status_header = 'HTTP/1.1 412';
        header($status_header);
        header('Content-type: text/plain');
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "The server does not meet one of the preconditions that the requester put on the request";
    }

    public static function NotFound($msg) {
        $status_header = 'HTTP/1.1 404';
        header($status_header);
        header('Content-type: text/plain');
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "Not Found";
    }

    public static function InternalServerError($msg) {
        $status_header = 'HTTP/1.1 505';
        header($status_header);
        header('Content-type: text/plain');
        if (strlen($msg) > 0)
            echo $msg;
        else
            echo "Internal Server Error";
    }

}

?>
