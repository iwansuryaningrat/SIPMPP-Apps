<div class="tab-pane fade" id="pills-chart-indikator-pm" role="tabpanel" aria-labelledby="pills-indikator-pm">
    <div class="indikator__kategori-title">
        <h3>Pengabdian Masyarakat</h3>
        <form action="" method="POST">
            <div class="form-group form-group__standar" id="formStandarPengabdian">
                <label for="filterStandarPengabdian" class="form-label form__label me-3 mb-0">Standar:</label>
                <select name="filterStandarPengabdian" id="filterStandarPengabdian" class="form-select form__select form-select__standar shadow-none">
                    <option selected disabled>Pilih Standar</option>
                    <?php foreach ($Stats['PPM'] as $PPM) : ?>
                        <option value="<?= $PPM['kode'] ?>"><?= $PPM['kode'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <!-- indikator chart content -->
    <?php foreach ($Stats['PPM'] as $Pengabdian) : ?>
        <div id="PPM<?= $Pengabdian['kode'] ?>Indikator" class="PPMIndikator">
            <h5 style="font-weight: 600;"><?= $Pengabdian['standar'] ?></h5>
            <!-- bar chart standar 1 -->
            <div class="chart__indikator-container mb-4">
                <canvas id="chartPPM<?= $Pengabdian['kode'] ?>Indikator"></canvas>
            </div>

            <!-- table indikator standar 1 -->
            <div class="sipmpp__table">
                <div class="table-responsive">
                    <table class="table sipmpp__table-content indikator__tbl table-hover" id="tablePPPM<?= $Pengabdian['kode'] ?>Indikator">
                        <thead class="bg__light">
                            <tr>
                                <th class="table__indikator-number">no</th>
                                <th class="table__indikator-indikator">indikator</th>
                                <th class="table__indikator-keterangan">keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1;
                            foreach ($Pengabdian['namaindikator'] as $key => $value) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>Indikator <?= $i; ?></td>
                                    <td><?= $value ?></td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>