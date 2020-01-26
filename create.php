<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Student</title>
    <?php
        include "templates/header.php";
        include "templates/footer.php";
        include "config/connection.php";
    ?>
</head>
<body>
<h2>Add a student</h2>
    <div class="container-sm">
        <form action="function/add.php" method="post">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <label for="studentID">Student ID</label>
                <input type="text" class="form-control" id="studentID" name="studentID" placeholder="123456789-0" pattern="[0-9]{9}-[0-9]" required>
            </div>
            <div class="form-group">
                <label for="lastname">Department</label>
                <select class="form-control" name="deptID" id="deptID" required>
                    <option>Department</option>
                    <?php
                    $stm = $pdo->prepare( 'SELECT deptID,deptName FROM department');
                    $stm->execute();
                    while ($row = $stm->fetch()) {
                        ?>
                        <option><?php echo $row['deptID'] .' : '. $row['deptName']; ?> </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="index.php">Back to HOME</a>
    </div>
</body>
</html>
