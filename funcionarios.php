<?php

$funcionariosAtuais = [

    [
        "nome" => "Mariana Souza",
        "cargo" => "Atendente",
        "horario" => "06:00 - 12:00",
        "inicial" => "M"
    ],

    [
        "nome" => "João Oliveira",
        "cargo" => "Barista",
        "horario" => "06:00 - 14:00",
        "inicial" => "J"
    ],

    [
        "nome" => "Carlos Lima",
        "cargo" => "Cozinheiro",
        "horario" => "06:00 - 15:00",
        "inicial" => "C"
    ]

];


$proximoTurno = [

    [
        "nome" => "Ana Martins",
        "cargo" => "Atendente",
        "horario" => "12:00 - 18:00",
        "inicial" => "A"
    ],

    [
        "nome" => "Pedro Santos",
        "cargo" => "Barista",
        "horario" => "14:00 - 20:00",
        "inicial" => "P"
    ],

    [
        "nome" => "Juliana Costa",
        "cargo" => "Cozinheira",
        "horario" => "15:00 - 21:00",
        "inicial" => "J"
    ]

];

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

    <link rel="stylesheet" href="src/css/global.css">

</head>


<body>


<header class="header">

    <div class="header-container">


        <a href="index.php" class="logo">

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



        <nav class="menu">

            <a href="index.php">
                🏠 Home
            </a>

            <a href="produtos.php">
                ☕ Produtos
            </a>

            <a href="funcionarios.php" class="ativo">
                👥 Funcionários
            </a>

        </nav>



        <div class="usuario">

            <div class="avatar">
                F
            </div>

        </div>


    </div>

</header>



<main class="dashboard">


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


        <button class="botao-novo-pedido">

            <span class="icone-botao">
                +
            </span>

            Adicionar funcionário

        </button>


    </section>



    <!-- FUNCIONÁRIOS ATUAIS -->

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


            <?php foreach ($funcionariosAtuais as $funcionario): ?>


                <article class="funcionario-card">


                    <div class="funcionario-card-topo">


                        <div class="avatar grande">

                            <?php
                                echo $funcionario["inicial"];
                            ?>

                        </div>


                        <span class="status-online">

                            ● Trabalhando

                        </span>


                    </div>



                    <h2>

                        <?php
                            echo $funcionario["nome"];
                        ?>

                    </h2>


                    <p class="cargo">

                        <?php
                            echo $funcionario["cargo"];
                        ?>

                    </p>



                    <div class="horario">

                        🕒

                        <?php
                            echo $funcionario["horario"];
                        ?>

                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>



    <!-- PRÓXIMO TURNO -->

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


            <?php foreach ($proximoTurno as $funcionario): ?>


                <article class="funcionario-card proximo-turno">


                    <div class="funcionario-card-topo">


                        <div class="avatar grande">

                            <?php
                                echo $funcionario["inicial"];
                            ?>

                        </div>


                        <span class="status-turno">

                            Próximo turno

                        </span>


                    </div>



                    <h2>

                        <?php
                            echo $funcionario["nome"];
                        ?>

                    </h2>


                    <p class="cargo">

                        <?php
                            echo $funcionario["cargo"];
                        ?>

                    </p>



                    <div class="horario">

                        🕒

                        <?php
                            echo $funcionario["horario"];
                        ?>

                    </div>


                </article>


            <?php endforeach; ?>


        </div>


    </section>


</main>


<script src="src/js/script.js"></script>


</body>

</html>