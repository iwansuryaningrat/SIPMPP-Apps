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