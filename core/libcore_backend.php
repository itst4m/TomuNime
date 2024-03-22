<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
class Libcore
{
    public $pdo = null;
    /**
     * Melakukan koneksi ke database
     */
    function connect()
    {
        // Database credentials
        $host = 'localhost'; // your database host
        $username = 'root'; // your database username
        $password = ''; // your database password
        $database = 'e-ticket'; // your database name

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    /**
     *`
     */
    function insertFlight($a, $file)
    {
        $sql = "INSERT INTO Flight (foto,maskapai, tanggal_penerbangan, kuota, bandara_asal, jam_kedatangan, tujuan_akhir, sektor, harga, jam_berangkat, jam_tiba) 
        VALUES (:foto, :maskapai, :tanggal_penerbangan, :kuota, :bandara_asal, :jam_kedatangan, :tujuan_akhir, :sektor, :harga, :jam_berangkat, :jam_tiba)";
        // Prepare and execute the SQL statement
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':maskapai', $a["maskapai"]);
        $stmt->bindParam(':tanggal_penerbangan', $a["tanggal_penerbangan"]);
        $stmt->bindParam(':kuota', $a["kuota"]);
        $stmt->bindParam(':bandara_asal', $a["bandara_asal"]);
        $stmt->bindParam(':jam_kedatangan', $a["jam_kedatangan"]);
        $stmt->bindParam(':tujuan_akhir', $a["tujuan_akhir"]);
        $stmt->bindParam(':sektor', $a["sektor"]);
        $stmt->bindParam(':harga', $a["harga"]);
        $stmt->bindParam(':jam_berangkat', $a["jam_berangkat"]);
        $stmt->bindParam(':jam_tiba', $a["jam_tiba"]);
        $namafoto = uniqid() . ".png";
        $this->uploadFile($file, getcwd() . "/../public/foto/", $namafoto);
        $stmt->bindParam(':foto',  $namafoto);
        return $stmt->execute();
    }
    function insertTicket($user_id, $kode_pnr, $tanggal, $flight_id)
    {
        $sql = "INSERT INTO Orders (user_id, kode_pnr, tanggal, flight_id) VALUES (:user_id, :kode_pnr, :tanggal, :flight_id)  ";
        // Prepare and execute the SQL statement
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':kode_pnr', $kode_pnr);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':flight_id', $flight_id);
        return $stmt->execute();
    }
    function deleteFlight($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `Flight` WHERE `flight_id`=:id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    function getTicket($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Orders INNER JOIN User INNER JOIN Flight ON Orders.user_id = User.user_id AND  Flight.flight_id = Orders.flight_id WHERE Orders.user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getTicketList()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Orders INNER JOIN User INNER JOIN Flight ON Orders.user_id = User.user_id AND  Flight.flight_id = Orders.flight_id");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function uploadFile($file, $targetDirectory, $nf)
    {
        $targetFile = $targetDirectory . $nf;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file already exists
        if (file_exists($targetFile)) {
            return "Sorry, the file already exists.";
        }

        // Check file size (adjust as needed)
        if ($file["size"] > 50000000) {
            return "Sorry, your file is too large.";
        }

        // Allow certain file formats (you can customize this list)
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            return "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }

    function editFlight($a, $id)
    {
        $sql = "UPDATE Flight SET
        maskapai = :maskapai,
        tanggal_penerbangan = :tanggal_penerbangan,
        kuota = :kuota,
        bandara_asal = :bandara_asal,
        jam_kedatangan = :jam_kedatangan,
        tujuan_akhir = :tujuan_akhir,
        sektor = :sektor,
        harga = :harga,
        jam_berangkat = :jam_berangkat,
        jam_tiba = :jam_tiba
        WHERE flight_id= :flight_id";

        // Prepare and execute the SQL statement
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':flight_id', $id);
        $stmt->bindParam(':maskapai', $a["maskapai"]);
        $stmt->bindParam(':tanggal_penerbangan', $a["tanggal_penerbangan"]);
        $stmt->bindParam(':kuota', $a["kuota"]);
        $stmt->bindParam(':bandara_asal', $a["bandara_asal"]);
        $stmt->bindParam(':jam_kedatangan', $a["jam_kedatangan"]);
        $stmt->bindParam(':tujuan_akhir', $a["tujuan_akhir"]);
        $stmt->bindParam(':sektor', $a["sektor"]);
        $stmt->bindParam(':harga', $a["harga"]);
        $stmt->bindParam(':jam_berangkat', $a["jam_berangkat"]);
        $stmt->bindParam(':jam_tiba', $a["jam_tiba"]);
        return $stmt->execute();
    }
    function getFlightList()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `Flight`");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getFlight($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `Flight` WHERE `flight_id`=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    function getUser($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `User` WHERE `email`=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    function loginUser($u, $p)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `User` WHERE `email`=:user AND `password`=:pass AND `role`=0");
        $stmt->bindParam(':user', $u);
        $stmt->bindParam(':pass', $p);
        // Execute the statement
        $stmt->execute();
        // Fetch all rows as an associative array
        $tickets = $stmt->fetch();
        if (gettype($tickets) == "boolean") {
            return false;
        } else if (gettype($tickets) == "array" && count($tickets) > 0) {

            setcookie("user", $u, time() + 3600);
            setcookie('pass', $p, time() + 3600);
            return  count($tickets) > 0;
        }
        return false;
    }
    function loginStaff($u, $p)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `User` WHERE `email`=:user AND `password`=:pass AND `role`=1");
        $stmt->bindParam(':user', $u);
        $stmt->bindParam(':pass', $p);
        // Execute the statement
        $stmt->execute();
        // Fetch all rows as an associative array
        $tickets = $stmt->fetch();
        if (gettype($tickets) == "boolean") {
            return false;
        } else if (gettype($tickets) == "array" && count($tickets) > 0) {

            setcookie("user", $u, time() + 3600);
            setcookie('pass', $p, time() + 3600);
            return  count($tickets) > 0;
        }
        return false;
    }
    function loginAdmin($u, $p)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `User` WHERE `email`=:user AND `password`=:pass AND `role`=2");
        $stmt->bindParam(':user', $u);
        $stmt->bindParam(':pass', $p);
        // Execute the statement
        $stmt->execute();
        // Fetch all rows as an associative array
        $tickets = $stmt->fetch();
        if (gettype($tickets) == "boolean") {
            return false;
        } else if (gettype($tickets) == "array" && count($tickets) > 0) {
            setcookie("user", "", time() - 3600, "/");
            setcookie("pass", "", time() - 3600, "/");
            setcookie("user", $u, time() + 3600);
            setcookie('pass', $p, time() + 3600);
            return  count($tickets) > 0;
        }
        return false;
    }
    function registerUser($nama, $email, $pass)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `User`(`nama`, `email`, `password`, role) VALUES (:nama, :email, :pass, 0) ");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':pass', $pass);
        // Execute the statement
        return  $stmt->execute();
        // Fetch all rows as an associative array

    }
    function confirmTicket($id)
    {
        $stmt = $this->pdo->prepare("UPDATE `Orders` SET `konfirmasi`=1  WHERE `order_id`=:order_id");
        $stmt->bindParam(':order_id', $id);
        // Execute the statement
        return  $stmt->execute();
        // Fetch all rows as an associative array

    }
    function isUserLogin()
    {
        if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {

            if (!$this->loginUser($_COOKIE["user"], $_COOKIE["pass"])) {
                die("akun anda salah username atau password");
            }
        } else {
            die("<script>alert('Anda belum login');window.location.href = 'login.php'</script>");
        }
    }
    function isStaffLogin()
    {
        if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {

            if (!$this->loginStaff($_COOKIE["user"], $_COOKIE["pass"])) {
                die("<script>alert('Anda belum masuk sebagai petugas');window.location.href = 'login.php'</script>");
            }
        } else {
            die("<script>alert('Anda belum login sebagai petugas');window.location.href = 'login.php'</script>");
        }
    }
    function isAdminLogin()
    {
        if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {

            if (!$this->loginAdmin($_COOKIE["user"], $_COOKIE["pass"])) {
                die(var_dump($_COOKIE));
            }
        } else {
            die("<script>alert('Anda belum login sebagai admin');window.location.href = 'login.php'</script>");
        }
    }
    function logout()
    {
        setcookie("user", "", time() - 3600, "/");
        setcookie("pass", "", time() - 3600, "/");
        setcookie("user", "", time() - 3600);
        setcookie("pass", "", time() - 3600);
        setcookie("user", "", time() - 3600, "/admin");
        setcookie("pass", "", time() - 3600, "/admin");
        setcookie("user", "", time() - 3600, "/petugas");
        setcookie("pass", "", time() - 3600, "/petugas");
    }
}
