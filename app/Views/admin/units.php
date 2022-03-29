<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/admin/index">Dashboard</a>
    / Unit
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Unit</h1>
      <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                      $name = trim($name);
                      $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                      $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                      return array($first_name, $last_name);
                    }
                    echo split_name($usersession['nama'])[0];
                    ?>
        </span>, selamat datang di dashboard Unit</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
  <h4 class="title__body__user">Daftar Unit</h4>
  <a href="/admin/addUnit" class="btn shadow-none btn__add btn__dark add__unit__icon" role="button" data-bs-toggle="modal" href="#staticBackdrop2">
    <i class="fa-solid fa-plus"></i>
    Add Unit
  </a>
</div>

<!-- table indikator -->
<!-- Menampilkan flashdata msg -->
<?= session()->getFlashdata('msg'); ?>

<div class="sipmpp__table">
  <div class="table-responsive">
    <table class="table table__unit__content sipmpp__table-content table-hover">
      <thead class="bg__light">
        <tr>
          <th class="table__unit-number">no</th>
          <th class="table__unit-namaunit">nama unit</th>
          <th class="table__unit-aksi">aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($units as $unit) : ?>
          <tr>
            <td><?= $i; ?>
            </td>
            <td><?= $unit['nama_unit']; ?>
            </td>
            <td>
              <a role="button" data-bs-toggle="modal" data-bs-placement="top" title="Edit" href="#staticBackdrop" class="edit__data__induk__icon me-3 me-md-5"><i class="fa-solid fa-pen-to-square" data-unit="<?= $unit['nama_unit']; ?>" data-id="<?= $unit['unit_id']; ?>"></i></a>
              <a data-bs-placement="top" title="Delete" href="#" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal edit -->
<div class="modal fade edit__unit__modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-unit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal__content">
      <div class="modal-header modal__header">
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal__body">
        <h4 class="modal-title" id="modal-data-induk">Edit Unit</h4>

        <!-- form -->
        <form class="modal__form" method="POST" action="/admin/editunit">
          <!-- id input -->
          <input type="hidden" id="idEdit" name="unit_id" />
          <!-- unit -->
          <div class="modal__form-content">
            <label for="unitEdit" class="form-label form__label">Unit <span class="color__danger">*</span></label>
            <input type="text" class="form-control shadow-none form__control" name="nama_unit" id="unitEdit" required autocomplete="off" />
          </div>
          <!-- Button -->
          <div class="modal__form-btn">
            <button type="button" class="btn cancel__btn shadow-none" data-bs-dismiss="modal">
              Batal
            </button>
            <button type="submit" class="btn modal__btn shadow-none">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal add -->
<div class="modal fade add__unit__modal" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-unit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal__content">
      <div class="modal-header modal__header">
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal__body">
        <h4 class="modal-title" id="modal-data-induk">Add Unit</h4>

        <!-- form -->
        <form class="modal__form" method="POST" action="/admin/addunit">
          <!-- id input -->
          <input type="hidden" id="idAdd" />
          <!-- unit -->
          <div class="modal__form-content">
            <label for="unitAdd" class="form-label form__label">Unit <span class="color__danger">*</span></label>
            <input type="text" name="nama_unit" class="form-control shadow-none form__control" id="unitAdd" required autocomplete="off" />
          </div>
          <!-- Button -->
          <div class="modal__form-btn">
            <button type="button" class="btn cancel__btn shadow-none" data-bs-dismiss="modal">
              Batal
            </button>
            <button type="submit" class="btn modal__btn shadow-none">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<!-- scripts -->
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

  // data trigger
  $(document).ready(() => {
    // get Edit Product
    $(".edit__data__induk__icon").on("click", function() {
      // get data from button edit
      const id = $(this).data("id");
      const unit = $(this).data("unit");
      // Set data to Form Edit
      $("#idEdit").val(id);
      $("#unitEdit").val(unit);
      // Call Modal Edit
      $(".edit__unit__modal").modal("show");
    });

    $(".add__unit__icon").on("click", function() {
      // Call Modal Edit
      $(".add__unit__modal").modal("show");
    });
  });
</script>

<?= $this->endSection();
