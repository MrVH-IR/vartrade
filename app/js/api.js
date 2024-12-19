const CryptoAPI = {
    async searchCrypto(query) {
        const response = await fetch(`../../api/search.php?searchData=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        return response.json();
    }
};

export default CryptoAPI;