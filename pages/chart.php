<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/farialimabets/css/styles.css">
  <title>Gráficos</title>
</head>
<style>
  .cn {
    max-width: 800px;
  }

  .tl {
    width: 100%;
    text-align: -webkit-center;
  }

  body {
    background: rgb(2, 0, 36);
    background: linear-gradient(175deg, rgba(2, 0, 36, 1) 0%, rgba(21, 44, 86, 1) 35%, rgba(0, 143, 172, 1) 100%);
    height: 900px;
  }
</style>

<body>
  <header>
    <h1>Gráfico do ultimo mês</h1>
    <nav>
      <ul>
        <li><a href="http://localhost/farialimabets">Home</a></li>
        <li><a href="http://localhost/farialimabets/pages/chart.php">Gráficos</a></li>
        <li><a href="http://localhost/farialimabets/pages/invest.php">Investir</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="tl">
      <div class="cn">
        <canvas id="chartCanvas" width="600" height="400"></canvas>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="/farialimabets/js/index.js"></script>
</body>

</html>