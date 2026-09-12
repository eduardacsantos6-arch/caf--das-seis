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
        string $senha,
        string $cargo,
        string $status
    ): string|null
    {
        if (
            empty($nome) ||
            empty($email) ||
            empty($senha) ||
            empty($cargo) ||
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
     * Verifica se a senha é válida
     */
    private function validateSenha(
        string $senha
    ): string|null
    {
        if (strlen($senha) < 6) {

            return "A senha deve ter no mínimo 6 caracteres.";

        }

        return null;
    }


    /**
     * Validação completa dos dados
     */
    public function validateUser(
        string $nome,
        string $email,
        string $senha,
        string $cargo,
        string $status
    ): string|null
    {

        $emptyFields = $this->validateEmptyFields(
            $nome,
            $email,
            $senha,
            $cargo,
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


        $senhaValidation = $this->validateSenha(
            $senha
        );

        if ($senhaValidation !== null) {

            return $senhaValidation;

        }


        return null;
    }


    /**
     * Cadastra um novo funcionário
     *
     * @return string|null Retorna null em caso de sucesso, ou a mensagem de erro
     */
    public function registerUser(
        string $nome,
        string $email,
        string $senha,
        string $cargo,
        ?int $id_turno = null,
        string $status = "Ativo"
    ): ?string
    {

        $validation = $this->validateUser(
            $nome,
            $email,
            $senha,
            $cargo,
            $status
        );


        if ($validation !== null) {

            return $validation;

        }


        if ($this->userModel->getUserbyEmail($email)) {

            return "Este e-mail já está cadastrado.";

        }


        $success = $this->userModel->registerUser(
            $nome,
            $email,
            $senha,
            $cargo,
            $id_turno,
            $status
        );

        return $success ? null : "Não foi possível concluir o cadastro. Tente novamente.";
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