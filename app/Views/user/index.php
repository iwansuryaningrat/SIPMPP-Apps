<?= $this->extend('template/userlayout'); ?>

<?= $this->section('user'); ?>



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
          <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%" data-bs-toggle="tooltip" data-bs-placement="top" title="72%"></div>
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
          <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width: 42%" data-bs-toggle="tooltip" data-bs-placement="top" title="42%"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- rekap content -->
<div class="recap__content">
  <!-- left -->
  <div class="recap__content-link">
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
  </div>

  <!-- right -->
  <!-- table unit -->
  <div class="recap__content-unit">
    <div class="sipmpp__table radius__lg shadow__box-sm">
      <h5 class="card__title mb-0">Daftar Unit</h5>
      <div class="table__unit table-responsive">
        <table class="table table__unit__content sipmpp__table-content table-hover">
          <thead class="bg__light">
            <tr>
              <th class="table__unit__head__number">No</th>
              <th class="table__unit__head__unit">Unit</th>
              <th class="table__unit__head__progress">Progress</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td>1</td>
              <td><a href="#" class="unit__link">LPPM</a></td>
              <td>
                <div class="progress table__unit__progress">
                  <div class="progress-bar bg__dark-main unit__progressbar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%" data-bs-toggle="tooltip" data-bs-placement="top" title="60%"></div>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- chart content -->
<div class="chart__content">
  <!-- left -->
  <div class="chart__content-left">
    <div class="chart__content-dounat shadow__box-sm">
      <h5 class="card__title mb-5">Nilai SPMI <span>2018</span></h5>
      <canvas id="myChartSpmi" width="400" height="400"></canvas>
    </div>
  </div>

  <!-- right -->
  <div class="chart__content-right">
    <div class="chart__content-chart shadow__box-sm"></div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('userscript'); ?>
<!-- chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- generate chart -->
<script>
  const myChartSpmi = document.getElementById('myChartSpmi').getContext('2d');

  const popChartSpmi = new Chart(myChartSpmi, {
    type: 'doughnut',
    data: {
      labels: [
        'S1',
        'S2',
        'S3',
        'S4',
        'S5',
        'S6',
        'S7',
        'S8',
        'S9',
        'S10',
        'S11',
        'S12'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100, 40, 120, 80, 20, 10, 30, 60, 90, 40],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(153, 102, 255)',
          'rgb(255, 159, 64)',
          'rgb(24, 99, 132)',
          'rgb(54, 162, 25)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(153, 102, 255)',
          'rgb(255, 159, 64)'
        ],
        hoverOffset: 2
      }],
      options: {
        legend: {
          position: 'bottom',
          labels: {
            fontSize: 40,
          }
        }
      }

    }
  });
</script>
<script>
  // tooltips
  // progress bar unit
  const tooltipsUnitProgress =
    document.querySelectorAll(".unit__progressbar");
  tooltipsUnitProgress.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
