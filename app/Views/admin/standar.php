<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / Standar
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Standar</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function split_name($name)
                            {
                                $name = trim($name);
                                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                                return array($first_name, $last_name);
                            }
                            echo split_name($usersession['nama'])[0];
                            ?>
                </span>, selamat datang di dashboard Standar</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add nav__kategori">
    <h4 class="title__body__user">Daftar Standar</h4>
    <a href="/admin/addStandarform" class="btn shadow-none btn__add btn__dark add__unit__icon" role="button">
        <i class="fa-solid fa-plus"></i>
        Add Standar
    </a>
</div>

<div class="filter__table">
    <div class="nav nav-pills" id="pills-tab" role="tablist">
        <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active" id="pills-spmi-penelitian"
            data-bs-toggle="pill" data-bs-target="#pills-table-spmi-penelitian" type="button" role="tab"
            aria-controls="pills-table-spmi-penelitian" aria-selected="true">
            Penelitian
        </button>
        <button class="btn filter__btn shadow-none nav-link" id="pills-spmi-pm" data-bs-toggle="pill"
            data-bs-target="#pills-table-spmi-pm" type="button" role="tab" aria-controls="pills-table-spmi-pm"
            aria-selected="false">
            Pengabdian Masyarakat
        </button>
    </div>
</div>

<!-- table standar -->
<div class="tab-content" id="pills-tabContent">
    <!-- penelitian -->
    <div class="tab-pane fade show active" id="pills-table-spmi-penelitian" role="tabpanel"
        aria-labelledby="pills-spmi-penelitian">
        <div class="sipmpp__table">
            <!-- Menampilkan flashdata message -->
            <?= session()->getFlashdata('message'); ?>

            <div class="table-responsive">
                <table class="table table__standar__content sipmpp__table-content table-hover">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__standar-number">no</th>
                            <th class="table__standar-kode">kode</th>
                            <th class="table__standar-standar">standar</th>
                            <th class="table__standar-aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($standarPEN as $standar) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td><?= $standar['standar_id']; ?>
                            </td>
                            <td><?= $standar['nama_standar']; ?>
                            </td>
                            <td>
                                <a data-bs-placement="top" title="lihat"
                                    href="/admin/viewIndikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>"
                                    class="edit__data__induk__icon me-lg-5 me-md-4 me-3"><i
                                        class="fa-solid fa-eye"></i></a>
                                <a data-bs-placement="top" title="Edit"
                                    href="/admin/editstandarform/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>"
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
    <div class="tab-pane fade" id="pills-table-spmi-pm" role="tabpanel" aria-labelledby="pills-spmi-pm">
        <div class="sipmpp__table">
            <!-- Menampilkan flashdata message -->
            <?= session()->getFlashdata('message'); ?>

            <div class="table-responsive">
                <table class="table table__standar__content sipmpp__table-content table-hover">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__standar-number">no</th>
                            <th class="table__standar-kode">kode</th>
                            <th class="table__standar-standar">standar</th>
                            <th class="table__standar-aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($standarPPM as $standar) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td><?= $standar['standar_id']; ?>
                            </td>
                            <td><?= $standar['nama_standar']; ?>
                            </td>
                            <td>
                                <a data-bs-placement="top" title="lihat"
                                    href="/admin/viewIndikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>"
                                    class="edit__data__induk__icon me-lg-5 me-md-4 me-3"><i
                                        class="fa-solid fa-eye"></i></a>
                                <a data-bs-placement="top" title="Edit"
                                    href="/admin/editstandarform/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>"
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
<a href="/admin/editIndikatorform"></a>

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
    // progress bar unit
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection();
