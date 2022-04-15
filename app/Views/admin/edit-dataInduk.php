<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / <a href="/admin/dataInduk">Data Induk</a> / Form Edit Data Induk
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Edit Data Induk</h1>
            <p>
                Form untuk mengubahkan data induk
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Edit Data Induk</h4>
</div>

<!-- form Edit Data Induk -->
<div class="form__add__datainduk">
    <form method="POST" action="/editdata/updateinduk/<?= $induk['induk_id'] . '/' . $induk['kategori_id']; ?>" id="formEditInduk">
        <!-- kategori -->
        <div class="row mb-3 mb-sm-4">
            <label for="kategori" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kategori
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select name="kategori_id" id="kategori" class="form-select form__select shadow-none" disabled required autocomplete="off">
                    <?php foreach ($kategori as $kategori) : ?>
                        <option value="<?= $kategori['kategori_id'] ?>" <?php if ($kategori['kategori_id'] == $induk['kategori_id']) {
                                                                            echo 'selected';
                                                                        } ?>><?= $kategori['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- Induk Id -->
        <div class="row mb-3 mb-sm-4">
            <label for="induk_id" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Id Induk
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="induk_id" name="induk_id" value="<?= $induk['induk_id']; ?>" required autocomplete="off" disabled onkeypress="javascript: return validationNumber(event)" placeholder="Masukkan kode data induk" />
            </div>
        </div>
        <!-- kode -->
        <div class="row mb-3 mb-sm-4">
            <label for="kode" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kode
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="kode" name="kode" value="<?= $induk['kode']; ?>" required autocomplete="off" placeholder="Masukkan kode data induk" />
            </div>
        </div>
        <!-- kebutuhan data -->
        <div class="row mb-3 mb-sm-4">
            <label for="kebutuhanData" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kebutuhan
                Data
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="kebutuhanData" name="nama_induk" value="<?= $induk['nama_induk']; ?>" required autocomplete="off" placeholder="Masukkan kebutuhan data" />
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/datainduk" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none" id="btnEditInduk">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
    // validation number
    let validationNumber = (evt) => {
        var iKeyCode = evt.which ? evt.which : evt.keyCode;
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    };

    // to uppercase
    $(function() {
        $('input#kode').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    })
    // validation jquery
    const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";
    $(document).ready(function() {
        $("#formEditInduk").validate({
            rules: {
                kategori_id: "required",
                induk_id: "required",
                kode: "required",
                nama_induk: "required",
            },
            messages: {
                kategori_id: {
                    required: exclamationCircle + " Kategori is required.",
                },
                induk_id: {
                    required: exclamationCircle + " Induk ID is required.",
                },
                kode: {
                    required: exclamationCircle + " Kode is required.",
                },
                nama_induk: {
                    required: exclamationCircle + " Kebutuhan data is required.",
                },
            },
        });

        $("#btnEditInduk").on("click", () => {
            console.log($("#formEditInduk").valid());
        });
    });
</script>

<?= $this->endSection();
