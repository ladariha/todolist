<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoCtrl
 *
 * @author vriha
 */
class TodoCtrl {

    private $todoDao = null;

    function __construct() {
        $this->todoDao = new TodoDAO();
    }

    /**
     * 
     * @param Todo $todo
     */
    public function edit($todo) {
        $this->todoDao->edit($todo);
    }

    public function create($todo) {
        $id = $this->todoDao->create($todo);
        $this->todoDao->addLabels($id, $todo->labels);
        return $id;
    }

    public function delete($id) {
        $this->todoDao->deleteLabelsForCase($id);
        $this->todoDao->deleteCase($id);
    }

    //put your code here
}

?>
