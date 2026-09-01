<?php

$produtos = [

    [
        "nome" => "Café Expresso",
        "categoria" => "Cafés",
        "preco" => "R$ 4,00",
        "icone" => "☕"
    ],

    [
        "nome" => "Cappuccino Cremoso",
        "categoria" => "Cafés",
        "preco" => "R$ 7,00",
        "icone" => "☕"
    ],

    [
        "nome" => "Café com Leite",
        "categoria" => "Bebidas",
        "preco" => "R$ 5,00",
        "icone" => "🥛"
    ],

    [
        "nome" => "Chocolate Quente",
        "categoria" => "Bebidas",
        "preco" => "R$ 8,00",
        "icone" => "🍫"
    ],

    [
        "nome" => "Pão de Queijo",
        "categoria" => "Salgados",
        "preco" => "R$ 6,00",
        "icone" => "🧀"
    ],

    [
        "nome" => "Croissant",
        "categoria" => "Salgados",
        "preco" => "R$ 9,00",
        "icone" => "🥐"
    ],

    [
        "nome" => "Bolo de Chocolate",
        "categoria" => "Doces",
        "preco" => "R$ 7,00",
        "icone" => "🍰"
    ],

    [
        "nome" => "Cookie",
        "categoria" => "Doces",
        "preco" => "R$ 5,00",
        "icone" => "🍪"
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

    <title>Produtos | Café das 6</title>

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

            <a href="produtos.php" class="ativo">
                ☕ Produtos
            </a>

            <a href="funcionarios.php">
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
                ☕ CARDÁPIO
            </span>


            <h1>
                Produtos da cafeteria
            </h1>


            <p>
                Escolha os produtos disponíveis para realizar
                um novo pedido.
            </p>

        </div>


        <button class="botao-novo-pedido">

            <span class="icone-botao">
                +
            </span>

            Adicionar produto

        </button>


    </section>



    <!-- FILTROS -->

    <section class="filtros">

        <button class="filtro ativo-filtro">

            Todos

        </button>

        <button class="filtro">

            ☕ Cafés

        </button>

        <button class="filtro">

            🥛 Bebidas

        </button>

        <button class="filtro">

            🥐 Salgados

        </button>

        <button class="filtro">

            🍰 Doces

        </button>

    </section>



    <!-- PRODUTOS -->

    <section class="produtos-grid">


        <?php foreach ($produtos as $produto): ?>


            <article class="produto-card">


                <div class="produto-topo">


                    <div class="produto-icone">

                        <?php
                            echo $produto["icone"];
                        ?>

                    </div>


                    <span class="categoria">

                        <?php
                            echo $produto["categoria"];
                        ?>

                    </span>


                </div>



                <h2>

                    <?php
                        echo $produto["nome"];
                    ?>

                </h2>


                <div class="produto-footer">


                    <strong>

                        <?php
                            echo $produto["preco"];
                        ?>

                    </strong>


                    <button class="botao-adicionar">

                        +

                    </button>


                </div>


            </article>


        <?php endforeach; ?>


    </section>


</main>


<script src="src/js/script.js"></script>


</body>
</html>