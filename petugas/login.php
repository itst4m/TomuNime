<?php
include "./../core/libcore_backend.php";
$core = new Libcore();
$core->connect();
$msg = '<div class="alert alert-warning p-2"><small>Masuk ke akun staff</small></div>';

if(isset($_POST["user"]) && isset($_POST["pass"])) {
    if($core->loginStaff($_POST["user"], $_POST["pass"])){
        header("Location: petugas.php");
    }
    else {
        $msg = '<div class="alert alert-danger p-2"><small>Email atau Passsword salah</small></div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TICKET - LOGIN</title>
    <link href="./../styles/bootstrap.min.css" rel="stylesheet">
    <link href="./../styles/styles.css" rel="stylesheet">

</head>
<body class="container" style="background-image: url(./../image/ryan_air.jpeg); background-repeat: no-repeat;background-size: cover;">
    <center>
    <form class=" p-3" action="" style="max-width: 500px;border: 2px solid #eee;border-radius: 10px;margin-top: 25vh;background: rgba(255,255,255,0.8)" method="post">
        <center><h3 class="mb-0">E-TICKET </h3></center>
        <small class="text-muted">Pelayanan cepat harga merakyat</small>
        <hr>
        <?=  $msg; ?>
        <input class="form-control" placeholder="Email" name="user">
        <input class="form-control mt-3" placeholder="Password" name="pass">
        <button class="btn btn-success mt-3 w-100">Login</button>
    </form>
    </center>
</body>

</html>