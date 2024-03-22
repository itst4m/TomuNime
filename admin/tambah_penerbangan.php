<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "./../core/libcore_backend.php";
$core = new Libcore();
$core->connect();
$core->isAdminLogin();
$msg = "";
$x = $core->getUser($_COOKIE["user"]);
if (isset($_POST["maskapai"])) {
    if ($core->insertFlight($_POST, $_FILES["foto"]))

        $msg = '<div class="alert alert-success p-2"><small>Data penerbangan telah dibuat </small></div>';
    else
        $msg = '<div class="alert alert-success p-2"><small>Data penerbangan gagal dibuat </small></div>';
}
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

                <li class="nav-item"">
                        <a class="nav-link" aria-current="page" href="data_penerbangan.php">Data</a>
                    </li>
                    <li class="nav-item" style="width: 85%;">
                        <a class="nav-link active" aria-current="page" href="tambah_penerbangan.php">Tambah Penerbangan</a>
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
        </div>
    </nav>
        <div class="container mt-3">
            <h3 class="text-muted">Admin area > Tambah Penerbangan</h3>

            <div class="container p-3" style="border: 2px solid #eee;border-radius: 10px">
                <?= $msg ?>
                <form method="post" action="tambah_penerbangan.php" enctype="multipart/form-data">

                    <!-- Dropdown for Maskapai -->
                    <div class="mb-3">
                        <label for="maskapai" class="form-label">Maskapai</label>
                        <select class="form-select" id="maskapai" name="maskapai" required>
                            <option value="ryan_air">Ryan Air</option>
                            <option value="batik_air">Batik Air</option>
                            <option value="easyjet">EasyJet</option>
                        </select>
                    </div>

                    <!-- Date input for Tanggal Penerbangan -->
                    <div class="mb-3">
                        <label for="tanggal_penerbangan" class="form-label">Tanggal Penerbangan</label>
                        <input type="date" class="form-control" id="tanggal_penerbangan" name="tanggal_penerbangan" required>
                    </div>

                    <!-- Number input for Kuota -->
                    <div class="mb-3">
                        <label for="kuota" class="form-label">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="kuota" required>
                    </div>

                    <!-- Time input for Jam Kedatangan -->
                    <div class="mb-3">
                        <label for="jam_kedatangan" class="form-label">Jam Kedatangan</label>
                        <input type="time" class="form-control" id="jam_kedatangan" name="jam_kedatangan" required>
                    </div>
                    <!-- Text input for bandara asal -->

                    <div class="mb-3">
                        <label for="tujuan_akhir" class="form-label">Bandara Asal</label>
                        <input type="text" class="form-control" id="bandara_asal" name="bandara_asal" required>
                    </div>

                    <!-- Text input for Tujuan Akhir -->
                    <div class="mb-3">
                        <label for="tujuan_akhir" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan_akhir" name="tujuan_akhir" required>
                    </div>

                    <!-- Text input for Sektor -->
                    <div class="mb-3">
                        <label for="sektor" class="form-label">Sektor</label>
                        <input type="text" class="form-control" id="sektor" name="sektor" required>
                    </div>

                    <!-- Number input for Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <!-- Time input for Jam Berangkat -->
                    <div class="mb-3">
                        <label for="jam_berangkat" class="form-label">Jam Berangkat</label>
                        <input type="time" class="form-control" id="jam_berangkat" name="jam_berangkat" required>
                    </div>

                    <!-- Time input for Jam Tiba -->
                    <div class="mb-3">
                        <label for="jam_tiba" class="form-label">Jam Tiba</label>
                        <input type="time" class="form-control" id="jam_tiba" name="jam_tiba" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_tiba" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
        <script src="./../styles/bootstrap.bundle.min.js"></script>

</body>

</html>