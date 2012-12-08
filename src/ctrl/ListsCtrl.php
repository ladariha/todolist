<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListsCtrl
 *
 * @author vriha
 */
class ListsCtrl {

    private $todoListDao = null;
    
    function __construct() {
        $this->todoListDao = new TodoListDAO();
    }

    
    
    public function getLists() {
        return $this->todoListDao->getLists();
    }
    
    
    
    
    //put your code here
}

?>
