<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin">Dashboard</a>
        / <a href="/admin/standar">Standar</a>
        / Form Add Standar
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Add Standar</h1>
            <p>
                Form untuk menambahkan data standar
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Add Standar</h4>
</div>

<!-- form add standar -->
<div class="form__add__standar">
    <form method="POST" action="/admin/addstandar">
        <!-- kategori -->
        <div class="row mb-3 mb-sm-4">
            <label for="kategori" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kategori
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select class="form-select form__select shadow-none" name="kategori_id" id="kategori" required autocomplete="off">
                    <option disabled selected>Pilih Kategori</option>
                    <?php foreach ($kategori as $kategori) : ?>
                        <option value="<?= $kategori['kategori_id']; ?>"><?= $kategori['nama_kategori']; ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
        </div>
        <!-- kode -->
        <div class="row mb-3 mb-sm-4">
            <label for="kode" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kode
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="kode" name="kode" required autocomplete="off" placeholder="Masukkan kode" />
            </div>
        </div>
        <!-- namaStandar -->
        <div class="row mb-3 mb-sm-4">
            <label for="namaStandar" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Nama
                Standar
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="namaStandar" name="namaStandar" required autocomplete="off" placeholder="Masukkan nama standar" />
            </div>
        </div>

        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/standar" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none">
                    Simpan
                </button>
            </div>
        </div>
    </form>
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

<?= $this->endSection(); ?>