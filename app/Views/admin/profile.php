<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

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
        <p id="profileEmail" class="ellipsis__text">
          <?= $data_user['email']; ?>
        </p>
      </div>
      <div class="nav-profile__btn">
        <i class="fi-br-angle-down" id="btn-dropdown"></i>
      </div>
    </div>

    <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
      <p class="nav-dropdown__title">Pengaturan Profil</p>
      <p class="d-flex align-items-center">
        <a href="#" class="d-block">Lihat Profil</a>
      </p>
      <hr />
      <p class="d-flex align-items-center">
        <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
        <a href="#" class="d-block">Log out</a>
      </p>
    </div>
  </div>

  <div class="header__main-title">
    <div class="header__main-title__pagination">
      <a id="unit-user" href="/admin/index" style="font-weight: 600;">Home</a>
      / Profile
    </div>
    <div class="header__main-title__subtitle">
      <div class="title__subtitle-desc">
        <h1>Profile</h1>
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
          </span>, selamat datang di profil Anda</p>
      </div>
    </div>
  </div>

  <!--========== body main ==========-->
  <div class="profile__section">
    <!-- left -->
    <div class="profile__section-profile">
      <h5>Profile Pengguna</h5>
      <hr class="head__hr" />
      <?= session()->getFlashdata('message'); ?>
      <form class="form__profile" action="/admin/editprofile" enctype="multipart/form-data" method="POST">
        <!-- foto -->
        <div class="mb-3">
          <label for="photo-profile" class="form-label form__label">Foto Profil</label>
          <div class="input-group input-group__photo">
            <div class="img__input-photo">
              <div class="img__photo-field">
                <img src="/profile/<?= $data_user['foto']; ?>" alt="photo-profile" class="img__input" id="img-input-preview" />
              </div>
            </div>
            <div class="img__input-field">
              <input type="file" class="form-control form__control__photo" id="photo-profile" aria-labelledby="photo-notice" onchange="previewImage(this)" name="photo-profile" />
              <label class="form__label__photo btn btn__dark" for="photo-profile">Ubah Profile</label>
              <label id="photo-notice" class="form-text form__text">
                Gambar profil Anda sebaiknya memiliki raiso 1:1 dan
                berukuran tidak lebih dari 2 MB.</label>
            </div>
          </div>
          <div id="alert-wrong-photo"></div>
        </div>
        <!-- Nama lengkap -->
        <div class="mb-3">
          <label for="fullname" class="form-label form__label">Nama Lengkap</label>
          <input type="text" class="form-control form__control shadow-none" id="fullname" value="<?= $data_user['nama']; ?>" name="fullname" required />
        </div>
        <!-- email -->
        <div class="mb-3">
          <label for="email" class="form-label form__label">Email</label>
          <input type="text" class="form-control form__control shadow-none" id="email" name="email" disabled value="<?= $data_user['email']; ?>" required />
        </div>
        <!-- nip -->
        <div class="mb-3">
          <label for="nip" class="form-label form__label">NIP</label>
          <input type="text" class="form-control form__control shadow-none" id="nip" name="nip" value="<?= $user['nip']; ?>" required />
        </div>
        <!-- nomor telepon -->
        <div class="mb-3 mb__big">
          <label for="no-telp" class="form-label form__label">Nomor telepon</label>
          <input type="text" class="form-control form__control shadow-none" id="no-telp" name="no-telp" value="<?= $user['telp']; ?>" required />
        </div>
        <!-- button -->
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn__dark shadow-none">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>

    <!-- right -->
    <div class="profile__section-password">
      <div class="section-password__border">
        <h5>Ubah Password</h5>
        <hr />
        <?= session()->getFlashdata('message'); ?>
        <form class="form__change__password" action="/admin/editpassword" method="POST">
          <div class="mb-3">
            <label for="oldPassword" class="form-label form__label">Password Lama <span class="color__danger">*</span></label>
            <input type="password" class="form-control form__control shadow-none" id="oldPassword" name="oldPassword" autocomplete="off" required />
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label form__label">Password Baru <span class="color__danger">*</span></label>
            <input type="password" class="form-control form__control shadow-none" id="newPassword" name="newPassword" aria-labelledby="new-password-notice" autocomplete="off" required />
            <div id="new-password-notice" class="form-text form__text">
              Gunakan minimal 8 karakter dengan kombinasi huruf dan angka.
            </div>
          </div>
          <div class="mb-3 mb__big">
            <label for="newPasswordConfirm" class="form-label form__label">Konfirmasi Password Baru
              <span class="color__danger">*</span></label>
            <input type="password" class="form-control form__control shadow-none" name="newPasswordConfirm" id="newPasswordConfirm" autocomplete="off" required />
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn__light" id="btnSubmitChangePassword">
              Ubah Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

  // preview image and validation
  previewImage = (input) => {
    const fi = document.getElementById("photo-profile");
    // Check if any file is selected.
    if (fi.files.length > 0) {
      for (const i = 0; i <= fi.files.length - 1; i++) {
        const fsize = fi.files.item(i).size;
        const file = Math.round(fsize / 1024);
        // The size of the file.
        if (file >= 2048) {
          const ukuranAsli = file / 1000;
          document.getElementById("alert-wrong-photo").innerHTML =
            "<p class='mt-2 color__danger'><i class='fa-solid fa-triangle-exclamation'></i> Ukuran file terlalu besar (<strong>" +
            ukuranAsli.toFixed(2) +
            " MB</strong>), pilih foto dengan ukuran dibawah 2 MB</p>";
        } else {
          var fileFhoto = $("#photo-profile[type=file]").get(0).files[0];

          if (fileFhoto) {
            var reader = new FileReader();

            reader.onload = function() {
              $("#img-input-preview").attr("src", reader.result);
            };

            reader.readAsDataURL(fileFhoto);
          }
        }
      }
    }
  };

  // validatePassword with JQuery
  $(document).ready(function() {
    $("#formChangePassword").validate({
      rules: {
        oldPassword: {
          required: true,
        },
        newPassword: {
          required: true,
          minlength: 8,
        },
        newPasswordConfirm: {
          required: true,
          minlength: 8,
          equalTo: "#newPassword",
        },
      },
    });

    $("#btnSubmitChangePassword").on("click", () => {
      console.log($("#formChangePassword").valid());
    });
  });
</script>

<?= $this->endSection();
