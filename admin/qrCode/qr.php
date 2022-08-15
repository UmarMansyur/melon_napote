<?php
include '../../config/connection.php';
if(empty($_GET['qr'])) {
    echo "<script>window.location.href='../index.php?page=dashboard'</script>";
} else {
    $data = mysqli_fetch_assoc($connection->query("SELECT * FROM tb_melon WHERE id_melon = '$_GET[qr]'"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= $data['id_melon']  ?>&choe=UTF-8" alt="">
    <script>
       window.onload = function() { window.print(); }

    </script>
</body>
</html>