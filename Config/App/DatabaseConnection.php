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

            echo "Conexión exitosa";
        } catch (PDOException $e) {
            echo "¡Error DB!: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->dbh;
    }

}