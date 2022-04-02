<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a href="/">Dashboard</a>
    / Report
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Report Overview</h1>
      <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                      $name = trim($name);
                      $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                      $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                      return array($first_name, $last_name);
                    }
                    echo split_name($data_user['nama'])[0];
                    ?></span>, selamat datang di halaman Report!</p>
    </div>
  </div>
</div>

<!-- body main -->
<h1>Cooming Soon!</h1>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  // tooltips
  // progress bar unit
  const tooltipsUnitProgress =
    document.querySelectorAll(".unit__progressbar");
  tooltipsUnitProgress.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection(); ?>