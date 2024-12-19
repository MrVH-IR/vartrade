<?php
require_once '../../api/CoinCap.php';

$cryptoId = $_GET['id'] ?? '';

if (empty($cryptoId)) {
    header('Location: /');
    exit;
}

$coinCap = new CoinCap();
$cryptoData = $coinCap->getAssetById($cryptoId);

if (!$cryptoData || !isset($cryptoData['data'])) {
    header('Location: /');
    exit;
}

$crypto = $cryptoData['data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($crypto['name']); ?> Details</title>
    <link rel="stylesheet" href="/app/css/Index.css">
    <link rel="stylesheet" href="/app/css/Crypto.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/recharts/2.12.2/Recharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.23.9/babel.min.js"></script>
</head>

<body>
    <div class="background-overlay"></div>

    <header>
        <nav>
            <a href="/" class="logo">VarTrade</a>
        </nav>
    </header>

    <main class="crypto-details">
        <div class="crypto-card">
            <div class="crypto-header">
                <h1><?php echo htmlspecialchars($crypto['name']); ?> (<?php echo htmlspecialchars($crypto['symbol']); ?>)</h1>
                <p class="rank">Rank #<?php echo htmlspecialchars($crypto['rank']); ?></p>
            </div>

            <div class="price-section">
                <h2>Price</h2>
                <p class="price">$<?php echo number_format(floatval($crypto['priceUsd']), 2); ?></p>
                <p class="change <?php echo floatval($crypto['changePercent24Hr']) >= 0 ? 'positive' : 'negative'; ?>">
                    <?php echo floatval($crypto['changePercent24Hr']) >= 0 ? '+' : ''; ?><?php echo number_format(floatval($crypto['changePercent24Hr']), 2); ?>%
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <h3>Market Cap</h3>
                    <p>$<?php echo number_format(floatval($crypto['marketCapUsd']), 0); ?></p>
                </div>
                <div id="chart-container" class="mt-8"></div>
                <div class="stat-item">
                    <h3>Volume (24Hr)</h3>
                    <p>$<?php echo number_format(floatval($crypto['volumeUsd24Hr']), 0); ?></p>
                </div>
                <div class="stat-item">
                    <h3>Supply</h3>
                    <p><?php echo number_format(floatval($crypto['supply']), 0); ?> <?php echo htmlspecialchars($crypto['symbol']); ?></p>
                </div>
                <?php if ($crypto['maxSupply']): ?>
                    <div class="stat-item">
                        <h3>Max Supply</h3>
                        <p><?php echo number_format(floatval($crypto['maxSupply']), 0); ?> <?php echo htmlspecialchars($crypto['symbol']); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($crypto['explorer']): ?>
                <div class="explorer-link">
                    <a href="<?php echo htmlspecialchars($crypto['explorer']); ?>" target="_blank" rel="noopener noreferrer">
                        Blockchain Explorer
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script type="text/babel">
        const { AreaChart, Area, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer } = Recharts;

const CryptoChart = ({ cryptoId }) => {
    const [priceData, setPriceData] = React.useState([]);
    const [timeframe, setTimeframe] = React.useState('1d');
    const [isLoading, setIsLoading] = React.useState(true);

    React.useEffect(() => {
        const fetchPriceHistory = async () => {
            setIsLoading(true);
            try {
                const response = await fetch(
                    `https://api.coincap.io/v2/assets/${cryptoId}/history?interval=${
                        timeframe === '1d' ? 'h1' : 'd1'
                    }&start=${getStartTime(timeframe)}&end=${Date.now()}`
                );
                const data = await response.json();
                
                const formattedData = data.data.map(item => ({
                    timestamp: new Date(item.time),
                    price: parseFloat(item.priceUsd)
                }));
                
                setPriceData(formattedData);
            } catch (error) {
                console.error('Error fetching price history:', error);
            }
            setIsLoading(false);
        };

        fetchPriceHistory();
    }, [cryptoId, timeframe]);

    const getStartTime = (tf) => {
        const now = Date.now();
        switch (tf) {
            case '1d': return now - (24 * 60 * 60 * 1000);
            case '7d': return now - (7 * 24 * 60 * 60 * 1000);
            case '30d': return now - (30 * 24 * 60 * 60 * 1000);
            case '90d': return now - (90 * 24 * 60 * 60 * 1000);
            case '365d': return now - (365 * 24 * 60 * 60 * 1000);
            default: return now - (24 * 60 * 60 * 1000);
        }
    };

    const timeframes = [
        { label: '24H', value: '1d' },
        { label: '7D', value: '7d' },
        { label: '30D', value: '30d' },
        { label: '90D', value: '90d' },
        { label: '1Y', value: '365d' }
    ];

    return (
        <div style={{ background: 'rgba(30, 30, 30, 0.9)', borderRadius: '16px', padding: '20px', marginTop: '20px' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                <h2 style={{ color: '#fff', fontSize: '1.5rem', fontWeight: 'bold' }}>Price Chart</h2>
                <div style={{ display: 'flex', gap: '8px' }}>
                    {timeframes.map(tf => (
                        <button
                            key={tf.value}
                            onClick={() => setTimeframe(tf.value)}
                            style={{
                                padding: '8px 16px',
                                borderRadius: '8px',
                                border: 'none',
                                cursor: 'pointer',
                                background: timeframe === tf.value ? '#3498db' : 'rgba(255, 255, 255, 0.1)',
                                color: '#fff',
                                transition: 'all 0.3s ease'
                            }}
                        >
                            {tf.label}
                        </button>
                    ))}
                </div>
            </div>

            <div style={{ height: '400px', width: '100%' }}>
                {isLoading ? (
                    <div style={{ 
                        display: 'flex', 
                        justifyContent: 'center', 
                        alignItems: 'center', 
                        height: '100%',
                        color: '#fff' 
                    }}>
                        Loading chart data...
                    </div>
                ) : (
                    <ResponsiveContainer width="100%" height="100%">
                        <AreaChart data={priceData}>
                            <defs>
                                <linearGradient id="colorPrice" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="5%" stopColor="#3498db" stopOpacity={0.3}/>
                                    <stop offset="95%" stopColor="#3498db" stopOpacity={0}/>
                                </linearGradient>
                            </defs>
                            <CartesianGrid strokeDasharray="3 3" stroke="rgba(255, 255, 255, 0.1)" />
                            <XAxis 
                                dataKey="timestamp"
                                tickFormatter={(timestamp) => {
                                    const date = new Date(timestamp);
                                    return timeframe === '1d' 
                                        ? date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
                                        : date.toLocaleDateString();
                                }}
                                stroke="#fff"
                            />
                            <YAxis
                                tickFormatter={value => `$${value.toFixed(2)}`}
                                stroke="#fff"
                            />
                            <Tooltip
                                formatter={(value) => [`$${value.toFixed(2)}`, 'Price']}
                                contentStyle={{
                                    background: '#1a1a1a',
                                    border: '1px solid #333',
                                    borderRadius: '4px',
                                    color: '#fff'
                                }}
                            />
                            <Area
                                type="monotone"
                                dataKey="price"
                                stroke="#3498db"
                                fill="url(#colorPrice)"
                            />
                        </AreaChart>
                    </ResponsiveContainer>
                )}
            </div>
        </div>
    );
};

const container = document.getElementById('chart-container');
const root = ReactDOM.createRoot(container);
root.render(<CryptoChart cryptoId="<?php echo $cryptoId; ?>" />);
</script>
</body>

</html>