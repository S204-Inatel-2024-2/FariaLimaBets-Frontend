let stockChart; // Variable to hold the chart instance

async function fetchHistoricalData(symbol) {
  const apiKey = "3LcGDlYJGST1jXsimEjh8piuITsoW3Wm";
  const url = `https://api.polygon.io/v2/aggs/ticker/${symbol}/range/1/month/2023-07-01/2024-07-01?apiKey=${apiKey}`;
  const response = await fetch(url);
  const data = await response.json();
  return data.results || [];
}

async function loadChart() {
  const ticker = document.getElementById("ticker-select").value;

  if (!ticker) return;

  // Obtém os dados históricos do ticker selecionado
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

  // Destroy the previous chart instance if it exists
  if (stockChart) {
    stockChart.destroy();
  }

  // Create a new chart instance
  stockChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: `Preço das ações ${ticker}`,
          data: prices,
          borderColor: "rgba(75, 192, 192, 1)",
          backgroundColor: "rgba(75, 192, 192, 0.2)",
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
          },
          ticks: {
            color: "#fff",
          },
        },
      },
    },
  });
}
