<!DOCTYPE html>
<html lang="en" class="nav__open">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title; ?>
    </title>

    <!-- meta data -->
    <meta name="title" content="SIPMPP UNDIP">
    <meta name="description"
        content="SIPMPP merupakan Sistem Informasi Penjaminan Mutu Penelitian dan Pengabdian Universitas Diponegoro.">
    <meta name="keywords" content="sipmpp, sipma, undip, penelitian, pengabdian, mutu">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="teamsipmppundip2019">
    <meta name="copyright" content="© 2022 teamsipmpppundip">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/solid.css"
        integrity="sha384-ltWlpN+Dl8XfKEnC9oW+dDRF8Z7jsYkxQ/WMRoJ2VHH5G2nQZ4if2NWwmV0ybzZ7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/fontawesome.css"
        integrity="sha384-RLM8Rxp/DcBfCfSI3bGwwoMMxxy34D2e58WAqXmmdnh0WYlAQ8jeOB3A1ed5KUSm" crossorigin="anonymous" />
    <!-- uicons icon -->
    <link rel="stylesheet" href="/auditor/vendor/uicons-bold-rounded/css/uicons-bold-rounded.css" />

    <!-- Custom Page Style -->
    <link rel="stylesheet" href="/auditor/css/<?= $css; ?>" />
    <?= $cssCustom; ?>

    <!-- appletochicon -->
    <link rel="shortcut icon" href="/assets/img/icon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/assets/img/icon/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/icon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/icon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/icon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/icon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/icon/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icon/apple-touch-icon-180x180.png" />
</head>

<body>
    <div class="wrapper__sipmpp">
        <!-- sidebar -->
        <?= $this->include('template/auditor/sidebar'); ?>

        <!-- main -->
        <div class="main__content" id="main-content">
            <!-- header main -->
            <div class="header__main-color <?= $header; ?>"></div>
            <div class="container-fluid container__fluid">

                <?= $this->include('template/auditor/profile'); ?>

                <?= $this->renderSection('auditor'); ?>

            </div>

            <!-- footer -->
            <?= $this->include('template/footer'); ?>
        </div>
    </div>

    <!-- Toast Welcome -->
    <div class="toast-container position-fixed bottom-0 end-0 p-4 animate__animated animate__slow animate__fadeInDown">
        <div class="toast toast__welcome" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true"
            data-bs-delay="5000">
            <div class="row">
                <div class="toast__left col-2 px-0 d-flex align-items-center justify-content-center">
                    <img src="/admin/assets/img/undip-logo-color.png" class="toast__welcome-img" alt="logo-undip">
                </div>
                <div class="toast__right col-10">
                    <div class="toast-header border-0 px-0">
                        <strong class="me-auto">SIPMPP UNDIP <span id="year__now"></span></strong>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body pt-0 ps-0 pe-3 pb-2">
                        Selamat Datang di Dashboard Auditor <span><?= $data_user['unit']; ?></span>
                        SIPMPP
                        UNDIP
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('modal'); ?>

    <!-- scripts -->
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
        integrity="sha384-vLLEq/Un/eZFmXAu4Xxf8F00RSSMzPcI7iDiT6hpB4zFpezCEGhb5daeR8PLyrLI" crossorigin="anonymous">
    </script>
    <!-- custom -->
    <script src="/auditor/js/scripts.js"></script>

    <?= $this->include('template/auditor/script'); ?>

    <?= $this->renderSection('script'); ?>

</body>

</html>