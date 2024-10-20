<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <link rel="stylesheet" href="css/styles2.css">
    <script src="js/index.js"></script> <!-- Inclui o arquivo JS -->

</head>

<body>
    <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
                <input type="checkbox" class="toggle">
                <span class="slider"></span>
                <span class="card-side"></span>
                <div class="flip-card__inner">
                    <!-- Formulário de Login -->
                    <div class="flip-card__front">
                        <div class="title">Login</div>
                        <form class="flip-card__form" onsubmit="event.preventDefault(); loginUsuario();">
                            <input class="flip-card__input" id="login-email" name="email" placeholder="Email" type="email" required>
                            <input class="flip-card__input" id="login-password" name="password" placeholder="Password" type="password" required>
                            <button class="flip-card__btn" type="submit">Login!</button>
                        </form>
                    </div>

                    <!-- Formulário de Cadastro -->
                    <div class="flip-card__back">
                        <div class="title">Cadastro</div>
                        <form class="flip-card__form" onsubmit="event.preventDefault(); cadastrarUsuario();">
                            <input class="flip-card__input" id="signup-name" placeholder="Nome" type="text" required>
                            <input class="flip-card__input" id="signup-email" name="email" placeholder="Email" type="email" required>
                            <input class="flip-card__input" id="signup-password" name="password" placeholder="Senha" type="password" required>
                            <button class="flip-card__btn" type="submit">Cadastrar!</button>
                        </form>
                    </div>
                </div>
            </label>
        </div>
    </div>
</body>

</html>
