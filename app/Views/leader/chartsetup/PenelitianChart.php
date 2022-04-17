<!-- PENELITIAN -->
<script>
    const labelsPENS1Indikator = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5'];
    const labelsPENS2Indikator = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5'];

    const dataPENS1Indikator = {
        labels: labelsPENS1Indikator,
        datasets: [{
            label: 'Nilai Indikator',
            backgroundColor: 'rgb(15, 22, 67)',
            borderColor: 'rgba(255, 99, 132, 0)',
            data: [10, 20, 30, 50, 80],
        }]
    };

    const dataPENS2Indikator = {
        labels: labelsPENS2Indikator,
        datasets: [{
            label: 'Nilai Indikator',
            backgroundColor: 'rgb(15, 22, 67)',
            borderColor: 'rgba(255, 99, 132, 0)',
            data: [30, 10, 10, 40, 63],
        }]
    };

    const configPENS1Indikator = {
        type: 'bar',
        data: dataPENS1Indikator,
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
                    text: 'S1. Nama Standar'
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

    const configPENS2Indikator = {
        type: 'bar',
        data: dataPENS2Indikator,
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
                    text: 'S2. Nama Standar'
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

    const chartPENS1Indikator = new Chart(
        document.getElementById(
            'chartPENS1Indikator'),
        configPENS1Indikator
    );

    const chartPENS2Indikator = new Chart(
        document.getElementById(
            'chartPENS2Indikator'),
        configPENS2Indikator
    );
</script>