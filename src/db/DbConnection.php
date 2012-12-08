<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbConnection
 *
 * @author vriha
 */
class DbConnection {

    /**
     *
     * @var PDO 
     */
    private static $db = null;

    public static function connectDatabase() {
        if (DbConnection::$db !== null) {
            return;
        }
        try {
            DbConnection::$db = new PDO(DHOST, DUSER, DPASS, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_EMULATE_PREPARES => true));
            DbConnection::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (Exception $ex) {
            throw new Exception('Database error', 'DB error [' . $ex . ']:', '');
        }
    }

    public static function getDB() {
        return DbConnection::$db;
    }

    public static function throwDbError($errorInfo) {
        $d = print_r($errorInfo, true);
        throw new Exception('Todolist database error: '.$d);
    }

}

?>
