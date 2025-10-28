<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian Bulanan 2025 - Plan vs Actual</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 30px;
        }

        h1 {
            color: #2d3748;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .kpi-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 12px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .chart-wrapper {
            position: relative;
            height: 450px;
            margin-top: 30px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .metric-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .metric-card.overall {
            border-left-color: #667eea;
        }

        .metric-card.response {
            border-left-color: #48bb78;
        }

        .metric-card.resolution {
            border-left-color: #f6ad55;
        }

        .metric-header {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .metric-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 12px;
        }

        .metric-card.overall .metric-icon {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .metric-card.response .metric-icon {
            background: rgba(72, 187, 120, 0.1);
            color: #48bb78;
        }

        .metric-card.resolution .metric-icon {
            background: rgba(246, 173, 85, 0.1);
            color: #f6ad55;
        }

        .metric-title {
            font-size: 14px;
            color: #718096;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-stats {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 12px;
        }

        .stat-item {
            flex: 1;
        }

        .stat-label {
            font-size: 11px;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
        }

        .stat-value.large {
            font-size: 32px;
        }

        .stat-unit {
            font-size: 18px;
            opacity: 0.8;
        }

        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .trend-indicator.down {
            background: #fee;
            color: #e53e3e;
        }

        .trend-indicator.up {
            background: #efe;
            color: #38a169;
        }

        .summary-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            border-radius: 12px;
            margin-top: 40px;
            color: white;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .summary-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .summary-item-label {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .summary-item-value {
            font-size: 28px;
            font-weight: 700;
        }

        .data-table {
            margin-top: 40px;
            overflow-x: auto;
        }

        .table-title {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #2d3748;
            font-size: 14px;
        }

        tr:hover {
            background: #f7fafc;
        }

        .performance-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .performance-badge.excellent {
            background: #c6f6d5;
            color: #22543d;
        }

        .performance-badge.good {
            background: #bee3f8;
            color: #2c5282;
        }

        .performance-badge.fair {
            background: #feebc8;
            color: #7c2d12;
        }

        .performance-badge.poor {
            background: #fed7d7;
            color: #742a2a;
        }

        @media (max-width: 768px) {
            .container {
                padding: 24px;
            }

            h1 {
                font-size: 24px;
            }

            .chart-wrapper {
                height: 350px;
                padding: 15px;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            .stat-value {
                font-size: 20px;
            }

            .stat-value.large {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Pencapaian Bulanan 2025 - Plan vs Actual</h1>
            <p class="subtitle">Monitoring KPI Response & Resolution Rate - Periode Januari - Oktober 2025</p>
            <span class="kpi-badge">🎯 Target KPI: 98%</span>
        </div>

        <div class="chart-wrapper">
            <canvas id="achievementChart"></canvas>
        </div>

        <div class="metrics-grid">
            <div class="metric-card overall">
                <div class="metric-header">
                    <div class="metric-icon">📈</div>
                    <div class="metric-title">Pencapaian Aktual</div>
                </div>
                <div class="metric-stats">
                    <div class="stat-item">
                        <div class="stat-label">Rata-rata</div>
                        <div class="stat-value large">74.5<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Tertinggi</div>
                        <div class="stat-value">86<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Terendah</div>
                        <div class="stat-value">36<span class="stat-unit">%</span></div>
                    </div>
                </div>
                <div class="trend-indicator down">↓ -47% dari bulan lalu</div>
            </div>

            <div class="metric-card response">
                <div class="metric-header">
                    <div class="metric-icon">✅</div>
                    <div class="metric-title">Action Response</div>
                </div>
                <div class="metric-stats">
                    <div class="stat-item">
                        <div class="stat-label">Rata-rata</div>
                        <div class="stat-value large">77.7<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Tertinggi</div>
                        <div class="stat-value">90<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Terendah</div>
                        <div class="stat-value">42<span class="stat-unit">%</span></div>
                    </div>
                </div>
                <div class="trend-indicator down">↓ -45% dari bulan lalu</div>
            </div>

            <div class="metric-card resolution">
                <div class="metric-header">
                    <div class="metric-icon">✔️</div>
                    <div class="metric-title">Action Resolution</div>
                </div>
                <div class="metric-stats">
                    <div class="stat-item">
                        <div class="stat-label">Rata-rata</div>
                        <div class="stat-value large">68.1<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Tertinggi</div>
                        <div class="stat-value">82<span class="stat-unit">%</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Terendah</div>
                        <div class="stat-value">30<span class="stat-unit">%</span></div>
                    </div>
                </div>
                <div class="trend-indicator down">↓ -49% dari bulan lalu</div>
            </div>
        </div>

        <div class="summary-section">
            <div class="summary-title">📋 Ringkasan Performance</div>
            <p style="opacity: 0.95; margin-bottom: 10px;">Analisis keseluruhan pencapaian KPI periode Januari - Oktober 2025</p>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-item-label">Gap dari Target</div>
                    <div class="summary-item-value">-23.5%</div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-label">Bulan Terbaik</div>
                    <div class="summary-item-value">Juni</div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-label">Bulan Terburuk</div>
                    <div class="summary-item-value">Oktober</div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-label">Konsistensi</div>
                    <div class="summary-item-value">Rendah</div>
                </div>
            </div>
        </div>

        <div class="data-table">
            <div class="table-title">📊 Data Detail Bulanan</div>
            <table>
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Pencapaian Aktual</th>
                        <th>Action Response</th>
                        <th>Action Resolution</th>
                        <th>Gap vs Target</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Januari</strong></td>
                        <td>80%</td>
                        <td>85%</td>
                        <td>75%</td>
                        <td>-18%</td>
                        <td><span class="performance-badge good">Good</span></td>
                    </tr>
                    <tr>
                        <td><strong>Februari</strong></td>
                        <td>77%</td>
                        <td>82%</td>
                        <td>72%</td>
                        <td>-21%</td>
                        <td><span class="performance-badge good">Good</span></td>
                    </tr>
                    <tr>
                        <td><strong>Maret</strong></td>
                        <td>54%</td>
                        <td>60%</td>
                        <td>48%</td>
                        <td>-44%</td>
                        <td><span class="performance-badge fair">Fair</span></td>
                    </tr>
                    <tr>
                        <td><strong>April</strong></td>
                        <td>85%</td>
                        <td>88%</td>
                        <td>82%</td>
                        <td>-13%</td>
                        <td><span class="performance-badge excellent">Excellent</span></td>
                    </tr>
                    <tr>
                        <td><strong>Mei</strong></td>
                        <td>79%</td>
                        <td>85%</td>
                        <td>73%</td>
                        <td>-19%</td>
                        <td><span class="performance-badge good">Good</span></td>
                    </tr>
                    <tr>
                        <td><strong>Juni</strong></td>
                        <td>86%</td>
                        <td>90%</td>
                        <td>82%</td>
                        <td>-12%</td>
                        <td><span class="performance-badge excellent">Excellent</span></td>
                    </tr>
                    <tr>
                        <td><strong>Juli</strong></td>
                        <td>65%</td>
                        <td>70%</td>
                        <td>60%</td>
                        <td>-33%</td>
                        <td><span class="performance-badge fair">Fair</span></td>
                    </tr>
                    <tr>
                        <td><strong>Agustus</strong></td>
                        <td>84%</td>
                        <td>88%</td>
                        <td>80%</td>
                        <td>-14%</td>
                        <td><span class="performance-badge excellent">Excellent</span></td>
                    </tr>
                    <tr>
                        <td><strong>September</strong></td>
                        <td>83%</td>
                        <td>87%</td>
                        <td>79%</td>
                        <td>-15%</td>
                        <td><span class="performance-badge good">Good</span></td>
                    </tr>
                    <tr style="background: #fff5f5;">
                        <td><strong>Oktober</strong></td>
                        <td><strong>36%</strong></td>
                        <td><strong>42%</strong></td>
                        <td><strong>30%</strong></td>
                        <td><strong>-62%</strong></td>
                        <td><span class="performance-badge poor">Poor</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt'],
            datasets: [{
                label: 'Pencapaian Aktual (%)',
                data: [80, 77, 54, 85, 79, 86, 65, 84, 83, 36],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                fill: true
            },
            {
                label: 'Action Response (%)',
                data: [85, 82, 60, 88, 85, 90, 70, 88, 87, 42],
                borderColor: '#48bb78',
                backgroundColor: 'rgba(72, 187, 120, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: '#48bb78',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                fill: false
            },
            {
                label: 'Action Resolution (%)',
                data: [75, 72, 48, 82, 73, 82, 60, 80, 79, 30],
                borderColor: '#f6ad55',
                backgroundColor: 'rgba(246, 173, 85, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: '#f6ad55',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                fill: false
            },
            {
                label: 'Target KPI (98%)',
                data: [98, 98, 98, 98, 98, 98, 98, 98, 98, 98],
                borderColor: '#e53e3e',
                borderWidth: 2.5,
                borderDash: [10, 5],
                pointRadius: 0,
                fill: false
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 13,
                                weight: '600'
                            },
                            boxWidth: 8,
                            boxHeight: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        padding: 16,
                        titleFont: {
                            size: 15,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 14
                        },
                        bodySpacing: 8,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y + '%';
                                return label;
                            },
                            afterBody: function(tooltipItems) {
                                const actual = tooltipItems[0].parsed.y;
                                const gap = actual - 98;
                                return '\nGap vs Target: ' + gap + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            },
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            stepSize: 20
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.06)',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 13,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        };

        const chart = new Chart(
            document.getElementById('achievementChart'),
            config
        );
    </script>
</body>
</html>