<?php
$apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";
$balance = 10000; // Saldo inicial

// Função para obter os dados das empresas relacionadas à AAPL
function getStockData($apiKey)
{
  $url = "https://api.polygon.io/v1/related-companies/AAPL?apiKey=" . $apiKey;

  $json = file_get_contents($url);
  $data = json_decode($json, true);

  $stocks = [];
  foreach ($data['results'] as $stock) {
    $stocks[] = [
      'symbol' => $stock['ticker'],
      'price' => rand(10, 500) // Simulando preços das ações
    ];
  }

  return $stocks;
}

$stocks = getStockData($apiKey);
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
    padding: 3rem 15rem 10rem 15rem;
    text-align: -webkit-center;
  }

  .color-bk {
    background: #eeeeee30;
  }

  .h2text,
  .balance {
    font-size: 22px;
    font-weight: 400;
    color: #fff;
    padding: 30px;
    letter-spacing: 1px;
  }

  h2 {
    font-weight: 400;
    color: #fff;
    padding: 30px;
    letter-spacing: 1px;
  }

  h3 {
    color: #fff;
  }

  .layout-text ul {
    padding: 0 10% 5% 10%;
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3%;
  }

  ul li {
    font-weight: 400;
    color: #fff;
    padding: 5px;
  }

  body {
    background: #fff url('/FariaLimaBets/images/banner2.jpg') no-repeat center center;
  }

  /* button */
  .form {
    display: grid;
    flex-direction: column;
    background: #606c88;
    background: -webkit-linear-gradient(to right, #3f4c6b, #606c88);
    background: linear-gradient(to right, #3f4c6b, #606c88);
    padding: 20px;
    border-radius: 10px;
    max-width: 350px;
    justify-content: center;
  }

  .form input {
    margin: 10px;
    outline: none;
    line-height: 1.5rem;
    font-size: 0.875rem;
    color: rgb(255 255 255);
    padding: 0.5rem 0.875rem;
    background-color: rgb(255 255 255 / 0.05);
    border: 1px solid rgba(253, 253, 253, 0.363);
    border-radius: 0.375rem;
    flex: 1 1 auto;
  }

  .form input::placeholder {
    color: rgb(216, 212, 212);
  }

  .form input:focus {
    border: 1px solid rgb(99 102 241);
  }

  .form button {
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
</style>

<body>
  <header>
    <h1>Investimento - APPL</h1>
    <nav>
      <ul>
        <li><a href="http://localhost/farialimabets">Home</a></li>
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
        <!-- <li><a href="http://localhost/farialimabets/pages/current_data.php">Dados Atuais</a></li> -->
      </ul>
    </nav>
  </header>
  <div class="layout-text">
    <div id="balance" class="h2text">
      <h2> Saldo: $<?php echo $balance; ?></h2>
    </div>
    <ul id="stock-list">
      <?php foreach ($stocks as $stock): ?>
        <li>
          <div class="form">
            (<?php echo $stock['symbol']; ?>) - Preço por ação: $<?php echo $stock['price']; ?>
            <input type="hidden" id="price_<?php echo $stock['symbol']; ?>" value="<?php echo $stock['price']; ?>" />
            <input class="" type="number" id="amount_<?php echo $stock['symbol']; ?>" placeholder="Valor a investir" min="0" max="<?php echo $balance; ?>" oninput="calculateInvestment('<?php echo $stock['symbol']; ?>')" />
            <span id="units_<?php echo $stock['symbol']; ?>"></span>
            <button onclick="invest('<?php echo $stock['symbol']; ?>')">
              Investir
            </button>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <div>
      <h2 style="margin-top:50px">Investimentos Realizados</h2>
      <ul id="investment-list">
        <!-- Investimentos serão listados aqui -->
      </ul>
    </div>
  </div>
</body>

</html>