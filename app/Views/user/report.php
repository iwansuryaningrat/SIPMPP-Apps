<?= $this->extend('template/userlayout'); ?>

<?= $this->section('user'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/" style="font-weight: 600;"><?= $data_user['unit']; ?></a>
    / Report
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Report Overview</h1>
      <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                      $name = trim($name);
                      $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                      $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                      return array($first_name, $last_name);
                    }
                    echo split_name($data_user['nama'])[0];
                    ?>
        </span>, selamat datang di halaman Report!</p>
    </div>
  </div>
</div>

<!-- body main -->
<ul class="nav nav-tabs nav__tabs" id="myTab" role="tablist">
  <li class="nav-item nav__item-tab" role="presentation">
    <button class="nav-link nav__link-tab active" id="penelitian-tab" data-bs-toggle="tab" data-bs-target="#penelitian" type="button" role="tab" aria-controls="penelitian" aria-selected="true">Penelitian</button>
  </li>
  <li class="nav-item nav__item-tab" role="presentation">
    <button class="nav-link nav__link-tab" id="pengabdian-tab" data-bs-toggle="tab" data-bs-target="#pengabdian" type="button" role="tab" aria-controls="pengabdian" aria-selected="false">Pengabdian Masyarakat</button>
  </li>
</ul>
<div class="tab-content tab__content" id="myTabContent">
  <!-- tab penelitian -->
  <div class="tab-pane fade show active" id="penelitian" role="tabpanel" aria-labelledby="penelitian-tab">
    <div class="title__tab">
      <h4>Rekap Indikator Penelitian</h4>
    </div>

    <div class="body__tab">

      <?php foreach ($stats['PEN'] as $stat) : ?>
        <!-- standar1 -->
        <div class="body__tab-item">
          <!-- title -->
          <div class="body__tab-item__title">
            <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePEN<?= $stat['kode'] ?>" role="button" aria-expanded="false" aria-controls="collapsePEN<?= $stat['kode'] ?>">
              <span><?= $stat['standar'] ?></span>
              <i class="fi-br-angle-down"></i>
            </a>
          </div>
          <!-- collapse -->
          <div class="collapse collapse__item" id="collapsePEN<?= $stat['kode'] ?>">
            <div class="mb-5 pt-3">
              <!-- bar chart standar 1 -->
              <div class="chart__collapse-container mb-4">
                <canvas id="barChartPEN<?= $stat['kode'] ?>"></canvas>
              </div>

              <!-- table indikator standar 1 -->
              <div class="table__collapse">
                <div class="sipmpp__table">
                  <div class="table__unit table-responsive">
                    <table class="table sipmpp__table-content table-hover" id="tableCollapsePEN<?= $stat['kode'] ?>">
                      <thead class="bg__light">
                        <tr>
                          <th class="table__collapse-number">no</th>
                          <th class="table__collapse-indikator">indikator</th>
                          <th class="table__collapse-keterangan">keterangan</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $i = 1;
                        foreach ($stat['namaindikator'] as $key => $value) : ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td>Indikator <?= $i; ?></td>
                            <td><?= $value; ?></td>
                          </tr>
                        <?php $i++;
                        endforeach ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>


  <!-- tab pengabdian masyarakat -->
  <div class="tab-pane fade" id="pengabdian" role="tabpanel" aria-labelledby="pengabdian-tab">
    <div class="title__tab">
      <h4>Rekap Indikator Pengabdian Masyarakat</h4>
    </div>

    <div class="body__tab">

      <?php foreach ($stats['PPM'] as $stat) : ?>
        <!-- standar1 -->
        <div class="body__tab-item">
          <!-- title -->
          <div class="body__tab-item__title">
            <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePPM<?= $stat['kode'] ?>" role="button" aria-expanded="false" aria-controls="collapsePPM<?= $stat['kode'] ?>">
              <span><?= $stat['standar'] ?></span>
              <i class="fi-br-angle-down"></i>
            </a>
          </div>
          <!-- collapse -->
          <div class="collapse collapse__item" id="collapsePPM<?= $stat['kode'] ?>">
            <div class="mb-5 pt-3">
              <!-- bar chart standar 1 -->
              <div class="chart__collapse-container mb-4">
                <canvas id="barChartPPM<?= $stat['kode'] ?>"></canvas>
              </div>

              <!-- table indikator standar 1 -->
              <div class="table__collapse">
                <div class="sipmpp__table">
                  <div class="table__unit table-responsive">
                    <table class="table sipmpp__table-content table-hover" id="tableCollapsePPM<?= $stat['kode'] ?>">
                      <thead class="bg__light">
                        <tr>
                          <th class="table__collapse-number">no</th>
                          <th class="table__collapse-indikator">indikator</th>
                          <th class="table__collapse-keterangan">keterangan</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $i = 1;
                        foreach ($stat['namaindikator'] as $key => $value) : ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td>Indikator <?= $i; ?></td>
                            <td><?= $value; ?></td>
                          </tr>
                        <?php $i++;
                        endforeach ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('userscript'); ?>

<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ===== CHART PENELITIAN ===== -->
<!-- Standar 1 -->
<?php foreach ($stats['PEN'] as $stat) : ?>
  <script>
    const labelsPEN<?= $stat['kode'] ?> = [
      <?php $i = 1;
      foreach ($stat['namaindikator'] as $key => $value) : ?> 'Indikator <?= $i; ?>',
      <?php $i++;
      endforeach; ?>
    ];

    const dataPEN<?= $stat['kode'] ?> = {
      labels: labelsPEN<?= $stat['kode'] ?>,
      datasets: [{
        label: 'Nilai Indikator',
        backgroundColor: 'rgb(15, 22, 67)',
        borderColor: 'rgba(255, 99, 132, 0)',
        data: [
          <?php foreach ($stat['nilai'] as $key => $value) : ?> <?= $value; ?>,
          <?php endforeach; ?>
        ],
      }]
    };

    const configPEN<?= $stat['kode'] ?> = {
      type: 'bar',
      data: dataPEN<?= $stat['kode'] ?>,
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

    const barChartPEN<?= $stat['kode'] ?> = new Chart(
      document.getElementById('barChartPEN<?= $stat['kode'] ?>'),
      configPEN<?= $stat['kode'] ?>
    );
  </script>
<?php endforeach; ?>

<!-- ===== CHART PENGABDIAN MASYARAKAT ===== -->
<?php foreach ($stats['PPM'] as $stat) : ?>
  <!-- Standar 1 -->
  <script>
    const leblsPPM<?= $stat['kode'] ?> = [
      <?php $i = 1;
      foreach ($stat['namaindikator'] as $key => $value) : ?> 'Indikator <?= $i; ?>',
      <?php $i++;
      endforeach; ?>
    ];

    const dataPPM<?= $stat['kode'] ?> = {
      labels: leblsPPM<?= $stat['kode'] ?>,
      datasets: [{
        label: 'Nilai Indikator',
        backgroundColor: 'rgb(15, 22, 67)',
        borderColor: 'rgba(255, 99, 132, 0)',
        data: [
          <?php foreach ($stat['nilai'] as $key => $value) : ?> <?= $value; ?>,
          <?php endforeach; ?>
        ],
      }]
    };

    const configPPM<?= $stat['kode'] ?> = {
      type: 'bar',
      data: dataPPM<?= $stat['kode'] ?>,
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

    const barChartPPM<?= $stat['kode'] ?> = new Chart(
      document.getElementById('barChartPPM<?= $stat['kode'] ?>'),
      configPPM<?= $stat['kode'] ?>
    );
  </script>
<?php endforeach; ?>

<?= $this->endSection();
