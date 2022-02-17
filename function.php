<?php

session_start();

$connectdb = mysqli_connect("localhost", "root", "", "stockbarang");

if (isset($_POST['newbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $inputtabel = mysqli_query($connectdb, "insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if ($inputtabel) {
        header('location:index.php');
    } else {
     echo "Gagal Menambah Data";
    }
}
