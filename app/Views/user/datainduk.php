<?= $this->extend('template/userlayout'); ?>

<?= $this->section('user'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/"><?= $data_user['unit']; ?></a>
    / Data Induk
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Pengisisan Data Induk</h1>
      <p>
        Mengisikan data induk sesuai dengan kategori dan kebutuhan data.
      </p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<h4 class="title__body__main">Unit: <span><?= $data_user['unit']; ?></span> <span><?= $data_user['tahun']; ?></span></h4>

<!-- filter -->
<div class="filter__table">
  <div class="nav nav-pills" id="pills-tab" role="tablist">
    <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link ellipsis__text active" id="pills-datainduk-penelitian" data-bs-toggle="pill" data-bs-target="#pills-table-datainduk-penelitian" type="button" role="tab" aria-controls="pills-table-datainduk-penelitian" aria-selected="true">
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
              <th class="table__datainduk-aksi">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data_indukPen as $datainduk) : ?>
              <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $datainduk['kode']; ?>
                </td>
                <td><?= $datainduk['nama_induk']; ?>
                </td>
                <td><?= $datainduk['nilai']; ?>
                </td>
                <td>
                  <a role="button" data-bs-toggle="modal" data-bs-placement="top" title="Edit" href="#staticBackdrop" class="edit__data__induk__icon" data-id="<?= $datainduk['induk_id']; ?>" data-kode="<?= $datainduk['kode']; ?>" data-kategori="<?= $datainduk['nama_kategori']; ?>" data-katid="<?= $datainduk['kategori_id']; ?>" data-kebutuhan-data="<?= $datainduk['nama_induk']; ?>" data-nilai="<?= $datainduk['nilai']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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
              <th class="table__datainduk-aksi">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1;
            foreach ($data_indukPPM as $datainduk) : ?>
              <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $datainduk['kode']; ?>
                </td>
                <td><?= $datainduk['nama_induk']; ?>
                </td>
                <td><?= $datainduk['nilai']; ?>
                </td>
                <td>
                  <a role="button" data-bs-toggle="modal" data-bs-placement="top" title="Edit" href="#staticBackdrop" class="edit__data__induk__icon" data-id="<?= $datainduk['induk_id']; ?>" data-kode="<?= $datainduk['kode']; ?>" data-kategori="<?= $datainduk['nama_kategori']; ?>" data-katid="<?= $datainduk['kategori_id']; ?>" data-kebutuhan-data="<?= $datainduk['nama_induk']; ?>" data-nilai="<?= $datainduk['nilai']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
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

<?= $this->section('modal'); ?>

<!-- Modal -->
<div class="modal fade edit__datainduk__modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-data-induk" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal__content">
      <div class="modal-header modal__header">
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal__body">
        <h4 class="modal-title" id="modal-data-induk">Nilai Data Induk</h4>

        <!-- form -->
        <form class="modal__form" method="POST" action="/home/editdatainduk" id="formEditInduk">
          <!-- id input -->
          <input type="hidden" id="id" name="induk_id" />
          <input type="hidden" id="kategori_id" name="kategori_id" />
          <!-- kategori -->
          <div class="modal__form-content">
            <label for="nama_kategori" class="form-label form__label">Kategori</label>
            <input type="text" class="form-control shadow-none form__control" id="nama_kategori" name="nama_kategori" disabled required />
          </div>
          <!-- kode -->
          <div class="modal__form-content">
            <label for="kode" class="form-label form__label">Kode</label>
            <input type="text" class="form-control shadow-none form__control" id="kode" name="kode" disabled required />
          </div>
          <!-- kebutuhan data -->
          <div class="modal__form-content">
            <label for="kebutuhan-data" class="form-label form__label">Kebutuhan Data</label>
            <textarea id="kebutuhan-data" class="form-control shadow-none form__control" cols="30" rows="3" name="kebutuhan" disabled required>
                </textarea>
          </div>
          <!-- nilai -->
          <div class="modal__form-content">
            <label for="nilai" class="form-label form__label">Nilai</label>
            <input type="text" class="form-control shadow-none form__control" id="nilai" name="nilai" required autocomplete="off" onkeypress="javascript: return validationNumber(event)" />
          </div>
          <div id="alert-wrong-text"></div>
          <div class="modal__form-btn">
            <button type="button" class="btn cancel__btn shadow-none" data-bs-dismiss="modal">
              Batal
            </button>
            <button type="submit" class="btn modal__btn shadow-none" id="btnEditInduk">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('userscript'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

  // tooltips
  // progress bar unit
  const tooltipsEdit = document.querySelectorAll(
    ".edit__data__induk__icon"
  );
  tooltipsEdit.forEach((t) => {
    new bootstrap.Tooltip(t);
  });

  // data trigger
  $(document).ready(() => {
    // get Edit Product
    $(".edit__data__induk__icon").on("click", function() {
      // get data from button edit
      const id = $(this).data("id");
      const kode = $(this).data("kode");
      const kategori = $(this).data("kategori");
      const kategoriId = $(this).data("katid");
      // console.log(kategoriId);
      // console.log(id);
      const kebutuhanData = $(this).data("kebutuhan-data");
      const nilai = $(this).data("nilai");
      // Set data to Form Edit
      $("#id").val(id);
      $("#kode").val(kode);
      $("#nama_kategori").val(kategori);
      $("#kebutuhan-data").val(kebutuhanData);
      $("#nilai").val(nilai);
      $("#kategori_id").val(kategoriId);
      // Call Modal Edit
      $(".edit__datainduk__modal").modal("show");
    });
  });

  // validation number
  let validationNumber = (evt) => {
    var iKeyCode = evt.which ? evt.which : evt.keyCode;
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
      return false;

    return true;
  };

  // validate form jquery
  const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

  $(document).ready(function() {
    $("#formEditInduk").validate({
      rules: {
        nilai: {
          required: true,
        },
      },
      messages: {
        nilai: {
          required: exclamationCircle + " Nilai is required.",
        },
      },
    });

    $("#btnEditInduk").on("click", () => {
      console.log($("#formEditInduk").valid());
    });
  });
</script>

<?= $this->endSection();
