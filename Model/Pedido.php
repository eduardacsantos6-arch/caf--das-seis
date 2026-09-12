<?php

namespace Model;

use Model\Connection;

use PDO;
use PDOException;

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    /**
     * Cria um novo pedido
     *
     * @param int $id_funcionario Identificador do funcionário
     * @param string $data_pedido Data do pedido
     * @param string $status Status do pedido
     * @param float $valor_total Valor total do pedido
     *
     * @return bool
     */
    public function createPedido(
        int $id_funcionario,
        string $data_pedido,
        string $status,
        float $valor_total
    ): bool {
        try {

            $sql = "INSERT INTO pedidos(id_funcionario, data_pedido, status, valor_total) VALUES (:id_funcionario, :data_pedido, :status, :valor_total)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id_funcionario',
                $id_funcionario,
                PDO::PARAM_INT
            );

            $stmt->bindParam(
                ':data_pedido',
                $data_pedido
            );

            $stmt->bindParam(
                ':status',
                $status
            );

            $stmt->bindParam(
                ':valor_total',
                $valor_total
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao criar pedido: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca todos os pedidos cadastrados
     *
     * @return array|bool
     */
    public function getPedidos(): array|bool {
        try {

            $sql = "SELECT * FROM pedidos ORDER BY data_pedido DESC";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar pedidos: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca um pedido pelo ID
     *
     * @param int $id_pedido Identificador do pedido
     *
     * @return array|bool
     */
    public function getPedidoById(
        int $id_pedido
    ): array|bool {
        try {

            $sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id_pedido',
                $id_pedido,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar pedido: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca pedidos realizados por um funcionário
     *
     * @param int $id_funcionario Identificador do funcionário
     *
     * @return array|bool
     */
    public function getPedidoHistory(
        int $id_funcionario
    ): array|bool {
        try {

            $sql = "SELECT * FROM pedidos WHERE id_funcionario = :id_funcionario ORDER BY data_pedido DESC LIMIT 6";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id_funcionario',
                $id_funcionario,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar histórico de pedidos: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca pedidos que ainda estão pendentes
     *
     * @return array|bool
     */
    public function getPedidosPendentes(): array|bool {
        try {

            $sql = "SELECT * FROM pedidos WHERE status = :status ORDER BY data_pedido DESC";

            $stmt = $this->db->prepare($sql);

            $status = "Pendente";

            $stmt->bindParam(
                ':status',
                $status
            );

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar pedidos pendentes: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Atualiza o status de um pedido
     *
     * @param int $id_pedido Identificador do pedido
     * @param string $status Novo status do pedido
     *
     * @return bool
     */
    public function updatePedidoStatus(
        int $id_pedido,
        string $status
    ): bool {
        try {

            $sql = "UPDATE pedidos SET status = :status WHERE id_pedido = :id_pedido";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':status',
                $status
            );

            $stmt->bindParam(
                ':id_pedido',
                $id_pedido,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao atualizar pedido: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Exclui um pedido
     *
     * @param int $id_pedido Identificador do pedido
     *
     * @return bool
     */
    public function deletePedido(
        int $id_pedido
    ): bool {
        try {

            $sql = "DELETE FROM pedidos WHERE id_pedido = :id_pedido";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id_pedido',
                $id_pedido,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao excluir pedido: " .
                $error->getMessage()
            );

            return false;
        }
    }
}