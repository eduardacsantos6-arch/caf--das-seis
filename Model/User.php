<?php

namespace Model;

require_once __DIR__ . "/../Model/Connection.php";

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
     * @param string $senha Senha em texto plano (será convertida em hash)
     * @param string $cargo Cargo do funcionário
     * @param int|null $id_turno Identificador do turno (opcional)
     * @param string $status Status do funcionário
     *
     * @return bool
     */
    public function registerUser(
        string $name,
        string $email,
        string $senha,
        string $cargo,
        ?int $id_turno,
        string $status
    ): bool
    {
        try {

            $senhaHash = password_hash(
                $senha,
                PASSWORD_ARGON2ID,
                [
                    "memory_cost" => 65536, // 64 MB
                    "time_cost"   => 4,
                    "threads"     => 2,
                ]
            );

            $sql = "INSERT INTO funcionarios(nome, email, senha, cargo, id_turno, status) VALUES (:nome, :email, :senha, :cargo, :id_turno, :status)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nome', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaHash);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(
                ':id_turno',
                $id_turno,
                $id_turno === null ? PDO::PARAM_NULL : PDO::PARAM_INT
            );
            $stmt->bindParam(':status', $status);

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

            $sql = "SELECT
                        f.*,
                        t.nome_turno,
                        t.horario_inicio,
                        t.horario_fim
                    FROM funcionarios f
                    LEFT JOIN turnos t ON t.id_turno = f.id_turno
                    ORDER BY f.nome ASC";

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

            $sql = "SELECT * FROM funcionarios WHERE email = :email";

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

            $sql = "SELECT id_funcionario, nome, email, cargo, id_turno, status, data_cadastro FROM funcionarios WHERE id_funcionario = :id";

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

            $sql = "SELECT * FROM funcionarios WHERE status = :status ORDER BY nome ASC";

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

            $sql = "UPDATE funcionarios SET status = :status WHERE id_funcionario = :id";

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

            $sql = "DELETE FROM funcionarios WHERE id_funcionario = :id";

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