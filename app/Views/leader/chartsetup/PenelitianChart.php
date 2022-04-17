<!-- PENELITIAN -->
<?php foreach ($Stats['PEN'] as $stat) : ?>
    <script>
        const labelsPEN<?= $stat['kode'] ?>Indikator = [
            <?php $i = 1;
            foreach ($stat['namaindikator'] as $key => $value) : ?> 'Indikator <?= $i; ?>',
            <?php $i++;
            endforeach; ?>
        ];

        const dataPEN<?= $stat['kode'] ?>Indikator = {
            labels: labelsPEN<?= $stat['kode'] ?>Indikator,
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

        const configPEN<?= $stat['kode'] ?>Indikator = {
            type: 'bar',
            data: dataPEN<?= $stat['kode'] ?>Indikator,
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
            },
        };

        const chartPEN<?= $stat['kode'] ?>Indikator = new Chart(
            document.getElementById(
                'chartPEN<?= $stat['kode'] ?>Indikator'),
            configPEN<?= $stat['kode'] ?>Indikator
        );
    </script>
<?php endforeach; ?>