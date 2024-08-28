<?php
//cahve da API do polygon.io
$apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";

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
      background: linear-gradient(175deg, rgba(2, 0, 36, 1) 0%, rgba(21, 44, 86, 1) 35%, rgba(0, 143, 172, 1) 100%);
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
      background: rgba(255, 255, 255, 0.8);
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
      transition: 0.3s;
      color: #fff;
      font-weight: 600;
      font-size: 0.875rem;
      line-height: 1.25rem;
      padding: 0.625rem 0.875rem;
      background-color: rgb(99 102 241);
      border-radius: 0.375rem;
      border: none;
      outline: none;
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
      background-color: rgb(1 72 241);
      color: #fff;
      transition: 0.3s;
    }

    label {
      font-size: 20px;
      font-weight: 400;
    }
  </style>
</head>

<body>
  <header>
    <h1>Investimento</h1>
    <nav>
      <ul>
        <li><a href="http://localhost/farialimabets">Home</a></li>
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
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