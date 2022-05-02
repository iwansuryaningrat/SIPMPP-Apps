<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/admin/index">Dashboard Admin</a>
    / Profile
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Profile</h1>
      <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                    function getFirstWord($string)
                    {
                        $arr = explode(' ', trim($string));
                        return isset($arr[0]) ? $arr[0] : $string;
                    }
                    echo getFirstWord($usersession['nama']);
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
    <?= session()->getFlashdata('profilemessage'); ?>
    <form class="form__profile" id="formChangeInfo" action="/editdata/editprofile" enctype="multipart/form-data"
      method="POST">
      <!-- foto -->
      <div>
        <label for="photo-profile" class="form-label form__label">Foto Profil</label>
        <div class="input-group input-group__photo">
          <div class="img__input-photo mb-3">
            <div class="img__photo-field">
              <img
                src="/profile/<?= $data_user['foto']; ?>"
                alt="photo-profile" class="img__input" id="img-input-preview" />
            </div>
          </div>
          <div class="img__input-field">
            <input type="file" class="form-control form__control__photo" id="photo-profile"
              aria-labelledby="photo-notice" onchange="previewImage(this)" name="photo-profile" />
            <label class="form__label__photo btn btn__dark ellipsis__text" for="photo-profile">Ubah Profile</label>
            <label id="photo-notice" class="form-text form__text mb-3">
              Gambar profil Anda sebaiknya memiliki raiso 1:1 dan
              berukuran tidak lebih dari 2 MB.</label>
          </div>
        </div>
        <div id="alert-wrong-photo"></div>
      </div>
      <!-- Nama lengkap -->
      <div class="mb-3">
        <label for="fullname" class="form-label form__label">Nama Lengkap</label>
        <input type="text" class="form-control form__control shadow-none" id="fullname"
          value="<?= $data_user['nama']; ?>"
          name="fullname" required />
      </div>
      <!-- email -->
      <div class="mb-3">
        <label for="email" class="form-label form__label">Email</label>
        <input type="text" class="form-control form__control shadow-none" id="email" name="email" disabled
          value="<?= $data_user['email']; ?>"
          required />
      </div>
      <!-- nip -->
      <div class="mb-3">
        <label for="nip" class="form-label form__label">NIP</label>
        <input type="text" class="form-control form__control shadow-none" id="nip" name="nip"
          value="<?= $user['nip']; ?>"
          required />
      </div>
      <!-- nomor telepon -->
      <div class="mb-3 mb__big">
        <label for="no-telp" class="form-label form__label">Nomor telepon</label>
        <input type="text" class="form-control form__control shadow-none" id="no-telp" name="no-telp"
          value="<?= $user['telp']; ?>"
          required />
      </div>
      <!-- button -->
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn__dark shadow-none ellipsis__text">
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
      <?= session()->getFlashdata('pwdmessage'); ?>
      <form class="form__change__password" id="formChangePassword" action="/editdata/editpassword" method="POST">
        <div class="mb-3 position-relative old__pass">
          <label for="oldPassword" class="form-label form__label">Password Lama <span
              class="color__danger">*</span></label>
          <input type="password" class="form-control form__control shadow-none" id="oldPassword" name="oldPassword"
            autocomplete="off" required />
          <span id="toggleOldPassword"><i class="fa-solid fa-eye icon__hide__password" title="show password"></i></span>
        </div>
        <div class="mb-3 position-relative new__pass">
          <label for="newPassword" class="form-label form__label">Password Baru <span
              class="color__danger">*</span></label>
          <input type="password" class="form-control form__control shadow-none" id="newPassword" name="newPassword"
            aria-labelledby="new-password-notice" autocomplete="off" required />
          <span id="toggleNewPassword"><i class="fa-solid fa-eye icon__hide__password" title="show password"></i></span>
          <div id="new-password-notice" class="form-text form__text">
            Gunakan minimal 8 karakter dengan kombinasi huruf dan angka.
          </div>
        </div>
        <div class="mb-3 mb__big position-relative confirm__pass">
          <label for="newPasswordConfirm" class="form-label form__label">Konfirmasi Password Baru
            <span class="color__danger">*</span></label>
          <input type="password" class="form-control form__control shadow-none" name="newPasswordConfirm"
            id="newPasswordConfirm" autocomplete="off" required />
          <span id="toggleNewPasswordConfirm"><i class="fa-solid fa-eye icon__hide__password"
              title="show password"></i></span>
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn__light shadow-none ellipsis__text" id="btnSubmitChangePassword">
            Ubah Password
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
  integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
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

  const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

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
          equalTo: "#newPassword",
        },
      },
      messages: {
        oldPassword: {
          required: exclamationCircle + " Password Lama is required.",
        },
        newPassword: {
          required: exclamationCircle + " Password Baru is required.",
          minlength: exclamationCircle + " Your Password must be at least 8 characters.",
        },
        newPasswordConfirm: {
          required: exclamationCircle + " Please enter the password again.",
          equalTo: exclamationCircle + " Your Konfirmasi Password does not match the Password Baru",
        },
      },
    });

    $("#formChangeInfo").validate({
      rules: {
        fullname: {
          required: true,
        },
        email: {
          required: true,
        },
        nip: {
          required: true,
        },
        'no-telp': {
          required: true,
          minlength: 12,
        },
      },
      messages: {
        fullname: {
          required: exclamationCircle + " Nama Lengkap is required.",
        },
        email: {
          required: exclamationCircle + " Email is required.",
        },
        nip: {
          required: exclamationCircle + " NIP is required.",
        },
        'no-telp': {
          required: exclamationCircle + " Nomor Telepon is required.",
          minlength: exclamationCircle + " Your Nomor Telepon must be at least 12 characters.",
        },
      }
    });

    $("#btnSubmitChangePassword").on("click", () => {
      console.log($("#formChangePassword").valid());
    });
    $("#btnSubmitChangeInfo").on("click", () => {
      console.log($("#formChangeInfo").valid());
    });
  });

  // togglePassword
  // change icon
  $("#toggleOldPassword").click(function() {
    $(this).children().toggleClass("fa-eye-slash");
    $(this).children().toggleClass("fa-eye");

    var type = $("#oldPassword").attr("type") === "password" ? "text" : "password";
    $("#oldPassword").attr("type", type);
  });

  $("#toggleNewPassword").click(function() {
    $(this).children().toggleClass("fa-eye-slash");
    $(this).children().toggleClass("fa-eye");

    var type = $("#newPassword").attr("type") === "password" ? "text" : "password";
    $("#newPassword").attr("type", type);
  });

  $("#toggleNewPasswordConfirm").click(function() {
    $(this).children().toggleClass("fa-eye-slash");
    $(this).children().toggleClass("fa-eye");

    var type = $("#newPasswordConfirm").attr("type") === "password" ? "text" : "password";
    $("#newPasswordConfirm").attr("type", type);
  });
</script>

<?= $this->endSection();
