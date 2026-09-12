<?php

namespace Model;

use PDO;
use PDOException;

require_once __DIR__ . "/../Config/configuration.php";

class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            try {

                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASSWORD
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $error) {

                die(
                    "Erro na conexão: " .
                    $error->getMessage()
                );
            }
        }

        return self::$instance;
    }
}