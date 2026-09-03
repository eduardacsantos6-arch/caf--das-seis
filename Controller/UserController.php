<?php

namespace Controller;

use Model\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    /**
     * Verifica se existem campos vazios
     */
    private function validateEmptyFields(
        string $nome,
        string $email,
        string $telefone,
        string $cargo,
        int $turno_id,
        string $status
    ): string|null
    {
        if (
            empty($nome) ||
            empty($email) ||
            empty($telefone) ||
            empty($cargo) ||
            empty($turno_id) ||
            empty($status)
        ) {

            return "Todos os campos devem ser preenchidos.";

        }

        return null;
    }


    /**
     * Verifica se o e-mail é válido
     */
    private function validateEmail(
        string $email
    ): string|null
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return "Digite um e-mail válido.";

        }

        return null;
    }


    /**
     * Verifica se o turno é válido
     */
    private function validateTurno(
        int $turno_id
    ): string|null
    {
        if ($turno_id <= 0) {

            return "Selecione um turno válido.";

        }

        return null;
    }


    /**
     * Validação completa dos dados
     */
    public function validateUser(
        string $nome,
        string $email,
        string $telefone,
        string $cargo,
        int $turno_id,
        string $status
    ): string|null
    {

        $emptyFields = $this->validateEmptyFields(
            $nome,
            $email,
            $telefone,
            $cargo,
            $turno_id,
            $status
        );

        if ($emptyFields !== null) {

            return $emptyFields;

        }


        $emailValidation = $this->validateEmail(
            $email
        );

        if ($emailValidation !== null) {

            return $emailValidation;

        }


        $turnoValidation = $this->validateTurno(
            $turno_id
        );

        if ($turnoValidation !== null) {

            return $turnoValidation;

        }


        return null;
    }


    /**
     * Cadastra um novo funcionário
     */
    public function registerUser(
        string $nome,
        string $email,
        string $telefone,
        string $cargo,
        int $turno_id,
        string $status,
        string $data_cadastro
    ): bool
    {

        $validation = $this->validateUser(
            $nome,
            $email,
            $telefone,
            $cargo,
            $turno_id,
            $status
        );


        if ($validation !== null) {

            return false;

        }


        return $this->userModel->registerUser(
            $nome,
            $email,
            $telefone,
            $cargo,
            $turno_id,
            $status,
            $data_cadastro
        );
    }


    /**
     * Busca todos os funcionários
     */
    public function getFuncionarios()
    {
        return $this->userModel->getFuncionarios();
    }


    /**
     * Busca funcionário pelo e-mail
     */
    public function getUserByEmail(
        string $email
    )
    {
        return $this->userModel->getUserbyEmail(
            $email
        );
    }


    /**
     * Busca informações de um funcionário
     */
    public function getUserInfo(
        int $id
    )
    {
        return $this->userModel->getUserInfo(
            $id
        );
    }
}