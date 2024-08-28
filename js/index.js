let stockChart; // variavel para armazenar a instância do grafico

//chamada do historico do ultimo ano dos valoes das ações
async function fetchHistoricalData(symbol) {
  const apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";
  const url = `https://api.polygon.io/v2/aggs/ticker/${symbol}/range/1/month/2023-07-01/2024-07-01?apiKey=${apiKey}`;
  const response = await fetch(url);
  const data = await response.json();
  return data.results || [];
}

//chamanda para carregar o grafico
async function loadChart() {
  const ticker = document.getElementById("ticker-select").value;

  if (!ticker) return;
  // chamada de função
  const historicalData = await fetchHistoricalData(ticker);

  if (!historicalData.length) {
    alert("Dados não encontrados.");
    return;
  }

  const labels = historicalData.map((result) =>
    new Date(result.t).toLocaleDateString()
  );
  const prices = historicalData.map((result) => result.c);

  const ctx = document.getElementById("stock-chart").getContext("2d");

  // caso ja tenha um grafico apaga
  if (stockChart) {
    stockChart.destroy();
  }

  // cria um novo grafico - layout
  stockChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: `Preço das ações do ultimo ano`,
          data: prices,
          borderColor: "rgba(75, 192, 192, 1)",
          backgroundColor: "rgba(75, 102, 192, 0.5)",
          fill: true,
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
            font: {
              size: 18,
            },
          },
          ticks: {
            color: "#fff",
          },
        },
        y: {
          title: {
            display: true,
            text: "Preço",
            color: "#fff",
            font: {
              size: 18,
            },
          },
          ticks: {
            color: "#fff",
          },
        },
      },
      plugins: {
        legend: {
          labels: {
            color: "#fff",
            font: {
              size: 18,
            },
          },
        },
      },
    },
  });
}
