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

// edit barang

if (isset($_POST['editbarang'])) {
    $idbarang = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

$edit = mysqli_query($connectdb, "UPDATE stock SET namabarang='$namabarang', deskripsi='$deskripsi', stock='$stock' WHERE idbarang='$idbarang'");
if ($edit) {
    header('location:index.php');
} else {
 echo "Gagal Menambah Data";
}
}

// Hapus Barang

if (isset($_POST['hapusbarang'])) {
    $idbarang = $_POST['idbarang'];

    $hapus = mysqli_query($connectdb, "DELETE FROM stock WHERE idbarang='$idbarang'")or die(mysqli_error());
    if ($hapus) {
        header('location:index.php');
    } else {
     echo "Gagal Menghapus Data";
    }
}

?>
