<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/admin/index">Dashboard</a>
    / Leader
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Leader</h1>
      <p>Halo <span>
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
        </span>, selamat datang di dashboard Leader</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-3">
  <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Leader</h4>
  <a href="/admin/addLeader" class="btn shadow-none btn__add btn__dark mb-lg-4 mb-3">
    <i class="fa-solid fa-plus"></i>
    Add Leader
  </a>
</div>

<!-- table leader -->
<div class="sipmpp__table">
  <div class="table-responsive">
    <table class="table table__user__content sipmpp__table-content table-hover">
      <thead class="bg__light">
        <tr>
          <th class="table__user-number">no</th>
          <th class="table__user-fullname">nama lengkap</th>
          <th class="table__user-email">email</th>
          <th class="table__user-unit">daftar unit</th>
          <th class="table__user-telepon">telepon</th>
          <th class="table__user-aksi">aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) :
          if ($user['role'] == 'pimpinan') : ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $user['nama']; ?></td>
              <td><?= $user['email']; ?></td>
              <td>
                <ol class="list__table__user-unit">
                  <?php foreach ($units as $unit) :
                    if ($unit['email'] == $user['email'] && $unit['role'] == 'pimpinan') : ?>
                      <li><?= $unit['nama_unit']; ?>
                      </li>
                  <?php endif;
                  endforeach; ?>
                </ol>
              </td>
              <td><?= $user['telp']; ?></td>
              <td>
                <a data-bs-placement="top" title="Delete" href="/admin/deleteUserRoleUnit/<?= $user['email']; ?>/4" class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
        <?php $i++;
          endif;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  // tooltips
  const tooltipsDelete = document.querySelectorAll(
    ".delete__data__induk__icon"
  );
  tooltipsDelete.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
