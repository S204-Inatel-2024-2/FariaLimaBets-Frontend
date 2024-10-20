<?php
//cahve da API do polygon.io
$apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";

$balance = 10000; // Saldo inicial pre-definido

// Lista de tickers predefinidos - AAPL
$tickers = ['AAPL', 'NVDA', 'AMZN', 'GOOGL', 'MSFT'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Gráfico de Ações</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/farialimabets/js/index.js" defer></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: linear-gradient(175deg, rgb(6 1 91 / 90%) 0%, rgb(0 33 95 / 100%) 15%, rgb(129 234 255 / 100%) 100%);
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
    }

    .container {
      padding: 2rem;
      text-align: center;
    }

    .form {
      margin: 1rem auto;
      padding: 1rem;
      max-width: 600px;
      background: #99cdff96;
      border-radius: 10px;
    }

    .form select,
    .form button {
      font-size: 1rem;
      padding: 0.5rem;
      margin: 0.5rem;
    }

    #chart-container {
      width: 80%;
      margin: 2rem auto;
    }

    canvas {
      max-width: 100%;
    }

    button {
      transition: all 0.3s;
      color: #fff;
      font-weight: 600;
      font-size: 0.875rem;
      line-height: 1.25rem;
      padding: 0.625rem 0.875rem;
      margin: 10px 40px 10px 40px;
      height: 40px;
      border-radius: 5px;
      border: 2px solid #fff;
      background-color: rgb(6 1 91 / 90%);
      box-shadow: 4px 4px #fff;
      color: #fff;
      cursor: pointer;
    }

    select {
      transition: 0.3s;
      color: rgb(99 102 241);
      font-weight: 600;
      font-size: 0.875rem;
      line-height: 1.25rem;
      padding: 0.625rem 0.875rem;
      background-color: #fff;
      border-radius: 0.375rem;
      border: none;
      outline: none;
      border: 2px solid rgb(99 102 241);
    }

    button:hover {
      box-shadow: 0 0 0 0 #fff;
      transform: translate(3px, 3px);
    }

    label {
      font-size: 20px;
      font-weight: 400;
      color: #fff;
    }
  </style>
</head>

<body>
  <header>
    <h1>Investimento</h1>
    <nav>
      <ul>
        <!-- <li><a href="http://localhost/farialimabets">Home</a></li> -->
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
        <li><a href="#" onclick="logoutUsuario()">Sair</a></li> <!-- Botão de logout -->
      </ul>
    </nav>
  </header>
  <div class="container">
    <div class="form">
      <label for="ticker-select">Selecione uma empresa:</label>
      <select id="ticker-select">
        <?php foreach ($tickers as $ticker): ?>
          <option value="<?php echo $ticker; ?>"><?php echo $ticker; ?></option>
        <?php endforeach; ?>
      </select>
      <button onclick="loadChart()">Carregar Gráfico</button>
    </div>
    <div id="chart-container">
      <canvas id="stock-chart"></canvas>
    </div>
  </div>
</body>

</html>