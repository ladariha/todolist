<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoDAO
 *
 * @author vriha
 */
class TodoDAO {

    /**
     * 
     * @param type $id
     * @return Todo[]
     */
    public function getTodosForList($id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("SELECT t.id, t.text, t.state, t.date, GROUP_CONCAT(k.label SEPARATOR '|') as labels FROM todo t LEFT JOIN (todo_has_label ck, label k) ON (ck.todo_id = t.id AND k.id=ck.labels_id)  WHERE t.todolist_id=:id GROUP BY t.id");
        $handler->bindParam(":id", $id);

        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }

        $results = array();
        while ($row = $handler->fetch(PDO::FETCH_ASSOC)) {
            $t = new Todo($row['id'], $row['text'], $row['date']);
            $t->state = $row['state'];
            $t->setLabels($row['labels'], "|");
            array_push($results, $t);
        }
        return $results;
    }

    /**
     * 
     * @param Todo $todo
     */
    public function edit($todo) {
        if (is_null($todo)) {
            throw new Exception("Object cannot be null");
        }

        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("UPDATE todo SET text=:t, date=:d, state=:s WHERE id=:i");
        $handler->bindParam(":i", $todo->id);
        $handler->bindParam(":t", $todo->text);
        $handler->bindParam(":d", $todo->date);
        $handler->bindParam(":s", $todo->state);

        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    public function deleteCaseHasLabelByListId($id, $o) {
        
        if (count($o) < 1)
            return;
        $obsolete_references = array();
        for ($i = 0; $i < count($o); $i++) {
            array_push($obsolete_references, $o[$i]->id);
        }

        $obsolete = Util::arrayToSQLOR($obsolete_references, "todo_id");
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("DELETE FROM todo_has_label WHERE " . $obsolete);

        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    public function deleteCasesForList($id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("DELETE FROM todo WHERE todolist_id=:id");
        $handler->bindParam(":id", $id);
        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    /**
     * 
     * @param Todo $todo
     */
    public function create($todo) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("INSERT INTO todo (todolist_id, state, date, text) VALUES (:tid, 'notFinished', :d, :t)");
        $handler->bindParam(":tid", $todo->todolist_id);
        date_default_timezone_set('UTC');
        $handler->bindValue(":d", date("Y-m-d H:i:s", strtotime($todo->date)));
        $handler->bindParam(":t", $todo->text);


        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
        return DbConnection::getDB()->lastInsertId();
    }

    public function addLabels($id, $labels) {
        foreach ($labels as $label) {

            DbConnection::connectDatabase();
            $handler = DbConnection::getDB()->prepare("SELECT id  FROM label WHERE label=:k");
            $handler->bindParam(':k', $label);

            if (!$handler->execute()) {
                DbConnection::throwDbError($handler->errorInfo());
            }

            $found = -1;
            while ($row = $handler->fetch(PDO::FETCH_ASSOC)) {
                $found = $row['id'];
            }

            if ($found < 0) {
                DbConnection::connectDatabase();
                $handler2 = DbConnection::getDB()->prepare("INSERT INTO label (label) VALUES (:k)");
                $handler2->bindValue(':k', $label);

                if (!$handler2->execute()) {
                    DbConnection::throwDbError($handler2->errorInfo());
                }
                $found = DbConnection::getDB()->lastInsertId();
            }

            DbConnection::connectDatabase();
            $handler2 = DbConnection::getDB()->prepare("INSERT INTO todo_has_label (todo_id, labels_id) VALUES (:k, :l)");
            $handler2->bindValue(':k', $id);
            $handler2->bindValue(':l', $found);

            if (!$handler2->execute()) {
                DbConnection::throwDbError($handler2->errorInfo());
            }
        }
    }

    public function deleteCase($id) {
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("DELETE FROM todo WHERE id=:id");
        $handler->bindParam(":id", $id);
        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

    public function deleteLabelsForCase($id) {
        
        DbConnection::connectDatabase();
        $handler = DbConnection::getDB()->prepare("DELETE FROM todo_has_label WHERE todo_id=:id");
        $handler->bindParam(":id", $id);
        if (!$handler->execute()) {
            DbConnection::throwDbError($handler->errorInfo());
        }
    }

}

?>
