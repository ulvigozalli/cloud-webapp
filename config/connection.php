<?php
//require "config.php";
//    $conn = mysqli_init();
//    mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
//    if (mysqli_connect_errno($conn)) {
//    die('Failed to connect to MySQL: '.mysqli_connect_error());
//    }
//?>

<?php
    require "config.php";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", "$username", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "เกิดข้อผิดพลาด : " . $e->getMessage();
    }
?>
