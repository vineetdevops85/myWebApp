document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});

async function fetchData() {
    const apiKey = "F3OLMOOBYGZFJE8V";
    const symbol = "AAPL"; // Example stock symbol (you can change it to any other symbol)

    const apiEndpoint = `https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${symbol}&apikey=${apiKey}`;

    try {
        const response = await fetch(apiEndpoint);
        const data = await response.json();

        displayData(data);
    } catch (error) {
        console.error("Error fetching data:", error);
        displayError("Error fetching data.");
    }
}

function displayData(data) {
    const stockDataElement = document.getElementById("stockData");

    if (data["Global Quote"]) {
        const stockQuote = data["Global Quote"];
        const html = `
            <p>Symbol: ${stockQuote["01. symbol"]}</p>
            <p>Open: ${stockQuote["02. open"]}</p>
            <p>High: ${stockQuote["03. high"]}</p>
            <p>Low: ${stockQuote["04. low"]}</p>
            <p>Price: ${stockQuote["05. price"]}</p>
            <p>Volume: ${stockQuote["06. volume"]}</p>
            <p>Last Refreshed: ${stockQuote["07. latest trading day"]}</p>
        `;

        stockDataElement.innerHTML = html;
    } else {
        displayError("Stock data not available.");
    }
}

function displayError(message) {
    const stockDataElement = document.getElementById("stockData");
    stockDataElement.innerHTML = `<p style="color: red;">${message}</p>`;
}
