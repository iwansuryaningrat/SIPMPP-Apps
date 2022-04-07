<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / <a href="/admin/standar">Standar</a> /
        Indikator
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Indikator</h1>
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
                </span>, selamat datang di dashboard Indikator</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <div>
        <h4 class="title__body__user mb-3">Kategori <span><?= $kategori['nama_kategori']; ?></span>
        </h4>
        <h4 class="title__body__user"><span><?= $standar['standar_id'] ?></span>.
            <span><?= $standar['nama_standar'] ?></span>
        </h4>
    </div>
    <div>
        <a href="/admin/addindikatorform/<?= $standar['standar_id'] . '/' . $kategori['kategori_id'] ?>" class="btn shadow-none btn__add btn__dark">
            <i class="fa-solid fa-plus"></i>
            Add Indikator
        </a>
    </div>
</div>

<!-- table indikator -->
<div class="sipmpp__table">
    <div class="table-responsive">
        <table class="table table__indikator__content sipmpp__table-content table-hover">
            <thead class="bg__light">
                <tr>
                    <th class="table__indikator-number">no</th>
                    <th class="table__indikator-indikator">indikator</th>
                    <th class="table__indikator-target">target</th>
                    <th class="table__indikator-kebutuhan-data">kebutuhan data</th>
                    <th class="table__indikator-aksi">aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($indikator as $dataindikator) : ?>
                    <tr>
                        <td><?= $i; ?>
                        </td>
                        <td><?= $dataindikator['nama_indikator']; ?>
                        </td>
                        <td><?= $dataindikator['target']; ?>
                        </td>
                        <td>Data</td>
                        <td>
                            <a data-bs-placement="top" title="Edit" href="admin/editindikatorform/<?= $standar['standar_id'] . '/' . $kategori['kategori_id'] . '/' . $dataindikator['indikator_id'] ?>" class="edit__data__induk__icon me-lg-4 me-md-4 me-3"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a data-bs-placement="top" title="Lihat" href="#" class="edit__data__induk__icon"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
    // tooltips
    // progress bar unit
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    const tooltipsDelete = document.querySelectorAll(
        ".delete__data__induk__icon"
    );

    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
    tooltipsDelete.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection();
