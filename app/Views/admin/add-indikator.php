<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<!-- Content -->
<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / <a href="/admin/standar">Standar</a> /
        <a href="#">Indikator</a> / Form Add Indikator
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Add Indikator</h1>
            <p>Form untuk menambah indikator baru</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Add Indikator</h4>
</div>

<!-- form add indikator -->
<div class="form__add__user">
    <form method="POST" action="#">
        <!-- User -->
        <div class="row mb-3 mb-sm-4">
            <label for="indikator" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Indikator <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="indikator" id="indikator" class="form-control form__control shadow-none"
                    required placeholder="Masukkan indikator">
            </div>
        </div>
        <!-- target -->
        <div class="row mb-3 mb-sm-4">
            <label for="target" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Target <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="target" id="target" class="form-control form__control shadow-none" required
                    placeholder="Masukkan target">
            </div>
        </div>
        <!-- kebutuhan data -->
        <div class="row mb-3 mb-sm-4">
            <label for="kebutuhan_data" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kebutuhan Data
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select name="kebutuhan_data" id="kebutuhan_data" class="form-select form__select shadow-none" required>
                    <option disabled selected>Pilih Kebutuhan Data</option>
                </select>
            </div>
        </div>
        <!-- nilai patokan -->
        <div class="row mb-3 mb-sm-4">
            <label for="nilai_patokan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Nilai Patokan
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="nilai_patokan" id="nilai_patokan"
                    class="form-control form__control shadow-none" required placeholder="Masukkan nilai patokan"
                    autocomplete="off" onkeypress="javascript: return validationNumber(event)">
            </div>
        </div>
        <!-- satuan -->
        <div class="row mb-3 mb-sm-4">
            <label for="satuan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Satuan <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="satuan" id="satuan" class="form-control form__control shadow-none" required
                    placeholder="Masukkan satuan">
            </div>
        </div>
        <!-- keterangan -->
        <div class="row mb-3 mb-sm-4">
            <label for="keterangan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Keterangan <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <textarea name="keterangan" id="keterangan" class="form-control form__control shadow-none" required
                    placeholder="Masukkan keterangan" cols="30" rows="3"></textarea>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="#" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- End Content -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    // validation number
    let validationNumber = (evt) => {
        var iKeyCode = evt.which ? evt.which : evt.keyCode;
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    };
</script>

<?= $this->endSection();
