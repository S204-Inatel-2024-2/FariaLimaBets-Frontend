<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Investir - Trading Game</title>
</head>

<body>
  <header>
    <h1>Investir</h1>
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
    <form id="investForm">
      <label for="amount">Quantidade (em USD):</label>
      <input type="number" id="amount" name="amount" min="1" required>
      <button type="submit">Investir</button>
    </form>
    <div id="resultMessage"></div>
  </main>
  <script src="/farialimabets/js/invest.js"></script>
</body>

</html>