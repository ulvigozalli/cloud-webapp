<?php
    include "../config/connection.php";
?>
<?php
    $upstd = $pdo->prepare("UPDATE students SET  fname = ? , lname = ?, deptID = ?");
    $upstd->bindParam(1,  $_POST['firstname']);
    $upstd->bindParam(2,  $_POST['lastname']);
    $upstd->bindParam(3,  $_POST['deptID']);
    if ($upstd->execute()){
        header("location: ../edit.php");
    }
?>
