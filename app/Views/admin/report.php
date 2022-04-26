<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / Report
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Report Overview</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function getFirstWord($string)
                            {
                                $arr = explode(' ', trim($string));
                                return isset($arr[0]) ? $arr[0] : $string;
                            }
                            echo getFirstWord($data_user['nama']);
                            ?>
                </span>, selamat datang di dashboard Report</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Coming Soon!</h4>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
</script>

<?= $this->endSection();
