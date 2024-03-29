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
            <img src="/profile/<?= $data_user['foto']; ?>" alt="profile-picture" id="photo-dropdown" />
        </div>
        <div class="nav-profile__desc">
            <p id="profileName" class="ellipsis__text"><?= $data_user['nama']; ?>
            </p>
            <p id="profileStatus" class="ellipsis__text">Auditor</p>
        </div>
        <div class="nav-profile__btn">
            <i class="fi-br-angle-down" id="btn-dropdown"></i>
        </div>
    </div>

    <div class="header__main-nav-dropdown" id="header-main-nav-dropdown">
        <p class="nav-dropdown__title">Pengaturan</p>
        <p class="d-flex align-items-center">
            <a href="/auditor/profile" class="d-block">Lihat Profil</a>
        </p>
        <hr />
        <form action="" method="POST" id="form-tahun-profile">
            <label for="tahunProfile" class="form-label form__label__profile nav-dropdown__title" id="form-tahun-profile-label">Tahun</label>
            <select name="tahun" id="tahunProfile" class="form-select form__select__profile shadow-none">
                <?php foreach ($tahunsession as $data_tahun) : ?>
                    <option value="<?= $data_tahun['tahun']; ?>" <?php if ($tahun == $data_tahun['tahun']) {
                                                                        echo 'selected';
                                                                    } ?>><?= $data_tahun['tahun']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <hr />
        <p class="d-flex align-items-center">
            <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
            <a href="/logout" class="d-block">Log out</a>
        </p>
    </div>
</div>