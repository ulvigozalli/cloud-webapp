<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
        include "templates/header.php";
        include "templates/footer.php";
        include "config/connection.php";

    $stmt = $pdo->prepare( 'SELECT stdID, fname, lname, deptName FROM students, department WHERE students.deptID = department.deptID');
    $stmt->execute();
    ?>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function confirmDelete() {
            if (confirm("Press a button!")) {
                <?php
                if (!empty($_REQUEST)) {
                    $stdID = '603020739-9';
                    $stmt = $pdo->prepare("DELETE FROM students WHERE students.stdID=?");
                    $stmt->bindParam(1, $stdID);
                    $stmt->execute();
                }
                ?>
            }
        }
    </script>
</head>
<body>
    <div class="col-12">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>StudentID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="myTable" >
            <?php while ($row = $stmt->fetch()) {?>
                <tr>
                    <td>
                        <?php echo $row['stdID']; ?>
                    </td>
                    <td>
                        <?php echo $row['fname']; ?>
                    </td>
                    <td>
                        <?php echo $row['lname']; ?>
                    </td>
                    <td>
                        <?php echo $row['deptName']; ?>
                    </td>
                    <td>

                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>