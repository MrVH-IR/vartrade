const CryptoUI = {
    displayResults(data, container) {
        container.innerHTML = '';

        if (!data || data.length === 0) {
            container.innerHTML = '<p class="no-results">No results found</p>';
            return;
        }

        data.forEach(crypto => {
            const changePercent = parseFloat(crypto.changePercent24Hr);
            const changeClass = changePercent >= 0 ? 'change-positive' : 'change-negative';
            const changeSign = changePercent >= 0 ? '+' : '';

            const div = document.createElement('div');
            div.classList.add('crypto-item');
            div.setAttribute('data-crypto-id', crypto.id);
            div.innerHTML = `
                <strong>${crypto.name} (${crypto.symbol})</strong>
                <p class="rank">Rank: #${crypto.rank}</p>
                <p class="price">$${parseFloat(crypto.priceUsd).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}</p>
                <p class="${changeClass}">24h Change: ${changeSign}${changePercent.toFixed(2)}%</p>
            `;

            div.addEventListener('click', () => {
                window.location.href = `/app/src/Crypto.php?id=${crypto.id}`;
            });

            container.appendChild(div);
        });
    },

    showError(container, message) {
        container.innerHTML = `<p class="error-message">${message}</p>`;
    }
};

export default CryptoUI;