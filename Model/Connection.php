<?php 
// IDENTIFICA QUAIS SÃO OS ARQUIVOS QUE
// DEVERÃO SER EXECUTADOS AUTOMATICAMENTE ENQUANTO EU UTILIZAR
// O SITE
namespace Model;

// USANDO AS CREDENCIAIS (PRECISA INFORMAR ONDE ELAS ESTÃO NÉ)
// DIR = DIRETÓRIO (QUAL É O LOCAL? QUAL É A PASTA? QUAL É O CAMINHO?)
require_once __DIR__ . "/../Config/configuration.php";

use PDO;
use PDOException;

// CONEXÃO COM O BANCO DE DADOS
class Connection {
    /**
     * 1° DEFINIR UM ATRIBUTO RESPONSÁVEL POR:
     * CONTER A CONEXÃO COM O BANCO (ESTABELECER A CONEXÃO COM O FITCALC NO MYSQL)
     *  A) SE A CONEXÃO EXISTIR, ENTRE NO BANCO
     *  B) SE A CONEXÃO NÃO EXISTIR, CRIE E UTILIZE AS CREDENCIAIS DE ACESSO
     */

    /**
     * STATIC SIGNIFICA "ESTÁTICO", OU SEJA:
     * TODA FUNÇÃO OU ATRIBUTO QUE CONTENHA ESSA PALAVRA NÃO IRÁ SOFRER ALTERAÇÕES
     * EXTERNAS, SERÁ APENAS RESPONSÁVEL POR UMA ÚNICA TAREFA UTILITÁRIA.
     */

    private static $stmt;

    // FUNÇÃO QUE IRÁ CRIAR A PONTE PARA CONECTAR O BANCO DE DADOS
    public static function getInstance():PDO {
        try {
            if(empty(self::$stmt)) {
                self::$stmt = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . "", DB_USER, DB_PASSWORD);
            }
        } catch (PDOException $error) {
            // Finalize qualquer tentativa de conexão com a seguinte mensagem:
            die("Erro na conexão" . $error->getMessage());
        }

        return self::$stmt;
    }

}