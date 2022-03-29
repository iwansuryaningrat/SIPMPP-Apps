<?= $this->extend('template/userlayout'); ?>

<?= $this->section('user'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/" style="font-weight: 600;"><?= $data_user['unit']; ?></a>
    / <a href="/home/standar">Nilai SPMI</a> /
    <a href="/">Indikator</a> / Form Indikator
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Penilaian Sistem Penjamin Mutu Internal</h1>
      <p>Menilai SPMI sesuai unit standar</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<h4 class="title__body__indikator-u">
  Unit: <span><?= $data_user['unit']; ?></span>
</h4>
<h4 class="title__body__indikator-s">
  <?= $standar['standar_id'] . '. ' . $standar['nama_standar']; ?>
</h4>

<!-- form indikator -->
<div class="mb-5"></div>
<div class="form__indikator">
  <form method="POST" action="/home/saveindikator/<?= $datapenilaian[0]['indikator_id'] . '/' . $tahun . '/' . $datapenilaian[0]['standar_id'] . '/' . $data_user['unit_id'] . '/' . $datapenilaian[0]['kategori_id']; ?>" enctype="multipart/form-data">
    <!-- indikator -->
    <div class="row mb-3">
      <label for="indikator" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Indikator</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="indikator" name="indikator" cols="30" rows="3" disabled required><?= $datapenilaian[0]['nama_indikator']; ?></textarea>
      </div>
    </div>
    <!-- target -->
    <div class="row mb-3">
      <label for="target" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Target</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" name="target" id="target" cols="30" rows="3" disabled required><?= $datapenilaian[0]['target']; ?></textarea>
      </div>
    </div>
    <!-- kebutuhan data -->
    <div class="row mb-3 mb-sm-4">
      <label for="kebutuhan-data" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kebutuhan Data</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="kebutuhan-data" name="kebutuhan-data" cols="30" rows="3" disabled required><?= $induk['nama_induk']; ?></textarea>
      </div>
    </div>
    <!-- satuan -->
    <div class="row mb-3 mb-sm-4">
      <label for="satuan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Satuan</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <input class="form-control form__control shadow-none" id="satuan" name="satuan" disabled required value="<?= $datapenilaian[0]['satuan']; ?>" />
      </div>
    </div>

    <div class="row mb-3">
      <label for="hasil" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Hasil <span class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <select class="form-select form__select shadow-none" name="hasil" id="hasil">
          <option selected disabled>Pilih hasil data</option>
          <option value="ADA / SESUAI">ADA / SESUAI</option>
          <option value="Tidak ADA / TIDAK SESUAI">Tidak ADA / TIDAK SESUAI</option>
        </select>
      </div>
    </div>

    <!-- dokumen -->
    <div class="row mb-3">
      <label for="dokumen" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Dokumen <span class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <div class="input-group">
          <input type="file" class="form-control form__control shadow-none" name="dokumen" id="dokumen" required />
          <label class="input-group-text" for="dokumen">Upload</label>
        </div>
      </div>
    </div>
    <!-- keterangan -->
    <div class="row mb-3">
      <label for="keterangan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Keterangan <span class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="keterangan" cols="30" rows="3" name="keterangan"></textarea>
      </div>
    </div>
    <!-- catatan -->
    <div class="row mb-3">
      <label for="catatan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Catatan</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" name="catatan" id="catatan" cols="30" rows="3" disabled><?= $datapenilaian[0]['catatan']; ?></textarea>
      </div>
    </div>
    <!-- button -->
    <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12 button__section">
        <a href="/home/indikator/<?= $standar['standar_id'] . '/' . $tahun . '/' . $datapenilaian[0]['kategori_id'] ?>" class="btn form__btn cancel__btn me-4" role="button">Batal</a>
        <button type="submit" class="btn form__btn btn__dark shadow-none">
          Simpan
        </button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('userscript'); ?>

<script>
  // dropdown
  $(document).click((e) => {
    if (
      e.target.id !== "header-main-nav-dropdown" &&
      e.target.id !== "btn-dropdown" &&
      e.target.id !== "photo-dropdown"
    ) {
      $("#header-main-nav-dropdown").removeClass("active");
    }
  });
  $("#btn-dropdown").click(() => {
    $("#header-main-nav-dropdown").toggleClass("active");
  });
  $("#photo-dropdown").click(() => {
    $("#header-main-nav-dropdown").toggleClass("active");
  });

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

  // tooltips
  // progress bar unit
  const tooltipsEdit = document.querySelectorAll(
    ".edit__data__induk__icon"
  );
  tooltipsEdit.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
