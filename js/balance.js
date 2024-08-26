document.addEventListener("DOMContentLoaded", function () {
  const initialAmount = 10000; // Saldo inicial
  let currentAmount = localStorage.getItem("balance");

  if (currentAmount === null) {
    currentAmount = initialAmount;
    localStorage.setItem("balance", currentAmount);
  }

  // Atualiza o texto do saldo atual e a barra de progresso
  document.getElementById(
    "currentBalance"
  ).textContent = `$${currentAmount.toLocaleString()}`;
  document.getElementById("progress").style.width = "100%";

  // Função para atualizar o saldo
  function updateBalance(newBalance) {
    localStorage.setItem("balance", newBalance);
    document.getElementById(
      "currentBalance"
    ).textContent = `$${newBalance.toLocaleString()}`;
    const progressPercentage = (newBalance / initialAmount) * 100;
    document.getElementById("progress").style.width = `${progressPercentage}%`;
  }

  // Exponha a função para ser usada em outros scripts, se necessário
  window.updateBalance = updateBalance;
});
