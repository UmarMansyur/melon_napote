<?php
@$page = $_GET['page'];
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
    default:
        include "./dashboard.php";
        break;
}
?>