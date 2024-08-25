<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo de Mercado de Ações</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Jogo de Mercado de Ações</h1>
        <div id="game">
            <div class="stock-info">
                <h2>Ação:</h2>
                <select id="stock-select">
                    <option value="MSFT">Microsoft (MSFT)</option>
                    <option value="GOOGL">Alphabet (GOOGL)</option>
                    <option value="AMZN">Amazon (AMZN)</option>
                    <option value="FB">Meta (FB)</option>
                    <option value="NFLX">Netflix (NFLX)</option>
                    <option value="TSLA">Tesla (TSLA)</option>
                </select>
                <p>Preço Atual: $<span id="current-price">0.00</span></p>
            </div>
            <div class="controls">
                <button id="buy-button">Comprar</button>
                <button id="sell-button">Vender</button>
                <p>Dinheiro Disponível: $<span id="available-cash">10000.00</span></p>
                <p>Quantidade de Ações: <span id="stock-quantity">0</span></p>
            </div>
            <div class="history">
                <h3>Histórico de Transações</h3>
                <ul id="transaction-history"></ul>
            </div>
        </div>
    </div>
    <script src="js/index.js"></script>
</body>
</html>
