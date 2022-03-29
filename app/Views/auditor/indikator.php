<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('user'); ?>

<div class="container-fluid container__fluid pb-0">
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
        <img src="/profile/<?= $data_user['foto']; ?>" alt="profile-picture" id="photo-dropdown" />
      </div>
      <div class="nav-profile__desc">
        <p id="profileName"><?= $data_user['nama']; ?>
        </p>
        <p id="profileEmail" class="ellipsis__text"><?= $data_user['email']; ?>
        </p>
      </div>
      <div class="nav-profile__btn">
        <i class="fi-br-angle-down" id="btn-dropdown"></i>
      </div>
    </div>

    <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
      <p class="nav-dropdown__title">Pengaturan Profil</p>
      <p class="d-flex align-items-center">
        <a href="/home/profile" class="d-block">Lihat Profil</a>
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
      <a id="unit-user" href="/" style="font-weight: 600"><?= $data_user['unit']; ?></a>
      / <a href="/">Nilai SPMI</a> / Indikator
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
    <?= $standar['standar_id'] . '. ' . $standar['nama_standar'] ?>
  </h4>

  <!-- table indikator -->
  <div class="sipmpp__table">
    <div class="table-responsive">
      <table class="table table__indikator__content sipmpp__table-content table-hover">
        <thead class="bg__light">
          <tr>
            <th class="table__indikator-number">No</th>
            <th class="table__indikator-indikator">Indikator</th>
            <th class="table__indikator-target">Target</th>
            <th class="table__indikator-nilai">nilai</th>
            <th class="table__indikator-aksi">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>1</td>
            <td>S1</td>
            <td>Target</td>
            <td>
              <a data-bs-placement="top" title="Edit" href="/home/indikatorform/" class="edit__data__induk__icon"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
          </tr>


        </tbody>
      </table>
    </div>
  </div>
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
