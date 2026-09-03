<?php

namespace Model;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            try {

                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=Cafeteria;charset=utf8",
                    "root",
                    ""
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