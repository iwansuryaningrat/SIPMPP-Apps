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
            <img src="/profile/<?= $data_user['foto']; ?>"
                alt="profile-picture" id="photo-dropdown" />
        </div>
        <div class="nav-profile__desc">
            <p id="profileName" class="ellipsis__text"><?= $data_user['nama']; ?>
            </p>
            <p id="profileStatus" class="ellipsis__text">Leader</p>
        </div>
        <div class="nav-profile__btn">
            <i class="fi-br-angle-down" id="btn-dropdown"></i>
        </div>
    </div>

    <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
        <p class="nav-dropdown__title">Pengaturan Profil</p>
        <p class="d-flex align-items-center">
            <a href="/leader/profile" class="d-block">Lihat Profil</a>
        </p>
        <hr />
        <form action="/leader/switchtahun" method="POST" id="form-tahun-profile">
            <!-- tahun -->
            <div class="mb-3">
                <label for="tahunProfile" class="form-label form__label__profile nav-dropdown__title"
                    id="form-tahun-profile-label">Tahun</label>
                <div class="d-flex align-items-center">
                    <select name="tahun" id="tahunProfile" class="form-select form__select__profile shadow-none">
                        <?php foreach ($tahunsession as $data_tahun) : ?>
                        <option
                            value="<?= $data_tahun['tahun']; ?>"
                            <?php if ($tahun == $data_tahun['tahun']) {
    echo 'selected';
} ?>>
                            <?= $data_tahun['tahun']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- unit -->
            <div class="mb-3">
                <label for="unitProfile" class="form-label form__label__profile nav-dropdown__title"
                    id="form-unit-profile-label">Unit</label>
                <div class="d-flex align-items-center">
                    <select name="unit" id="unitProfile" class="form-select form__select__profile shadow-none">
                        <option value="">Unit 1</option>
                        <option value="">Unit 2</option>
                        <option value="">Unit 3</option>
                    </select>
                </div>
            </div>
        </form>
        <hr />
        <p class="d-flex align-items-center">
            <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
            <a href="/logout" class="d-block">Log out</a>
        </p>
    </div>
</div>