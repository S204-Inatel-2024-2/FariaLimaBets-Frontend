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
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/balance.php">Investir</a></li>
        <li><a href="http://localhost/farialimabets/pages/current_data.php">Saldo</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Dados Atuais</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <form id="investForm">
      <label for="ticker">Ticker da Ação:</label>
      <input type="text" id="ticker" name="ticker">

      <label for="amount">Quantidade:</label>
      <input type="number" id="amount" name="amount">

      <button type="submit">Investir</button>
    </form>
  </main>
  <script>
    document.getElementById('investForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Lógica para processar o investimento
      alert('Investimento realizado com sucesso!');
    });
  </script>
</body>

</html>