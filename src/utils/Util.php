<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author vriha
 */
class Util {

    /**
     * @assert (1) == 2
     * @param type $date
     * @return type
     */
    public static function diffDates($date) {
        if (is_null($date))
            throw new Exception('Missing parameter');
        $now = time(); // or your date as well
        date_default_timezone_set('UTC');
        $datediff = strtotime($date) - $now;
        return ($datediff / (60 * 60 * 24));
    }

    public static function arrayToSQLOR($data, $string) {
        $sql = "";
        for ($i = 0; $i < count($data); $i++) {

            $sql = $sql . $string . "=" . $data[$i] . " OR ";
        }

        $sql = substr($sql, 0, strlen($sql) - 3);
        return "(" . $sql . ")";
    }

}

?>
