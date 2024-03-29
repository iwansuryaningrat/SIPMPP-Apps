<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/admin/index">Dashboard Admin</a>
    / <a href="/admin/user">Base User</a> / Form Add User
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Add Base User</h1>
      <p>
        Form untuk menambahkan base user baru
      </p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
  <h4 class="title__body__user">Form Add Base User</h4>
</div>

<!-- form add user -->
<div class="form__add__user">
  <form method="POST" action="/savedata/addbasicuser/user" id="formAddBaseUser">
    <!-- User -->
    <div class="row mb-3 mb-sm-4">
      <label for="user" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">User <span
          class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <select name="user" id="user" class="form-select form__select shadow-none" required>
          <option value="" disabled selected>Pilih User</option>
          <?php foreach ($users as $user) : ?>
          <option value="<?= $user['email'] ?>">
            <?= $user['nama']; ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- unit -->
    <div class="row mb-3 mb-sm-4">
      <label for="unit" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Unit <span
          class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <select name="unit[]" id="unit" class="form-select form__select shadow-none" multiple multiselect-search="true"
          multiselect-select-all="true" multiselect-max-items="5" onchange="console.log(this.selectedOptions)" required
          placeholder-inputs="Pilih Unit">
          <?php foreach ($units as $unit) : ?>
          <option
            value="<?= $unit['unit_id'] ?>">
            <?= $unit['nama_unit']; ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- tahun -->
    <div class="row mb-3 mb-sm-4">
      <label for="tahun" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Tahun <span
          class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <select name="tahun[]" id="tahun" class="form-select form__select shadow-none" multiple
          multiselect-search="true" multiselect-select-all="true" multiselect-max-items="5"
          onchange="console.log(this.selectedOptions)" required placeholder-inputs="Pilih Tahun">
          <?php foreach ($tahuns as $tahuns) : ?>
          <option
            value="<?= $tahuns['tahun'] ?>">
            <?= $tahuns['tahun'] ?>
          </option>
          <?php endforeach; ?>

        </select>
      </div>
    </div>
    <!-- button -->
    <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12 button__section">
        <a href="/admin/user" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
        <button type="submit" class="btn form__btn btn__dark shadow-none" id="btnAddBaseUser">
          Simpan
        </button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/admin/assets/js/multipleselect-dropdown.js"></script>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
  integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
  // validate form jquery
  const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

  $(document).ready(function() {
    $("#formAddBaseUser").validate({
      rules: {
        user: {
          required: true,
        },
        unit: {
          required: true,
        },
        tahun: {
          required: true,
        },
      },
      messages: {
        user: {
          required: exclamationCircle + " User is required.",
        },
        unit: {
          required: exclamationCircle + " Unit is required.",
        },
        tahun: {
          required: exclamationCircle + " Tahun is required.",
        },
      },
    });

    $("#btnAddBaseUser").on("click", () => {
      console.log($("#formAddBaseUser").valid());
    });
  });
</script>

<?= $this->endSection();
