<?php
$pageTitle = "User Details";
?>
<?php
require('layout/admin/header.php');
?>
<!--Content Container start--->
<div class="container-fluid">
    <div class="row">
        <?php
        include('layout/admin/sidebar.php');
        ?>

        <div class="col-9">
            <h1>All Users</h1>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Vehicle_no</th>
                            <th scope="col">Licence_no</th>
                            <th scope="col">Phone_no</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "driver");
                        if ($conn->connect_error) {
                            die("Connection error");
                        }
                        $sql = "SELECT * FROM user";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "
                  <tr>
               
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['vehicle_no'] . "</td>
                    <td>" . $row['lno'] . "</td>
                    <td>" . $row['phone_no'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>
                      <input type='submit' id='" . $row['id'] . "'class='edit btn btn-info' value='Add Fine'/>
                    </td>
                  </tr>
                  ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<html>

<body>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $(document).ready(function () {

            $(".edit").click(function () {
                var id = this.id;
                $('#hidden_id').val(id);
                $("#mdlNew").modal('show');

            });

            $('#einsert').click(function () {
                var fine_type = $('#fine_type').val();
                var fine_amount = $('#fine_amount').val();
                var description = $('#description').val();
                var user_id = $('#hidden_id').val();
                $.ajax({
                    type: 'POST',
                    url: 'insert.php',
                    data: {
                        user_id: user_id,
                        fine_type: fine_type,
                        fine_amount: fine_amount,
                        description: description
                    },
                    success: function (data) {
                        alert(data);
                        location.reload();
                    }
                });
            });

        });
    </script>

</body>

</html>

<div class="modal fade" id="mdlNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Entry Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="fine_type" class="form-label">Fine_type</label>
                    <select id="fine_type" class="form-select form-select-sm mb-3">
                        <option value="100">Mapasey</option>
                        <option value="101">Lane Rule Break</option>
                        <option value="102">No Parking Area</option>
                        <option value="103">License and Bluebook</option>
                        <option value="104">One Way</option>
                        <option value="105">Overload</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fine_amount" class="form-label">Fine_amount</label>
                    <input type="number" class="form-control" id="fine_amount" required />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" required />
                </div>
            </div>

            <div class="modal-footer">
                <input type="hidden" name="hidden_id" id="hidden_id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="einsert">Insert</button>
            </div>
        </div>
    </div>
</div>