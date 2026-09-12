<?php

namespace Model;

require_once __DIR__ . "/../Model/Connection.php";

use PDO;
use PDOException;

class Categoria
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    /**
     * Busca todas as categorias cadastradas
     *
     * @return array
     */
    public function getCategorias(): array
    {
        try {

            $sql = "SELECT * FROM categorias ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar categorias: " .
                $error->getMessage()
            );

            return [];
        }
    }


    /**
     * Busca uma categoria pelo nome
     *
     * @param string $nome Nome da categoria
     *
     * @return array|bool
     */
    public function getCategoriaByNome(string $nome): array|bool
    {
        try {

            $sql = "SELECT * FROM categorias WHERE nome = :nome";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar categoria: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Cadastra uma nova categoria
     *
     * @param string $nome Nome da categoria
     *
     * @return int|bool ID da categoria criada, ou false em caso de erro
     */
    public function createCategoria(string $nome): int|bool
    {
        try {

            $sql = "INSERT INTO categorias (nome) VALUES (:nome)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);

            if (!$stmt->execute()) {

                return false;

            }

            return (int) $this->db->lastInsertId();

        } catch (PDOException $error) {

            error_log(
                "Erro ao cadastrar categoria: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Retorna o ID de uma categoria pelo nome, criando-a
     * automaticamente se ela ainda não existir.
     *
     * @param string $nome Nome da categoria
     *
     * @return int|bool
     */
    public function getOrCreateIdByNome(string $nome): int|bool
    {
        $categoria = $this->getCategoriaByNome($nome);

        if ($categoria) {

            return (int) $categoria["id_categoria"];

        }

        return $this->createCategoria($nome);
    }
}
