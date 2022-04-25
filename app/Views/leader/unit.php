<?= $this->extend('template/leaderlayout'); ?>

<?= $this->section('leader'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/leader/index">Dashboard Leader</a>
        / Unit
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Unit</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function split_name($name)
                            {
                                $name = trim($name);
                                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                                return array($first_name, $last_name);
                            }
                            echo split_name($data_user['nama'])[0];
                            ?>
                </span>, selamat datang di dashboard Unit</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-3">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Unit</h4>
</div>

<!-- table indikator -->
<!-- Menampilkan flashdata msg -->
<?= session()->getFlashdata('msg'); ?>

<div class="sipmpp__table">
    <div class="table-responsive">
        <table class="table table__unit__content sipmpp__table-content table-hover">
            <thead class="bg__light">
                <tr>
                    <th class="table__unit-number">no</th>
                    <th class="table__unit-namaunit">nama unit</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($units as $unit) : ?>
                <tr>
                    <td class="table__unit-number"><?= $i; ?>
                    </td>
                    <td class="table__unit-namaunit"><?= $unit['nama_unit']; ?>
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
<!-- scripts -->
<script>
</script>

<?= $this->endSection();
