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

    <script>
        function confirmDelete(stdID) {
            var ans = confirm("ต้องการลบ  " + stdID);
            if (ans==true)
                document.location = "function/delete.php?stdID=" + stdID;
        }
    </script>

</head>
<body>

<div class="container mt-3">
    <h2>Update and Delete your Students Profile</h2>
    <p> Search the table for StudentID, First Names, Last Names :</p>
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
        <tbody id="myTable">
        <?php while ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?php echo $row['stdID']; ?> </td>
                <td><?php echo $row['fname']; ?> </td>
                <td><?php echo $row['lname']; ?> </td>
                <td><?php echo $row['deptName']; ?> </td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                            data-whatever="@fat">Update
                    </button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="function/update.php">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">StudentID :</label>
                                            <h1 class="form-control"><?php echo $row['stdID'] ?>  </h1>
                                            <input type="hidden" class="form-control" id="studentID" name="studentID"
                                                   value="<?= $row['stdID'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">First Name :</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                   value="<?= $row['fname'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Last Name :</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname""
                                            value="<?= $row['lname'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Department</label>
                                            <select class="form-control" name="deptID" id="deptID" required>
                                                <option><?php echo $row['deptID'] . $row['deptName']; ?></option>
                                                <?php
                                                $stm = $pdo->prepare('SELECT deptID,deptName FROM department');
                                                $stm->execute();
                                                while ($rows = $stm->fetch()) {
                                                    ?>
                                                    <option> <?php echo $rows['deptID'] . ' : ' . $rows['deptName']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </td>
                <td>
                    <a href="#" class="btn btn-danger" onclick='confirmDelete("<?php echo $row['stdID']; ?>")'
                       )">Delete</a>
                </td>
            </tr>
        <?php } ;?>
        </tbody>
    </table>

    <a href="index.php">Back to HOME</a>
</div>
<?php require "templates/footer.php"; ?>
</div>



</body>
</html>