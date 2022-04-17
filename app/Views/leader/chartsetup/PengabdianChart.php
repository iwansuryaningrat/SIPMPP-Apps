<!-- PENGABDIAN -->
<?php foreach ($Stats['PPM'] as $stat) : ?>
    <script>
        const leblsPPM<?= $stat['kode'] ?>Indikator = [
            <?php $i = 1;
            foreach ($stat['namaindikator'] as $key => $value) : ?> 'Indikator <?= $i; ?>',
            <?php $i++;
            endforeach; ?>
        ];

        const dataPPM<?= $stat['kode'] ?>Indikator = {
            labels: leblsPPM<?= $stat['kode'] ?>Indikator,
            datasets: [{
                label: 'Nilai Indikator',
                backgroundColor: 'rgb(15, 22, 67)',
                borderColor: 'rgba(255, 99, 132, 0)',
                data: [
                    <?php foreach ($stat['nilai'] as $key => $value) : ?>
                        <?= $value; ?>,
                    <?php endforeach; ?>
                ],
            }]
        };

        const configPPM<?= $stat['kode'] ?>Indikator = {
            type: 'bar',
            data: dataPPM<?= $stat['kode'] ?>Indikator,
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: '<?= $stat['standar'] ?>'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 100,
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        suggestedMin: 0,
                        suggestedMax: 100,
                    },
                },
            },
        };

        const chartPPM<?= $stat['kode'] ?>Indikator = new Chart(
            document.getElementById(
                'chartPPM<?= $stat['kode'] ?>Indikator'),
            configPPM<?= $stat['kode'] ?>Indikator
        );
    </script>
<?php endforeach; ?>