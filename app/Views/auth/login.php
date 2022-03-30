<!DOCTYPE html>
<html lang="en">

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
    <!-- custom -->
    <link rel="stylesheet" href="/assets/css/styles-login.css" />

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
    <div class="container__login">
        <div class="login__content">
            <!-- left -->
            <div class="login__content-left">
                <div class="content-left__bg">
                    <div id="carouselExampleCaptions" class="carousel slide content-left__carousel"
                        data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner carousel__inner">
                            <div class="carousel-item active carousel__item">
                                <img src="..." class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item carousel__item">
                                <img src="..." class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item carousel__item">
                                <img src="..." class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>

            <!-- right -->
            <div class="login__content-right">
                <div class="login__content-right__body">
                    <h2 class="login__title">Login</h2>
                    <p class="login__desc mb-4">
                        Selamat datang kembali! Silahkan masukkan detail Anda dibawah ini.
                    </p>

                    <!-- Mengecek apakah ada flash data -->
                    <?php if (session()->getFlashdata('gagal')) : ?>
                    <!-- alert danger -->
                    <div class="alert alert-danger d-flex alert-dismissible" role="alert" style="padding-right: 2.5rem">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="padding: 1.25rem"></button>
                        <i class="bi bi-exclamation-triangle-fill d-block pe-3" style="font-size: 1.25rem"></i>
                        <div>
                            <!-- Menampilkan flashdata gagal -->
                            <?= session()->getFlashdata('gagal'); ?>
                        </div>
                    </div>
                    <!-- end alert danger -->
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')) : ?>
                    <!-- alert success -->
                    <div class="alert alert-success d-flex alert-dismissible" role="alert"
                        style="padding-right: 2.5rem">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="padding: 1.25rem"></button>
                        <i class="bi bi-check-circle-fill d-block pe-3" style="font-size: 1.25rem"></i>
                        <div>
                            <!-- Menampilkan flashdata success -->
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    </div>
                    <!-- end alert success -->
                    <?php endif; ?>


                    <form class="form__login" method="POST" action="/auth/formloginunit">
                        <div class="mb-4 position-relative">
                            <label for="email" class="form-label form__label">Email</label>
                            <input type="email" class="form-control form__control shadow-none" name="email" id="email"
                                placeholder="Masukkan Email" required autocomplete="off" />
                            <i class="fa-solid fa-at icon__form"></i>
                        </div>
                        <div class="mb-5 position-relative">
                            <label for="password" class="form-label form__label">Password</label>
                            <input type="password" class="form-control form__control shadow-none" name="password"
                                id="password" placeholder="Masukkan password" required />
                            <i class="fa-solid fa-lock icon__form"></i>
                        </div>
                        <button type="submit" class="btn login__btn shadow-none">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(function() {
            $("input").focus(function(event) {
                $("svg").css("color", "rgba(79, 79, 79, 0.6)");
                $(event.target).next(".icon__form").css("color", "#1a42b8");
            });
        });
    </script>
</body>

</html>