<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <link rel="stylesheet" href="css/styles2.css">
    <script>
        // Função para cadastrar um novo usuário
        function cadastrarUsuario() {
            const name = document.getElementById('signup-name').value;
            const email = document.getElementById('signup-email').value;
            const password = document.getElementById('signup-password').value;

            if (!name || !email || !password) {
                alert("Preencha todos os campos para se cadastrar.");
                return;
            }

            fetch('http://localhost:3333/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erro ao cadastrar usuário.');
                    }
                })
                .then(data => {
                    alert('Usuário cadastrado com sucesso!');
                    console.log(data);
                })
                .catch(error => {
                    alert('Ocorreu um erro no cadastro: ' + error.message);
                    console.error('Erro:', error);
                });
        }

        // Função para fazer login
        function loginUsuario() {
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            if (!email || !password) {
                alert("Preencha todos os campos para fazer login.");
                return;
            }

            fetch('http://localhost:3333/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erro ao fazer login.');
                    }
                })
                .then(data => {
                    // Redirecionar para a página invest.php após o sucesso do login
                    window.location.href = '/farialimabets/pages/invest.php';
                })
                .catch(error => {
                    alert('Ocorreu um erro no login: ' + error.message);
                    console.error('Erro:', error);
                });
        }
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
                <input type="checkbox" class="toggle">
                <span class="slider"></span>
                <span class="card-side"></span>
                <div class="flip-card__inner">
                    <div class="flip-card__front">
                        <div class="title">Login</div>
                        <form class="flip-card__form" onsubmit="event.preventDefault(); loginUsuario();">
                            <input class="flip-card__input" id="login-email" name="email" placeholder="Email" type="email">
                            <input class="flip-card__input" id="login-password" name="password" placeholder="Password" type="password">
                            <button class="flip-card__btn" type="submit">Login!</button>
                        </form>
                    </div>
                    <div class="flip-card__back">
                        <div class="title">Signup</div>
                        <form class="flip-card__form" onsubmit="event.preventDefault(); cadastrarUsuario();">
                            <input class="flip-card__input" id="signup-name" placeholder="Name" type="text">
                            <input class="flip-card__input" id="signup-email" name="email" placeholder="Email" type="email">
                            <input class="flip-card__input" id="signup-password" name="password" placeholder="Password" type="password">
                            <button class="flip-card__btn" type="submit">Singup!</button>
                        </form>
                    </div>
                </div>
            </label>
        </div>
    </div>
</body>

</html>