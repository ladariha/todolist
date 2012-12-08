<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Todo
 *
 * @author vriha
 */
class Todo {

    public $id;
    public $text;
    public $date;
    public $labels;
    public $state;
    public $daysLeft;

    function __construct($id, $text, $date) {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->labels = array();
        $this->daysLeft = Util::diffDates($this->date);
    }

    
    public function setLabels($labels, $separator) {
        if (isset($labels) && strlen($labels) > 0) {
            $this->labels = explode($separator, $labels);
        }
    }

}

?>
