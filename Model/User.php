<?php

namespace Model;

use Model\Connection;

use PDO;
use PDOException;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    /**
     * Cadastra um novo funcionário
     *
     * @param string $name Nome do funcionário
     * @param string $email E-mail do funcionário
     * @param string $telefone Telefone do funcionário
     * @param string $cargo Cargo do funcionário
     * @param string $turno_id Identificador do turno
     * @param string $status Status do funcionário
     * @param string $data_cadastro Data de cadastro
     *
     * @return bool
     */
    public function registerUser(
        string $name,
        string $email,
        string $telefone,
        string $cargo,
        string $turno_id,
        string $status,
        string $data_cadastro
    ): bool
    {
        try {

            $sql = "INSERT INTO funcionario(nome, email, telefone, cargo, turno_id, status, data_cadastro) VALUES (:nome, :email, :telefone, :cargo, :turno_id, :status, :data_cadastro)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nome', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(':turno_id', $turno_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':data_cadastro', $data_cadastro);

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao registrar funcionário: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca todos os funcionários
     *
     * @return array|bool
     */
    public function getFuncionarios(): array|bool
    {
        try {

            $sql = "SELECT * FROM funcionario ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar funcionários: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca um funcionário pelo e-mail
     *
     * @param string $email E-mail do funcionário
     *
     * @return array|bool
     */
    public function getUserbyEmail(string $email): array|bool
    {
        try {

            $sql = "SELECT * FROM funcionario WHERE email = :email";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':email',
                $email,
                PDO::PARAM_STR
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar funcionário: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca as informações de um funcionário pelo ID
     *
     * @param int $id Identificador do funcionário
     *
     * @return array|bool
     */
    public function getUserInfo(int $id): array|bool
    {
        try {

            $sql = "SELECT nome, email, telefone, cargo, turno_id, status, data_cadastro FROM funcionario WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar funcionário: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca os funcionários que estão trabalhando
     *
     * @return array|bool
     */
    public function getFuncionariosAtivos(): array|bool
    {
        try {

            $status = "Ativo";

            $sql = "SELECT * FROM funcionario WHERE status = :status ORDER BY nome ASC";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':status', $status);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar funcionários ativos: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Atualiza o status de um funcionário
     *
     * @param int $id Identificador do funcionário
     * @param string $status Novo status
     *
     * @return bool
     */
    public function updateFuncionarioStatus(
        int $id,
        string $status
    ): bool
    {
        try {

            $sql = "UPDATE funcionario SET status = :status WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':status', $status);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao atualizar status do funcionário: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Exclui um funcionário
     *
     * @param int $id Identificador do funcionário
     *
     * @return bool
     */
    public function deleteFuncionario(int $id): bool
    {
        try {

            $sql = "DELETE FROM funcionario WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao excluir funcionário: " .
                $error->getMessage()
            );

            return false;
        }
    }
}