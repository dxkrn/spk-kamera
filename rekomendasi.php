<?php
session_start();
include('koneksi.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>SPK Kamera</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.css" media="screen,projection" />
    <link rel="stylesheet" href="assets/css/table.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="apple-touch-icon" sizes="76x76" href="assets/image/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/image/favicon.png">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Import jQuery before materialize.js-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
    <div class="navbar-fixed">
        <nav>
            <div class="container">

                <div class="nav-wrapper">

                    <ul class="left" style="margin-left: -52px;">
                        <li><a href="home.php">HOME</a></li>
                        <?php
                        if ($_SESSION['role'] == "admin") {
                            echo '<li><a href="daftar_kamera.php">DAFTAR KAMERA</a></li>';
                        }
                        ?>
                        <li><a class="active" href="rekomendasi.php">REKOMENDASI</a></li>
                        <li><a href="metode_fuzzy.php">FUZZY</a></li>
                        <li><a href="#about">TENTANG</a></li>
                        <li><a href="logout.php">KELUAR</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    <!-- Body Start -->

    <!-- Daftar Laptop Start -->
    <div style="background-color: #F7F4FF">
        <div class="container">
            <div class="section-card" style="padding: 32px 0px 20px 0px">
                <ul>
                    <li>
                        <div class="row">
                            <div class="col s3">
                            </div>
                            <div class="col s6">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="row">
                                            <center>
                                                <h4>Masukan Bobot</h4>
                                            </center>
                                            <br>
                                            <form class="col s12" method="POST" action="hasil.php">
                                                <div class="row">
                                                    <div class="col s12">

                                                        <div class="col s6" style="margin-top: 10px;">
                                                            <b>Kriteria Harga</b>
                                                        </div>
                                                        <div class="col s6">
                                                            <select required name="harga">
                                                                <option value="" disabled selected style="color: #eceff1;"><i>Kriteria Harga</i></option>
                                                                <option value="5">Rp. 1.000.000 ke bawah</option>

                                                                <option value="4">1.000.000 - 3.000.000</option>
                                                                <option value="3">3.000.000 - 4.000.000</option>
                                                                <option value="2">4.000.000 - 5.000.000</option>
                                                                <option value="1">5.000.000 ke atas</option>
                                                            </select>
                                                        </div>

                                                        <div class="col s6" style="margin-top: 10px;">
                                                            <b>Resolusi Gambar</b>
                                                        </div>
                                                        <div class="col s6">
                                                            <select required name="res_gambar">
                                                                <option value="" disabled selected>Kriteria Resolusi Gambar</option>
                                                                <option value="1">12 MP</option>
                                                                <option value="2">16 MP</option>
                                                                <option value="3">18 MP</option>
                                                                <option value="4">20 MP</option>
                                                                <option value="5">24 MP</option>
                                                            </select>
                                                        </div>

                                                        <div class="col s6" style="margin-top: 10px;">
                                                            <b>Resolusi Video</b>
                                                        </div>
                                                        <div class="col s6">
                                                            <select required name="res_video">
                                                                <option value="" disabled selected>Kriteria Resolusi Video</option>
                                                                <option value="1">HD</option>
                                                                <option value="2">FHD</option>
                                                                <option value="3">2K</option>
                                                                <option value="4">4K</option>
                                                                <option value="5">8K</option>
                                                            </select>
                                                        </div>

                                                        <div class="col s6" style="margin-top: 10px;">
                                                            <b>ISO Max</b>
                                                        </div>
                                                        <div class="col s6">
                                                            <select required name="iso_max">
                                                                <option value="" disabled selected>Kriteria ISO Max</option>
                                                                <option value="1">3200</option>
                                                                <option value="2">6400</option>
                                                                <option value="3">12800</option>
                                                                <option value="4">25600</option>
                                                                <option value="5">51200</option>
                                                            </select>
                                                        </div>

                                                        <div class="col s6" style="margin-top: 10px;">
                                                            <b>Shutter Speed</b>
                                                        </div>
                                                        <div class="col s6">
                                                            <select required name="shutter_max">
                                                                <option value="" disabled selected>Kriteria Shutter Speed</option>
                                                                <option value="1">1/2000s</option>
                                                                <option value="3">1/4000s</option>
                                                                <option value="5">1/8000s</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <center><button type="submit" class="waves-effect waves-light btn" style="margin-bottom:-46px;">Hitung</button></center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s3">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Rekomendasi Laptop End -->

    <!-- Modal Start -->
    <div id="about" class="modal">
        <div class="modal-content">
            <h4>Tentang</h4>
            <p>Sistem Pendukung Keputusan Pemilihan Kamera ini menggunakan metode TOPSIS dan Fuzzy Tahani.
                Sistem ini dibuat sebagai Tugas Akhir Mata Kuliah Sistem Pendukung Keputusan Prodi Pendidikan Teknik Informatika Universitas Negeri Yogyakarta. <br>
                <br>
                Dicky Khurniawan <a href="https://github.com/dxkrnn/"> (Github)</a><br>
            </p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Body End -->

    <!-- Footer Start -->
    <div class="footer-copyright" style="padding: 0px 0px; background-color: white">
        <div class="container">
            <p align="center" style="color: #999">Dicky Khurniawan &copy;2023</p>
        </div>
    </div>
    <!-- Footer End -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.parallax').parallax();
            $('select').material_select();
            $('.modal').modal();
        });
    </script>
</body>

</html>