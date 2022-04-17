<!-- CHART INDIKATOR -->
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

<!-- PENGABDIAN -->
<script>
    const labelsPPMS1Indikator = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5'];
    const labelsPPMS2Indikator = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5'];

    const dataPPMS1Indikator = {
        labels: labelsPPMS1Indikator,
        datasets: [{
            label: 'Nilai Indikator',
            backgroundColor: 'rgb(15, 22, 67)',
            borderColor: 'rgba(255, 99, 132, 0)',
            data: [10, 20, 30, 50, 80],
        }]
    };

    const dataPPMS2Indikator = {
        labels: labelsPPMS2Indikator,
        datasets: [{
            label: 'Nilai Indikator',
            backgroundColor: 'rgb(15, 22, 67)',
            borderColor: 'rgba(255, 99, 132, 0)',
            data: [30, 10, 10, 40, 63],
        }]
    };

    const configPPMS1Indikator = {
        type: 'bar',
        data: dataPPMS1Indikator,
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

    const configPPMS2Indikator = {
        type: 'bar',
        data: dataPPMS2Indikator,
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

    const chartPPMS1Indikator = new Chart(
        document.getElementById(
            'chartPPMS1Indikator'),
        configPPMS1Indikator
    );

    const chartPPMS2Indikator = new Chart(
        document.getElementById(
            'chartPPMS2Indikator'),
        configPPMS2Indikator
    );
</script>