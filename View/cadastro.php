
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro | Sistema da Cafeteria</title>

    <link rel="stylesheet" href="../templates/css/cadastro.css">
</head>

<body>

    <main class="cadastro-container">

        <section class="cadastro-card">

            <!-- Logo -->
            <div class="logo">
                ☕
            </div>

            <h1>Criar conta</h1>

            <p class="subtitle">
                Cadastre um novo usuário no sistema
            </p>

            <form action="cadastro.php" method="POST">

                <!-- Nome -->
                <div class="form-group">
                    <label for="nome">Nome completo</label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        placeholder="Digite seu nome completo"
                        required
                    >
                </div>

                <!-- Usuário -->
                <div class="form-group">
                    <label for="usuario">Nome de usuário</label>

                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        placeholder="Digite seu nome de usuário"
                        required
                    >
                </div>

                <!-- E-mail -->
                <div class="form-group">
                    <label for="email">E-mail</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu e-mail"
                        required
                    >
                </div>

                <!-- Senha -->
                <div class="form-group">
                    <label for="senha">Senha</label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <!-- Confirmar senha -->
                <div class="form-group">
                    <label for="confirmar_senha">
                        Confirmar senha
                    </label>

                    <input
                        type="password"
                        id="confirmar_senha"
                        name="confirmar_senha"
                        placeholder="Digite a senha novamente"
                        required
                    >
                </div>

                <!-- Botão -->
                <button type="submit" class="btn-cadastrar">
                    Criar usuário
                </button>

            </form>

            <!-- Voltar -->
            <div class="back-login">

                <a href="../index.html">
                    ← Voltar para o login
                </a>

            </div>

        </section>

    </main>

</body>
</html>
