<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoList_DAO
 *
 * @author vriha
 */
class TodoListDAO {

    public function getLists() {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("SELECT id, name FROM todolist");


        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }

        $results = array();
        while ($row = $handler->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, new TodoList($row['id'], $row['name']));
        }
        return $results;
    }

    /**
     * 
     * @param type $id
     * @return \TodoList|null
     */
    public function getList($id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("SELECT name FROM todolist WHERE id=:id");
        $handler->bindParam(":id", $id);

        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }


        while ($row = $handler->fetch(PDO::FETCH_ASSOC)) {
           $r = new TodoList($id, $row['name']);
            return $r;
        }
        return null;
    }

    public function createList($name) {
         DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("INSERT INTO todolist (name) VALUES (:name)");
        $handler->bindParam(":name", $name);

        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
        
        return DbConnection::getDB()->lastInsertId();

    }

    public function deleteList($id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("DELETE FROM todolist WHERE id=:id");
        $handler->bindParam(":id", $id);
        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    public function update($name, $id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("UPDATE todolist SET name=:n WHERE id=:id");
        $handler->bindParam(":id", $id);
        $handler->bindParam(":n", $name);
        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    //put your code here
}

?>
