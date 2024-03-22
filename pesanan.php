<?php
include "./core/libcore_backend.php";
$core = new Libcore();
$core->connect();
$core->isUserLogin();
$x = $core->getUser($_COOKIE["user"]);
$data = $core->getTicket($x["user_id"]);

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
                        <a class="nav-link" aria-current="page" href="index.php">Form Pemesanan</a>
                    </li>
                    <li class="nav-item w-75">
                        <a class="nav-link active" aria-current="page" href="pesanan.php">Tiket Saya</a>
                    </li>


                    <li class="nav-item dropdown" style="margin-left: 3%;">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $x["nama"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="admin/login.php">Login Adminf</a></li>
                            <li><a class="dropdown-item" href="petugas/login.php">Login Staff</a></li>

                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container mt-5 ">
    <h4 class="text-muted">User Area > Ticket Status</h4>

        <table class="table table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th>Maskapai</th>
                    <th>Tujuan</th>
                    <th>Sektor</th>
                    <th>Tanggal Penerbangan</th>
                    <th>Jam Kedatangan</th>
                    <th>Jam Keberangkatan</th>
                    <th>Jam Tiba</th>
                    <th>Kode PNR</th>
                    <th>Harga</th>
                    <th>Konfirmasi</th>


                </tr>
            </thead>
            <tbody>
                <tr>

                    <?php
                    foreach ($data as $f) :
                    ?>
                        <td><?= $f["maskapai"] ?></td>
                        <td><?= $f["bandara_asal"] ?> - <?= $f["tujuan_akhir"] ?> </td>
                        <td><?= $f["sektor"] ?></td>
                        <td><?= $f["tanggal_penerbangan"] ?></td>
                        <td><?= $f["jam_kedatangan"] ?></td>
                        <td><?= $f["jam_berangkat"] ?></td>
                        <td><?= $f["jam_tiba"] ?></td>
                        <td><?= $f["kode_pnr"]; ?></td>
                        <td><?= $f["harga"] ?></td>
                        <td><?= $f["konfirmasi"] == 0 ? "<small class='text-danger'>belum</small>" : "<a class='btn btn-sm btn-success'>Cetak tiket</a>"; ?></td>



                </tr>
            <?php
                    endforeach;
            ?>
            </tbody>
        </table>
    </div>
    <script src="./styles/bootstrap.bundle.min.js"></script>

</body>

</html>