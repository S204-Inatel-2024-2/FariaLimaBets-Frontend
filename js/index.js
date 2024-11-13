// Variável para armazenar a instância do gráfico de ações
let stockChart;

// Saldo inicial (para ser atualizado a partir do backend)
let balance = 0; // Inicializado em zero, será atualizado após o login

// =============================== LOGIN & AUTENTICAÇÃO ===============================

// Função para cadastrar um novo usuário
async function cadastrarUsuario() {
  const name = document.getElementById("signup-name").value;
  const email = document.getElementById("signup-email").value;
  const password = document.getElementById("signup-password").value;

  if (!name || !email || !password) {
    alert("Preencha todos os campos para se cadastrar.");
    return;
  }

  try {
    const response = await fetch("http://localhost:3333/users", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, email, password }),
    });

    if (response.ok) {
      const data = await response.json();
      alert("Usuário cadastrado com sucesso!");
      console.log(data);
    } else {
      const errorData = await response.json();
      throw new Error(errorData.message || "Erro ao cadastrar usuário.");
    }
  } catch (error) {
    alert("Ocorreu um erro no cadastro: " + error.message);
    console.error("Erro:", error);
  }
}

// Função para fazer login
async function loginUsuario() {
  const email = document.getElementById("login-email").value;
  const password = document.getElementById("login-password").value;

  if (!email || !password) {
    alert("Preencha todos os campos para fazer login.");
    return;
  }

  try {
    const response = await fetch("http://localhost:3333/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }),
    });

    if (response.ok) {
      const data = await response.json();
      localStorage.setItem("jwt_token", data.data.jwt_token);
      localStorage.setItem("user_email", email);
      localStorage.setItem("user_password", password);

      //await getSaldoUsuario(); // Chama a função para obter o saldo após o login
      alert("Login realizado com sucesso!");
      window.location.href = "/farialimabets/pages/invest.php"; // Redireciona
    } else {
      const errorData = await response.json();
      throw new Error(errorData.message || "Erro ao fazer login.");
    }
  } catch (error) {
    alert("Ocorreu um erro no login: " + error.message);
    console.error("Erro:", error);
  }
}

// Função para obter o saldo do usuário logado (usando o token JWT)
async function getSaldoUsuario() {
  const token = localStorage.getItem("jwt_token");

  if (!token) {
    alert("Usuário não autenticado.");
    return;
  }

  try {
    const response = await fetch("http://localhost:3333/me", {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
    });

    if (response.ok) {
      const data = await response.json();
      balance = data.data.wallet.value; // Corrigido para acessar o valor do saldo
      const balanceElement = document
        .getElementById("balance")
        .querySelector("h2");
      if (balanceElement) {
        balanceElement.innerText = `Saldo: $${balance
          .toFixed(2)
          .replace(".", ",")}`;
      } else {
        console.error("Elemento <h2> não encontrado.");
      }
    } else {
      const errorData = await response.json();
      throw new Error(errorData.message || "Erro ao obter saldo.");
    }
  } catch (error) {
    alert("Erro ao obter saldo: " + error.message);
    console.error("Erro:", error);
  }
}

// =============================== AÇÕES & INVESTIMENTOS ===============================

// Atualizar saldo (frontend)
function updateBalance(amountSpent) {
  balance -= amountSpent;
  const balanceElement = document.getElementById("balance").querySelector("h2");
  if (balanceElement) {
    balanceElement.innerText = `Saldo: $${balance
      .toFixed(2)
      .replace(".", ",")}`;
  }
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
    ).innerText = `Custo total para ${numShares} ações: $${totalCost.toFixed(
      2
    )}`;
  } else {
    document.getElementById(`units_${stockSymbol}`).innerText = "";
  }
}

// Função para investir em ações
async function invest(stockSymbol, numShares) {
  numShares = parseInt(numShares, 10); // Garante que numShares seja um número inteiro

  const token = localStorage.getItem("jwt_token");

  if (!token) {
    alert("Usuário não autenticado.");
    return;
  }

  const stockPrice = parseFloat(document.getElementById(`price_${stockSymbol}`).value);
  const totalCost = stockPrice * numShares;

  if (numShares <= 0 || isNaN(totalCost)) {
    alert("Insira um número válido de ações.");
    return;
  }

  if (totalCost > balance) {
    alert("Saldo insuficiente para esta compra.");
    return;
  }

  // Atualiza o saldo
  updateBalance(totalCost);

  // Criar o payload para a requisição
  const payload = {
    quantity: numShares,
    value: totalCost,
    company: stockSymbol,
  };

  try {
    const response = await fetch("http://localhost:3333/shares", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
    });

    if (!response.ok) {
      throw new Error("Erro ao comprar ações.");
    }

    // Exibe a mensagem de investimento bem-sucedido
    const investmentMessage = `Você comprou ${numShares} ações de ${stockSymbol} por $${totalCost.toFixed(2)}`;
    alert(investmentMessage);

    // Atualiza a lista de ações compradas
    fetchShares(); // Atualiza a lista de ações na interface

  } catch (error) {
    alert("Erro: " + error.message);
  }
}

// Função para buscar e exibir ações compradas
async function fetchShares() {
  const url = "http://localhost:3333/shares";
  const token = localStorage.getItem("jwt_token");

  if (!token) {
    alert("Usuário não autenticado.");
    return;
  }

  try {
    const response = await fetch(url, {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (!response.ok) {
      throw new Error("Erro ao buscar ações");
    }

    const data = await response.json();

    // Verifica se as ações foram listadas com sucesso
    if (data.code === 200 && data.message_code === "LISTED") {
      displayShares(data.data); // Exibe as ações na interface
    } else {
      console.error(data.message);
    }
  } catch (error) {
    console.error("Erro:", error);
  }
}

// Função para exibir as ações na interface
function displayShares(shares) {
  const sharesList = document.getElementById("shares-list");
  sharesList.innerHTML = ""; // Limpa a lista

  // Itera sobre as ações e exibe a quantidade atualizada corretamente
  shares.forEach((share) => {
    const shareItem = document.createElement("li");
    shareItem.classList.add("share-item"); // Adiciona uma classe para o item da lista

    shareItem.innerHTML = `
      <div class="form">
        Empresa: ${share.company} <br>
        Quantidade: ${share.quantity} <br>
        Valor Total: $${share.total_value.toFixed(2).replace(".", ",")} <br>
        <input type="number" class="sell-input" id="sell_quantity_${share.company}" placeholder="Qtd para vender" min="1" max="${share.quantity}">
        <button class="sell-button" onclick="sellShares('${share.company}', document.getElementById('sell_quantity_${share.company}').value, ${share.purchase_price})">
          Vender
        </button>
      </div>
    `;

    sharesList.appendChild(shareItem);
  });
}

// Função para vender ações
async function sellShares(company, quantity, price) {
  const token = localStorage.getItem("jwt_token");
  if (!token) {
    alert("Usuário não autenticado.");
    return;
  }

  quantity = parseInt(quantity);

  if (isNaN(quantity) || quantity <= 0) {
    alert("Insira uma quantidade válida para venda.");
    return;
  }

  const payload = {
    quantity: quantity,
    value: price * quantity,
    company: company,
  };

  try {
    const response = await fetch("http://localhost:3333/sell-shares", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify(payload),
    });

    if (response.ok) {
      const data = await response.json();
      alert(`Venda de ${quantity} ações da ${company} realizada com sucesso.`);

      // Atualiza a lista de ações e o saldo do usuário após a venda
      fetchShares();
      getSaldoUsuario();
    } else {
      const errorData = await response.json();
      throw new Error(errorData.message || "Erro ao vender ações.");
    }
  } catch (error) {
    alert("Erro ao vender ações: " + error.message);
  }
}
// =============================== GRÁFICO ===============================

// Chamada do histórico do último ano dos valores das ações
async function fetchHistoricalData(symbol) {
  const apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";
  const url = `https://api.polygon.io/v2/aggs/ticker/${symbol}/range/1/month/2023-07-01/2024-07-01?apiKey=${apiKey}`;
  const response = await fetch(url);
  const data = await response.json();
  return data.results || [];
}

// Carregar o gráfico de ações
async function loadChart() {
  const ticker = document.getElementById("ticker-select").value;

  if (!ticker) return;

  const historicalData = await fetchHistoricalData(ticker);

  if (!historicalData.length) {
    alert("Dados não encontrados.");
    return;
  }

  const labels = historicalData.map((result) =>
    new Date(result.t).toLocaleDateString("pt-BR", { month: "short" })
  );
  const prices = historicalData.map((result) => result.c);

  const ctx = document.getElementById("stock-chart").getContext("2d");

  // Destruir gráfico antigo, se existir
  if (stockChart) {
    stockChart.destroy();
  }

  // Criar um novo gráfico
  stockChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: `Preço das ações do último ano`,
          data: prices,
          borderColor: "rgba(255, 255, 255, 0.9)",
          backgroundColor: "rgba(0, 82, 204, 0.5)",
          pointBackgroundColor: "rgba(255, 255, 255, 0.8)",
          pointBorderColor: "#fff",
          pointRadius: 5,
          pointHoverRadius: 7,
          fill: true,
          tension: 0.4,
        },
      ],
    },
    options: {
      responsive: true,
      scales: {
        x: {
          title: {
            display: true,
            text: "Data",
            color: "#fff",
            font: { size: 20, family: "Arial" },
          },
          ticks: {
            color: "#fff",
            font: { size: 14 },
          },
          grid: { color: "rgba(255, 255, 255, 0.1)" },
        },
        y: {
          title: {
            display: true,
            text: "Preço",
            color: "#fff",
            font: { size: 20, family: "Arial" },
          },
          ticks: {
            color: "#fff",
            font: { size: 14 },
          },
          grid: { color: "rgba(255, 255, 255, 0.1)" },
        },
      },
      plugins: {
        legend: {
          labels: { color: "#fff", font: { size: 14, family: "Arial" } },
          position: "top",
        },
        tooltip: {
          backgroundColor: "rgba(0, 0, 0, 0.7)",
          titleColor: "#fff",
          bodyColor: "#fff",
          cornerRadius: 5,
        },
      },
      interaction: {
        mode: "index",
        intersect: false,
      },
    },
  });
}

function logoutUsuario() {
  // Remove o token dos locais de armazenamento
  localStorage.removeItem("jwt_token");
  sessionStorage.removeItem("jwt_token");

  // Caso o token esteja em um cookie, remova-o também (opcional)
  document.cookie =
    "jwt_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

  // Redireciona o usuário para a página de login
  window.location.href = "http://localhost/farialimabets/";
}
