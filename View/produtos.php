<?php

namespace Model;

use Model\Connection;

use PDO;
use PDOException;

class Produto
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    /**
     * Cadastra um novo produto
     */
    public function registerProduto(
        string $nome,
        string $categoria,
        float $preco,
        string $icone,
        string $status
    ): bool {

        try {

            $sql = "INSERT INTO produtos(
                nome,
                categoria,
                preco,
                icone,
                status
            ) VALUES (
                :nome,
                :categoria,
                :preco,
                :icone,
                :status
            )";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':icone', $icone);
            $stmt->bindParam(':status', $status);

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao cadastrar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca todos os produtos cadastrados
     */
    public function getProdutos()
    {
        try {

            $sql = "SELECT * FROM produtos";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar produtos: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Busca um produto pelo ID
     */
    public function getProdutoById(int $id)
    {
        try {

            $sql = "SELECT * FROM produtos
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Atualiza um produto
     */
    public function updateProduto(
        int $id,
        string $nome,
        string $categoria,
        float $preco,
        string $icone,
        string $status
    ): bool {

        try {

            $sql = "UPDATE produtos SET
                nome = :nome,
                categoria = :categoria,
                preco = :preco,
                icone = :icone,
                status = :status
                WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':icone', $icone);
            $stmt->bindParam(':status', $status);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao atualizar produto: " .
                $error->getMessage()
            );

            return false;
        }
    }


    /**
     * Exclui um produto
     */
    public function deleteProduto(int $id): bool
    {
        try {

            $sql = "DELETE FROM produtos
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(
                ':id',
                $id,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $error) {

            error_log(
                "Erro ao excluir produto: " .
                $error->getMessage()
            );

            return false;
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

    <title>Produtos | Café das 6</title>

    <link
        rel="stylesheet"
        href="../templates/css/global.css"
    >

</head>


<body>


<header class="header">

    <div class="header-container">


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



        <nav class="menu">

            <a href="../View/home.php">
                🏠 Home
            </a>

            <a
                href="../View/produtos.php"
                class="ativo"
            >
                ☕ Produtos
            </a>

            <a href="../View/funcionarios.php">
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


    <!-- TOPO DA PÁGINA -->

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


        <!-- BOTÃO FUNCIONAL -->

        <a
            href="cadastro_produto.php"
            class="botao-novo-pedido"
        >

            <span class="icone-botao">
                +
            </span>

            Adicionar produto

        </a>


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


        <?php if (count($produtos) > 0): ?>


            <?php foreach ($produtos as $produto): ?>


                <article class="produto-card">


                    <div class="produto-topo">


                        <div class="produto-icone">

                            <?php echo $produto["icone"]; ?>

                        </div>


                        <span class="categoria">

                            <?php echo $produto["categoria"]; ?>

                        </span>


                    </div>



                    <h2>

                        <?php echo $produto["nome"]; ?>

                    </h2>



                    <div class="produto-footer">


                        <strong>

                            R$

                            <?php

                            echo number_format(
                                $produto["preco"],
                                2,
                                ",",
                                "."
                            );

                            ?>

                        </strong>



                        <button
                            class="botao-adicionar"
                            type="button"
                        >

                            +

                        </button>


                    </div>


                </article>


            <?php endforeach; ?>


        <?php else: ?>


            <div class="sem-produtos">

                <div class="produto-icone">
                    ☕
                </div>

                <h2>
                    Nenhum produto cadastrado
                </h2>

                <p>
                    Clique em "Adicionar produto" para
                    cadastrar o primeiro produto da cafeteria.
                </p>

            </div>


        <?php endif; ?>


    </section>


</main>


</body>

</html>
