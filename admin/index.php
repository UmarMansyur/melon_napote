<?php
session_start();
include "../config/connection.php";
if (empty($_SESSION['id'])) {
    header('location: ../auth/login.php');
} else {
    $getData = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_pengguna WHERE id_pengguna = '$_SESSION[id]'"));
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Kampong Melon | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Melon Napote, Universitas Madura" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Data Table -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div id="layout-wrapper">
        <header id="page-topbar" class="bg-warning">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/" alt="" height="17">
                                <a href="" class="fw-semibold pt-2 text-white font-size-24" id="text-logo"></a>
                            </span>
                        </a>
                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/l" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/" alt="" height="19">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars text-white"></i>
                    </button>
                </div>
                <div class="d-flex">
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-7.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1 text-white" key="t-henry"><?= $getData['username'] ?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block text-white"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="?page=profile"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="./logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu bg-success">
            <div data-simplebar class="h-100">
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <div id="profile" class="text-center mt-4 mb-5">
                        <img class="rounded-circle header shadow" width="140px" src="assets/images/users/avatar-7.jpg" style="border: 3px solid white;">
                        <h4 class="font-size-20 mt-2 text-white"><?= $getData['username'] ?></h4>
                    </div>
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title text-white" key="t-menu">Main</li>

                        <li>
                            <a href="?page=dashboard" class="waves-effect">
                                <i class="bx bx-home-circle text-white"></i>
                                <span key="t-dashboards" class="text-white">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-title text-white" key="t-menu">Toko</li>
                        <?php if ($getData['type'] == 'kasir') : ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect text-white">
                                    <i class="bx bx-git-merge text-white"></i>
                                    <span class="text-white">Jenis Melon</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="index.php?page=tambah_jenis" class="text-white">Tambah Jenis</a></li>
                                    <li><a href="index.php?page=data_jenis" class="text-white">Daftar Jenis Melon</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect text-white">
                                    <i class="bx bx-bowling-ball text-white"></i>
                                    <span class="text-white">Data Melon</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="index.php?page=tambah_melon" class="text-white">Tambah Melon</a></li>
                                    <li><a href="index.php?page=data_melon" class="text-white">Daftar Melon</a></li>
                                </ul>
                            </li>
                        <?php endif ?>
                        <?php if ($getData['type'] == 'owner') : ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect text-white">
                                    <i class="bx bx-store-alt text-white"></i>
                                    <span class="text-white">Produk</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="index.php?page=data_jenis" class="text-white">Data Jenis Melon</a></li>
                                    <li><a href="index.php?page=data_melon" class="text-white">Data Melon</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect text-white">
                                    <i class="bx bxs-report text-white"></i>
                                    <span class="text-white">Laporan Penjualan</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="index.php?page=data_transaksi" class="text-white">Data Transaksi</a></li>
                                    <li><a href="index.php?page=grafik" class="text-white">Grafik Penjualan</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="?page=pembelian" class="waves-effect">
                                    <i class="bx bxs-cart-alt text-white"></i>
                                    <span key="t-dashboards" class="text-white">Data Melon</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="?page=penjualan" class="waves-effect">
                                    <i class="bx bxs-archive text-white"></i>
                                    <span key="bx bxs-archive" class="text-white">Penjualan</span>
                                </a>
                            </li> -->
                        <?php endif ?>
                        <?php if ($getData['type'] != 'owner') : ?>
                        <li class="menu-title text-white" key="t-menu">Pasar</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect text-white">
                                <i class="bx bxs-cart-alt text-white"></i>
                                <span class="text-white">Transaksi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="?page=transaksi" class="text-white">Tambah Transaksi</a></li>
                                <li><a href="?page=data_transaksi" class="text-white">Daftar Transaksi</a></li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <!-- <li>
                            <a href="?page=transaksi" class="waves-effect">
                                <i class="bx bxs-cart-alt text-white"></i>
                                <span key="t-dashboards" class="text-white">Data Transaksi</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <?php include './slot.php'; ?>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <!-- end modal -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Kampong Melon. ProJs Universitas Madura
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Zainal Fatah
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- dashboard init -->
    <script src="assets/js/pages/apexcharts.init.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- <script src="assets/js/pages/echarts.init.js"></script>
    <script src="assets/libs/echarts/echarts.min.js"></script> -->
    <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

    <script>
        $("#dataTable").DataTable({
            "language": {
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ data",
                "sZeroRecords": "Data Tidak Ada",
                "sInfo": "_START_ - _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Data Kosong",
                "sInfoFiltered": "(_MAX_ data keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari :",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            },
            "lengthMenu": [
                [5, 10, 25, 50],
                [5, 10, 25, 50]
            ],

        });
    </script>

</body>

</html>