<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Model\Connection;

session_start();

if (!isset($_SESSION["id"])) {

    header("Location: ../index.php");
    exit();

}

$nomeUsuario = $_SESSION["nome"] ?? "";
$inicialUsuario = $nomeUsuario !== "" ? mb_strtoupper(mb_substr($nomeUsuario, 0, 1)) : "?";

$db = Connection::getInstance();

// Contagem de pedidos em aberto (aguardando atendimento)
$stmt = $db->prepare(
    "SELECT COUNT(*) FROM pedidos WHERE status IN ('Em aberto', 'Pendente')"
);
$stmt->execute();
$pedidosAbertos = (int) $stmt->fetchColumn();

// Contagem de pedidos em preparo
$stmt = $db->prepare(
    "SELECT COUNT(*) FROM pedidos WHERE status = 'Em preparo'"
);
$stmt->execute();
$pedidosPreparo = (int) $stmt->fetchColumn();

// Contagem de pedidos concluídos hoje
$stmt = $db->prepare(
    "SELECT COUNT(*) FROM pedidos WHERE status = 'Concluído' AND DATE(data_pedido) = CURDATE()"
);
$stmt->execute();
$pedidosConcluidos = (int) $stmt->fetchColumn();

// Mapa de status -> classe CSS usada em home.css (.status.aberto / .preparo / .concluido)
$classePorStatus = [
    "Em aberto"   => "aberto",
    "Pendente"    => "aberto",
    "Em preparo"  => "preparo",
    "Concluído"   => "concluido",
];

// Itens de pedido mais recentes, com nome do funcionário e do produto
$stmt = $db->prepare(
    "SELECT
        p.id_pedido,
        f.nome AS cliente,
        pr.nome AS produto,
        ip.quantidade,
        p.status
    FROM itens_pedido ip
    INNER JOIN pedidos p ON p.id_pedido = ip.id_pedido
    INNER JOIN funcionarios f ON f.id_funcionario = p.id_funcionario
    INNER JOIN produtos pr ON pr.id_produto = ip.id_produto
    ORDER BY p.data_pedido DESC
    LIMIT 8"
);
$stmt->execute();
$itensRecentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pedidos = array_map(function ($item) use ($classePorStatus) {

    return [
        "numero"     => "#" . $item["id_pedido"],
        "cliente"    => $item["cliente"],
        "produto"    => $item["produto"],
        "quantidade" => $item["quantidade"],
        "status"     => $item["status"],
        "classe"     => $classePorStatus[$item["status"]] ?? "aberto",
    ];

}, $itensRecentes);

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

    <link rel="stylesheet" href="../templates/css/global.css">
    <link rel="stylesheet" href="../templates/css/home.css">

</head>


<body>


<!-- ================= HEADER ================= -->

<header class="header">

    <div class="header-container">


        <a href="../index.php" class="logo">

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
                <?php echo htmlspecialchars($inicialUsuario); ?>
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
                                            echo htmlspecialchars(
                                                substr($pedido["cliente"], 0, 1)
                                            );
                                        ?>

                                    </div>


                                    <?php
                                        echo htmlspecialchars($pedido["cliente"]);
                                    ?>

                                </div>

                            </td>



                            <td>

                                ☕

                                <?php
                                    echo htmlspecialchars($pedido["produto"]);
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
                                        echo htmlspecialchars($pedido["status"]);
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

</body>
</html>