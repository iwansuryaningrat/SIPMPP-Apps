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
            <img src="/profile/<?= $usersession['foto']; ?>"
                alt="profile-picture" id="photo-dropdown" />
        </div>
        <div class="nav-profile__desc">
            <p id="profileName" class="ellipsis__text"><?= $usersession['nama']; ?>
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
        <form action="" method="POST" id="form-tahun-profile">
            <label for="tahunProfile" class="form-label form__label__profile nav-dropdown__title"
                id="form-tahun-profile-label">Tahun</label>
            <div class="d-flex align-items-center">
                <select name="tahun" id="tahunProfile" class="form-select form__select__profile shadow-none me-2">
                    <option value="">2018</option>
                    <option value="">2019</option>
                    <option value="">2020</option>
                    <option value="">2021</option>
                    <option value="">2022</option>
                </select>
                <button class="btn btn__dark"><i class="fa-solid fa-check"></i></button>
            </div>
        </form>
        <hr />
        <p class="d-flex align-items-center">
            <i class="fa-solid fa-arrow-right-from-bracket d-flex"></i>
            <a href="/logout" class="d-block">Log out</a>
        </p>
    </div>
</div>