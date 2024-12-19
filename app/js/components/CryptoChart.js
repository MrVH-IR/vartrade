import React, { useState, useEffect } from 'react';
import {
    AreaChart,
    Area,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
    ResponsiveContainer
} from 'recharts';

const CryptoChart = ({ cryptoId }) => {
    const [priceData, setPriceData] = useState([]);
    const [timeframe, setTimeframe] = useState('1d'); // 1d, 7d, 30d, 90d, 365d
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const fetchPriceHistory = async () => {
            setIsLoading(true);
            try {
                const response = await fetch(`https://api.coincap.io/v2/assets/${cryptoId}/history?interval=${timeframe === '1d' ? 'h1' : 'd1'}&start=${getStartTime(timeframe)}&end=${Date.now()}`);
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

    const formatXAxis = (timestamp) => {
        const date = new Date(timestamp);
        if (timeframe === '1d') {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
        return date.toLocaleDateString();
    };

    const formatTooltip = (value, name) => {
        return [`$${value.toFixed(2)}`, 'Price'];
    };

    const timeframes = [
        { label: '24H', value: '1d' },
        { label: '7D', value: '7d' },
        { label: '30D', value: '30d' },
        { label: '90D', value: '90d' },
        { label: '1Y', value: '365d' }
    ];

    return (
        <div className="w-full bg-gray-900 rounded-lg p-4 shadow-lg">
            <div className="flex justify-between items-center mb-4">
                <h2 className="text-xl font-bold text-white">Price Chart</h2>
                <div className="flex gap-2">
                    {timeframes.map(tf => (
                        <button
                            key={tf.value}
                            onClick={() => setTimeframe(tf.value)}
                            className={`px-3 py-1 rounded ${timeframe === tf.value
                                    ? 'bg-blue-500 text-white'
                                    : 'bg-gray-700 text-gray-300 hover:bg-gray-600'
                                }`}
                        >
                            {tf.label}
                        </button>
                    ))}
                </div>
            </div>

            <div className="h-[400px] w-full">
                {isLoading ? (
                    <div className="flex items-center justify-center h-full">
                        <div className="text-white">Loading chart data...</div>
                    </div>
                ) : (
                    <ResponsiveContainer width="100%" height="100%">
                        <AreaChart data={priceData}>
                            <defs>
                                <linearGradient id="colorPrice" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="5%" stopColor="#3498db" stopOpacity={0.3} />
                                    <stop offset="95%" stopColor="#3498db" stopOpacity={0} />
                                </linearGradient>
                            </defs>
                            <CartesianGrid strokeDasharray="3 3" stroke="#2c3e50" />
                            <XAxis
                                dataKey="timestamp"
                                tickFormatter={formatXAxis}
                                stroke="#ecf0f1"
                            />
                            <YAxis
                                domain={['auto', 'auto']}
                                tickFormatter={value => `$${value.toFixed(2)}`}
                                stroke="#ecf0f1"
                            />
                            <Tooltip
                                formatter={formatTooltip}
                                contentStyle={{
                                    background: '#1a1a1a',
                                    border: '1px solid #333',
                                    borderRadius: '4px'
                                }}
                                labelStyle={{ color: '#ecf0f1' }}
                                itemStyle={{ color: '#3498db' }}
                            />
                            <Area
                                type="monotone"
                                dataKey="price"
                                stroke="#3498db"
                                fillOpacity={1}
                                fill="url(#colorPrice)"
                            />
                        </AreaChart>
                    </ResponsiveContainer>
                )}
            </div>
        </div>
    );
};

export default CryptoChart;