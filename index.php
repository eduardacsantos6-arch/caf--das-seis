<?php

session_start();

require_once "Model/User.php";

use Model\User;

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["usuario"];
    $senha = $_POST["senha"];

    $userModel = new User();

    $funcionario = $userModel->getUserbyEmail(
        $email
    );


    if ($funcionario) {

        if (password_verify(
            $senha,
            $funcionario["senha"]
        )) {

            $_SESSION["id"] = $funcionario["id"];
            $_SESSION["nome"] = $funcionario["nome"];
            $_SESSION["email"] = $funcionario["email"];
            $_SESSION["cargo"] = $funcionario["cargo"];

            header("Location: View/home.php");

            exit();

        } else {

            $mensagem = "Senha incorreta.";

        }

    } else {

        $mensagem = "Funcionário não encontrado.";

    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Café das 6</title>

    <link
        rel="stylesheet"
        href="templates/css/login.css"
    >

</head>

<body>

    <main class="login-container">

        <section class="login-card">

            <!-- Logo -->

            <div class="logo">
                ☕
            </div>


            <h1>Café das 6</h1>


            <p class="subtitle">
                Sistema de Gerenciamento
            </p>


            <!-- Mensagem de erro -->

            <?php if ($mensagem != "") { ?>

                <p class="mensagem-erro">
                    <?php echo $mensagem; ?>
                </p>

            <?php } ?>


            <!-- Formulário de Login -->

            <form
                action="login.php"
                method="POST"
            >

                <div class="form-group">

                    <label for="usuario">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="usuario"
                        name="usuario"
                        placeholder="Digite seu e-mail"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="senha">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>


                <div class="form-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="lembrar"
                        >

                        <span>
                            Lembrar-me
                        </span>

                    </label>

                    <a href="#">
                        Esqueci minha senha
                    </a>

                </div>


                <button
                    type="submit"
                    class="btn-login"
                >
                    Entrar
                </button>

            </form>


            <!-- Cadastro -->

            <div class="register-area">

                <p>
                    Ainda não possui uma conta?
                </p>

                <a
                    href="View/cadastro.php"
                    class="btn-register"
                >
                    Cadastrar novo usuário
                </a>

            </div>


            <p class="footer-text">
                Sistema interno do Café das 6
            </p>

        </section>

    </main>

</body>

</html>