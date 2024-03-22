<?php
include "./core/libcore_backend.php";
$core = new Libcore();
$core->connect();
$core->isUserLogin();
$data = $core->getFlightList();
$x = $core->getUser($_COOKIE["user"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TICKET - RESERVASI PESAWAT</title>
    <link href="./styles/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/styles.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(60,160, 60,0.8);">
        <div class="container-fluid ps-5">
            <a class="navbar-brand" href="#">E-TICKET</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 ms-auto" style="float: right;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Form Pemesanan</a>
                    </li>
                    <li class="nav-item w-75">
                        <a class="nav-link" aria-current="page" href="pesanan.php">Tiket Saya</a>
                    </li>
                   
                   
                    <li class="nav-item dropdown" style="margin-left: 3%;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $x["nama"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="admin/login.php">Login Admin</a></li>
                            <li><a class="dropdown-item" href="petugas/login.php">Login Staff</a></li>

                          
                        </ul>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <div class="container mt-5 d-flex">
        <?php foreach ($data as $flight) : ?>
            <div class="col-md-3 mb-4 h-50 m-1">
                <div class="card" style="height: 550px;">
                    <div class="card-body">
                        <img src="./public/foto/<?= $flight['foto']; ?>" class="card-img-top" alt="..." height="250">
                        <h5 class="card-title mb-0"><?= $flight['maskapai'] ?> #<?= $flight['flight_id'] ?></h5>
                        <p class="text-muted mb-3 h6"><?= $flight['bandara_asal'] ?> - <?= $flight['tujuan_akhir'] ?></p>
                        Jam Penerbangan: <?= $flight['tanggal_penerbangan'] ?><br>
                            Quota: <?= $flight['kuota'] ?><br>
                            <!-- Add other data fields as needed -->
                            
                            <!-- Example: -->
                            Sektor: <?= $flight['sektor'] ?><br>
                            Waktu Kedatangan: <?= $flight['jam_kedatangan'] ?>
                        </p>
                        <!-- Add more fields as needed -->
                        <form method="post" action="booking.php">
                            <input name="id" value="<?= $flight['flight_id'] ?>" type="hidden">
                            <hr>
                            <small class="text-muted">harga: Rp<?= $flight['harga'] ?></small>
                            <button class="btn btn-success w-100">Pesan Tiket</a>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="./styles/bootstrap.bundle.min.js"></script>

</body>

</html>