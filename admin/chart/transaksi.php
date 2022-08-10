<?php


class Transaksi
{
    protected $connection;
    public function __construct()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'melon_napote';
        $this->connection = new mysqli($hostname, $username, $password, $database);
    }
    public function statistik()
    {
        $data = mysqli_fetch_assoc($this->connection->query("SELECT MONTH(created_at) as bulan, COUNT(*) as banyak FROM tb_transaksi GROUP BY bulan"));
        return json_encode($data);
    }
}

$statistik = new Transaksi();
echo $statistik->statistik();
