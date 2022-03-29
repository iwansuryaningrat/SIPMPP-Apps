<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="container-fluid container__fluid">
  <div class="header__main-nav">
    <div class="header__main-nav-btn">
      <div id="header-main-nav-btn-i" class="line__humberger">
        <span class="line__menu line-1" id="line1"></span>
        <span class="line__menu line-2" id="line2"></span>
        <span class="line__menu line-3" id="line3"></span>
      </div>
    </div>
    <div class="header__main-nav-profile">
      <div class="nav-profile__photo">
        <img src="/profile/<?= $usersession['foto']; ?>" alt="profile-picture" id="photo-dropdown" />
      </div>
      <div class="nav-profile__desc">
        <p id="profileName" class="ellipsis__text"><?= $usersession['nama']; ?> </p>
        <p id="profileStatus" class="ellipsis__text">Administrator</p>
      </div>
      <div class="nav-profile__btn">
        <i class="fi-br-angle-down" id="btn-dropdown"></i>
      </div>
    </div>

    <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
      <p class="nav-dropdown__title">Pengaturan Profil</p>
      <p class="d-flex align-items-center">
        <a href="/admin/profile" class="d-block">Lihat Profil</a>
      </p>
      <hr />
      <p class="d-flex align-items-center">
        <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
        <a href="/logout" class="d-block">Log out</a>
      </p>
    </div>
  </div>

  <div class="header__main-title">
    <div class="header__main-title__pagination">
      <a href="/admin/index">Dashboard</a>
    </div>
    <div class="header__main-title__subtitle">
      <div class="title__subtitle-desc">
        <h1>Dashboard Admin Overview</h1>
        <p>Halo <span>
            <?php // uses regex that accepts any word character or hyphen in last name
            function split_name($name)
            {
              $name = trim($name);
              $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
              $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
              return array($first_name, $last_name);
            }
            echo split_name($usersession['nama'])[0];
            ?>
          </span>, selamat datang kembali!</p>
      </div>
      <div class="title__subtitle-btn">
        <a href="/admin/report" class="report__link big__btn btn__dark">
          <img src="/admin/assets/img/icon/report-icon.svg" alt="icon-report" />
          <span>Report</span>
        </a>
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
              <tr>
                <td>1</td>
                <td>Penelitian</td>
                <td>20</td>
                <td>15</td>
                <td>30</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Pengabdian Masyarakat</td>
                <td>18</td>
                <td>12</td>
                <td>24</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

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
</script>

<?= $this->endSection();
