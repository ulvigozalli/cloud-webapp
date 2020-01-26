<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile Student</title>
    <?php
        include "templates/header.php";
        include "templates/footer.php";
        include "config/connection.php";
        $stmt = $pdo->prepare( 'SELECT * FROM students, department WHERE students.deptID = department.deptID');
        $stmt->execute();
        $row = $stmt->fetch();
    ?>

    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
    <script>
        function confirmDelete(stdID) {
            var ans = confirm("ต้องการลบ  " + stdID);
            if (ans==true)
                document.location = "function/delete.php?stdID=" + stdID;
        }
    </script>
</head>
<body class="container mt-3">
    <div class="col-12">
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
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="myTable" >
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
                        <?php echo $row['deptName'];?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Update</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <label for="recipient-name" class="col-form-label">StudentID  :</label>
                                                <h1 class="form-control"><?php echo $row['stdID'] ?>  </h1>
                                                <input  type="hidden" class="form-control" id="studentID" name="studentID" value="<?= $row['stdID'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">First Name  :</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $row['fname'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Last Name  :</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"" value="<?= $row['lname'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Department</label>
                                                <select class="form-control" name="deptID" id="deptID" required>
                                                    <option><?php echo $row['deptID']  . $row['deptName']; ?></option>
                                                    <?php
                                                    $stm = $pdo->prepare( 'SELECT deptID,deptName FROM department');
                                                    $stm->execute();
                                                    while ($rows = $stm->fetch()) {
                                                        ?>
                                                        <option> <?php echo $rows['deptID'] .' : '. $rows['deptName']; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" onclick='confirmDelete("<?php echo $row['stdID']; ?>")')">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>