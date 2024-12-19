import CryptoAPI from './api.js';
import CryptoUI from './ui.js';

const CryptoApp = {
    init() {
        this.searchInput = document.getElementById('searchInput');
        this.searchButton = document.getElementById('searchButton');
        this.resultsContainer = document.createElement('div');
        this.resultsContainer.id = 'resultsContainer';
        document.querySelector('.search-container').appendChild(this.resultsContainer);

        this.bindEvents();
    },

    bindEvents() {
        this.searchButton.addEventListener('click', () => this.handleSearch());
        this.searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.handleSearch();
            }
        });
        this.searchInput.addEventListener('input', () => this.handleInput());
    },

    async handleSearch() {
        const query = this.searchInput.value.trim();
        if (!query) {
            this.resultsContainer.innerHTML = '';
            return;
        }

        try {
            const data = await CryptoAPI.searchCrypto(query);
            CryptoUI.displayResults(data, this.resultsContainer);
        } catch (error) {
            console.error('Error fetching data:', error);
            CryptoUI.showError(
                this.resultsContainer,
                'Sorry, there was an error fetching the data. Please try again.'
            );
        }
    },

    handleInput() {
        if (this.searchInput.value.trim() === '') {
            this.resultsContainer.innerHTML = '';
        }
    }
};

// Initialize the app when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => CryptoApp.init());