<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / <a href="/admin/dataInduk">Data Induk</a> / Form Auto Generate
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Auto Generate Data Induk</h1>
            <p>
                Form untuk menambahkan data induk secara otomatis.
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Auto Generate Data Induk</h4>
</div>

<!-- form auto generate data induk -->
<div class="form__add__user">
    <form method="POST" action="/admin/indukgenerator">
        <!-- tahun -->
        <div class="row mb-3 mb-sm-4">
            <label for="tahun" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Tahun <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select name="tahun[]" id="tahun" class="form-select form__select shadow-none" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="5" onchange="console.log(this.selectedOptions)" required placeholder-inputs="Pilih Tahun">
                    <option value="tahun 1">tahun 1</option>
                    <option value="tahun 2">tahun 2</option>
                    <option value="tahun 3">tahun 3</option>
                    <option value="tahun 4">tahun 4</option>
                    <option value="tahun 5">tahun 5</option>
                </select>
            </div>
        </div>
        <!-- unit -->
        <div class="row mb-3 mb-sm-4">
            <label for="unit" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Unit <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select name="unit[]" id="unit" class="form-select form__select shadow-none" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="5" onchange="console.log(this.selectedOptions)" required placeholder-inputs="Pilih Unit">
                    <option value="unit 1">unit 1</option>
                    <option value="unit 2">unit 2</option>
                    <option value="unit 3">unit 3</option>
                    <option value="unit 4">unit 4</option>
                    <option value="unit 5">unit 5</option>
                </select>
            </div>
        </div>
        <!-- standar -->
        <div class="row mb-3 mb-sm-4">
            <label for="standar" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Standar <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8 row pe-0">
                <div class="col-lg-6 col-12 pe-lg-2 pe-0 mb-lg-0 mb-3">
                    <select name="standarPenelitian[]" id="standarPenelitian" class="form-select form__select shadow-none" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)" required placeholder-inputs="Penelitian">
                        <option value="Standar Penelitian 1">Standar Penelitian 1</option>
                        <option value="Standar Penelitian 2">Standar Penelitian 2</option>
                        <option value="Standar Penelitian 3">Standar Penelitian 3</option>
                        <option value="Standar Penelitian 4">Standar Penelitian 4</option>
                        <option value="Standar Penelitian 5">Standar Penelitian 5</option>
                    </select>
                </div>
                <div class="col-lg-6 col-12 pe-0">
                    <select name="standarPengabdian[]" id="standarPengabdian" class="form-select form__select shadow-none" multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)" required placeholder-inputs="Pengabdian Masyarakat">
                        <option value="Standar Pengabdian Masyarakat 1">Standar Pengabdian Masyarakat 1</option>
                        <option value="Standar Pengabdian Masyarakat 2">Standar Pengabdian Masyarakat 2</option>
                        <option value="Standar Pengabdian Masyarakat 3">Standar Pengabdian Masyarakat 3</option>
                        <option value="Standar Pengabdian Masyarakat 4">Standar Pengabdian Masyarakat 4</option>
                        <option value="Standar Pengabdian Masyarakat 5">Standar Pengabdian Masyarakat 5</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/dataInduk" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/admin/assets/js/multipleselect-dropdown.js"></script>
<script>
</script>

<?= $this->endSection();
