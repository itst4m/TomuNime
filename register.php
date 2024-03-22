<?php
include "./core/libcore_backend.php";
$core = new Libcore();
$core->connect();
if(isset($_POST["nama"]) && isset($_POST["email"]) && isset($_POST["pass"])) {
    $x = $core->registerUser($_POST["nama"], $_POST["email"], $_POST["pass"]);
    if($x){
$msg = '<div class="alert alert-success p-2"><small>Akun telah dibuat </small></div>';
        
    }
    else {
        if($x){
            $msg = '<div class="alert alert-success p-2"><small>Akun gagal dibuat </small></div>';
                    
                }
    }
}
$msg = '<div class="alert alert-warning p-2"><small>Registrasi Akun</small></div>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TICKET - LOGIN</title>
    <link href="./styles/bootstrap.min.css" rel="stylesheet">
    <link href="./styles/styles.css" rel="stylesheet">

</head>
<body class="container" style="background-image: url(./image/ryan_air.jpeg); background-repeat: no-repeat;background-size: cover;">
    <center>
    <form  class=" p-3" action="" style="max-width: 500px;border: 2px solid #eee;border-radius: 10px;margin-top: 20vh;background: rgba(255,255,255,0.8)" method="post">
        <center><h3 class="mb-0">E-TICKET</h3></center>
        <small class="text-muted">Pelayanan cepat harga merakyat</small>
        <hr>
        <?=  $msg; ?>
        <input class="form-control mt-3 w-100" placeholder="Nama" name="nama">
        <div class="d-flex justify-content-start"><small class="text-muted" style="text-align: start;">Masukkan nama depan dan belakang anda</small></div>

        <input class="form-control mt-3" placeholder="Email" name="email" type="email">
        <div class="d-flex justify-content-start"><small class="text-muted" style="text-align: start;">Masukkan email yang valid (harus memiliki simbol '@')</small></div>
        <input class="form-control mt-3" placeholder="Password" name="pass">
        <div class="d-flex justify-content-start"><small class="text-muted" style="text-align: start;">Masukkan password yang ingin digunakan</small></div>

        <button class="btn btn-success mt-3 w-100">Register</button>
    </form>
    </center>
</body>

</html>