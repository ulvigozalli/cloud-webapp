<?php
    include "../config/connection.php";
?>
<?php
    $det = $pdo->prepare("DELETE FROM students WHERE students.stdID=? ");
    $det->bindParam(1,  $_GET['stdID']);
    if ($det->execute()){
        header("location: ../edit.php");
    }
?>