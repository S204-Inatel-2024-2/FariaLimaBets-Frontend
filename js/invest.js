let balance = 10000; // Saldo inicial

//atualizar saldo 
function updateBalance(amountSpent) {
  balance -= amountSpent;
  document.getElementById("balance").innerText = `Saldo: $${balance.toFixed(
    2
  )}`;
  document.getElementById("balance").style.fontSize = "35px";
  document.getElementById("balance").style.height = "100px";
}

//calcular o preco por cada ação
function calculateInvestment(stockSymbol) {
  const stockPrice = parseFloat(
    document.getElementById(`price_${stockSymbol}`).value
  );
  const investmentAmount = parseFloat(
    document.getElementById(`amount_${stockSymbol}`).value
  );

  if (investmentAmount > 0) {
    const unitsBought = investmentAmount / stockPrice;
    document.getElementById(
      `units_${stockSymbol}`
    ).innerText = ` Ações compradas: ${unitsBought.toFixed(2)}`;
  } else {
    document.getElementById(`units_${stockSymbol}`).innerText = "";
  }
}

//investir valor na ação desejada 
function invest(stockSymbol) {
  const investmentAmount = parseFloat(
    document.getElementById(`amount_${stockSymbol}`).value
  );
  const stockPrice = parseFloat(
    document.getElementById(`price_${stockSymbol}`).value
  );

  if (investmentAmount > balance || investmentAmount <= 0) {
    alert("Valor inválido para investimento.");
    return;
  }

  const unitsBought = investmentAmount / stockPrice;
  updateBalance(investmentAmount);

  const investmentList = document.getElementById("investment-list");
  const listItem = document.createElement("li");
  listItem.innerText = `Investido $${investmentAmount.toFixed(
    2
  )} em ${stockSymbol} (Preço: $${stockPrice.toFixed(
    2
  )}, Ações compradas: ${unitsBought.toFixed(4)})`;
  investmentList.appendChild(listItem);

  document.getElementById(`amount_${stockSymbol}`).value = ""; // Limpa o campo de entrada
  document.getElementById(`units_${stockSymbol}`).innerText = ""; // Limpa a exibição das ações compradas
}
