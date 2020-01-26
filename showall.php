<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "config/connection.php";
    $stmt = $pdo->prepare( 'SELECT stdID, fname, lname, deptName FROM students, department WHERE students.deptID = department.deptID');
    $stmt->execute();
    ?>

    <?php require "templates/header.php"; ?>
    <title>Show the students</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container mt-3">
    <h2>Show the students</h2>
    <p>Type something in the input field to search the table for studentid, first names, last names or Department:</p>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>StudentID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
        </tr>
        </thead>
        <tbody id="myTable">
        <?php while ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?php echo $row['stdID']; ?> </td>
                <td><?php echo $row['fname']; ?> </td>
                <td><?php echo $row['lname']; ?> </td>
                <td><?php echo $row['deptName']; ?> </td>
            </tr>
        <?php } ;?>
        </tbody>
    </table>

    <a href="index.php">Back to HOME</a>
</div>
<?php require "templates/footer.php"; ?>
</div>

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</body>
</html>