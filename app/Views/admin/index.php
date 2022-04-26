<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    Dashboard Admin
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Dashboard Admin Overview</h1>
      <p>Halo <span>
          <?php // uses regex that accepts any word character or hyphen in last name
          function getFirstWord($string)
          {
              $arr = explode(' ', trim($string));
              return isset($arr[0]) ? $arr[0] : $string;
          }
          echo getFirstWord($data_user['nama']);
          ?>
        </span>, selamat datang kembali!</p>
    </div>
    <div class="title__subtitle-btn">
    </div>
  </div>
</div>

<!-- body main -->
<div class="recap__content">
  <!-- table unit -->
  <div class="recap__content-unit">
    <div class="sipmpp__table radius__lg">
      <h5 class="card__title mb-0">Daftar Unit</h5>
      <div class="table__unit table-responsive">
        <table class="table table__unit__content sipmpp__table-content table-hover">
          <thead class="bg__light">
            <tr>
              <th class="table__unit__head__number">No</th>
              <th class="table__unit__head__unit">Unit</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($units as $unit) : ?>
            <tr>
              <td><?= $i; ?>
              </td>
              <td><?= $unit['nama_unit']; ?>
              </td>
            </tr>
            <?php $i++;
            endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- table unit -->
  <div class="recap__content-unit">
    <div class="sipmpp__table radius__lg">
      <h5 class="card__title mb-0">Daftar Kategori</h5>
      <div class="table__unit table-responsive">
        <table class="table table__kategori__content sipmpp__table-content table-hover">
          <thead class="bg__light">
            <tr>
              <th class="table__kategori-number">no</th>
              <th class="table__kategori-nama">nama</th>
              <th class="table__kategori-datainduk">Jumlah Data Induk</th>
              <th class="table__kategori-standar">Jumlah Standar</th>
              <th class="table__kategori-indikator">Jumlah Indikator</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1;
            foreach ($counter as $data) : ?>
            <tr>
              <td><?= $i; ?>
              </td>
              <td><?= $data['kategori']; ?>
              </td>
              <td><?= $data['induk']; ?>
              </td>
              <td><?= $data['standar']; ?>
              </td>
              <td><?= $data['indikator']; ?>
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

<div class="toast-container position-fixed bottom-0 end-0 p-4 animate__animated animate__slow animate__fadeInDown">
  <div class="toast toast__welcome" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true"
    data-bs-delay="5000">
    <div class="row">
      <div class="toast__left col-2 px-0 d-flex align-items-center justify-content-center">
        <img src="/admin/assets/img/undip-logo-color.png" class="toast__welcome-img" alt="logo-undip">
      </div>
      <div class="toast__right col-10">
        <div class="toast-header border-0 px-0">
          <strong class="me-auto">SIPMPP UNDIP <span id="year__now"></span></strong>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body pt-0 ps-0 pe-3 pb-2">
          Selamat Datang di Dashboard Admin SIPMPP UNDIP
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  // toast on load
  window.onload = function() {
    $('.toast').toast('show');
  };

  // get year now
  var currentYear = new Date().getFullYear();
  $("#year__now").text(currentYear);
</script>

<?= $this->endSection();
