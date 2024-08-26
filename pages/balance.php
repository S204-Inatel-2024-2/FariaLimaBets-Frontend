<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Saldo - Trading Game</title>
</head>
<style>
  #balanceContainer {
    text-align: center;
    margin: 20px;
  }

  #goal {
    font-size: 18px;
    margin-bottom: 10px;
  }

  #glass {
    width: 100%;
    height: 20px;
    background: #c7c7c7;
    border-radius: 10px;
    float: left;
    overflow: hidden;
    margin-bottom: 10px;
  }

  #progress {
    float: left;
    height: 20px;
    background: #FF5D50;
    border-radius: 10px;
    width: 100%;
    /* Inicialmente 100% para saldo total */
  }
</style>

<body>
  <header>
    <h1>Saldo</h1>
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
    <div id="balanceContainer">
      <div id="goal">$10,000</div>
      <div id="glass">
        <div id="progress"></div>
      </div>
      <p>Seu saldo atual é: <span id="currentBalance">$10,000</span></p>
    </div>
  </main>
  <script src="/farialimabets/js/balance.js"></script>
</body>

</html>