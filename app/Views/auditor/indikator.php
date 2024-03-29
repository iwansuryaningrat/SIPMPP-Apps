<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/">Audit <?= $data_user['unit']; ?></a>
    / <a href="/auditor/standar">Nilai SPMI</a> / Indikator
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Audit Indikator SPMI</h1>
      <p>Daftar nilai SPMI sesuai indikator</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<h4 class="title__body__indikator-u">
  Kategori: <?= $kategori; ?> <span><?= $data_user['tahun']; ?></span>
</h4>
<h4 class="title__body__indikator-s">
  <?= $standar['standar_id'] . '. ' . $standar['nama_standar'] ?>
</h4>

<!-- table indikator -->
<!-- Menampilkan Flashdata Message -->
<?= session()->getFlashdata('message'); ?>
<div class="sipmpp__table">
  <div class="table-responsive">
    <table class="table table__indikator__content sipmpp__table-content table-hover">
      <thead class="bg__light">
        <tr>
          <th class="table__indikator-number">No</th>
          <th class="table__indikator-indikator">Indikator</th>
          <th class="table__indikator-target">Target</th>
          <th class="table__indikator-status">status</th>
          <th class="table__indikator-nilai">nilai</th>
          <th class="table__indikator-aksi">Aksi</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($datapenilaian as $data) : ?>
          <tr>
            <td><?= $i; ?>
            </td>
            <?php foreach ($indikator as $indi) :
              if ($data['indikator_id'] == $indi['indikator_id'] &&  $data['standar_id'] == $indi['standar_id'] && $data['kategori_id'] == $indi['kategori_id']) : ?>
                <td>
                  <?= $indi['nama_indikator']; ?>
                </td>
                <td>
                  <?= $indi['target']; ?>
                </td>
            <?php endif;
            endforeach; ?>
            <td><span class="badge badge__sipmpp <?php if ($data['status'] == 'Diaudit') {
                                                    echo 'badge__success';
                                                  } elseif ($data['status'] == 'Dikirim') {
                                                    echo 'badge__primary';
                                                  } elseif ($data['status'] == 'Belum Diisi') {
                                                    echo 'badge__danger';
                                                  } else {
                                                    echo 'badge__warning';
                                                  } ?>"><?= $data['status']; ?></span></td>
            <td><?= sprintf("%.2f", floatval($data['nilai_akhir'])); ?>

            </td>
            <td>
              <a data-bs-placement="top" title="Edit" href="/auditor/indikatorform/<?= $data['kategori_id'] . '/' . $data['standar_id'] . '/' . $data['indikator_id']; ?>" class="edit__data__induk__icon"><i class="fa-solid fa-pen-to-square"></i></a>
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
  tooltipsEdit.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
