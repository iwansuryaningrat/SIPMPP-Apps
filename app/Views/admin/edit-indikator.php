<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<!-- Content -->
<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / <a href="/admin/standar">Standar</a> /
        <a
            href="/admin/viewIndikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>">Indikator</a>
        / Form Edit Indikator
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Edit Indikator</h1>
            <p>Form untuk mengubah indikator</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Edit Indikator</h4>
</div>

<!-- form edit indikator -->
<div class="form__add__user">
    <form method="POST"
        action="/editdata/editIndikator/<?= $indikator_id . '/' . $kategori_id . '/' . $standar_id ?>"
        id="formEditIndikator">
        <!-- User -->
        <div class="row mb-3 mb-sm-4">
            <label for="indikator" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Indikator <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="indikator" id="indikator"
                    value="<?= $indikator['nama_indikator'] ?>"
                    class="form-control form__control shadow-none" required placeholder="Masukkan indikator">
            </div>
        </div>
        <!-- target -->
        <div class="row mb-3 mb-sm-4">
            <label for="target" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Target <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="target" id="target"
                    value="<?= $indikator['target'] ?>"
                    class="form-control form__control shadow-none" required placeholder="Masukkan target">
            </div>
        </div>
        <!-- kebutuhan data -->
        <div class="row mb-3 mb-sm-4">
            <label for="kebutuhan_data" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kebutuhan Data
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <select name="kebutuhan_data" id="kebutuhan_data" class="form-select form__select shadow-none" required>
                    <?php foreach ($induk as $datainduk) : ?>
                    <option
                        value="<?= $datainduk['induk_id']; ?>"
                        <?php if ($indikator['nama_indikator'] == $datainduk['induk_id']) {
    echo 'selected';
} ?>><?= $datainduk['nama_induk']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!-- nilai patokan -->
        <div class="row mb-3 mb-sm-4">
            <label for="nilai_patokan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Nilai Patokan
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="nilai_patokan"
                    value="<?= $indikator['nilai_acuan'] ?>"
                    id="nilai_patokan" class="form-control form__control shadow-none" required
                    placeholder="Masukkan nilai patokan" autocomplete="off"
                    onkeypress="javascript: return validationNumber(event)">
            </div>
        </div>
        <!-- satuan -->
        <div class="row mb-3 mb-sm-4">
            <label for="satuan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Satuan <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input type="text" name="satuan" id="satuan"
                    value="<?= $indikator['satuan'] ?>"
                    class="form-control form__control shadow-none" required placeholder="Masukkan satuan">
            </div>
        </div>
        <!-- keterangan -->
        <div class="row mb-3 mb-sm-4">
            <label for="keterangan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Keterangan <span
                    class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <textarea name="keterangan" id="keterangan" class="form-control form__control shadow-none" required
                    placeholder="Masukkan keterangan" cols="30"
                    rows="3"><?= $indikator['keterangan'] ?></textarea>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/viewIndikator/<?= $standar_id . '/' . $kategori_id ?>"
                    class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none" id="btnEditIndikator">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<!-- End Content -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
        $("#formEditIndikator").validate({
            rules: {
                indikator: {
                    required: true,
                },
                target: {
                    required: true,
                },
                kebutuhan_data: {
                    required: true,
                },
                nilai_patokan: {
                    required: true,
                },
                satuan: {
                    required: true,
                },
                keterangan: {
                    required: true,
                },
            },
            messages: {
                indikator: {
                    required: exclamationCircle + " Indikator is required.",
                },
                target: {
                    required: exclamationCircle + " Target is required.",
                },
                kebutuhan_data: {
                    required: exclamationCircle + " Kebutuhan Data is required.",
                },
                nilai_patokan: {
                    required: exclamationCircle + " Nilai Patokan is required.",
                },
                satuan: {
                    required: exclamationCircle + " Satuan is required.",
                },
                keterangan: {
                    required: exclamationCircle + " Keterangan is required.",
                },
            },
        });

        $("#btnEditIndikator").on("click", () => {
            console.log($("#formEditIndikator").valid());
        });
    });
</script>

<?= $this->endSection();
