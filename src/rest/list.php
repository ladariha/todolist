<?php

require_once '../conf/setup.php';

switch ($_SERVER['REQUEST_METHOD']) {

    case "GET":
        if (!isset($_REQUEST['id'])) {
            HTTP::BadRequest("Missing parameters");
            die();
        }
        $ctrl = new ListCtrl();
        $list = $ctrl->getList(intval($_REQUEST['id']));
        HTTP::OK(json_encode($list), 'Content-type: application/json');
        break;
    case "POST":
        $put = file_get_contents('php://input');
        $data = json_decode($put);

        if (!isset($data->name)) {
            HTTP::BadRequest("Missing parameters");
            die();
        }
        $ctrl = new ListCtrl();
        HTTP::OK($ctrl->create($data->name));
        break;
    case "DELETE":
        if (!isset($_REQUEST['id'])) {
            HTTP::BadRequest("Missing parameters");
            die();
        }
        $ctrl = new ListCtrl();
        $list = $ctrl->deleteList(intval($_REQUEST['id']));
        HTTP::OK('');
        break;
    case "PUT":
        $put = file_get_contents('php://input');
        $data = json_decode($put);

        if (!isset($data->name) || !isset($_REQUEST['id'])) {
            HTTP::BadRequest("Missing parameters");
            die();
        }
        $ctrl = new ListCtrl();
        HTTP::OK($ctrl->update($data->name, $_REQUEST['id']));
        break;
    default :
        HTTP::MethodNotAllowed("");
        break;
}
?>
