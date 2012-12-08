<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoList
 *
 * @author vriha
 */
class TodoList {
    public $id;
    public $todos;
    public $name;
    
    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->todos = array();
    }

    
}

?>
