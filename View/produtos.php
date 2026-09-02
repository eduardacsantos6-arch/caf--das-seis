

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Produtos | Café das 6</title>

    <link rel="stylesheet" href="../templates/css/global.css">

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

            <a href="home.php">
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


        <button class="botao-novo-pedido"> <a href="../View/cadastro_produto.php">

            <span class="icone-botao">
                +
            </span>

            Adicionar produto
        </a>
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