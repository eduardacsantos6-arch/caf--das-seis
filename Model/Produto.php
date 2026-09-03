<?php

namespace Model;

require_once __DIR__ . "/../Model/Connection.php";

use PDO;
use PDOException;

class Produto
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function registerProduto(
        string $nome,
        string $categoria,
        float $preco,
        string $icone,
        string $status
    ): bool {

        try {

            $sql = "INSERT INTO produtos
            (
                nome,
                categoria,
                preco,
                icone,
                status
            )
            VALUES
            (
                :nome,
                :categoria,
                :preco,
                :icone,
                :status
            )";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":categoria", $categoria);
            $stmt->bindParam(":preco", $preco);
            $stmt->bindParam(":icone", $icone);
            $stmt->bindParam(":status", $status);

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao cadastrar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    public function getProdutos(): array
    {
        try {

            $sql = "SELECT * FROM produtos";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar produtos: " .
                $error->getMessage()
            );

            return [];
        }
    }


    public function getProdutoById(int $id): array|bool
    {
        try {

            $sql = "SELECT * FROM produtos WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ":id",
                $id,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    public function updateProduto(
        int $id,
        string $nome,
        string $categoria,
        float $preco,
        string $icone,
        string $status
    ): bool {

        try {

            $sql = "UPDATE produtos SET
                nome = :nome,
                categoria = :categoria,
                preco = :preco,
                icone = :icone,
                status = :status
                WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":categoria", $categoria);
            $stmt->bindParam(":preco", $preco);
            $stmt->bindParam(":icone", $icone);
            $stmt->bindParam(":status", $status);

            $stmt->bindParam(
                ":id",
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao atualizar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    public function deleteProduto(int $id): bool
    {
        try {

            $sql = "DELETE FROM produtos WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ":id",
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao excluir produto: " .
                $error->getMessage()
            );

            return false;
        }
    }
}