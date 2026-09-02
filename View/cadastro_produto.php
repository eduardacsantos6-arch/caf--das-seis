```php
<?php

require_once "../Model/Produto.php";

use Model\Produto;

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $preco = $_POST["preco"];
    $icone = $_POST["icone"];
    $status = $_POST["status"];

    $produtoModel = new Produto();

    $resultado = $produtoModel->createProduto(
        $nome,
        $categoria,
        $preco,
        $icone,
        $status
    );

    if ($resultado) {

        header("Location: produtos.php");
        exit();

    } else {

        $mensagem = "Não foi possível cadastrar o produto.";
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

    <title>Cadastro de Produto | Café das 6</title>

    <link
        rel="stylesheet"
        href="../templates/css/global.css"
    >

</head>

<body>

<main class="cadastro-container">

    <section class="cadastro-card">

        <div class="logo">
            ☕
        </div>

        <h1>
            Cadastro de Produto
        </h1>

        <p class="subtitle">
            Cadastre um novo produto no cardápio
        </p>


        <?php if ($mensagem != ""): ?>

            <p class="mensagem-erro">
                <?php echo $mensagem; ?>
            </p>

        <?php endif; ?>


        <form
            action="cadastro_produto.php"
            method="POST"
        >

            <!-- NOME -->

            <div class="form-group">

                <label for="nome">
                    Nome do produto
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Ex: Cappuccino"
                    required
                >

            </div>


            <!-- CATEGORIA -->

            <div class="form-group">

                <label for="categoria">
                    Categoria
                </label>

                <select
                    id="categoria"
                    name="categoria"
                    required
                >

                    <option value="">
                        Selecione uma categoria
                    </option>

                    <option value="Cafés">
                        ☕ Cafés
                    </option>

                    <option value="Bebidas">
                        🥛 Bebidas
                    </option>

                    <option value="Salgados">
                        🥐 Salgados
                    </option>

                    <option value="Doces">
                        🍰 Doces
                    </option>

                </select>

            </div>


            <!-- PREÇO -->

            <div class="form-group">

                <label for="preco">
                    Preço
                </label>

                <input
                    type="number"
                    id="preco"
                    name="preco"
                    step="0.01"
                    min="0"
                    placeholder="Ex: 8.50"
                    required
                >

            </div>


            <!-- ÍCONE -->

            <div class="form-group">

                <label for="icone">
                    Ícone do produto
                </label>

                <select
                    id="icone"
                    name="icone"
                    required
                >

                    <option value="">
                        Selecione um ícone
                    </option>

                    <option value="☕">
                        ☕ Café
                    </option>

                    <option value="🥛">
                        🥛 Bebida
                    </option>

                    <option value="🥐">
                        🥐 Salgado
                    </option>

                    <option value="🍰">
                        🍰 Doce
                    </option>

                    <option value="🧃">
                        🧃 Suco
                    </option>

                </select>

            </div>


            <!-- STATUS -->

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option value="Disponível">
                        Disponível
                    </option>

                    <option value="Indisponível">
                        Indisponível
                    </option>

                </select>

            </div>


            <!-- BOTÃO -->

            <button
                type="submit"
                class="btn-cadastrar"
            >
                Cadastrar produto
            </button>

        </form>


        <!-- VOLTAR -->

        <div class="back-login">

            <a href="produtos.php">
                ← Voltar para produtos
            </a>

        </div>

    </section>

</main>

</body>

</html>
```
