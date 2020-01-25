<?php
include_once("config/connection.php");
if ($_POST['action'] == 'edit' && $_POST['stdid']) {
    $updateField='';
    if(isset($_POST['fname'])) {
        $updateField.= "fname='".$_POST['fname']."'";
    } else if(isset($_POST['lname'])) {
        $updateField.= "lname='".$_POST['lname']."'";
    } else if(isset($_POST['deptname'])) {
        $updateField.= "deptname='".$_POST['deptname']."'";
    }
    if($updateField && $_POST['stdid']) {
        $sqlQuery = "UPDATE students SET $updateField WHERE stdid='" . $_POST['stdid'] . "'";
        mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
        $data = array(
            "message"	=> "Record Updated",
            "status" => 1
        );
        echo json_encode($data);
    }
}
if ($_POST['action'] == 'delete' && $_POST['stdid']) {
    $sqlQuery = "DELETE FROM students WHERE stdid='" . $_POST['stdid'] . "'";
    mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
    $data = array(
        "message"	=> "Record Deleted",
        "status" => 1
    );
    echo json_encode($data);
}
?><?php
