<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
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
                            ?>
                </span>, selamat datang di dashboard Penilaian</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-1">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Penilaian</h4>
    <div class="title__body__button">
        <a href="/admin/autoGeneratePenilaian" class="btn shadow-none btn__add btn__generate mb-lg-4 mb-3" role="button">
            <i class="fa-solid fa-folder-plus"></i>
            Auto Generate
        </a>
    </div>
</div>

<!-- filter -->
<div class="filter__table">
    <div class="nav nav-pills" id="pills-tab" role="tablist">
        <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active" id="pills-penilaian-penelitian" data-bs-toggle="pill" data-bs-target="#pills-table-penilaian-penelitian" type="button" role="tab" aria-controls="pills-table-penilaian-penelitian" aria-selected="true">
            Penelitian
        </button>
        <button class="btn filter__btn shadow-none nav-link" id="pills-penilaian-pm" data-bs-toggle="pill" data-bs-target="#pills-table-penilaian-pm" type="button" role="tab" aria-controls="pills-table-penilaian-pm" aria-selected="false">
            Pengabdian Masyarakat
        </button>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- penelitian -->
    <div class="tab-pane fade show active" id="pills-table-penilaian-penelitian" role="tabpanel" aria-labelledby="pills-penilaian-penelitian">
        <!-- table data induk -->
        <div class="">
            <!-- datatable penilaian -->
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table id="datatablePenilaianPenelitian" class="display">
                    <thead class="bg__light">
                        <tr>
                            <th class="datatable__number">no</th>
                            <th class="datatable__tahun">tahun</th>
                            <th class="datatable__unit">unit</th>
                            <th class="datatable__standar">standar</th>
                            <th class="datatable__nama-standar">nama standar</th>
                            <!-- <th class="datatable__status">status</th> -->
                            <th class="datatable__aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($dataPenilaian as $data) :
                            if ($data['kategori_id'] == 'PEN') : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['tahun'] ?></td>
                                    <td><?= $data['nama_unit'] ?></td>
                                    <td><?= $data['standar_id'] ?></td>
                                    <td><?= $data['nama_standar'] ?></td>
                                    <!-- <td><span class="badge badge__sipmpp badge__success">Sukses</span></td> -->
                                    <td>
                                        <a data-bs-placement="top" title="Delete" href="/deletedata/deletePenilaian/<?= $data['tahun'] . '/' . $data['unit_id'] . '/' . $data['standar_id'] . '/' . $data['kategori_id'] ?>$, $standar_id, $kategori_id)" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php $i++;
                            endif;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- pengabdian masyarakat -->
    <div class="tab-pane fade" id="pills-table-penilaian-pm" role="tabpanel" aria-labelledby="pills-penilaian-pm">
        <!-- table data induk -->
        <div class="">
            <!-- datatable penilaian -->
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table id="datatablePenilaianPengabdian" class="display">
                    <thead class="bg__light">
                        <tr>
                            <th class="datatable__number">no</th>
                            <th class="datatable__tahun">tahun</th>
                            <th class="datatable__unit">unit</th>
                            <th class="datatable__standar">standar</th>
                            <th class="datatable__nama-standar">nama standar</th>
                            <!-- <th class="datatable__status">status</th> -->
                            <th class="datatable__aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($dataPenilaian as $data) :
                            if ($data['kategori_id'] == 'PPM') : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $data['tahun'] ?></td>
                                    <td><?= $data['nama_unit'] ?></td>
                                    <td><?= $data['standar_id'] ?></td>
                                    <td><?= $data['nama_standar'] ?></td>
                                    <!-- <td><span class="badge badge__sipmpp badge__success">Sukses</span></td> -->
                                    <td>
                                        <a data-bs-placement="top" title="Delete" href="/deletedata/deletePenilaian/<?= $data['tahun'] . '/' . $data['unit_id'] . '/' . $data['standar_id'] . '/' . $data['kategori_id'] ?>$, $standar_id, $kategori_id)" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php $i++;
                            endif;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
</script>
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
    const tooltipsEdit = document.querySelectorAll(".edit__data__induk__icon");
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    const tooltipsDelete = document.querySelectorAll(".delete__data__induk__icon");
    tooltipsDelete.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    // datatable
    $(document).ready(function() {
        $('#datatablePenilaianPenelitian').DataTable();
        $('#datatablePenilaianPengabdian').DataTable();
    });
</script>

<?= $this->endSection();
