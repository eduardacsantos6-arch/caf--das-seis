
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Sistema da Cafeteria</title>

    <link rel="stylesheet" href="templates/css/login.css">
</head>

<body>

    <main class="login-container">

        <section class="login-card">

            <!-- Logo -->
            <div class="logo">
                ☕
            </div>

            <h1>Cafeteria</h1>

            <p class="subtitle">
                Sistema de Gerenciamento
            </p>

            <!-- Formulário de Login -->
            <form action="login.php" method="POST">

                <div class="form-group">
                    <label for="usuario">Usuário ou E-mail</label>

                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        placeholder="Digite seu usuário ou e-mail"
                        required
                    >
                </div>

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

                <div class="form-options">

                    <label class="remember">
                        <input
                            type="checkbox"
                            name="lembrar"
                        >

                        <span>Lembrar-me</span>
                    </label>

                    <a href="#">Esqueci minha senha</a>

                </div>

                <button type="submit" class="btn-login">
                    Entrar
                </button>

            </form>

            <!-- Cadastro -->
            <div class="register-area">

                <p>Ainda não possui uma conta?</p>

                <a href="View/cadastro.php" class="btn-register">
                    Cadastrar novo usuário
                </a>

            </div>

            <p class="footer-text">
                Sistema interno da cafeteria
            </p>

        </section>

    </main>

</body>
</html>

