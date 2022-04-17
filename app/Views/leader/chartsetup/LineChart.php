<!-- CHART YEAR -->
<script>
    // ========== CONFIG CHART LINE ==========
    const labelsLine = [
        <?php foreach ($nilaiTahun['tahun'] as $tahun) {
            echo '"' . $tahun . '",';
        } ?>
    ];

    const dataLine = {
        labels: labelsLine,
        datasets: [{
                // data[0]
                label: 'Penelitian',
                data: [
                    <?php foreach ($nilaiTahun['nilai'] as $nilaitahunpen) {
                        echo '"' . $nilaitahunpen['pen']['avg'] . '",';
                    } ?>
                ],
                borderColor: 'rgba(73, 74, 106, 1)',
                backgroundColor: function gradientGenerate(chartStandarLine) {
                    return gradientBackgroundLine(chartStandarLine.chart.ctx, chartStandarLine.chart.data
                        .datasets[0]
                        .borderColor);
                },
                fill: true,
            },
            {
                // data[1]
                label: 'Pengabdian Masyarakat',
                data: [
                    <?php foreach ($nilaiTahun['nilai'] as $nilaitahunppm) {
                        echo '"' . $nilaitahunppm['ppm']['avg'] . '",';
                    } ?>
                ],
                borderColor: 'rgba(178, 99, 87, 1)',
                backgroundColor: function gradientGenerate(chartStandarLine) {
                    return gradientBackgroundLine(chartStandarLine.chart.ctx, chartStandarLine.chart.data
                        .datasets[1]
                        .borderColor);
                },
                fill: true,
            }
        ]
    };

    const configLine = {
        type: 'line',
        data: dataLine,
        options: {
            maintainAspectRatio: false,
            tension: 0.4,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMin: 0,
                    suggestedMax: 110,
                }
            },
            interaction: {
                intersect: false,
                axis: 'xy',
                mode: 'nearest',
            },
            plugins: {
                legend: {
                    display: false,
                },
            }
        }
    };

    function gradientBackgroundLine(ctxLine, bgLine) {
        const gradient = ctxLine.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, bgLine);
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
        return gradient;
    }

    // ========== RENDER CHART DOUNAT ==========
    const chartStandarLine = new Chart(
        document.getElementById('chartStandarLine'),
        configLine
    );

    // ========== LEGENDS CUSTOM ==========
    // teks
    $('#legendsPenelitian').html("<i class='fa-solid fa-circle me-2' id='legends" + chartStandarLine.data.datasets[0]
        .label.split(' ').slice(0, -1).join(' ') +
        "Icon'></i>" + chartStandarLine.data.datasets[0].label);
    $('#legendsPengabdian').html("<i class='fa-solid fa-circle me-2' id='legends" + chartStandarLine.data.datasets[1]
        .label.split(' ').slice(0, -1).join(' ') +
        "Icon'></i>" + chartStandarLine.data.datasets[1].label);
    // color
    $('#legendsPenelitianIcon').css('color', chartStandarLine.data.datasets[0].borderColor);
    $('#legendsPengabdianIcon').css('color', chartStandarLine.data.datasets[1].borderColor);

    // toggleDataChart
    function toggleDataChart(value) {
        const visibilityDataChart = chartStandarLine.isDatasetVisible(value);
        if (visibilityDataChart) {
            chartStandarLine.hide(value);
        } else {
            chartStandarLine.show(value);
        }
    }

    // function hide
    jQuery(function($) {
        jQuery('.legends__item').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('hideChart');
        });
    });
</script>