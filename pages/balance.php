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


<div id="balance">
  Saldo: $<?php echo $balance; ?>
</div>