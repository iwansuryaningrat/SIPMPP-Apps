<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <span id="unit-user" style="font-weight: 600"><?= $data_user['unit']; ?></span>
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Dashboard Overview</h1>
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
      <a href="/home/report" class="report__link big__btn btn__dark">
        <img src="/assets/img/icon/report-icon.svg" alt="icon-report" />
        <span>Report</span>
      </a>
    </div>
  </div>
</div>

<!-- body main -->
<!-- progress pengisian -->
<div class="progress__content">
  <div class="progress__content-card mb-3 mb-sm-4 mb-lg-0 shadow__box-sm" id="progress-data-induk">
    <div class="d-flex align-items-center mb-2">
      <div class="progress__icon-warp">
        <img src="/assets/img/logo-data-induk.svg" alt="logo-data-induk" />
      </div>
      <h5 class="card__title mb-2">Pengisian Data Induk <span><?= $data_user['tahun']; ?></span></h5>
    </div>

    <div class="progress__content-progress">
      <div class="progress__content-progress-desc">
        <p>Task Complete</p>
        <p>72%</p>
      </div>
      <div>
        <div class="progress progress__content-progress-bar">
          <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="72"
            aria-valuemin="0" aria-valuemax="100" style="width: 72%" data-bs-toggle="tooltip" data-bs-placement="top"
            title="72%"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="progress__content-card shadow__box-sm" id="progress-spmi">
    <div class="d-flex align-items-center mb-2">
      <div class="progress__icon-warp">
        <img src="/assets/img/logo-spmi.svg" alt="logo-spmi" />
      </div>
      <h5 class="mb-3 card__title">Pengisian Nilai SPMI <span><?= $data_user['tahun']; ?></span></h5>
    </div>

    <div class="progress__content-progress">
      <div class="progress__content-progress-desc">
        <p>Task Complete</p>
        <p>5/12 Standar (42%)</p>
      </div>
      <div>
        <div class="progress progress__content-progress-bar">
          <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="42"
            aria-valuemin="0" aria-valuemax="100" style="width: 42%" data-bs-toggle="tooltip" data-bs-placement="top"
            title="42%"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- rekap content -->
<!-- <div class="recap__content"> -->
<!-- left -->
<!-- <div class="recap__content-link">
    <div class="recap__link-card shadow__box-md">
      <div class="recap__link-card__body">
        <img src="/assets/img/penelitian-logo.svg" alt="penelitian-logo" />
        <h5 class="card__title mb-0 ellipsis__text">Penelitian</h5>
      </div>
      <div class="recap__link-card__footer">
        <a href="/home/standar">
          <span class="ellipsis__text">Selengkapnya</span>
          <i class="bi bi-arrow-right-circle d-flex"></i>
        </a>
      </div>
    </div>

    <div class="recap__link-card shadow__box-md">
      <div class="recap__link-card__body">
        <img src="/assets/img/pengabdian-masyarakat-logo.svg" alt="penelitian-logo" />
        <h5 class="card__title mb-0 ellipsis__text">
          Pengabdian Masyarakat
        </h5>
      </div>
      <div class="recap__link-card__footer">
        <a href="/home/standar">
          <span class="ellipsis__text">Selengkapnya</span>
          <i class="bi bi-arrow-right-circle d-flex"></i>
        </a>
      </div>
    </div>
  </div> -->

<!-- right -->
<!-- table unit -->
<!-- <div class="recap__content-unit">
    <div class="sipmpp__table radius__lg shadow__box-sm">
      <div class="content-unit__title">
        <h5 class="card__title mb-3">Progress SPMI <span><?= $data_user['tahun']; ?></span>
</h5>
<div class="filter__panel mb-3">
  <div class="nav nav-pills" id="pills-tab" role="tablist">
    <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active" id="pills-spmi-penelitian"
      data-bs-toggle="pill" data-bs-target="#pills-table-spmi-penelitian" type="button" role="tab"
      aria-controls="pills-table-spmi-penelitian" aria-selected="true">
      Penelitian
    </button>
    <button class="btn filter__btn shadow-none nav-link" id="pills-spmi-pm" data-bs-toggle="pill"
      data-bs-target="#pills-table-spmi-pm" type="button" role="tab" aria-controls="pills-table-spmi-pm"
      aria-selected="false">
      Pengabdian Masyarakat
    </button>
  </div>
</div>
</div> -->

<!-- <div class="tab-content" id="pills-tabContent"> -->
<!-- table penelitian -->
<!-- <div class="tab-pane fade show active" id="pills-table-spmi-penelitian" role="tabpanel" aria-labelledby="pills-spmi-penelitian">
          <div class="table__unit table-responsive">
            <table class="table table__unit__content sipmpp__table-content table-hover">
              <thead class="bg__light">
                <tr>
                  <th class="table__unit__head__number">#</th>
                  <th class="table__unit__head__unit">nama standar</th>
                  <th class="table__unit__head__progress">Progress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>S1</td>
                  <td>Standar Peneliti</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%" data-bs-toggle="tooltip" data-bs-placement="top" title="60%"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>S2</td>
                  <td>Standar Sistem Informasi Penelitian</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%" data-bs-toggle="tooltip" data-bs-placement="top" title="40%"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>S3</td>
                  <td>Standar Pembelajaran</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%" data-bs-toggle="tooltip" data-bs-placement="top" title="90%"></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div> -->

<!-- table pengabdian masyarakat -->
<!-- <div class="tab-pane fade" id="pills-table-spmi-pm" role="tabpanel" aria-labelledby="pills-spmi-pm">
          <div class="table__unit table-responsive">
            <table class="table table__unit__content sipmpp__table-content table-hover">
              <thead class="bg__light">
                <tr>
                  <th class="table__unit__head__number">#</th>
                  <th class="table__unit__head__unit">nama standar</th>
                  <th class="table__unit__head__progress">Progress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>S1</td>
                  <td>Standar Pengabdian</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%" data-bs-toggle="tooltip" data-bs-placement="top" title="40%"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>S2</td>
                  <td>Standar Sistem Informasi Penelitian</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100" style="width: 17%" data-bs-toggle="tooltip" data-bs-placement="top" title="17%"></div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>S3</td>
                  <td>Standar Kerjasama Pendidikan</td>
                  <td>
                    <div class="progress table__unit__progress">
                      <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100" style="width: 3%" data-bs-toggle="tooltip" data-bs-placement="top" title="3%"></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- chart content -->
<!-- <div class="chart__content"> -->
<!-- left -->
<!-- <div class="chart__content-left">
    <div class="chart__content-dounat shadow__box-sm">
      <div class="content-unit__title">
        <h5 class="card__title">Nilai SPMI <span>2018</span></h5>
        <div class="filter__panel mb-3">
          <div class="nav nav-pills" id="pills-tab" role="tablist">
            <button class="btn filter__btn-chart me-0 me-md-3 shadow-none active nav-link active"
              id="pillsStandarPenelitian" data-bs-toggle="pill" data-bs-target="#pillsChartStandarPenelitian"
              type="button" role="tab" aria-controls="pillsChartStandarPenelitian" aria-selected="true">
              Penelitian
            </button>
            <button class="btn filter__btn-chart shadow-none nav-link" id="pillsStandarPengabdian" data-bs-toggle="pill"
              data-bs-target="#pillsChartStandarPengabdian" type="button" role="tab"
              aria-controls="pillsChartStandarPengabdian" aria-selected="false">
              Pengabdian Masyarakat
            </button>
          </div>
        </div>
      </div>
      <div class="tab-content" id="pills-tabContent"> -->
<!-- penelitian -->
<!-- <div class="tab-pane fade show active" id="pillsChartStandarPenelitian" role="tabpanel"
          aria-labelledby="pillsStandarPenelitian">
          <div class="chart__container">
            <canvas id="chartStandarDoughnutPenelitian"></canvas>
          </div>
        </div> -->

<!-- pengabdian masyarakat -->
<!-- <div class="tab-pane fade" id="pillsChartStandarPengabdian" role="tabpanel"
          aria-labelledby="pillsStandarPengabdian">
          <div class="chart__container">
            <canvas id="chartStandarDoughnutPengabdian"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<!-- right -->
<!-- <div class="chart__content-right">
    <div class="chart__content-line shadow__box-sm">
      <h5 class="card__title mb-5">Nilai SPMI</h5>
      <canvas id="chartStandarLine" width="540" height="400"></canvas>
    </div>
  </div>
</div> -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ========== GENERATE CHART ========== -->
<!-- penelitian -->
<script>
  // ========== CONFIG CHART DOUNAT ==========
  // setup block
  const labelsDoughnutPenelitian = ['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S10', 'S11', 'S12'];

  const dataDoughnutPenelitian = {
    labels: labelsDoughnutPenelitian,
    datasets: [{
      label: 'Standar Dataset',
      data: [300, 50, 100, 40, 120, 80, 20, 10, 30, 60, 90, 40],
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
      hoverOffset: 3,
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
      ctx.font = '60px Work Sans';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText('97%', width / 2, (height / 2));
      // x0 = starting point ont the horizontal level l/r
      // y0 = starting point on the vertical level t/b
      // x1 = length of the shape in pixel horizontal level
      // y1 = length of the shape in pixel vertical level
    }
  };

  // config block
  const configDoughnutPenelitian = {
    type: 'doughnut',
    data: dataDoughnutPenelitian,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        },
      }
    },
    // options: {},
    plugins: [counterDoughnutPenelitian]
  };

  // ========== RENDER CHART DOUNAT ==========
  const chartStandarDoughnutPenelitian = new Chart(
    document.getElementById('chartStandarDoughnutPenelitian'),
    configDoughnutPenelitian
  );
</script>
<!-- pengabdian -->
<script>
  // ========== CONFIG CHART DOUNAT ==========
  // setup block
  const labelsDoughnutPengabdian = ['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S10', 'S11', 'S12'];

  const dataDoughnutPengabdian = {
    labels: labelsDoughnutPengabdian,
    datasets: [{
      label: 'Standar Dataset',
      data: [300, 50, 100, 40, 120, 80, 20, 10, 30, 60, 90, 40],
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
      hoverOffset: 3,
      borderWidth: 0,
      cutout: '70%',
    }]
  };

  // conter plugin block
  const counterDoughnutPengabdian = {
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
      ctx.font = '60px Work Sans';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText('57%', width / 2, (height / 2));
      // x0 = starting point ont the horizontal level l/r
      // y0 = starting point on the vertical level t/b
      // x1 = length of the shape in pixel horizontal level
      // y1 = length of the shape in pixel vertical level
    }
  };

  // config block
  const configDoughnutPengabdian = {
    type: 'doughnut',
    data: dataDoughnutPengabdian,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
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

<script>
  // ========== CONFIG CHART LINE ==========
  const labelsLine = ['2018', '2019', '2020', '2021', '2022'];

  const dataLine = {
    labels: labelsLine,
    datasets: [{
        label: 'Penelitian',
        data: [120, 49, 24, 84, 56],
        backgroundColor: [
          'rgba(15, 22, 67, .2)',
          'rgba(38, 48, 77, .2)',
          'rgba(189, 179, 185, .2)',
          'rgba(191, 125, 115, .2)',
          'rgba(178, 99, 87, .2)',
        ],
        borderColor: [
          'rgba(15, 22, 67, 1)',
          'rgba(38, 48, 77, 1)',
          'rgba(189, 179, 185, 1)',
          'rgba(191, 125, 115, 1)',
          'rgba(178, 99, 87, 1)',
        ],
        borderWidth: 2,
      },
      {
        label: 'Pengabdian Masyarakat',
        data: [59, 80, 63, 28, 64],
        backgroundColor: [
          'rgba(15, 22, 67, .2)',
          'rgba(38, 48, 77, .2)',
          'rgba(189, 179, 185, .2)',
          'rgba(191, 125, 115, .2)',
          'rgba(178, 99, 87, .2)',
        ],
        borderColor: [
          'rgba(15, 22, 67, 1)',
          'rgba(38, 48, 77, 1)',
          'rgba(189, 179, 185, 1)',
          'rgba(191, 125, 115, 1)',
          'rgba(178, 99, 87, 1)',
        ],
        borderWidth: 2,
      }
    ]
  };

  const configLine = {
    type: 'line',
    data: dataLine,
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  // ========== RENDER CHART DOUNAT ==========
  const chartStandarLine = new Chart(
    document.getElementById('chartStandarLine'),
    configLine
  );
</script>

<script>
  // active filer button
  $(function() {
    $(".filter__btn").click(function() {
      // remove classes from all
      $(".filter__btn").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
      // stop the page from jumping to the top
      return false;
    });
  });

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

  // tooltips
  // progress bar unit
  const tooltipsUnitProgress =
    document.querySelectorAll(".unit__progressbar");
  tooltipsUnitProgress.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
