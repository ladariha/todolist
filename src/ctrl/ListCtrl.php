<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListCtrl
 *
 * @author vriha
 */
class ListCtrl {

    private $todoDao = null;
    private $todoListDao = null;

    function __construct() {
        $this->todoDao = new TodoDAO();
        $this->todoListDao = new TodoListDAO();
    }

    public function getList($id) {
        $list = $this->todoListDao->getList($id);
        if (!is_null($list)) {
            $list->todos = $this->todoDao->getTodosForList($id);
        }
        return $list;
    }

    public function create($name) {
        return $this->todoListDao->createList($name);
    }

    public function deleteList($id) {
        $o = $this->todoDao->getTodosForList($id);
        $this->todoDao->deleteCaseHasLabelByListId($id, $o);
        $this->todoDao->deleteCasesForList($id);
        $this->todoListDao->deleteList($id);
    }

    public function update($newName, $id) {
        $this->todoListDao->update($newName, intval($id));
        return intval($id);
    }

    //put your code here
}

?>
