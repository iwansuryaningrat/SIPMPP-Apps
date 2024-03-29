<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / <a href="/admin/standar">Standar</a>
        / Form Edit Standar
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Edit Standar</h1>
            <p>
                Form untuk mengedit data standar
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Edit Standar</h4>
</div>

<!-- form add standar -->
<div class="form__add__standar">
    <form method="POST"
        action="/editdata/editstandar/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>"
        id="formEditStandar">
        <!-- kategori -->
        <div class="row mb-3 mb-sm-4">
            <label for="kategori" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kategori
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select class="form-select form__select shadow-none" name="kategori_id" id="kategori" disabled
                    autocomplete="off">
                    <option disabled selected>Pilih Kategori</option>
                    <?php foreach ($kategori as $kategori) : ?>
                    <option
                        value="<?= $kategori['kategori_id']; ?>"
                        <?php if ($kategori['kategori_id'] == $standar['kategori_id']) {
    echo 'selected';
} ?>><?= $kategori['nama_kategori']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- kode -->
        <div class="row mb-3 mb-sm-4">
            <label for="kode" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kode
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="kode" name="kode" required autocomplete="off"
                    value="<?= $standar['standar_id'] ?>"
                    disabled placeholder="Masukkan kode" />
            </div>
        </div>
        <!-- namaStandar -->
        <div class="row mb-3 mb-sm-4">
            <label for="namaStandar" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Nama Standar<span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="namaStandar" name="namaStandar"
                    value="<?= $standar['nama_standar'] ?>"
                    required autocomplete="off" placeholder="Masukkan nama standar" />
            </div>
        </div>

        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/standar" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none" id="btnEditStandar">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
    // to uppercase
    $(function() {
        $('input#kode').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    })
    // validate form jquery
    const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

    $(document).ready(function() {
        $("#formEditStandar").validate({
            rules: {
                kategori_id: {
                    required: true,
                },
                kode: {
                    required: true,
                },
                namaStandar: {
                    required: true,
                },
            },
            messages: {
                kategori_id: {
                    required: exclamationCircle + " Kategori is required.",
                },
                kode: {
                    required: exclamationCircle + " Kode is required.",
                },
                namaStandar: {
                    required: exclamationCircle + " Nama Standars is required.",
                },
            },
        });

        $("#btnEditStandar").on("click", () => {
            console.log($("#formEditStandar").valid());
        });
    });
</script>

<?= $this->endSection();
