<?php
    include "../config/connection.php";
?>
<?php
    $addstd = $pdo->prepare("INSERT INTO students (stdID, fname, lname, deptID) VALUES (?, ?, ?, ?)");
    $addstd->bindParam(1, $_POST['studentID']);
    $addstd->bindParam(2, $_POST['firstname']);
    $addstd->bindParam(3, $_POST['lastname']);
    $addstd->bindParam(4, $_POST['deptID']);
    if ($addstd->execute()){
        header("location: ../index.php");
    }
?>