<?php
require "function.php";
require "cek.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Manajemen Barang</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                                Barang Keluar
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 mb-4">Dashboard Barang Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Tambah Barang
                            </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</ths>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php  
                                            $query = mysqli_query($connectdb, "SELECT * FROM stock");
                                            $no = 1;
                                            while ($data = mysqli_fetch_array($query)) {
                                                $namabarang = $data["namabarang"]; 
                                                $deskripsi = $data["deskripsi"]; 
                                                $stock = $data["stock"];
                                                $idbarang = $data["idbarang"];
                                                ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $namabarang; ?> </td>
                                                    <td><?= $deskripsi; ?> </td>
                                                    <td><?= $stock; ?> </td>
                                                    <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?=$idbarang;?>"> Edit </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$idbarang;?>"> Hapus </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal Edit Barang -->
                                                <div class="modal fade" id="edit<?=$idbarang;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Barang</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control mb-3">
                                                    <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control mb-3">
                                                    <input type="number" name="stock" value="<?= $stock; ?>" class="form-control mb-3">
                                                    <input type="hidden" name="idbarang" value="<?= $idbarang; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                                        <button type="submit" name="editbarang" class="btn btn-primary">Edit</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- Akhir Modal Edit Barang -->
                                                <!-- Modal Hapus Barang -->
                                                <div class="modal fade" id="hapus<?=$idbarang;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Barang</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post">
                                                    <div class="modal-body">
                                                        <p class="" >Yakin ingin menghapus <b> <?= $namabarang; ?> ? </b></p>
                                                        <input type="hidden" name="idbarang" value="<?= $idbarang; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                                        <button type="submit" name="hapusbarang" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                                <!-- Akhir Modal Hapus Barang -->
                                                <?php }; ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <form method="post">
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <select name="barangnya" id="barangnya" class="form-control mb-3">
                           <?php 
                           $ambildata = mysqli_query($connectdb, "select * from stock");
                           while($fetcharray = mysqli_fetch_array($ambildata)) {
                            $idb = $fetcharray['idbarang'];
                            $namab = $fetcharray['namabarang'];
                            ?>

                            <option value="<?= $idb?>" class="form-control mb-3"><?= $namab ?> </option>

                           <?php 
                           }
                           ?>
                       </select>
                       <input type="text" name="penerima" placeholder="Penerima" class="form-control mb-3">
                       <input type="number" name="qty" placeholder="Quantity" class="form-control mb-3">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="barangmasuk" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </div>
                </div>
                </form>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
