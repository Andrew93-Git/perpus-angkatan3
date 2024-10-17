<?php
session_start();
//empty(kosong
if (empty($_SESSION['NAMA'])) {
    header("location:login.php?access=failed");

    include 'koneksi.php';
    include 'function/helper.php';
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="row">
        <div class="col-md">
            <!-- navbar -->
            <div class="menu border-bottom border-black">
                <nav class="navbar navbar-expand-lg shadow-lg navbar-light">
                    <div class="container-fluid">
                        <div class="logo">
                            <a class=" navbar-brand fs-3 text-dark" href="#">PerpusPPKD</a>
                            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                        </div>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active text-dark" aria-current="page"
                                        href="views/dashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="views/manage-account.php">Manage Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active text-dark" href="views/manage-books.php">Manage Books</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- end of navbar -->

            <!-- hero section -->
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/p1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block mb-5">
                            <div class="title mb-5">
                                <h1 class="fs-1">Discover the World of Knowledge at Our Library</h1>
                            </div>
                            <div class="button mb-5">
                                <button class="btn btn-primary"><a href="views/login.php"
                                        class="text-decoration-none text-light">Click To See More</a></button>
                            </div>
                            <img src="img/poto.jfif" class="rounded-circle mb-3" alt="">
                            <h5 class="fs-2">SELAMAT DATANG</h5>
                            <p class="fs-3">PERPUSTAKAAN PPKD JAKARTA PUSAT</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/p2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block mb-5">
                            <div class="title mb-5">
                                <h1 class="fs-1 text-dark">Discover the World of Knowledge at Our Library</h1>
                            </div>
                            <div class="button mb-5">
                                <button class="btn btn-primary">Click To See More</button>
                            </div>
                            <img src="img/poto.jfif" class="rounded-circle mb-3" alt="">
                            <h5 class="fs-2">SELAMAT DATANG</h5>
                            <p class="fs-3">PERPUSTAKAAN PPKD JAKARTA PUSAT</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/p3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block mb-5">
                            <div class="title mb-5">
                                <h1 class="fs-1">Discover the World of Knowledge at Our Library</h1>
                            </div>
                            <div class="button mb-5">
                                <button class="btn btn-primary">Click To See More</button>
                            </div>
                            <img src="img/poto.jfif" class="rounded-circle mb-3" alt="">
                            <h5 class="fs-2">SELAMAT DATANG</h5>
                            <p class="fs-3">PERPUSTAKAAN PPKD JAKARTA PUSAT</p>
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
            <!-- end of hero section -->

            <!-- footer -->
            <footer class="bg-white text-light d-flex justify-content-center aling-items-center pt-2">
                <p class="fs-5 text-dark">Copyright @ 2024 PPKD JAKARTA PUSAT</p>
            </footer>
            <!-- end of footer -->
        </div>
    </div>
    </div>



    <script src="bootstrap-5.3.3/dist//js//bootstrap.bundle.js"></script>

</body>

</html>