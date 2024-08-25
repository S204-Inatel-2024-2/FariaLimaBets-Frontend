// app.js

const API_KEY = 'F8PFPSCB56EDDTOL';
let STOCK_SYMBOL = 'MSFT'; // Símbolo inicial
const currentPriceElement = document.getElementById('current-price');
const availableCashElement = document.getElementById('available-cash');
const stockQuantityElement = document.getElementById('stock-quantity');
const transactionHistoryElement = document.getElementById('transaction-history');

let availableCash = 10000.00;
let stockQuantity = 0;
let currentPrice = 0.00;

// Função para buscar o preço da ação
async function fetchStockPrice(symbol) {
    const API_URL = `https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${symbol}&apikey=${API_KEY}`;
    try {
        const response = await fetch(API_URL);
        const data = await response.json();
        currentPrice = parseFloat(data['Global Quote']['05. price']);
        currentPriceElement.textContent = currentPrice.toFixed(2);
    } catch (error) {
        console.error('Erro ao buscar o preço da ação:', error);
    }
}

// Função para atualizar o jogo
function updateGame() {
    availableCashElement.textContent = availableCash.toFixed(2);
    stockQuantityElement.textContent = stockQuantity;
}

// Função para adicionar uma transação ao histórico
function addTransaction(type, price, quantity) {
    const transaction = document.createElement('li');
    transaction.textContent = `${type} ${quantity} ações por $${price.toFixed(2)} cada`;
    transactionHistoryElement.appendChild(transaction);
}

// Evento para seleção de uma nova ação
const stockSelectElement = document.getElementById('stock-select');
stockSelectElement.addEventListener('change', () => {
    const selectedSymbol = stockSelectElement.value;
    updateStockSymbol(selectedSymbol);
});

// Função para atualizar o símbolo da ação e buscar o novo preço
function updateStockSymbol(symbol) {
    STOCK_SYMBOL = symbol;
    fetchStockPrice(STOCK_SYMBOL);
}

// Eventos de compra e venda de ações
document.getElementById('buy-button').addEventListener('click', () => {
    if (availableCash >= currentPrice) {
        stockQuantity++;
        availableCash -= currentPrice;
        addTransaction('Comprou', currentPrice, 1);
        updateGame();
    } else {
        alert('Dinheiro insuficiente para comprar ações.');
    }
});

document.getElementById('sell-button').addEventListener('click', () => {
    if (stockQuantity > 0) {
        stockQuantity--;
        availableCash += currentPrice;
        addTransaction('Vendeu', currentPrice, 1);
        updateGame();
    } else {
        alert('Você não tem ações para vender.');
    }
});

// Buscar o preço inicial quando a página é carregada
fetchStockPrice(STOCK_SYMBOL);
updateGame();
