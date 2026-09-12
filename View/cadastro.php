<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Controller\UserController;
use Model\Turno;

$mensagem = "";
$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cargo = $_POST["setor"];
    $senha = $_POST["senha"];
    $status = $_POST["status"] ?? "";
    $id_turno = !empty($_POST["id_turno"]) ? (int) $_POST["id_turno"] : null;

    $userController = new UserController();

    $erro = $userController->registerUser(
        $nome,
        $email,
        $senha,
        $cargo,
        $id_turno,
        $status
    );

    if ($erro === null) {

        $mensagem = "Cadastro realizado com sucesso!";
        $sucesso = true;

    } else {

        $mensagem = $erro;

    }
}

$turnoModel = new Turno();
$turnos = $turnoModel->getTurnos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro | Café das 6</title>

    <link rel="stylesheet" href="../templates/css/cadastro.css">

</head>


<body class="pagina-login">


    <main class="container">


        <section class="card-login">


            <div class="logo">

                <div class="icone-cafe">
                    ☕
                </div>

                <h1>Café das 6</h1>

                <p>Cadastro de Funcionário</p>

            </div>


            <h2>Crie sua conta</h2>


            <?php if ($mensagem != ""): ?>

                <div class="mensagem <?php echo $sucesso ? "sucesso" : "erro"; ?>">

                    <?php echo $mensagem; ?>

                </div>

            <?php endif; ?>


            <form method="POST">


                <div class="campo">

                    <label for="nome">
                        Nome completo
                    </label>

                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

                </div>



                <div class="campo">

                    <label for="email">
                        E-mail
                    </label>

                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

                </div>



                <div class="campo">

                    <label for="setor">
                        Setor
                    </label>

                    <select id="setor" name="setor" required>

                        <option value="">
                            Selecione seu setor
                        </option>

                        <option value="Administrativo">
                            Administrativo
                        </option>

                        <option value="Tecnologia">
                            Tecnologia
                        </option>

                        <option value="Produção">
                            Produção
                        </option>

                        <option value="Recursos Humanos">
                            Recursos Humanos
                        </option>

                        <option value="Financeiro">
                            Financeiro
                        </option>

                    </select>

                </div>



                <div class="campo">

                    <label for="status">
                        Situação
                    </label>

                    <select id="status" name="status" required>

                        <option value="">
                            Selecione a situação
                        </option>

                        <option value="Trabalhando">
                            Já está trabalhando
                        </option>

                        <option value="Próximo turno">
                            Entra em um próximo turno
                        </option>

                    </select>

                </div>



                <div class="campo">

                    <label for="id_turno">
                        Turno (opcional)
                    </label>

                    <select id="id_turno" name="id_turno">

                        <option value="">
                            Sem turno definido
                        </option>

                        <?php foreach ($turnos as $turno): ?>

                            <option value="<?php echo (int) $turno["id_turno"]; ?>">

                                <?php
                                echo htmlspecialchars($turno["nome_turno"]);
                                echo " (";
                                echo substr($turno["horario_inicio"], 0, 5);
                                echo " às ";
                                echo substr($turno["horario_fim"], 0, 5);
                                echo ")";
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>



                <div class="campo">

                    <label for="senha">
                        Crie uma senha
                    </label>

                    <input type="password" id="senha" name="senha" placeholder="Digite uma senha" required>

                </div>



                <button type="submit" class="botao">

                    Cadastrar

                </button>


            </form>



            <p class="link">

                Já possui uma conta?

                <a href="../index.php">
                    Fazer login
                </a>

            </p>


        </section>


    </main>


</body>

</html>