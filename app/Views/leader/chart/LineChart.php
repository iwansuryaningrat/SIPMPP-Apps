<div class="chart__content-right col-lg-7 col-12">
    <div class="chart__content-line shadow__box-sm">
        <h6 id="unitTahun"><?= $data_user['unit'] ?></h6>
        <h5 class="card__title">Analisis Kategori Tahunan</h5>
        <div class="chart__container">
            <canvas id="chartStandarLine"></canvas>
            <div class="legends__chart">
                <button id="legendsPenelitian" class="legends__item btn shadow-none ellipsis__text" onclick="toggleDataChart(0)"></button>
                <button id="legendsPengabdian" class="legends__item btn shadow-none ellipsis__text" onclick="toggleDataChart(1)"></button>
            </div>
        </div>
    </div>
</div>