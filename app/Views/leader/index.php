<?= $this->extend('template/leaderlayout'); ?>

<?= $this->section('leader'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <span id="unit-user">Dashboard Leader</span>
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Dashboard Leader Overview</h1>
            <p>Halo <span>
                    <?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                        $name = trim($name);
                        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                        return array($first_name, $last_name);
                    }
                    echo split_name($data_user['nama'])[0];
                    ?>
                </span>, selamat
                datang kembali!</p>
        </div>
        <div class="title__subtitle-btn">
            <div class="report__link btn btn__dark shadow-none button__filters" id="btnFilterLeader">
                <i class="fa-solid fa-filter me-2" id="btnFilterLeaderIcon"></i>
                <span id="btnFilterLeaderSpan">Filter</span>
            </div>
        </div>
    </div>
</div>

<div id="filterLeader">
    <div class="filter__leader-container position-relative" id="filterLeaderContainer">
        <form action="#" method="POST" id="formFilterLeader">
            <h5 class="title__filter">Filters</h5>
            <!-- tahun -->
            <div class="mb-3">
                <label for="tahunLeader" class="form-label form__label">Tahun</label>
                <select name="tahunLeader" id="tahunLeader" class="form-select form__select shadow-none">
                    <option value="">tahun1</option>
                    <option value="">tahun2</option>
                    <option value="">tahun3</option>
                </select>
            </div>
            <!-- unit -->
            <div class="mb-3">
                <label for="unitLeader" class="form-label form__label">Unit</label>
                <select name="unitLeader" id="unitLeader" class="form-select form__select shadow-none">
                    <option value="">unit1</option>
                    <option value="">unit2</option>
                    <option value="">unit3</option>
                </select>
            </div>
            <!-- submit -->
            <div class="submit__leader">
                <a href="#" class="btn__submit-leader shadow-none color__primary">Save view</a>
            </div>
        </form>
    </div>
</div>

<!-- body main -->
<!-- chart content -->
<div class="chart__content row">
    <!-- left -->
    <div class="chart__content-left col-lg-5 col-12">
        <div class="chart__content-dounat shadow__box-sm">
            <h6 id="unitStandar">Nama Unit Sekarang</h6>
            <div class="content-unit__title">
                <h5 class="card__title">Status Nilai SPMI <span><?= $data_user['tahun']; ?></span>
                </h5>
                <div class="filter__panel">
                    <div class="nav nav-pills" id="pills-tab" role="tablist">
                        <button class="btn filter__btn-chart me-0 me-md-3 shadow-none active nav-link active mb-3"
                            id="pillsStandarPenelitian" data-bs-toggle="pill"
                            data-bs-target="#pillsChartStandarPenelitian" type="button" role="tab"
                            aria-controls="pillsChartStandarPenelitian" aria-selected="true">
                            Penelitian
                        </button>
                        <button class="btn filter__btn-chart shadow-none nav-link mb-3" id="pillsStandarPengabdian"
                            data-bs-toggle="pill" data-bs-target="#pillsChartStandarPengabdian" type="button" role="tab"
                            aria-controls="pillsChartStandarPengabdian" aria-selected="false">
                            Pengabdian Masyarakat
                        </button>
                    </div>
                </div>
            </div>
            <hr />
            <div class="tab-content" id="pills-tabContent">
                <!-- penelitian -->
                <div class="tab-pane fade show active" id="pillsChartStandarPenelitian" role="tabpanel"
                    aria-labelledby="pillsStandarPenelitian">
                    <div class="chart__container">
                        <canvas id="chartStandarDoughnutPenelitian"></canvas>
                    </div>
                </div>

                <!-- pengabdian masyarakat -->
                <div class="tab-pane fade" id="pillsChartStandarPengabdian" role="tabpanel"
                    aria-labelledby="pillsStandarPengabdian">
                    <div class="chart__container">
                        <canvas id="chartStandarDoughnutPengabdian"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- right -->
    <div class="chart__content-right col-lg-7 col-12">
        <div class="chart__content-line shadow__box-sm">
            <h6 id="unitTahun">Nama Unit Sekarang</h6>
            <h5 class="card__title">Analisis Kategori Tahunan</h5>
            <div class="chart__container">
                <canvas id="chartStandarLine"></canvas>
                <div class="legends__chart">
                    <button id="legendsPenelitian" class="legends__item btn shadow-none ellipsis__text"
                        onclick="toggleDataChart(0)"></button>
                    <button id="legendsPengabdian" class="legends__item btn shadow-none ellipsis__text"
                        onclick="toggleDataChart(1)"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- indikator chart content -->
<div class="indikator__content">
    <div class="indikator__content-card shadow__box-sm">
        <h6 id="unitIndikator">Nama Unit Sekarang</h6>
        <div class="content-indikator__title">
            <h5 class="card__title mb-3">Rekap Indikator <span><?= $data_user['tahun']; ?></span>
            </h5>
            <div class="filter__panel mb-3">
                <div class="nav nav-pills" id="pills-tab" role="tablist">
                    <button class="btn filter__btn-indikator me-0 me-md-3 shadow-none active nav-link active mb-2"
                        id="piils-indikator-penelitian" data-bs-toggle="pill"
                        data-bs-target="#pills-chart-indikator-penelitian" type="button" role="tab"
                        aria-controls="pills-chart-indikator-penelitian" aria-selected="true">
                        Penelitian
                    </button>
                    <button class="btn filter__btn-indikator shadow-none nav-link mb-2" id="pills-indikator-pm"
                        data-bs-toggle="pill" data-bs-target="#pills-chart-indikator-pm" type="button" role="tab"
                        aria-controls="pills-chart-indikator-pm" aria-selected="false">
                        Pengabdian Masyarakat
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- table penelitian -->
            <div class="tab-pane fade show active" id="pills-chart-indikator-penelitian" role="tabpanel"
                aria-labelledby="piils-indikator-penelitian">
                <div class="indikator__kategori-title">
                    <h3>Penelitian</h3>
                    <form action="" method="POST">
                        <div class="form-group form-group__standar" id="formStandarPenelitian">
                            <label for="filterStandarPenelitian"
                                class="form-label form__label me-3 mb-0">Standar:</label>
                            <select name="filterStandarPenelitian" id="filterStandarPenelitian"
                                class="form-select form__select form-select__standar shadow-none">
                                <option selected disabled>Pilih Standar</option>
                                <option value="1">S1</option>
                                <option value="2">S2</option>
                                <option value="3">S3</option>
                                <option value="4">S4</option>
                                <option value="5">S5</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- indikator chart content -->
                <!-- PENS1 -->
                <div id="PENS1Indikator" class="PENIndikator">
                    <h5 style="font-weight: 600;">S1. Standar Hasil Penelitian</h5>
                    <!-- bar chart standar 1 -->
                    <div class="chart__indikator-container mb-4">
                        <canvas id="chartPENS1Indikator"></canvas>
                    </div>

                    <!-- table indikator standar 1 -->
                    <div class="sipmpp__table">
                        <div class="table-responsive">
                            <table class="table sipmpp__table-content indikator__tbl table-hover"
                                id="tablePENS1Indikator">
                                <thead class="bg__light">
                                    <tr>
                                        <th class="table__indikator-number">no</th>
                                        <th class="table__indikator-indikator">indikator</th>
                                        <th class="table__indikator-keterangan">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Indikator 1</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Indikator 2</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- PENS2 -->
                <div id="PENS2Indikator" class="PENIndikator">
                    <h5 style="font-weight: 600;">S2. Standar Isi Penelitian</h5>
                    <!-- bar chart standar 2 -->
                    <div class="chart__indikator-container mb-4">
                        <canvas id="chartPENS2Indikator"></canvas>
                    </div>

                    <!-- table indikator standar 2 -->
                    <div class="sipmpp__table">
                        <div class="table-responsive">
                            <table class="table sipmpp__table-content indikator__tbl table-hover"
                                id="tablePENS2Indikator">
                                <thead class="bg__light">
                                    <tr>
                                        <th class="table__indikator-number">no</th>
                                        <th class="table__indikator-indikator">indikator</th>
                                        <th class="table__indikator-keterangan">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Indikator 1</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Indikator 2</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- PENS3 -->
                <div id="PENS3Indikator" class="PENIndikator">
                    <h5 style="font-weight: 600;">S3. Standar Proses Penelitian</h5>
                </div>
            </div>

            <!-- table pengabdian masyarakat -->
            <div class="tab-pane fade" id="pills-chart-indikator-pm" role="tabpanel"
                aria-labelledby="pills-indikator-pm">
                <div class="indikator__kategori-title">
                    <h3>Pengabdian Masyarakat</h3>
                    <form action="" method="POST">
                        <div class="form-group form-group__standar" id="formStandarPengabdian">
                            <label for="filterStandarPengabdian"
                                class="form-label form__label me-3 mb-0">Standar:</label>
                            <select name="filterStandarPengabdian" id="filterStandarPengabdian"
                                class="form-select form__select form-select__standar shadow-none">
                                <option selected disabled>Pilih Standar</option>
                                <option value="1">S1</option>
                                <option value="2">S2</option>
                                <option value="3">S3</option>
                                <option value="4">S4</option>
                                <option value="5">S5</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- indikator chart content -->
                <!-- PPMS1 -->
                <div id="PPMS1Indikator" class="PPMIndikator">
                    <h5 style="font-weight: 600;">S1. Standar Hasil PKM</h5>
                    <!-- bar chart standar 1 -->
                    <div class="chart__indikator-container mb-4">
                        <canvas id="chartPPMS1Indikator"></canvas>
                    </div>

                    <!-- table indikator standar 1 -->
                    <div class="sipmpp__table">
                        <div class="table-responsive">
                            <table class="table sipmpp__table-content indikator__tbl table-hover"
                                id="tablePPPMS1Indikator">
                                <thead class="bg__light">
                                    <tr>
                                        <th class="table__indikator-number">no</th>
                                        <th class="table__indikator-indikator">indikator</th>
                                        <th class="table__indikator-keterangan">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Indikator 1</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Indikator 2</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- PPMS2 -->
                <div id="PPMS2Indikator" class="PPMIndikator">
                    <h5 style="font-weight: 600;">S2. Standar Isi PKM</h5>
                    <!-- bar chart standar 2 -->
                    <div class="chart__indikator-container mb-4">
                        <canvas id="chartPPMS2Indikator"></canvas>
                    </div>

                    <!-- table indikator standar 2 -->
                    <div class="sipmpp__table">
                        <div class="table-responsive">
                            <table class="table sipmpp__table-content indikator__tbl table-hover"
                                id="tablePPPMS2Indikator">
                                <thead class="bg__light">
                                    <tr>
                                        <th class="table__indikator-number">no</th>
                                        <th class="table__indikator-indikator">indikator</th>
                                        <th class="table__indikator-keterangan">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Indikator 1</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Indikator 2</td>
                                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                            similique
                                            nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                            mollitia et eligendi, laudantium blanditiis in aut.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- PPMS3 -->
                <div id="PPMS3Indikator" class="PPMIndikator">
                    <h5 style="font-weight: 600;">S3. Standar Proses PKM</h5>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ========== GENERATE CHART ========== -->
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

<script>
    $(function() {
        $(".filter__btn-chart").click(function() {
            // remove classes from all
            $(".filter__btn-chart").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
            // stop the page from jumping to the top
            return false;
        });
    });

    $(function() {
        $(".filter__btn-indikator").click(function() {
            // remove classes from all
            $(".filter__btn-indikator").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
            // stop the page from jumping to the top
            return false;
        });
    });

    // tooltips
    // progress bar unit
    const tooltipsUnitProgress =
        document.querySelectorAll(".unit__progressbar");
    tooltipsUnitProgress.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    // show and hide indikator chart
    $(document).ready(function() {
        $('#filterStandarPenelitian').change(function() {
            $('.PENIndikator').hide();
            $('#PENS' + $(this).val() + 'Indikator').show();
        });

        $('#filterStandarPengabdian').change(function() {
            $('.PPMIndikator').hide();
            $('#PPMS' + $(this).val() + 'Indikator').show();
        });
    });
</script>

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

<?= $this->endSection();
