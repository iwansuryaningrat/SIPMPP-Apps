<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / Daftar User
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Daftar User</h1>
            <p>Halo
                <span>
                    <?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                        $name = trim($name);
                        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                        return array($first_name, $last_name);
                    }
                    echo split_name($usersession['nama'])[0];
                    ?>
                </span>, selamat datang di dashboard Daftar User
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user mb-3 me-3">Daftar User</h4>
    <a href="/admin/addUserForm" class="btn shadow-none btn__add btn__dark">
        <i class="fa-solid fa-plus"></i>
        Add User
    </a>
</div>

<!-- Menampilkan flashdata -->
<?= session()->getFlashdata('msg'); ?>

<!-- table auditor -->
<div class="sipmpp__table">
    <div class="table-responsive">
        <table class="table table__daftar-user__content sipmpp__table-content table-hover">
            <thead class="bg__light">
                <tr>
                    <th class="table__user-number">No</th>
                    <th class="table__user-fullname">Nama Lengkap</th>
                    <th class="table__user-email">Email</th>
                    <th class="table__user-telepon">Telepon</th>
                    <th class="table__user-nip">NIP</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $i; ?>
                    </td>
                    <td><?= $user['nama']; ?>
                    </td>
                    <td><?= $user['email']; ?>
                    </td>
                    <td><?= $user['telp']; ?>
                    </td>
                    <td><?= $user['nip']; ?>
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

</script>

<?= $this->endSection();
