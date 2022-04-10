<?= $this->extend('template/userlayout'); ?>

<?= $this->section('user'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/">Dashboard</a>
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
    <button class="nav-link nav__link-tab active" id="penelitian-tab" data-bs-toggle="tab" data-bs-target="#penelitian"
      type="button" role="tab" aria-controls="penelitian" aria-selected="true">Penelitian</button>
  </li>
  <li class="nav-item nav__item-tab" role="presentation">
    <button class="nav-link nav__link-tab" id="pengabdian-tab" data-bs-toggle="tab" data-bs-target="#pengabdian"
      type="button" role="tab" aria-controls="pengabdian" aria-selected="false">Pengabdian Masyarakat</button>
  </li>
</ul>
<div class="tab-content tab__content" id="myTabContent">
  <!-- tab penelitian -->
  <div class="tab-pane fade show active" id="penelitian" role="tabpanel" aria-labelledby="penelitian-tab">
    <div class="title__tab">
      <h4>Rekap Indikator Penelitian</h4>
    </div>

    <div class="body__tab">
      <!-- standar1 -->
      <div class="body__tab-item">
        <!-- title -->
        <div class="body__tab-item__title">
          <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePENS1" role="button" aria-expanded="false"
            aria-controls="collapsePENS1">
            <span>S1. Standar Hasil Penelitian</span>
            <i class="fi-br-angle-down"></i>
          </a>
        </div>
        <!-- collapse -->
        <div class="collapse collapse__item" id="collapsePENS1">
          <div class="mb-5 pt-3">
            <!-- bar chart standar 1 -->
            <div class="chart__collapse-container mb-4">
              <canvas id="barChartPENS1"></canvas>
            </div>

            <!-- table indikator standar 1 -->
            <div class="table__collapse">
              <div class="sipmpp__table">
                <div class="table__unit table-responsive">
                  <table class="table sipmpp__table-content table-hover" id="tableCollapsePENS1">
                    <thead class="bg__light">
                      <tr>
                        <th class="table__collapse-number">no</th>
                        <th class="table__collapse-indikator">indikator</th>
                        <th class="table__collapse-keterangan">keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Indikator 1</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nobis officia voluptatum
                          expedita natus adipisci porro ullam numquam earum, vel quam accusantium, doloribus nostrum
                          quisquam laudantium eaque rerum molestiae labore.</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Indikator 2</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio fugiat eos unde eius ipsam
                          voluptate vero! Quaerat similique nostrum dolor facilis illo nesciunt perferendis blanditiis,
                          ducimus eveniet quos sit perspiciatis?</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- standar2 -->
      <div class="body__tab-item">
        <!-- title -->
        <div class="body__tab-item__title">
          <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePENS2" role="button" aria-expanded="false"
            aria-controls="collapsePENS2">
            <span>S2. Standar Sistem Informasi Penelitian</span>
            <i class="fi-br-angle-down"></i>
          </a>
        </div>
        <!-- collapse -->
        <div class="collapse collapse__item" id="collapsePENS2">
          <div class="mb-5 pt-3">
            <!-- bar chart standar 2 -->
            <div class="chart__collapse-container mb-4">
              <canvas id="barChartPENS2"></canvas>
            </div>

            <!-- table indikator standar 2 -->
            <div class="table__collapse">
              <div class="sipmpp__table">
                <div class="table__unit table-responsive">
                  <table class="table sipmpp__table-content table-hover" id="tableCollapsePENS2">
                    <thead class="bg__light">
                      <tr>
                        <th class="table__collapse-number">no</th>
                        <th class="table__collapse-indikator">indikator</th>
                        <th class="table__collapse-keterangan">keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Indikator 1</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nobis officia voluptatum
                          expedita natus adipisci porro ullam numquam earum, vel quam accusantium, doloribus nostrum
                          quisquam laudantium eaque rerum molestiae labore.</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Indikator 2</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio fugiat eos unde eius ipsam
                          voluptate vero! Quaerat similique nostrum dolor facilis illo nesciunt perferendis blanditiis,
                          ducimus eveniet quos sit perspiciatis?</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- tab pengabdian masyarakat -->
  <div class="tab-pane fade" id="pengabdian" role="tabpanel" aria-labelledby="pengabdian-tab">
    <div class="title__tab">
      <h4>Rekap Indikator Pengabdian Masyarakat</h4>
    </div>

    <div class="body__tab">
      <!-- standar1 -->
      <div class="body__tab-item">
        <!-- title -->
        <div class="body__tab-item__title">
          <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePPMS1" role="button" aria-expanded="false"
            aria-controls="collapsePPMS1">
            <span>S1. Standar Hasil PKM</span>
            <i class="fi-br-angle-down"></i>
          </a>
        </div>
        <!-- collapse -->
        <div class="collapse collapse__item" id="collapsePPMS1">
          <div class="mb-5 pt-3">
            <!-- bar chart standar 1 -->
            <div class="chart__collapse-container mb-4">
              <canvas id="barChartPPMS1"></canvas>
            </div>

            <!-- table indikator standar 1 -->
            <div class="table__collapse">
              <div class="sipmpp__table">
                <div class="table__unit table-responsive">
                  <table class="table sipmpp__table-content table-hover" id="tableCollapsePPMS1">
                    <thead class="bg__light">
                      <tr>
                        <th class="table__collapse-number">no</th>
                        <th class="table__collapse-indikator">indikator</th>
                        <th class="table__collapse-keterangan">keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Indikator 1</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nobis officia voluptatum
                          expedita natus adipisci porro ullam numquam earum, vel quam accusantium, doloribus nostrum
                          quisquam laudantium eaque rerum molestiae labore.</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Indikator 2</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio fugiat eos unde eius ipsam
                          voluptate vero! Quaerat similique nostrum dolor facilis illo nesciunt perferendis blanditiis,
                          ducimus eveniet quos sit perspiciatis?</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- standar2 -->
      <div class="body__tab-item">
        <!-- title -->
        <div class="body__tab-item__title">
          <a class="tab-item__link" data-bs-toggle="collapse" href="#collapsePPMS2" role="button" aria-expanded="false"
            aria-controls="collapsePPMS2">
            <span>S2. Standar Sistem Informasi PKM</span>
            <i class="fi-br-angle-down"></i>
          </a>
        </div>
        <!-- collapse -->
        <div class="collapse collapse__item" id="collapsePPMS2">
          <div class="mb-5 pt-3">
            <!-- bar chart standar 2 -->
            <div class="chart__collapse-container mb-4">
              <canvas id="barChartPPMS2"></canvas>
            </div>

            <!-- table indikator standar 2 -->
            <div class="table__collapse">
              <div class="sipmpp__table">
                <div class="table__unit table-responsive">
                  <table class="table sipmpp__table-content table-hover" id="tableCollapsePPMS2">
                    <thead class="bg__light">
                      <tr>
                        <th class="table__collapse-number">no</th>
                        <th class="table__collapse-indikator">indikator</th>
                        <th class="table__collapse-keterangan">keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Indikator 1</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nobis officia voluptatum
                          expedita natus adipisci porro ullam numquam earum, vel quam accusantium, doloribus nostrum
                          quisquam laudantium eaque rerum molestiae labore.</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Indikator 2</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio fugiat eos unde eius ipsam
                          voluptate vero! Quaerat similique nostrum dolor facilis illo nesciunt perferendis blanditiis,
                          ducimus eveniet quos sit perspiciatis?</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('userscript'); ?>

<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ===== CHART PENELITIAN ===== -->
<!-- Standar 1 -->
<script>
  const labelsPENS1 = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5', 'Indikator 6',
    'Indikator 7', 'Indikator 8',
  ];

  const dataPENS1 = {
    labels: labelsPENS1,
    datasets: [{
      label: 'Nilai Indikator',
      backgroundColor: 'rgb(15, 22, 67)',
      borderColor: 'rgba(255, 99, 132, 0)',
      data: [6, 10, 5, 2, 20, 30, 45, 96],
    }]
  };

  const configPENS1 = {
    type: 'bar',
    data: dataPENS1,
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
          text: 'Data Indikator Standar Hasil Penelitian'
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

  const barChartPENS1 = new Chart(
    document.getElementById('barChartPENS1'),
    configPENS1
  );
</script>

<!-- Standar 2 -->
<script>
  const labelsPENS2 = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5', 'Indikator 6',
    'Indikator 7', 'Indikator 8',
  ];

  const dataPENS2 = {
    labels: labelsPENS2,
    datasets: [{
      label: 'Nilai Indikator',
      backgroundColor: 'rgb(15, 22, 67)',
      borderColor: 'rgba(255, 99, 132, 0)',
      data: [18, 20, 75, 38, 24, 84, 56, 100],
    }]
  };

  const configPENS2 = {
    type: 'bar',
    data: dataPENS2,
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
          text: 'Data Indikator Standar Sistem Informasi Penelitian'
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

  const barChartPENS2 = new Chart(
    document.getElementById('barChartPENS2'),
    configPENS2
  );
</script>

<!-- ===== CHART PENGABDIAN MASYARAKAT ===== -->
<!-- Standar 1 -->
<script>
  const leblsPPMS1 = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5', 'Indikator 6',
    'Indikator 7', 'Indikator 8',
  ];

  const dataPPMS1 = {
    labels: leblsPPMS1,
    datasets: [{
      label: 'Nilai Indikator',
      backgroundColor: 'rgb(15, 22, 67)',
      borderColor: 'rgba(255, 99, 132, 0)',
      data: [6, 10, 5, 2, 20, 30, 45, 96],
    }]
  };

  const configPPMS1 = {
    type: 'bar',
    data: dataPPMS1,
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
          text: 'Data Indikator Standar Hasil PKM'
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

  const barChartPPMS1 = new Chart(
    document.getElementById('barChartPPMS1'),
    configPPMS1
  );
</script>

<!-- Standar 2 -->
<script>
  const labelsPPMS2 = ['Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5', 'Indikator 6',
    'Indikator 7', 'Indikator 8',
  ];

  const dataPPMS2 = {
    labels: labelsPPMS2,
    datasets: [{
      label: 'Nilai Indikator',
      backgroundColor: 'rgb(15, 22, 67)',
      borderColor: 'rgba(255, 99, 132, 0)',
      data: [18, 20, 75, 38, 24, 84, 56, 100],
    }]
  };

  const configPPMS2 = {
    type: 'bar',
    data: dataPPMS2,
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
          text: 'Data Indikator Standar Sistem Informasi PKM'
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

  const barChartPPMS2 = new Chart(
    document.getElementById('barChartPPMS2'),
    configPPMS2
  );
</script>

<?= $this->endSection();
