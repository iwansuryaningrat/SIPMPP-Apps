<?= $this->extend('template/leaderlayout'); ?>

<?= $this->section('leader'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <span id="unit-user">Dashboard Leader</span>
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Dashboard Leader Overview</h1>
            <p>Halo <span>
                    <?php // uses regex that accepts any word character or hyphen in last name
                    function split_name($name)
                    {
                        $name = trim($name);
                        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                        $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                        return array($first_name, $last_name);
                    }
                    echo split_name($data_user['nama'])[0];
                    ?>
                </span>, selamat
                datang kembali!</p>
        </div>
        <div class="title__subtitle-btn">
            <button type="button" class="report__link btn btn__dark shadow-none button__filters" id="btnFilterLeader" data-bs-toggle="modal" data-bs-target="#filterLeaderContainer">
                <i class="fa-solid fa-filter me-2" id="btnFilterLeaderIcon"></i>
                <span id="btnFilterLeaderSpan">Filter</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Filter Form -->
<div class="modal fade" id="filterLeaderContainer" tabindex="-1" aria-labelledby="filterLeaderContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered align-items-center justify-content-center">
        <div class="modal-content modal__content-filter">
            <div class="modal-body position-relative modal__body-filter">
                <form action="/leader/switchTahunUnit" method="POST" id="formFilterLeader">
                    <h5 class="title__filter">Filters</h5>
                    <!-- tahun -->
                    <div class="mb-3">
                        <label for="tahunLeader" class="form-label form__label">Tahun</label>
                        <select name="tahunLeader" id="tahunLeader" class="form-select form__select shadow-none">
                            <?php foreach ($data_tahun as $daftartahun) : ?>
                                <option value="<?= $daftartahun['tahun'] ?>" <?php if ($data_user['tahun'] == $daftartahun['tahun']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $daftartahun['tahun'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- unit -->
                    <div class="mb-3">
                        <label for="unitLeader" class="form-label form__label">Unit</label>
                        <select name="unitLeader" id="unitLeader" class="form-select form__select shadow-none">
                            <?php foreach ($data_unit as $daftarunit) : ?>
                                <option value="<?= $daftarunit['unit_id'] ?>" <?php if ($data_user['unit_id'] == $daftarunit['unit_id']) {
                                                                                    echo "selected";
                                                                                } ?>><?= $daftarunit['nama_unit'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- submit -->
                    <div class="submit__leader">
                        <button class="btn btn__submit-leader shadow-none color__primary" type="submit">
                            Save view
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- body main -->
<!-- chart content -->
<div class="chart__content row">
    <!-- left -->
    <?= $this->include('leader/chart/DoughnutChart'); ?>

    <!-- right -->
    <?= $this->include('leader/chart/LineChart'); ?>

</div>

<!-- indikator chart content -->
<div class="indikator__content">
    <div class="indikator__content-card shadow__box-sm">
        <h6 id="unitIndikator"><?= $data_user['unit'] ?>
        </h6>
        <div class="content-indikator__title">
            <h5 class="card__title mb-3">Rekap Indikator <span><?= $data_user['tahun']; ?></span>
            </h5>
            <div class="filter__panel mb-3">
                <div class="nav nav-pills" id="pills-tab" role="tablist">
                    <button class="btn filter__btn-indikator me-0 me-md-3 shadow-none active nav-link active mb-2" id="piils-indikator-penelitian" data-bs-toggle="pill" data-bs-target="#pills-chart-indikator-penelitian" type="button" role="tab" aria-controls="pills-chart-indikator-penelitian" aria-selected="true">
                        Penelitian
                    </button>
                    <button class="btn filter__btn-indikator shadow-none nav-link mb-2" id="pills-indikator-pm" data-bs-toggle="pill" data-bs-target="#pills-chart-indikator-pm" type="button" role="tab" aria-controls="pills-chart-indikator-pm" aria-selected="false">
                        Pengabdian Masyarakat
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- table penelitian -->
            <?= $this->include('leader/chart/PenelitianChart'); ?>

            <!-- table pengabdian masyarakat -->
            <?= $this->include('leader/chart/PengabdianChart'); ?>

        </div>
    </div>
</div>

<!-- Toast Welcome -->
<div class="toast-container position-fixed bottom-0 end-0 p-4 animate__animated animate__slow animate__fadeInDown">
    <div class="toast toast__welcome" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-bs-delay="5000">
        <div class="row">
            <div class="toast__left col-2 px-0 d-flex align-items-center justify-content-center">
                <img src="/admin/assets/img/undip-logo-color.png" class="toast__welcome-img" alt="logo-undip">
            </div>
            <div class="toast__right col-10">
                <div class="toast-header border-0 px-0">
                    <strong class="me-auto">SIPMPP UNDIP <span id="year__now"></span></strong>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body pt-0 ps-0 pe-3 pb-2">
                    Selamat Datang di Dashboard Leader SIPMPP UNDIP
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?= $this->include('leader/chartsetup/DoughnutChart'); ?>
<?= $this->include('leader/chartsetup/LineChart'); ?>
<?= $this->include('leader/chartsetup/PenelitianChart'); ?>
<?= $this->include('leader/chartsetup/PengabdianChart'); ?>

<script>
    $(function() {
        $(".filter__btn-chart").click(function() {
            // remove classes from all
            $(".filter__btn-chart").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
            // stop the page from jumping to the top
            return false;
        });
    });

    $(function() {
        $(".filter__btn-indikator").click(function() {
            // remove classes from all
            $(".filter__btn-indikator").removeClass("active");
            // add class to the one we clicked
            $(this).addClass("active");
            // stop the page from jumping to the top
            return false;
        });
    });

    // tooltips
    // progress bar unit
    const tooltipsUnitProgress =
        document.querySelectorAll(".unit__progressbar");
    tooltipsUnitProgress.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    // show and hide indikator chart
    $(document).ready(function() {
        $('#filterStandarPenelitian').change(function() {
            $('.PENIndikator').hide();
            $('#PEN' + $(this).val() + 'Indikator').show();
        });

        $('#filterStandarPengabdian').change(function() {
            $('.PPMIndikator').hide();
            $('#PPM' + $(this).val() + 'Indikator').show();
        });
    });

    // toast on load
    window.onload = function() {
        $('.toast').toast('show');
    };

    // get year now
    var currentYear = new Date().getFullYear();
    $("#year__now").text(currentYear);
</script>

<?= $this->endSection();
