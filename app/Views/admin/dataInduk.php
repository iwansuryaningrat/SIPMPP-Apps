<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / Daftar Data Induk
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Daftar Data Induk</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function getFirstWord($string)
                            {
                                $arr = explode(' ', trim($string));
                                return isset($arr[0]) ? $arr[0] : $string;
                            }
                            echo getFirstWord($usersession['nama']);
                            ?>
                </span>, selamat datang di dashboard Daftar Data Induk</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-2">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Data Induk</h4>
    <div class="title__body__button">
        <a href="/admin/addDataIndukform" class="btn shadow-none btn__add btn__dark mb-lg-4 mb-3" role="button">
            <i class="fa-solid fa-plus"></i>
            Add Data Induk
        </a>
    </div>
</div>

<!-- filter -->
<div class="filter__table mb-4">
    <div class="nav nav-pills" id="pills-tab" role="tablist">
        <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active" id="pills-datainduk-penelitian"
            data-bs-toggle="pill" data-bs-target="#pills-table-datainduk-penelitian" type="button" role="tab"
            aria-controls="pills-table-datainduk-penelitian" aria-selected="true">
            Penelitian
        </button>
        <button class="btn filter__btn shadow-none nav-link" id="pills-datainduk-pm" data-bs-toggle="pill"
            data-bs-target="#pills-table-datainduk-pm" type="button" role="tab" aria-controls="pills-table-datainduk-pm"
            aria-selected="false">
            Pengabdian Masyarakat
        </button>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- penelitian -->
    <div class="tab-pane fade show active" id="pills-table-datainduk-penelitian" role="tabpanel"
        aria-labelledby="pills-datainduk-penelitian">
        <!-- table data induk -->
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
                        <?php foreach ($indukPEN as $indukPEN) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td class="text-uppercase"><?= $indukPEN['kode'] ?>
                            </td>
                            <td><?= $indukPEN['nama_induk'] ?>
                            </td>
                            <td>
                                <a role="button" data-bs-placement="top" title="Edit"
                                    href="/admin/editDataInduk/<?= $indukPEN['induk_id'] . '/' . $indukPEN['kategori_id'] ?>"
                                    class="edit__data__induk__icon"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- pengabdian masyarakat -->
    <div class="tab-pane fade" id="pills-table-datainduk-pm" role="tabpanel" aria-labelledby="pills-datainduk-pm">
        <!-- table data induk -->
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
                        <?php $i = 1;
                        foreach ($indukPPM as $data_induk) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td class="text-uppercase"><?= $data_induk['kode'] ?>
                            </td>
                            <td><?= $data_induk['nama_induk'] ?>
                            </td>
                            <td>
                                <a role="button" data-bs-placement="top" title="Edit"
                                    href="/admin/editDataInduk/<?= $data_induk['induk_id'] . '/' . $data_induk['kategori_id'] ?>"
                                    class="edit__data__induk__icon"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    // active filer button
    $(function() {
        $(".filter__btn").click(function() {
            // remove classes from all
            $(".filter__btn").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
            // stop the page from jumping to the top
            return false;
        });
    });

    // tooltips
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection();
