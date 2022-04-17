<div class="chart__content-left col-lg-5 col-12">
    <div class="chart__content-dounat shadow__box-sm">
        <h6 id="unitStandar"><?= $data_user['unit'] ?></h6>
        <div class="content-unit__title">
            <h5 class="card__title">Status Nilai SPMI <span><?= $data_user['tahun']; ?></span>
            </h5>
            <div class="filter__panel">
                <div class="nav nav-pills" id="pills-tab" role="tablist">
                    <button class="btn filter__btn-chart me-0 me-md-3 shadow-none active nav-link active mb-3" id="pillsStandarPenelitian" data-bs-toggle="pill" data-bs-target="#pillsChartStandarPenelitian" type="button" role="tab" aria-controls="pillsChartStandarPenelitian" aria-selected="true">
                        Penelitian
                    </button>
                    <button class="btn filter__btn-chart shadow-none nav-link mb-3" id="pillsStandarPengabdian" data-bs-toggle="pill" data-bs-target="#pillsChartStandarPengabdian" type="button" role="tab" aria-controls="pillsChartStandarPengabdian" aria-selected="false">
                        Pengabdian Masyarakat
                    </button>
                </div>
            </div>
        </div>
        <hr />
        <div class="tab-content" id="pills-tabContent">
            <!-- penelitian -->
            <div class="tab-pane fade show active" id="pillsChartStandarPenelitian" role="tabpanel" aria-labelledby="pillsStandarPenelitian">
                <div class="chart__container">
                    <canvas id="chartStandarDoughnutPenelitian"></canvas>
                </div>
            </div>

            <!-- pengabdian masyarakat -->
            <div class="tab-pane fade" id="pillsChartStandarPengabdian" role="tabpanel" aria-labelledby="pillsStandarPengabdian">
                <div class="chart__container">
                    <canvas id="chartStandarDoughnutPengabdian"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>