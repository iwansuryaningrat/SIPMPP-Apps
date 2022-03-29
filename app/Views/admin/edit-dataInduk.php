<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="container-fluid container__fluid pb-0">
    <div class="header__main-nav">
        <div class="header__main-nav-btn">
            <div id="header-main-nav-btn-i" class="line__humberger">
                <span class="line__menu line-1" id="line1"></span>
                <span class="line__menu line-2" id="line2"></span>
                <span class="line__menu line-3" id="line3"></span>
            </div>
        </div>
        <div class="header__main-nav-profile">
            <div class="nav-profile__photo">
                <img src="/profile/<?= $usersession['foto']; ?>" alt="profile-picture" id="photo-dropdown" />
            </div>
            <div class="nav-profile__desc">
                <p id="profileName" class="ellipsis__text"><?= $usersession['nama']; ?> </p>
                <p id="profileStatus" class="ellipsis__text">Administrator</p>
            </div>
            <div class="nav-profile__btn">
                <i class="fi-br-angle-down" id="btn-dropdown"></i>
            </div>
        </div>

        <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
            <p class="nav-dropdown__title">Pengaturan Profil</p>
            <p class="d-flex align-items-center">
                <a href="/admin/profile" class="d-block">Lihat Profil</a>
            </p>
            <hr />
            <p class="d-flex align-items-center">
                <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
                <a href="/logout" class="d-block">Log out</a>
            </p>
        </div>
    </div>

    <div class="header__main-title">
        <div class="header__main-title__pagination">
            <a href="/admin">Dashboard</a>
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
        <form method="POST" action="/admin/updateinduk">
            <!-- kategori -->
            <div class="row mb-3 mb-sm-4">
                <label for="kategori" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kategori
                    <span class="color__danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <select name="kategori_id" id="kategori" class="form-select form__select shadow-none" required autocomplete="off">
                        <?php foreach ($kategori as $kategori) : ?>
                            <option value="<?= $kategori['kategori_id'] ?>" <?php if ($kategori['kategori_id'] == $induk['kategori_id']) echo 'selected'; ?>><?= $kategori['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- kode -->
            <div class="row mb-3 mb-sm-4">
                <label for="kode" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kode
                    <span class="color__danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <input class="form-control form__control shadow-none" id="kode" name="induk_id" value="<?= $induk['induk_id']; ?>" required autocomplete="off" placeholder="Masukkan kode data induk" />
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
                    <button type="submit" class="btn form__btn btn__dark shadow-none">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
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