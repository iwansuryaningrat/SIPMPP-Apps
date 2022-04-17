<div class="tab-pane fade" id="pills-chart-indikator-pm" role="tabpanel" aria-labelledby="pills-indikator-pm">
    <div class="indikator__kategori-title">
        <h3>Pengabdian Masyarakat</h3>
        <form action="" method="POST">
            <div class="form-group form-group__standar" id="formStandarPengabdian">
                <label for="filterStandarPengabdian" class="form-label form__label me-3 mb-0">Standar:</label>
                <select name="filterStandarPengabdian" id="filterStandarPengabdian" class="form-select form__select form-select__standar shadow-none">
                    <option selected disabled>Pilih Standar</option>
                    <option value="1">S1</option>
                    <option value="2">S2</option>
                    <option value="3">S3</option>
                    <option value="4">S4</option>
                    <option value="5">S5</option>
                </select>
            </div>
        </form>
    </div>

    <!-- indikator chart content -->
    <!-- PPMS1 -->
    <div id="PPMS1Indikator" class="PPMIndikator">
        <h5 style="font-weight: 600;">S1. Standar Hasil PKM</h5>
        <!-- bar chart standar 1 -->
        <div class="chart__indikator-container mb-4">
            <canvas id="chartPPMS1Indikator"></canvas>
        </div>

        <!-- table indikator standar 1 -->
        <div class="sipmpp__table">
            <div class="table-responsive">
                <table class="table sipmpp__table-content indikator__tbl table-hover" id="tablePPPMS1Indikator">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__indikator-number">no</th>
                            <th class="table__indikator-indikator">indikator</th>
                            <th class="table__indikator-keterangan">keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Indikator 1</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                similique
                                nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                mollitia et eligendi, laudantium blanditiis in aut.</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Indikator 2</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                similique
                                nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                mollitia et eligendi, laudantium blanditiis in aut.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- PPMS2 -->
    <div id="PPMS2Indikator" class="PPMIndikator">
        <h5 style="font-weight: 600;">S2. Standar Isi PKM</h5>
        <!-- bar chart standar 2 -->
        <div class="chart__indikator-container mb-4">
            <canvas id="chartPPMS2Indikator"></canvas>
        </div>

        <!-- table indikator standar 2 -->
        <div class="sipmpp__table">
            <div class="table-responsive">
                <table class="table sipmpp__table-content indikator__tbl table-hover" id="tablePPPMS2Indikator">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__indikator-number">no</th>
                            <th class="table__indikator-indikator">indikator</th>
                            <th class="table__indikator-keterangan">keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Indikator 1</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                similique
                                nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                mollitia et eligendi, laudantium blanditiis in aut.</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Indikator 2</td>
                            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias
                                similique
                                nisi facere iste, qui, modi itaque quis quas eos quia porro culpa dicta
                                mollitia et eligendi, laudantium blanditiis in aut.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- PPMS3 -->
    <div id="PPMS3Indikator" class="PPMIndikator">
        <h5 style="font-weight: 600;">S3. Standar Proses PKM</h5>
    </div>
</div>