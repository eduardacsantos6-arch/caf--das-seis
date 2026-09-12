<?php

require_once __DIR__ . "/../Model/User.php";

use Model\User;

session_start();

if (!isset($_SESSION["id"])) {

    header("Location: ../index.php");
    exit();

}

$nomeUsuario = $_SESSION["nome"] ?? "";
$inicialUsuario = $nomeUsuario !== "" ? mb_strtoupper(mb_substr($nomeUsuario, 0, 1, "UTF-8"), "UTF-8") : "?";

$userModel = new User();


/*
|--------------------------------------------------------------------------
| BUSCAR FUNCIONÁRIOS
|--------------------------------------------------------------------------
*/

$funcionarios = $userModel->getFuncionarios();

if ($funcionarios === false) {
    $funcionarios = [];
}


/*
|--------------------------------------------------------------------------
| SEPARAR FUNCIONÁRIOS POR TURNO
|--------------------------------------------------------------------------
*/

$funcionariosAtuais = [];
$proximoTurno = [];

foreach ($funcionarios as $funcionario) {

    /*
    |--------------------------------------------------------------
    | Cria a inicial do funcionário
    |--------------------------------------------------------------
    */

    $inicial = mb_strtoupper(
        mb_substr(
            $funcionario["nome"],
            0,
            1,
            "UTF-8"
        ),
        "UTF-8"
    );

    $funcionario["inicial"] = $inicial;


    /*
    |--------------------------------------------------------------
    | Horário
    |
    | Vem do JOIN com a tabela turnos (nome_turno, horario_inicio,
    | horario_fim). Se o funcionário não tiver turno definido,
    | mostramos uma mensagem padrão.
    |--------------------------------------------------------------
    */

    if (!empty($funcionario["nome_turno"])) {

        $funcionario["horario"] = sprintf(
            "%s (%s às %s)",
            $funcionario["nome_turno"],
            substr($funcionario["horario_inicio"], 0, 5),
            substr($funcionario["horario_fim"], 0, 5)
        );

    } else {

        $funcionario["horario"] = "Sem turno definido";

    }


    /*
    |--------------------------------------------------------------
    | SEPARAR POR STATUS
    |--------------------------------------------------------------
    */

    if ($funcionario["status"] === "Trabalhando") {

        $funcionariosAtuais[] = $funcionario;

    } elseif ($funcionario["status"] === "Próximo turno") {

        $proximoTurno[] = $funcionario;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Funcionários | Café das 6</title>

    <link
        rel="stylesheet"
        href="../templates/css/global.css"
    >

    <link
        rel="stylesheet"
        href="../templates/css/home.css"
    >

    <link
        rel="stylesheet"
        href="../templates/css/funcionarios.css"
    >

</head>


<body>


<header class="header">

    <div class="header-container">


        <!-- LOGO -->

        <a href="home.php" class="logo">

            <div class="logo-icon">
                ☕
            </div>

            <div>

                <span class="logo-title">
                    Café das 6
                </span>

                <span class="logo-subtitle">
                    CAFETERIA
                </span>

            </div>

        </a>


        <!-- MENU -->

        <nav class="menu">

            <a href="home.php">
                🏠 Home
            </a>

            <a href="produtos.php">
                ☕ Produtos
            </a>

            <a
                href="funcionarios.php"
                class="ativo"
            >
                👥 Funcionários
            </a>

        </nav>


        <!-- USUÁRIO -->

        <div class="usuario">

            <div class="avatar">
                <?php echo htmlspecialchars($inicialUsuario); ?>
            </div>

        </div>


    </div>

</header>



<main class="dashboard">


    <!-- ============================================
         TOPO DA PÁGINA
    ============================================= -->

    <section class="pagina-topo">

        <div>

            <span class="tag">
                👥 EQUIPE
            </span>

            <h1>
                Funcionários
            </h1>

            <p>
                Acompanhe quem está trabalhando agora
                e os próximos turnos.
            </p>

        </div>


        <!-- BOTÃO PARA CADASTRAR FUNCIONÁRIO -->

        <a
            href="cadastro.php"
            class="botao-novo-pedido"
        >

            <span class="icone-botao">
                +
            </span>

            Adicionar funcionário

        </a>

    </section>



    <!-- ============================================
         FUNCIONÁRIOS ATUAIS
    ============================================= -->

    <section class="secao">


        <div class="secao-header">

            <div>

                <span class="titulo-pequeno">
                    TURNO ATUAL
                </span>

                <h2>
                    🟢 Trabalhando agora
                </h2>

            </div>


            <span class="contador">

                <?php echo count($funcionariosAtuais); ?>

                funcionários

            </span>

        </div>



        <div class="funcionarios-grid">


            <?php if (count($funcionariosAtuais) > 0): ?>


                <?php foreach ($funcionariosAtuais as $funcionario): ?>


                    <article class="funcionario-card">


                        <div class="funcionario-card-topo">


                            <div class="avatar grande">

                                <?php
                                echo htmlspecialchars(
                                    $funcionario["inicial"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>

                            </div>


                            <span class="status-online">

                                ● Trabalhando

                            </span>


                        </div>



                        <h2>

                            <?php
                            echo htmlspecialchars(
                                $funcionario["nome"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </h2>



                        <p class="cargo">

                            <?php
                            echo htmlspecialchars(
                                $funcionario["cargo"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </p>



                        <div class="horario">

                            🕒

                            <?php
                            echo htmlspecialchars(
                                $funcionario["horario"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </div>


                    </article>


                <?php endforeach; ?>


            <?php else: ?>


                <p class="sem-funcionarios">

                    Nenhum funcionário está trabalhando
                    no momento.

                </p>


            <?php endif; ?>


        </div>


    </section>



    <!-- ============================================
         PRÓXIMO TURNO
    ============================================= -->

    <section class="secao">


        <div class="secao-header">


            <div>

                <span class="titulo-pequeno">
                    PRÓXIMO TURNO
                </span>

                <h2>
                    🕒 Entrando mais tarde
                </h2>

            </div>


        </div>



        <div class="funcionarios-grid">


            <?php if (count($proximoTurno) > 0): ?>


                <?php foreach ($proximoTurno as $funcionario): ?>


                    <article class="funcionario-card proximo-turno">


                        <div class="funcionario-card-topo">


                            <div class="avatar grande">

                                <?php
                                echo htmlspecialchars(
                                    $funcionario["inicial"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>

                            </div>


                            <span class="status-turno">

                                Próximo turno

                            </span>


                        </div>



                        <h2>

                            <?php
                            echo htmlspecialchars(
                                $funcionario["nome"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </h2>



                        <p class="cargo">

                            <?php
                            echo htmlspecialchars(
                                $funcionario["cargo"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </p>



                        <div class="horario">

                            🕒

                            <?php
                            echo htmlspecialchars(
                                $funcionario["horario"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>

                        </div>


                    </article>


                <?php endforeach; ?>


            <?php else: ?>


                <p class="sem-funcionarios">

                    Não há funcionários cadastrados
                    para o próximo turno.

                </p>


            <?php endif; ?>


        </div>


    </section>


</main>


</body>

</html>