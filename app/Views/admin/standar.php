<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
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
                            ?></span>, selamat datang di dashboard Standar</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Daftar Standar</h4>
    <a href="/admin/addStandarform" class="btn shadow-none btn__add btn__dark add__unit__icon" role="button">
        <i class="fa-solid fa-plus"></i>
        Add Standar
    </a>
</div>

<!-- table indikator -->
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
                    <th class="table__standar-standar">Kategori</th>
                    <th class="table__standar-aksi">aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($standar as $standar) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $standar['standar_id']; ?></td>
                        <td><?= $standar['nama_standar']; ?></td>
                        <td><?= $standar['nama_kategori']; ?></td>
                        <td>
                            <a data-bs-placement="top" title="lihat" href="/admin/viewIndikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>" class="edit__data__induk__icon me-4"><i class="fa-solid fa-eye"></i></a>
                            <a data-bs-placement="top" title="Edit" href="/admin/editstandarform/<?= $standar['standar_id'] . '/' . $standar['kategori_id']; ?>" class="edit__data__induk__icon me-4"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a data-bs-placement="top" title="Delete" href="#" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
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
        ".lihat__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection(); ?>