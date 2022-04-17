<!-- PENELITIAN -->
<script>
    // ========== CONFIG CHART DOUNAT ==========
    // setup block
    const labelsDoughnutPenelitian = [
        <?php foreach ($datanilaiPEN['standar'] as $PEN) {
            echo '"' . $PEN . '",';
        } ?>
    ];

    const dataDoughnutPenelitian = {
        labels: labelsDoughnutPenelitian,
        datasets: [{
            label: 'Standar Dataset',
            data: [
                <?php foreach ($datanilaiPEN['nilai'] as $nilaiPEN) {
                    echo $nilaiPEN . ',';
                } ?>
            ],
            backgroundColor: [
                'rgb(15, 22, 67)',
                'rgb(73, 74, 106)',
                'rgb(131, 127, 146)',
                'rgb(189, 179, 185)',
                'rgb(185, 152, 152)',
                'rgb(182, 126, 120)',
                'rgb(178, 99, 87)',
                'rgb(204, 119, 79)',
                'rgb(229, 139, 72)',
                'rgb(255, 159, 64)',
                'rgb(175, 133, 65)',
                'rgb(95, 68, 66)',
            ],
            borderColor: [
                'rgb(15, 22, 67)',
                'rgb(73, 74, 106)',
                'rgb(131, 127, 146)',
                'rgb(189, 179, 185)',
                'rgb(185, 152, 152)',
                'rgb(182, 126, 120)',
                'rgb(178, 99, 87)',
                'rgb(204, 119, 79)',
                'rgb(229, 139, 72)',
                'rgb(255, 159, 64)',
                'rgb(175, 133, 65)',
                'rgb(95, 68, 66)',
            ],
            hoverOffset: 0,
            borderWidth: 0,
            cutout: '70%',
        }]
    };

    // conter plugin block
    const counterDoughnutPenelitian = {
        id: 'counter',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    top,
                    right,
                    bottom,
                    left,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            // write text + automate the text
            ctx.font = '42px Work Sans';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('<?= $datanilaiPEN['avg'] ?>',
                left + (
                    width / 2), top + (height / 2));
        },
        afterInit(chart, args, options) {
            const fitValue = chart.legend.fit;
            chart.legend.fit = function fit() {
                fitValue.bind(chart.legend)();
                let height = this.height += 24;
                return height;
            }
        }
    };

    // config block
    const configDoughnutPenelitian = {
        type: 'doughnut',
        data: dataDoughnutPenelitian,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 0,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 10,
                        font: {
                            size: 14,
                            family: 'Work Sans',
                            weight: 'bold'
                        },
                        fontFamily: 'Work Sans',
                        padding: 12,
                        usePointStyle: true,
                    },
                },
            }
        },
        plugins: [counterDoughnutPenelitian]
    };

    // ========== RENDER CHART DOUNAT ==========
    const chartStandarDoughnutPenelitian = new Chart(
        document.getElementById('chartStandarDoughnutPenelitian'),
        configDoughnutPenelitian
    );
</script>

<!-- PENGABDIAN MASYARAKAT -->
<script>
    // ========== CONFIG CHART DOUNAT ==========
    // setup block
    const labelsDoughnutPengabdian = [
        <?php foreach ($datanilaiPPM['standar'] as $PPM) {
            echo '"' . $PPM . '",';
        } ?>
    ];

    const dataDoughnutPengabdian = {
        labels: labelsDoughnutPengabdian,
        datasets: [{
            label: 'Standar Dataset',
            data: [
                <?php foreach ($datanilaiPPM['nilai'] as $nilaiPPM) {
                    echo $nilaiPPM . ',';
                } ?>
            ],
            backgroundColor: [
                'rgb(15, 22, 67)',
                'rgb(73, 74, 106)',
                'rgb(131, 127, 146)',
                'rgb(189, 179, 185)',
                'rgb(185, 152, 152)',
                'rgb(182, 126, 120)',
                'rgb(178, 99, 87)',
                'rgb(204, 119, 79)',
                'rgb(229, 139, 72)',
                'rgb(255, 159, 64)',
                'rgb(175, 133, 65)',
                'rgb(95, 68, 66)',
            ],
            borderColor: [
                'rgb(15, 22, 67)',
                'rgb(73, 74, 106)',
                'rgb(131, 127, 146)',
                'rgb(189, 179, 185)',
                'rgb(185, 152, 152)',
                'rgb(182, 126, 120)',
                'rgb(178, 99, 87)',
                'rgb(204, 119, 79)',
                'rgb(229, 139, 72)',
                'rgb(255, 159, 64)',
                'rgb(175, 133, 65)',
                'rgb(95, 68, 66)',
            ],
            hoverOffset: 0,
            borderWidth: 0,
            cutout: '70%',
        }]
    };

    // conter plugin block
    const counterDoughnutPengabdian = {
        id: 'counterPengabdian',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    top,
                    right,
                    bottom,
                    left,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            // write text + automate the text
            ctx.font = '42px Work Sans';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('<?= $datanilaiPPM['avg'] ?>',
                left + (
                    width / 2), top + (height / 2));
        },
        afterInit(chart, args, options) {
            const fitValuePengabdian = chart.legend.fit;
            chart.legend.fit = function fitPengabdian() {
                fitValuePengabdian.bind(chart.legend)();
                let height = this.height += 24;
                return height;
            }
        }
    };

    // config block
    const configDoughnutPengabdian = {
        type: 'doughnut',
        data: dataDoughnutPengabdian,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 0,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 10,
                        font: {
                            size: 14,
                            family: 'Work Sans',
                            weight: 'bold'
                        },
                        fontFamily: 'Work Sans',
                        padding: 12,
                        usePointStyle: true,
                    },
                },
            }
        },
        plugins: [counterDoughnutPengabdian]
    };

    // ========== RENDER CHART DOUNAT ==========
    const chartStandarDoughnutPengabdian = new Chart(
        document.getElementById('chartStandarDoughnutPengabdian'),
        configDoughnutPengabdian
    );
</script>