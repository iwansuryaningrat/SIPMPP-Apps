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
                <td>1</td>
                <td>Unit 1</td>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('modal'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- scripts -->
<script>
</script>

<?= $this->endSection();
