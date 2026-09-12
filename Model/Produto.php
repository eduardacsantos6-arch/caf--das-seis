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


    /**
     * Cadastra um novo produto
     *
     * @param string $nome Nome do produto
     * @param string|null $descricao Descrição do produto
     * @param float $preco Preço do produto
     * @param int|null $id_categoria Identificador da categoria
     * @param bool $disponivel Se o produto está disponível para venda
     *
     * @return bool
     */
    public function registerProduto(
        string $nome,
        ?string $descricao,
        float $preco,
        ?int $id_categoria,
        bool $disponivel = true
    ): bool {

        try {

            $sql = "INSERT INTO produtos
            (
                nome,
                descricao,
                preco,
                id_categoria,
                disponivel
            )
            VALUES
            (
                :nome,
                :descricao,
                :preco,
                :id_categoria,
                :disponivel
            )";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":preco", $preco);
            $stmt->bindParam(
                ":id_categoria",
                $id_categoria,
                $id_categoria === null ? PDO::PARAM_NULL : PDO::PARAM_INT
            );
            $stmt->bindParam(
                ":disponivel",
                $disponivel,
                PDO::PARAM_BOOL
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao cadastrar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca todos os produtos cadastrados, com o nome da categoria
     *
     * @return array
     */
    public function getProdutos(): array
    {
        try {

            $sql = "SELECT
                        p.*,
                        c.nome AS categoria
                    FROM produtos p
                    LEFT JOIN categorias c ON c.id_categoria = p.id_categoria
                    ORDER BY p.nome ASC";

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


    /**
     * Busca apenas os produtos disponíveis, com o nome da categoria
     *
     * @return array
     */
    public function getProdutosDisponiveis(): array
    {
        try {

            $sql = "SELECT
                        p.*,
                        c.nome AS categoria
                    FROM produtos p
                    LEFT JOIN categorias c ON c.id_categoria = p.id_categoria
                    WHERE p.disponivel = 1
                    ORDER BY p.nome ASC";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar produtos disponíveis: " .
                $error->getMessage()
            );

            return [];
        }
    }


    /**
     * Busca um produto pelo ID
     *
     * @param int $id Identificador do produto
     *
     * @return array|bool
     */
    public function getProdutoById(int $id): array|bool
    {
        try {

            $sql = "SELECT
                        p.*,
                        c.nome AS categoria
                    FROM produtos p
                    LEFT JOIN categorias c ON c.id_categoria = p.id_categoria
                    WHERE p.id_produto = :id";

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


    /**
     * Atualiza um produto
     *
     * @param int $id Identificador do produto
     * @param string $nome Nome do produto
     * @param string|null $descricao Descrição do produto
     * @param float $preco Preço do produto
     * @param int|null $id_categoria Identificador da categoria
     * @param bool $disponivel Se o produto está disponível para venda
     *
     * @return bool
     */
    public function updateProduto(
        int $id,
        string $nome,
        ?string $descricao,
        float $preco,
        ?int $id_categoria,
        bool $disponivel
    ): bool {

        try {

            $sql = "UPDATE produtos SET
                nome = :nome,
                descricao = :descricao,
                preco = :preco,
                id_categoria = :id_categoria,
                disponivel = :disponivel
                WHERE id_produto = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":preco", $preco);
            $stmt->bindParam(
                ":id_categoria",
                $id_categoria,
                $id_categoria === null ? PDO::PARAM_NULL : PDO::PARAM_INT
            );
            $stmt->bindParam(
                ":disponivel",
                $disponivel,
                PDO::PARAM_BOOL
            );

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


    /**
     * Exclui um produto
     *
     * @param int $id Identificador do produto
     *
     * @return bool
     */
    public function deleteProduto(int $id): bool
    {
        try {

            $sql = "DELETE FROM produtos WHERE id_produto = :id";

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
