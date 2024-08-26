document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("investForm");
  const resultMessage = document.getElementById("resultMessage");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Previne o envio padrão do formulário

    const amount = parseFloat(document.getElementById("amount").value);
    let currentBalance = parseFloat(localStorage.getItem("balance"));

    if (amount > currentBalance) {
      resultMessage.textContent = "Saldo insuficiente para o investimento.";
      return;
    }

    const newBalance = currentBalance - amount;
    localStorage.setItem("balance", newBalance);

    resultMessage.textContent = `Investimento realizado com sucesso! Novo saldo: $${newBalance.toLocaleString()}`;
    if (window.updateBalance) {
      window.updateBalance(newBalance); // Atualiza o saldo na página de saldo
    }
  });
});
