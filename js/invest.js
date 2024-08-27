let balance = 10000; // Saldo inicial

// Atualizar saldo
function updateBalance(amountSpent) {
  balance -= amountSpent;
  document.getElementById("balance").innerText = `Saldo: $${balance.toFixed(
    2
  )}`;
  document.getElementById("balance").style.fontSize = "35px";
  document.getElementById("balance").style.height = "100px";
}

// Calcular o preço total de ações compradas
function calculateInvestment(stockSymbol, numShares) {
  const stockPrice = parseFloat(
    document.getElementById(`price_${stockSymbol}`).value
  );

  if (numShares > 0) {
    const totalCost = numShares * stockPrice;
    document.getElementById(
      `units_${stockSymbol}`
    ).innerText = ` Custo total para ${numShares} ações: $${totalCost.toFixed(
      2
    )}`;
  } else {
    document.getElementById(`units_${stockSymbol}`).innerText = "";
  }
}

// Investir valor na ação desejada
function invest(stockSymbol, numShares) {
  const stockPrice = parseFloat(
    document.getElementById(`price_${stockSymbol}`).value
  );

  if (numShares <= 0) {
    alert("Número de ações inválido.");
    return;
  }

  const totalCost = numShares * stockPrice;

  if (totalCost > balance) {
    alert("Saldo insuficiente para a compra.");
    return;
  }

  updateBalance(totalCost);

  const investmentList = document.getElementById("investment-list");
  const listItem = document.createElement("li");
  listItem.innerText = `Comprado ${numShares} ações de ${stockSymbol} (Preço por ação: $${stockPrice.toFixed(
    2
  )}, Custo total: $${totalCost.toFixed(2)})`;
  investmentList.appendChild(listItem);

  document.getElementById(`units_${stockSymbol}`).innerText = ""; // Limpa a exibição do custo
}
