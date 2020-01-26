<?php
    include "../config/connection.php";
?>
<?php
    $det = $pdo->prepare("DELETE FROM students WHERE students.stdID=? ");
    $det->bindParam(1,  $_POST['studentID']);
    if ($det->execute()){
        header("location: ../edit.php");
    }
?>