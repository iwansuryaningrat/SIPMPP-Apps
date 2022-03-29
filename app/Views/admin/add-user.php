<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / <a href="/admin/daftarUser">Daftar User</a> / Form Add User
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Add User</h1>
            <p>
                Form untuk menambahkan user baru
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Add User</h4>
</div>

<!-- form add user -->
<div class="form__add__user">
    <!-- Menampilkan flashdata -->
    <?= session()->getFlashdata('msg'); ?>
    <form method="POST" action="/admin/adduser">
        <!-- fullname -->
        <div class="row mb-3 mb-sm-4">
            <label for="fullname" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Nama Lengkap
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="fullname" name="fullname" required autocomplete="off" placeholder="Masukkan nama lengkap" />
            </div>
        </div>
        <!-- email -->
        <div class="row mb-3 mb-sm-4">
            <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Email
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" id="email" name="email" required autocomplete="off" placeholder="Masukkan email" />
            </div>
        </div>
        <!-- password -->
        <div class="row mb-3 mb-sm-4">
            <label for="password" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Password
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-9 col-sm-8">
                <input class="form-control form__control shadow-none" type="password" id="password" name="password" required autocomplete="off" placeholder="Masukkan password" />
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/user" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
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

<?= $this->endSection();
