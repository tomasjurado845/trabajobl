// complejo/java/modules/charts.js
class ChartsModule {
    constructor() {
        this.charts = {};
    }

    initializeChart(chartId, config) {
        const ctx = document.getElementById(chartId).getContext('2d');
        this.charts[chartId] = new Chart(ctx, config);
    }

    updateChartData(chartId, newData) {
        if (this.charts[chartId]) {
            this.charts[chartId].data = newData;
            this.charts[chartId].update();
        }
    }

    // Ejemplo de método para crear un gráfico de líneas
    createLineChart(chartId, labels, datasets) {
        const config = {
            type: 'line',
            data: { labels, datasets },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Gráfico de Líneas' }
                }
            }
        };
        this.initializeChart(chartId, config);
    }
}