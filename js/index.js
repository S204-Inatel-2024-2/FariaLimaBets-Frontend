document.addEventListener("DOMContentLoaded", function () {
  fetch("fetch_data.php")
    .then((response) => response.json())
    .then((data) => {
      const labels = data.map((item) => item.date); // Datas para o eixo X
      const closePrices = data.map((item) => item.close); // Preços de fechamento para o eixo Y

      const ctx = document.getElementById("chartCanvas").getContext("2d");
      new Chart(ctx, {
        type: "line",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Preço de Fechamento (USD)",
              data: closePrices,
              borderColor: "#fff",
              color: "#fff",
              borderWidth: 1,
              fill: false,
            },
          ],
        },
        options: {
          scales: {
            x: {
              title: {
                display: true,
                text: "Dia do mês",
                color: "#fff",
              },
              ticks: {
                color: "#fff",
              },
            },
            y: {
              title: {
                display: true,
                text: "Preço de Fechamento (USD)",
                color: "#fff",
              },
              ticks: {
                color: "#fff",
              },
            },
          },
        },
      });
    })
    .catch((error) => console.error("Erro ao buscar os dados:", error));
});
