<?php

$pedidosAbertos = 4;
$pedidosPreparo = 3;
$pedidosConcluidos = 12;

$pedidos = [

    [
        "numero" => "#1042",
        "cliente" => "Ana Souza",
        "produto" => "Cappuccino",
        "quantidade" => 1,
        "status" => "Em preparo",
        "classe" => "preparo"
    ],

    [
        "numero" => "#1043",
        "cliente" => "João Silva",
        "produto" => "Café Expresso",
        "quantidade" => 2,
        "status" => "Em aberto",
        "classe" => "aberto"
    ],

    [
        "numero" => "#1044",
        "cliente" => "Maria Oliveira",
        "produto" => "Pão de Queijo",
        "quantidade" => 3,
        "status" => "Concluído",
        "classe" => "concluido"
    ],

    [
        "numero" => "#1045",
        "cliente" => "Carlos Santos",
        "produto" => "Chocolate Quente",
        "quantidade" => 1,
        "status" => "Em preparo",
        "classe" => "preparo"
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

    <title>Café das 6 | Dashboard</title>

    <link rel="stylesheet" href="src/css/global.css">

</head>


<body>


<!-- ================= HEADER ================= -->

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

            <a href="index.php" class="ativo">
                🏠 Home
            </a>

            <a href="produtos.php">
                ☕ Produtos
            </a>

            <a href="funcionarios.php">
                👥 Funcionários
            </a>

        </nav>



        <div class="usuario">

            <div class="usuario-info">

                <span class="usuario-nome">
                    Funcionário
                </span>

                <span class="usuario-status">
                    ● Online
                </span>

            </div>

            <div class="avatar">
                F
            </div>

        </div>


    </div>

</header>


<main class="dashboard">


    <section class="hero-dashboard">


        <div>

            <span class="tag">
                ☕ PAINEL PRINCIPAL
            </span>


            <h1>
                Bom dia! Pronto para mais um café?
            </h1>


            <p>
                Acompanhe os pedidos da cafeteria e organize
                as solicitações do dia.
            </p>

        </div>



        <a href="produtos.php" class="botao-novo-pedido">

            <span class="icone-botao">
                +
            </span>

            Criar novo pedido

        </a>


    </section>


    <section class="cards-resumo">


        <article class="card-resumo card-aberto">

            <div class="card-icon">
                📋
            </div>


            <div>

                <span>
                    Pedidos em aberto
                </span>

                <h2>
                    <?php echo $pedidosAbertos; ?>
                </h2>

                <small>
                    Aguardando atendimento
                </small>

            </div>

        </article>



        <article class="card-resumo card-preparo">

            <div class="card-icon">
                ☕
            </div>


            <div>

                <span>
                    Em preparo
                </span>

                <h2>
                    <?php echo $pedidosPreparo; ?>
                </h2>

                <small>
                    Pedidos sendo preparados
                </small>

            </div>

        </article>



        <article class="card-resumo card-concluido">

            <div class="card-icon">
                ✓
            </div>


            <div>

                <span>
                    Concluídos hoje
                </span>

                <h2>
                    <?php echo $pedidosConcluidos; ?>
                </h2>

                <small>
                    Pedidos finalizados
                </small>

            </div>

        </article>


    </section>

    <section class="secao">


        <div class="secao-header">


            <div>

                <span class="titulo-pequeno">
                    MOVIMENTAÇÃO
                </span>

                <h2>
                    Pedidos recentes
                </h2>

            </div>


            <button class="botao-secundario">

                Ver todos →

            </button>


        </div>



        <div class="tabela-container">


            <table>


                <thead>

                    <tr>

                        <th>Pedido</th>

                        <th>Funcionário</th>

                        <th>Produto</th>

                        <th>Quantidade</th>

                        <th>Status</th>

                    </tr>

                </thead>



                <tbody>


                    <?php foreach ($pedidos as $pedido): ?>


                        <tr>


                            <td class="numero-pedido">

                                <?php
                                    echo $pedido["numero"];
                                ?>

                            </td>



                            <td>

                                <div class="funcionario-tabela">

                                    <div class="mini-avatar">

                                        <?php
                                            echo substr(
                                                $pedido["cliente"],
                                                0,
                                                1
                                            );
                                        ?>

                                    </div>


                                    <?php
                                        echo $pedido["cliente"];
                                    ?>

                                </div>

                            </td>



                            <td>

                                ☕

                                <?php
                                    echo $pedido["produto"];
                                ?>

                            </td>



                            <td>

                                <?php
                                    echo $pedido["quantidade"];
                                ?>

                            </td>



                            <td>

                                <span
                                    class="
                                        status
                                        <?php echo $pedido["classe"]; ?>
                                    "
                                >

                                    <?php
                                        echo $pedido["status"];
                                    ?>

                                </span>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                </tbody>


            </table>


        </div>


    </section>

    <section class="grid-inferior">


        <div class="secao pequena-secao">


            <div class="secao-header">

                <div>

                    <span class="titulo-pequeno">
                        HOJE
                    </span>

                    <h2>
                        Resumo do dia
                    </h2>

                </div>

            </div>


            <div class="resumo-dia">


                <div class="resumo-item">

                    <span>
                        ☕ Cafés vendidos
                    </span>

                    <strong>
                        28
                    </strong>

                </div>


                <div class="resumo-item">

                    <span>
                        🥐 Lanches pedidos
                    </span>

                    <strong>
                        19
                    </strong>

                </div>


                <div class="resumo-item">

                    <span>
                        📋 Total de pedidos
                    </span>

                    <strong>
                        19
                    </strong>

                </div>


            </div>


        </div>



        <div class="card-destaque">


            <div class="graos">
                ☕ ☕ ☕
            </div>


            <span>
                CAFÉ DAS 6
            </span>


            <h2>
                Uma pausa fica melhor com café.
            </h2>


            <p>
                Organize seus pedidos e aproveite
                o melhor momento do dia.
            </p>


            <a href="produtos.php">
                Fazer um pedido →

            </a>


        </div>

    </section>

</main>

<script src="src/js/script.js"></script>


</body>
</html>