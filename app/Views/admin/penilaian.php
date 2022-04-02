<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / Penilaian
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Penilaian</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function split_name($name)
                            {
                                $name = trim($name);
                                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                                return array($first_name, $last_name);
                            }
                            echo split_name($usersession['nama'])[0];
                            ?></span>, selamat datang di dashboard Penilaian</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Daftar Penilaian</h4>
    <a href="/admin/addDataInduk" class="btn shadow-none btn__add btn__dark" role="button">
        <i class="fa-solid fa-plus"></i>
        Add Penilaian
    </a>
</div>

<!-- table penilaian -->
<div class="sipmpp__table">
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
                <tr>
                    <td>1</td>
                    <td class="text-uppercase">mk</td>
                    <td>Mata Kuliah</td>
                    <td>
                        <a role="button" data-bs-placement="top" title="Edit" href="/admin/editDataInduk" class="edit__data__induk__icon me-3 me-md-5"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a data-bs-placement="top" title="Delete" href="#" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="text-uppercase">perpus</td>
                    <td>Target jumlah mahasiswa yang terlibat dalam penelitian dan pengabdian kepada
                        masyarakat</td>
                    <td>
                        <a role="button" data-bs-placement="top" title="Edit" href="/admin/editDataInduk" class="edit__data__induk__icon me-3 me-md-5"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a data-bs-placement="top" title="Delete" href="#" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="mb-5"></div>
<!-- datatable penilaian -->
<div class="table-responsive">
    <table id="datatablePenilaian" class="display">
        <thead class="bg__light">
            <tr>
                <th>no</th>
                <th>tahun</th>
                <th>unit</th>
                <th>kategori</th>
                <th>standar</th>
                <th>status</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2019</td>
                <td>S1-Informatika</td>
                <td>Penelitian</td>
                <td>S12</td>
                <td>Sukses</td>
                <td>Aksi</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2020</td>
                <td>S1-Matematika</td>
                <td>Penelitian</td>
                <td>S15</td>
                <td>Belum di audit</td>
                <td>Aksi</td>
            </tr>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
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

    // datatable
    $(document).ready(function() {
        $('#datatablePenilaian').DataTable();
    });
</script>

<?= $this->endSection(); ?>