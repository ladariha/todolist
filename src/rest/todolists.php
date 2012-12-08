<?php
require_once '../conf/setup.php';

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        $ctrl = new ListsCtrl();
        $lists = $ctrl->getLists();
        HTTP::OK(json_encode($lists), 'Content-type: application/json');
        break;
    default :
        HTTP::MethodNotAllowed("");
        break;
}
?>
