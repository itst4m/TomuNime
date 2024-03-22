<?php 
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$p= dirname($currentPath);
setcookie("user", "", time() - 3600, "$p/");
setcookie("pass", "", time() - 3600, "$p/");
setcookie("user", "", time() - 3600);
setcookie("pass", "", time() - 3600);
setcookie("user", "", time() - 3600, "$p/admin");
setcookie("pass", "", time() - 3600, "$p/admin");
setcookie("user", "", time() - 3600, "$p/petugas");
setcookie("pass", "", time() - 3600, "$p/petugas");
header("Location: index.php");
?>