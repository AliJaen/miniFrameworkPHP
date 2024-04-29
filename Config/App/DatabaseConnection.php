<?php

class DatabaseConnection {
    private $dbh;

    public function __construct($database = "") {
        try {
            if ($database == "") {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            } else {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . $database . ";charset=" . DB_CHARSET;
            }
            $this->dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "¡Error DB!: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->dbh;
    }

    public static function query($sql, $params = []) {
        $db = new DatabaseConnection();
        $link = (object)$db->getConnection();
        $link->beginTransaction(); // Prevent errores, checkpoint
        $query = $link->prepare($sql);

        if (!$query->execute($params)) {
            $link->rollback();
            $error = $query->errorInfo();
            throw new Exception($error[2]);
        }

        // SELECT || INSERT || UPDATE || DELETE || ALTERTABLE
        // Handle the type of query
        if (strpos($sql, "SELECT") !== false) {
            return $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        } elseif (strpos($sql, "INSERT") !== false) {
            $id = $link->lastInsertId();
            $link->commit();
            return $id;
        } elseif (strpos($sql, "UPDATE") !== false) {
            $link->commit();
            return true;
        } elseif (strpos($sql, "DELETE") !== false) {
            if ($query->rowCount() > 0) {
                $link->commit();
                return true;
            }

            $link->rollBack();
            return false;
        } else {
            // alter table || drop table
            $link->commit();
            return true;
        }

    }

}