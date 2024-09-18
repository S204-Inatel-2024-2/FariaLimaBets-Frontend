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

  const labels = historicalData.map(result =>
    new Date(result.t).toLocaleDateString('pt-BR', { month: 'short' })
  );
  const prices = historicalData.map(result => result.c);

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
          label: `Preço das ações do último ano`,
          data: prices,
          borderColor: "rgba(255, 255, 255, 0.9)",
          backgroundColor: "rgba(0, 82, 204, 0.5)", // Fundo mais suave
          pointBackgroundColor: "rgba(255, 255, 255, 0.8)", // Destaque nos pontos
          pointBorderColor: "#fff",
          pointRadius: 5,
          pointHoverRadius: 7, // Aumenta o ponto ao passar o mouse
          fill: true,
          tension: 0.4 // Linhas mais suaves
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          title: {
            display: true,
            text: "Data",
            color: "#fff", // Cor mais suave para os títulos
            font: {
              size: 20,
              family: "Arial"
            }
          },
          ticks: {
            color: "#fff", // Cor dos ticks mais suave
            font: {
              size: 14
            }
          },
          grid: {
            color: "rgba(255, 255, 255, 0.1)" // Grade mais discreta
          }
        },
        y: {
          title: {
            display: true,
            text: "Preço",
            color: "#fff",
            font: {
              size: 20,
              family: "Arial"
            }
          },
          ticks: {
            color: "#fff",
            font: {
              size: 14
            }
          },
          grid: {
            color: "rgba(255, 255, 255, 0.1)"
          }
        }
      },
      plugins: {
        legend: {
          labels: {
            color: "#fff",
            font: {
              size: 14,
              family: "Arial"
            }
          },
          position: "top" // Move a legenda para o topo
        },
        tooltip: {
          backgroundColor: "rgba(0, 0, 0, 0.7)", // Tooltip mais escuro e moderno
          titleColor: "#fff",
          bodyColor: "#fff",
          cornerRadius: 5 // Bordas arredondadas na tooltip
        }
      },
      elements: {
        line: {
          borderWidth: 2, // Linhas mais finas
          borderColor: "rgba(255, 255, 255, 0.9)"
        }
      },
      interaction: {
        mode: "index",
        intersect: false // Tooltip mostra os valores ao passar o mouse sem precisar clicar diretamente
      }
    }
  });
}
