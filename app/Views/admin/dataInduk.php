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
            <a href="/admin/index">Dashboard</a>
            / Data Induk
        </div>
        <div class="header__main-title__subtitle">
            <div class="title__subtitle-desc">
                <h1>Data Induk</h1>
                <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                                function split_name($name)
                                {
                                    $name = trim($name);
                                    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                    $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                                    return array($first_name, $last_name);
                                }
                                echo split_name($usersession['nama'])[0];
                                ?></span>, selamat datang di dashboard Data Induk</p>
            </div>
        </div>
    </div>

    <!--========== body main ==========-->
    <div class="title__table__add">
        <h4 class="title__body__user">Daftar Data Induk</h4>
        <a href="/admin/addDataIndukform" class="btn shadow-none btn__add btn__dark" role="button">
            <i class="fa-solid fa-plus"></i>
            Add Data Induk
        </a>
    </div>

    <!-- table indikator -->
    <div class="sipmpp__table">
        <?= session()->getFlashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table__datainduk__content sipmpp__table-content table-hover">
                <thead class="bg__light">
                    <tr>
                        <th class="table__datainduk-number">no</th>
                        <th class="table__datainduk-kode">kode</th>
                        <th class="table__datainduk-kebutuhan-data">kebutuhan data</th>
                        <th class="table__datainduk-aksi">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($induk as $induk) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td class="text-uppercase"><?= $induk['induk_id'] ?></td>
                            <td><?= $induk['nama_induk'] ?></td>
                            <td>
                                <a role="button" data-bs-placement="top" title="Edit" href="/admin/editDataInduk/<?= $induk['induk_id'] . '/' . $induk['kategori_id'] ?>" class="edit__data__induk__icon me-3 me-md-5"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a data-bs-placement="top" title="Delete" href="#" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
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

    // tooltips
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    const tooltipsDelete = document.querySelectorAll(
        ".delete__data__induk__icon"
    );
    tooltipsDelete.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection(); ?>