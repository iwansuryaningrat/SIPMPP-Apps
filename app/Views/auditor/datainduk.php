<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/">Audit <?= $data_user['unit']; ?></a>
    / Data Induk
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Audit Data Induk</h1>
      <p>
        Daftar data induk sesuai dengan kategori dan kebutuhan data.
      </p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<h4 class="title__body__main">Unit: <span><?= $data_user['unit']; ?></span> <span><?= $data_user['tahun']; ?></span></h4>

<!-- filter -->
<div class="filter__table">
  <div class="nav nav-pills" id="pills-tab" role="tablist">
    <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active ellipsis__text" id="pills-datainduk-penelitian" data-bs-toggle="pill" data-bs-target="#pills-table-datainduk-penelitian" type="button" role="tab" aria-controls="pills-table-datainduk-penelitian" aria-selected="true">
      Penelitian
    </button>
    <button class="btn filter__btn shadow-none nav-link ellipsis__text" id="pills-datainduk-pm" data-bs-toggle="pill" data-bs-target="#pills-table-datainduk-pm" type="button" role="tab" aria-controls="pills-table-datainduk-pm" aria-selected="false">
      Pengabdian Masyarakat
    </button>
  </div>
</div>

<!-- =====data table induk =====-->
<div class="tab-content" id="pills-tabContent">
  <!-- Menampilkan Flashdata Message -->
  <?= session()->getFlashdata('message'); ?>

  <!-- penelitian -->
  <div class="tab-pane fade show active" id="pills-table-datainduk-penelitian" role="tabpanel" aria-labelledby="pills-datainduk-penelitian">
    <div class="sipmpp__table">
      <div class="table-responsive">
        <table class="table table__datainduk__content sipmpp__table-content table-hover" id="datainduk-penelitian">
          <thead class="bg__light">
            <tr>
              <th class="table__datainduk-number">No</th>
              <th class="table__datainduk-kode">kode</th>
              <th class="table__datainduk-kebutuhandata">Kebutuhan Data</th>
              <th class="table__datainduk-nilai">Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_indukPen as $datainduk) : ?>
              <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $datainduk['induk_id']; ?>
                </td>
                <td><?= $datainduk['nama_induk']; ?>
                </td>
                <td><?= $datainduk['nilai']; ?>
                </td>
              </tr>
            <?php $i++;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- pengabdian masyarakat -->
  <div class="tab-pane fade" id="pills-table-datainduk-pm" role="tabpanel" aria-labelledby="pills-datainduk-pm">
    <div class="sipmpp__table">
      <div class="table-responsive">
        <table class="table table__datainduk__content sipmpp__table-content table-hover" id="datainduk-pm">
          <thead class="bg__light">
            <tr>
              <th class="table__datainduk-number">No</th>
              <th class="table__datainduk-kode">kode</th>
              <th class="table__datainduk-kebutuhandata">Kebutuhan Data</th>
              <th class="table__datainduk-nilai">Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($data_indukPPM as $datainduk) : ?>
              <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $datainduk['induk_id']; ?>
                </td>
                <td><?= $datainduk['nama_induk']; ?>
                </td>
                <td><?= $datainduk['nilai']; ?>
                </td>
              </tr>
            <?php $i++;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

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
</script>

<?= $this->endSection();
