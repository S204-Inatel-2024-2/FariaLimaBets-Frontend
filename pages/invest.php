<?php
$apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";
$balance = 10000; // Saldo inicial pre-definido

// Função para obter o preço real de uma ação das 5 empresas
function getStockPrice($apiKey, $symbol)
{
  $url = "https://api.polygon.io/v2/aggs/ticker/{$symbol}/prev?apiKey=" . $apiKey;
  $json = file_get_contents($url);
  $data = json_decode($json, true);

  // Verifica se os dados foram retornados com sucesso
  if (isset($data['results'][0]['c'])) {
    return $data['results'][0]['c']; // Preço de fechamento
  } else {
    return null; // Retorna null se não conseguir obter o preço
  }
}

// Obtém o preço de cada ticker
//$tickers = getRelatedCompanies($apiKey);
$tickers = ['AAPL', 'NVDA', 'AMZN', 'GOOGL', 'MSFT'];
$stocks = [];
foreach ($tickers as $ticker) {
  $price = getStockPrice($apiKey, $ticker);
  if ($price !== null) {
    $stocks[] = [
      'symbol' => $ticker,
      'price' => $price
    ];
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Investimento em Ações</title>
  <script src="/farialimabets/js/invest.js"></script>
</head>
<style>
  .layout-text {
    padding: 3rem 7rem 10rem 7rem;
    text-align: -webkit-center;
  }

  .color-bk {
    background: #eeeeee30;
  }

  .h2text {
    font-size: 22px;
    font-weight: 400;
    color: #fff;
    letter-spacing: 1px;
    height: 100px;
    align-content: center;
  }

  h3 {
    font-size: 25px;
    color: #fff;
  }

  .layout-text ul {
    padding: 0 10% 5% 10%;
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3%;
  }

  ul li {
    font-weight: 400;
    color: #fff;
    padding: 5px;
  }

  body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background: linear-gradient(175deg, rgb(6 1 91 / 90%) 0%, rgb(0 33 95 / 100%) 15%, rgb(129 234 255 / 100%) 100%);
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
  }

  /* button */
  .form {
    display: grid;
    flex-direction: column;
    background: #606c88;
    background: -webkit-linear-gradient(to right, #3f4c6b, #606c88);
    background: linear-gradient(to right, #3f4c6b, #606c88);
    padding: 20px;
    max-width: 350px;
    justify-content: center;
    border-radius: 5px;
    border: 2px solid #fff;
    box-shadow: 4px 4px #fff;
  }

  .form input {
    margin: 10px;
    line-height: 1.5rem;
    font-size: 0.875rem;
    flex: 1 1 auto;
    width: 250px;
    height: 40px;
    border-radius: 5px;
    border: 2px solid #fff;
    background-color: #eee;
    box-shadow: 4px 4px #fff;
    font-weight: 600;
    color: #333;
    padding: 5px 10px;
    outline: none;
  }

  .form input::placeholder {
    color: rgb(216, 212, 212);
  }

  .form input:focus {
    border: 1px solid rgb(99 102 241);
  }

  .form button:hover {
    box-shadow: 0 0 0 0 #fff;
    transform: translate(3px, 3px);
  }

  .form span,
  .form input {
    margin-bottom: 10px;
    margin-top: 10px;
  }

  .form button {
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

  .ul-res ul {
    text-align: center;
    grid-template-columns: repeat(1, 1fr);
  }

  .ul-res ul li {
    margin-bottom: 10px;
  }
</style>

<body>
  <header>
    <h1>Investimento - AAPL</h1>
    <nav>
      <ul>
        <!-- <li><a href="http://localhost/farialimabets">Home</a></li> -->
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
        <li><a href="http://localhost/farialimabets">Sair</a></li>
      </ul>
    </nav>
  </header>
  <div class="layout-text">
    <div id="balance" class="h2text">
      <h2>Saldo: $10.000</h2>
    </div>
    <ul id="stock-list">
      <?php foreach ($stocks as $stock): ?>
        <li>
          <div class="form">
            <?php echo $stock['symbol']; ?> - Preço por ação: $<?php echo $stock['price']; ?>
            <input type="hidden" id="price_<?php echo $stock['symbol']; ?>" value="<?php echo $stock['price']; ?>" />
            <input class="" type="number" id="shares_<?php echo $stock['symbol']; ?>" placeholder="Número de ações" min="0" value="0" oninput="calculateInvestment('<?php echo $stock['symbol']; ?>', this.value)" />
            <span id="units_<?php echo $stock['symbol']; ?>"></span>
            <button onclick="invest('<?php echo $stock['symbol']; ?>', document.getElementById('shares_<?php echo $stock['symbol']; ?>').value)">
              Comprar
            </button>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="ul-res" style="margin-top:70px">
      <!-- historico de investimentos -->
      <h3>Investimentos Realizados</h3>
      <ul>
        <li id="investment-list"></li>
      </ul>
    </div>
  </div>
</body>

</html>