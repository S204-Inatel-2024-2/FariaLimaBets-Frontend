<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Gráficos - Trading Game</title>
</head>

<body>
  <header>
    <h1>Gráficos</h1>
    <nav>
      <ul>
        <li><a href="http://localhost/farialimabets">Home</a></li>
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
        <li><a href="http://localhost/farialimabets/pages/balance.php">Saldo</a></li>
        <li><a href="http://localhost/farialimabets/pages/current_data.php">Dados Atuais</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="cn">
      <canvas id="chartCanvas" width="600" height="400"></canvas>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/farialimabets/js/index.js"></script>
</body>

</html>