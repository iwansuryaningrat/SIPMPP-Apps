<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?>
    </title>

    <!-- meta data -->
    <meta name="title" content="SIPMPP UNDIP">
    <meta name="description" content="SIPMPP merupakan Sistem Informasi Penjaminan Mutu Penelitian dan Pengabdian Universitas Diponegoro.">
    <meta name="keywords" content="sipmpp, sipma, undip, penelitian, pengabdian, mutu">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="teamsipmppundip2019">
    <meta name="copyright" content="© 2022 teamsipmpppundip">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/solid.css" integrity="sha384-ltWlpN+Dl8XfKEnC9oW+dDRF8Z7jsYkxQ/WMRoJ2VHH5G2nQZ4if2NWwmV0ybzZ7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.0/css/fontawesome.css" integrity="sha384-RLM8Rxp/DcBfCfSI3bGwwoMMxxy34D2e58WAqXmmdnh0WYlAQ8jeOB3A1ed5KUSm" crossorigin="anonymous" />

    <!-- Font Icon -->
    <link rel="stylesheet" href="/register/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="/register/css/style.css">
    <link rel="stylesheet" href="/assets/css/styles-register.css">

    <!-- appletochicon -->
    <link rel="shortcut icon" href="/assets/img/icon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
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

    <div class="main main__register">

        <!-- Sign up form -->
        <section class="signup mb-0">
            <div class="container container__register">
                <div class="signup-content position-relative">
                    <div class="signup-form signup__form">
                        <h2 class="form-title">Generate New Administrator</h2>
                        <!-- Mengecek apakah ada flash data -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <!-- alert danger -->
                            <div class="alert alert-danger d-flex alert-dismissible" role="alert" style="padding-right: 2.5rem">
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="padding: 1.25rem"></button>
                                <i class="bi bi-exclamation-triangle-fill d-block pe-3" style="font-size: 1.25rem"></i>
                                <div>
                                    <!-- Menampilkan flashdata error -->
                                    <?= session()->getFlashdata('error'); ?>
                                </div>
                            </div>
                            <!-- end alert danger -->
                        <?php endif; ?>

                        <form method="POST" class="register-form" id="register-form" action="/auth/registerprocess">
                            <div class="form-group">
                                <label for="nama"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama" id="nama" placeholder="Nama" required />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <label for="superpass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="superpass" id="superpass" placeholder="Superadmin password" required />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit btn__dark" value="Generate" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image signup__image">
                        <figure><img src="/register/images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                    <div class="signup__caption">
                        <div class="logo__sipmpp__content">
                            <img src="/assets/img/undip-logo-color.png" alt="logo-sipmpp" />
                            <p>SIPMPP UNDIP</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <p>Sistem Informasi Penjaminan Mutu Penelitian dan Pengabdian Universitas Diponegoro</p>
            <div class="footer__caption">
                <p class="mb-0">
                    <span id="year__now"></span>, made with <i class="fa-solid fa-heart"></i> by
                    <span style="font-weight: 600">teamsipmppundip</span>
                </p>
            </div>
        </footer>
    </div>

    <!-- JS -->
    <script src="/register/vendor/jquery/jquery.min.js"></script>
    <script src="/register/js/main.js"></script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        // get year now
        var currentYear = new Date().getFullYear();
        $("#year__now").text(currentYear);
    </script>
</body>

</html>