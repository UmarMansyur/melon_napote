<?php
@$page = $_GET['page'];
switch ($getData['type']) {
    case 'kasir':
        switch ($page) {
            case 'dashboard':
                include "./dashboard.php";
                break;
            case 'tambah_jenis':
                include "./jenis/tambah.php";
                break;
            case 'data_jenis':
                include "./jenis/data_melon.php";
                break;
            case 'profile':
                include "./profile.php";
                break;
            case 'data_melon':
                include "./data_melon/data_melon.php";
                break;
            case 'tambah_melon':
                include "./data_melon/tambah.php";
                break;
            case 'transaksi':
                include "./transaksi/transaksi.php";
                break;
            case 'data_transaksi':
                include "./transaksi/daftar_transaksi.php";
                break;
            case 'detail_transaksi':
                include "./transaksi/detail_transaksi.php";
                break;
            default:
                include "./dashboard.php";
                break;
        }
        break;
    case 'owner':
        switch ($page) {
            case 'dashboard':
                include "./dashboard.php";
                break;
            case 'data_jenis':
                include "./jenis/data_melon.php";
                break;
            case 'profile':
                include "./akun/profile.php";
                break;
            case 'data_melon':
                include "./data_melon/data_melon.php";
                break;
            case 'transaksi':
                include "./transaksi/transaksi.php";
                break;
            case 'data_transaksi':
                include "./transaksi/daftar_transaksi.php";
                break;
            case 'detail_transaksi':
                include "./transaksi/detail_transaksi.php";
                break;
            case 'data_transaksi_bulanan':
                include "./transaksi/transaksi_bulanan.php";
                break;
            case 'grafik':
                include './chart/grafik.php';
                break;
            default:
                include "./dashboard.php";
                break;
        }
        break;
    case 'admin':
        switch ($page) {
            case 'dashboard':
                include "./dashboard.php";
                break;
            case 'tambah_jenis':
                include "./jenis/tambah.php";
                break;
            case 'data_jenis':
                include "./jenis/data_melon.php";
                break;
            case 'profile':
                include "./akun/profile.php";
                break;
            case 'data_melon':
                include "./data_melon/data_melon.php";
                break;
            case 'tambah_melon':
                include "./data_melon/tambah.php";
                break;
            case 'transaksi':
                include "./transaksi/transaksi.php";
                break;
            case 'data_transaksi':
                include "./transaksi/daftar_transaksi.php";
                break;
            case 'detail_transaksi':
                include "./transaksi/detail_transaksi.php";
                break;
            case 'data_transaksi_bulanan':
                include "./transaksi/transaksi_bulanan.php";
                break;
            case 'grafik':
                include './chart/grafik.php';
                break;
            default:
                include "./dashboard.php";
                break;
        }
        break;
    default:
        # code...
        break;
}
