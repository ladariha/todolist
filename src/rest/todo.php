<?php

require_once '../conf/setup.php';

switch ($_SERVER['REQUEST_METHOD']) {

    case "PUT":
        $put = file_get_contents('php://input');
        $data = json_decode($put);

        if (!isset($data->text) || !isset($data->date) || !isset($data->state) || !isset($data->id)) {
            HTTP::BadRequest("Missing parameters");
            die();
        }
        $ctrl = new TodoCtrl();
        $ctrl->edit($data);
        HTTP::OK('');
        break;
    case "POST":
        $put = file_get_contents('php://input');
        $data = json_decode($put);

        if (!isset($data->text) || !isset($data->date) || !isset($data->todolist_id)) {
            HTTP::BadRequest("Missing parameters ");
            die();
        }
        $ctrl = new TodoCtrl();
        HTTP::OK($ctrl->create($data));
        break;
    case "DELETE":
        
        if (!isset($_REQUEST['id'])) {
            HTTP::BadRequest("Missing parameters ");
            die();
        }
        $ctrl = new TodoCtrl();
        $ctrl->delete(intval($_REQUEST['id']));
        break;
    default :
        HTTP::MethodNotAllowed("");
        break;
}
?>
