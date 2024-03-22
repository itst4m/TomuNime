<?php
include "./../core/libcore_backend.php";
$core = new Libcore();
$core->connect();
$core->isAdminLogin();
if(isset($_GET["del"])){
    if($core->deleteFlight($_GET["del"])) echo "<script>alert('Data telah dihapus')</script>";
}
$data = $core->getFlightList();
$x = $core->getUser($_COOKIE["user"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TICKET - RESERVASI PESAWAT</title>
    <link href="./../styles/bootstrap.min.css" rel="stylesheet">
    <link href="./../styles/styles.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(0,0, 0,0.8);">
        <div class="container-fluid ps-5">
            <a class="navbar-brand" href="#">E-TICKET<small><i>staff</i></small></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 ms-auto" style="float: right;">
                   
                    <li class="nav-item" >
                        <a class="nav-link active" aria-current="page" href="data_penerbangan.php">Data</a>
                    </li>
                    <li class="nav-item" style="width: 85%;">
                        <a class="nav-link" aria-current="page" href="tambah_penerbangan.php">Tambah Penerbangan</a>
                    </li>


                    <li class="nav-item dropdown" style="margin-left: 3%;">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $x["nama"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./../logout.php">Logout</a></li>
                            <li><a class="dropdown-item" href="./../admin/login.php">Login to Admin</a></li>
                            <li><a class="dropdown-item" href="./../petugas/login.php">Login to Staff</a></li>

                        </ul>
                    </li>
                </ul>

            </div>
        </div></nav>
    <div class="container mt-5">
        <h2>Flight Data</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Maskapai</th>
                    <th>Tanggal Penerbangan</th>
                    <th>Kuota</th>
                    <th>Bandara Asal</th>
                    <th>Jam Kedatangan</th>
                    <th>Tujuan Akhir</th>
                    <th>Sektor</th>
                    <th>Harga</th>
                    <th>Jam Berangkat</th>
                    <th>Jam Tiba</th>
                    <th>Image</th>

                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $flight) : ?>
                    <tr>
                        <td><?= strval($flight['maskapai']); ?></td>
                        <td><?= strval( $flight['tanggal_penerbangan']); ?></td>
                        <td><?= strval( $flight['kuota']); ?></td>
                        <td><?= $flight['bandara_asal']; ?></td>
                        <td><?= $flight['jam_kedatangan']; ?></td>
                        <td><?= $flight['tujuan_akhir']; ?></td>
                        <td><?= $flight['sektor']; ?></td>
                        <td><?= $flight['harga']; ?></td>
                        <td><?= $flight['jam_berangkat']; ?></td>
                        <td><?= $flight['jam_tiba']; ?></td>
                        <td><img src="./../public/foto/<?= $flight['foto']; ?>" width="100" height="100"> </td>

                        <td><a class="btn btn-success btn-sm m-1" href="edit_penerbangan.php?id=<?= $flight['flight_id']; ?>">Edit</a><a class="btn btn-danger btn-sm m-1" href="?del=<?= $flight['flight_id'] ?>">Hapus</a></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="./../styles/bootstrap.bundle.min.js"></script>

    </div>
</body>

</html>