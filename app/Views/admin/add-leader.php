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
                <p id="profileName" class="ellipsis__text">
                    <?= $usersession['nama']; ?>
                </p>
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
            <a href="/admin/index">Dashboard</a>
            / <a href="/admin/user">Base User</a> / Form Add Leader
        </div>
        <div class="header__main-title__subtitle">
            <div class="title__subtitle-desc">
                <h1>Add Leader</h1>
                <p>
                    Form untuk menambahkan leader baru
                </p>
            </div>
        </div>
    </div>

    <!--========== body main ==========-->
    <div class="title__table__add">
        <h4 class="title__body__user">Form Add Leader</h4>
    </div>

    <!-- form add user -->
    <div class="form__add__user">
        <form method="POST" action="/admin/addbasicuser/pimpinan">
            <!-- User -->
            <div class="row mb-3 mb-sm-4">
                <label for="user" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">User <span class="color__danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <select name="user" id="user" class="form-select form__select shadow-none" required>
                        <option disabled selected>Pilih User</option>
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['email'] ?>"><?= $user['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- tahun -->
            <div class="row mb-3 mb-sm-4">
                <label for="tahun" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Tahun <span class="color__danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-8">
                    <select name="tahun" id="tahun" class="form-select form__select shadow-none" required>
                        <option disabled selected>Pilih Tahun</option>
                        <?php foreach ($tahun as $tahun) : ?>
                            <option value="<?= $tahun['tahun'] ?>"><?= $tahun['tahun'] ?></option>
                        <?php endforeach; ?>
                    </select>
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