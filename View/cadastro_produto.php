
<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Model\Produto;
use Model\Categoria;

session_start();

if (!isset($_SESSION["id"])) {

    header("Location: ../index.php");
    exit();

}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $categoriaNome = $_POST["categoria"];
    $preco = (float) $_POST["preco"];
    $descricao = $_POST["descricao"] ?? "";
    $disponivel = isset($_POST["disponivel"]);

    $categoriaModel = new Categoria();
    $id_categoria = $categoriaModel->getOrCreateIdByNome($categoriaNome);

    if ($id_categoria === false) {

        $mensagem = "Não foi possível identificar a categoria selecionada.";

    } else {

        $produtoModel = new Produto();

        $resultado = $produtoModel->registerProduto(
            $nome,
            $descricao !== "" ? $descricao : null,
            $preco,
            $id_categoria,
            $disponivel
        );

        if ($resultado) {

            header("Location: produtos.php");
            exit();

        } else {

            $mensagem = "Não foi possível cadastrar o produto.";

        }
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

    <link
        rel="stylesheet"
        href="../templates/css/cadastro_produto.css"
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


            <!-- DESCRIÇÃO -->

            <div class="form-group">

                <label for="descricao">
                    Descrição (opcional)
                </label>

                <input
                    type="text"
                    id="descricao"
                    name="descricao"
                    placeholder="Ex: Café expresso com leite vaporizado"
                >

            </div>


            <!-- DISPONIBILIDADE -->

            <div class="form-group form-group-checkbox">

                <label for="disponivel">

                    <input
                        type="checkbox"
                        id="disponivel"
                        name="disponivel"
                        checked
                    >

                    Produto disponível para venda

                </label>

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
