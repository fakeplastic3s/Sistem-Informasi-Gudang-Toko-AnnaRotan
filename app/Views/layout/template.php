<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">

    <!-- unicon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- librari jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    @media print {
        @page {
            margin-top: 30px;
            margin: 10px;
        }

        .btn,
        #header,
        #sidebar,
        footer,
        header,
        aside,
        .fixed-top,
        form,
        .breadcrumb,
        .aksi,
        a {
            display: none;
            visibility: hidden;
        }
    }
</style>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url('Dashboard'); ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="mx-2">
                <span class="d-none d-lg-block" id=""></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- End Icons Navigation -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!-- <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>End Search Icon -->



                <li class="nav-item dropdown pe-4">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <i class="bi bi-person"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('user_name'); ?> </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= session()->get('user_name'); ?></h6>
                            <span><?= session()->get('user_email'); ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('Dashboard/profil/' . session()->get('user_id')); ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('Ganti_Akun'); ?>">
                                <i class="bi bi-person"></i>
                                <span>Change Account</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> -->

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/login/logout'); ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->


    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item ">

                <a class="nav-link collapsed" href="<?= base_url('Dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <?php if (session()->get('user_name') == 'Admin Gudang') { ?>

                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Pengadaan'); ?>">
                        <i class="bi bi-cart4"></i>
                        <span>Pengadaan</span>
                    </a>
                </li><!-- End Pengadaan Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('BarangMasuk'); ?>">
                        <i class="bi bi-box2"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li><!-- End Barang Masuk Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('BarangKeluar'); ?>">
                        <i class="bi bi-inbox"></i>
                        <span>Barang Keluar</span>
                    </a>
                </li><!-- End Barang Keluar Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('StokBarang'); ?>">
                        <i class="bi bi-box-seam"></i>
                        <span>Stok Barang</span>
                    </a>
                </li><!-- End Stok Barang Nav -->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Keuangan') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('AnggaranPengadaan'); ?>">
                        <i class="bi bi-cash-coin"></i>
                        <span>Anggaran Pengadaan</span>
                    </a>
                </li><!-- End Anggaran Pengadaan Nav -->
            <?php } ?>


            <?php if (session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Supplier'); ?>">
                        <i class="bi bi-boxes"></i>
                        <span>Data Supplier</span>
                    </a>
                </li><!-- End Supplier Nav -->
            <?php } ?>
            <?php if (session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('DataAkun'); ?>">
                        <i class="bi bi-people-fill"></i>
                        <span>Data Akun</span>
                    </a>
                </li><!-- End Akun Nav -->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin' or session()->get('user_name') == 'Admin Gudang') { ?>
                <li class="nav-heading">Report</li>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Pengadaan/laporan'); ?>">
                        <i class="bi bi-clipboard"></i>
                        <span>Laporan Pengadaan</span>
                    </a>
                </li> <!--end-->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('BarangMasuk/laporan'); ?>">
                        <i class="bi bi-clipboard"></i>
                        <span>Laporan Barang Masuk</span>
                    </a>
                </li> <!--end-->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('BarangKeluar/laporan'); ?>">
                        <i class="bi bi-clipboard"></i>
                        <span>Laporan Barang Keluar</span>
                    </a>
                </li> <!--end-->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('StokBarang/laporan'); ?>">
                        <i class="bi bi-clipboard"></i>
                        <span>Laporan Stok Barang</span>
                    </a>
                </li> <!--end-->
            <?php  } ?>



            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('Dashboard/profil/' . session()->get('user_id')); ?>">
                    <i class="bi bi-person"></i>
                    <span> Profile </span>
                </a>
            </li>
            <!-- End Profile Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="pages-faq.html">
                    <i class="bi bi-question-circle"></i>
                    <span>F.A.Q</span>
                </a>
            </li>
            End F.A.Q Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li> -->
            <!-- End Contact Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.html">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li> -->
            <!-- End Register Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('Ganti_Akun'); ?>">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <span>Change Account</span>
                </a>
            </li><!-- End Login Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('login/logout'); ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Logout Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="pages-error-404.html">
                    <i class="bi bi-dash-circle"></i>
                    <span>Error 404</span>
                </a>
            </li> -->
            <!-- End Error 404 Page Nav -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="pages-blank.html">
                    <i class="bi bi-file-earmark"></i>
                    <span>Blank</span>
                </a>
            </li> -->
            <!-- End Blank Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->
    <div class="content-wrapper">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?= $title; ?></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <?= $this->renderSection('content'); ?>
            <!-- content -->

        </main>
    </div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>fsolo</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assets/js/main.js"></script>

    <script>
        // Jam

        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var timeString = hours.toString().padStart(2, '0') + ':' +
                minutes.toString().padStart(2, '0') + ':' +
                seconds.toString().padStart(2, '0');

            document.getElementById('clock').textContent = timeString;
        }

        // Memperbarui waktu setiap 1 detik
        setInterval(updateClock, 1);
        // end Jam


        $(document).ready(function() {
            // Setelah 5 detik, panggil fungsi untuk menghapus div
            setTimeout(function() {
                $(".alert").fadeTo(500, 0, function() {
                    $(this).slideUp(500, function() {
                        $(this).remove();
                    });
                });
            }, 3000);
        });
    </script>

</body>

</html>