<div class="tab-pane fade show active" id="pills-chart-indikator-penelitian" role="tabpanel" aria-labelledby="piils-indikator-penelitian">
    <div class="indikator__kategori-title">
        <h3>Penelitian</h3>
        <form action="" method="POST">
            <div class="form-group form-group__standar" id="formStandarPenelitian">
                <label for="filterStandarPenelitian" class="form-label form__label me-3 mb-0">Standar:</label>
                <select name="filterStandarPenelitian" id="filterStandarPenelitian" class="form-select form__select form-select__standar shadow-none">
                    <option selected disabled>Pilih Standar</option>
                    <?php foreach ($Stats['PEN'] as $PEN) : ?>
                        <option value="<?= $PEN['kode'] ?>"><?= $PEN['kode'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <!-- indikator chart content -->
    <?php foreach ($Stats['PEN'] as $Penelitian) : ?>
        <div id="PEN<?= $Penelitian['kode'] ?>Indikator" class="PENIndikator">
            <h5 style="font-weight: 600;"><?= $Penelitian['standar'] ?></h5>
            <!-- bar chart standar 1 -->
            <div class="chart__indikator-container mb-4">
                <canvas id="chartPEN<?= $Penelitian['kode'] ?>Indikator"></canvas>
            </div>

            <!-- table indikator standar 1 -->
            <div class="sipmpp__table">
                <div class="table-responsive">
                    <table class="table sipmpp__table-content indikator__tbl table-hover" id="tablePEN<?= $Penelitian['kode'] ?>Indikator">
                        <thead class="bg__light">
                            <tr>
                                <th class="table__indikator-number">no</th>
                                <th class="table__indikator-indikator">indikator</th>
                                <th class="table__indikator-keterangan">keterangan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 1;
                            foreach ($Penelitian['namaindikator'] as $key => $value) : ?>
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