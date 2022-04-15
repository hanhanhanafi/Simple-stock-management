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

// Barang Masuk

if (isset($_POST['barangmasuk'])) {
    $idba = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['qty'];

    $cekstock = mysqli_query($connectdb, "select * from stock where idbarang='$idba'");
    $getdata = mysqli_fetch_array($cekstock);

    $stockbarang = $getdata['stock'];
    $plusstockdanqty = $stockbarang + $quantity;

$inputbm = mysqli_query($connectdb, "insert into masuk (idbarang, keterangan, quantity) values ('$idba', '$penerima', '$quantity')");
$updatedatastock = mysqli_query($connectdb, "update stock set stock='$plusstockdanqty' where idbarang='$idba'"); 
if ($inputbm&&$updatedatastock) {
    header('location:index.php');
} else {
    echo "Gagal Tambah Barang";
    header('location:index.php');
}

}

// Barang Keluar

if (isset($_POST['barangkeluar'])) {
    $idba = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $quantity = $_POST['qty'];

    $cekstock = mysqli_query($connectdb, "select * from stock where idbarang='$idba'");
    $getdata = mysqli_fetch_array($cekstock);

    $stockbarang = $getdata['stock'];
    $plusstockdanqty = $stockbarang - $quantity;

$inputbk = mysqli_query($connectdb, "insert into keluar (idbarang, penerima, quantity) values ('$idba', '$penerima', '$quantity')");
$updatedatastock = mysqli_query($connectdb, "update stock set stock='$plusstockdanqty' where idbarang='$idba'"); 
if ($inputbk&&$updatedatastock) {
    header('location:keluar.php');
} else {
    echo "Gagal";
    header('location:keluar.php');
}

}


?>
