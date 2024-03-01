<?php
$pageTitle = "Fines";
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
            <h1>Fine Details</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Fine ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Addess</th>
                                <th scope="col">Fine_date</th>
                                <th scope="col">Fine_type</th>
                                <th scope="col">Fine_amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>


                        <tbody>

                            <?php
                            $fineTypeMapping = array(
                                100 => 'Mapasey',
                                101 => 'Lane Rule Break',
                                102 => 'No Parking Area',
                                103 => 'License and Bluebook',
                                104 => 'One Way',
                                105 => 'Overload',
                            );

                            $conn = new mysqli("localhost", "root", "", "driver");
                            if ($conn->connect_error) {
                                die("Connection error");
                            }
                            $sql = "SELECT user.id AS user_id, fine.id AS fine_id, user.*, fine.* FROM user,fine WHERE user.id = fine.user_id";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $fineType = isset($fineTypeMapping[$row['fine_type']]) ? $fineTypeMapping[$row['fine_type']] : 'Unknown';
                                echo "
                <tr>
               
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['fine_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['fine_date'] . "</td>
                    <td>" . $fineType . "</td>
                    <td>" . $row['fine_amount'] . "</td>
                    <td>" . $row['status'] . "</td>
                <td>
                <input type='submit' id='" . $row['id'] . "'class='edit btn btn-info' value='View'/>
                
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
                    $("#mdlEdit").modal('show');
                    $.ajax({
                        url: "files/uedit.php",
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function (data) {
                            var jData = JSON.parse(data);
                            $('#upt_fine_date').val(jData[0].fine_date);
                            $('#upt_fine_type').val(jData[0].fine_type);
                            $('#upt_fine_amount').val(jData[0].fine_amount);
                            $('#upt_description').val(jData[0].description);
                            $('#upt_status').val(jData[0].status);
                            $('#hidden_id').val(id);
                            $("#mdlEdit").modal('show');
                        }
                    });
                });

                $('#userUpdate').click(function (e) {
                    e.preventDefault();

                    var fine_date = $('#upt_fine_date').val();
                    var fine_type = $('#upt_fine_type').val();
                    var fine_amount = $('#upt_fine_amount').val();
                    var description = $('#upt_description').val();
                    var status = $('#upt_status').val();
                    var id = $('#hidden_id').val();


                    $.ajax({
                        url: "files/userupdate.php",
                        type: 'POST',
                        data: {
                            id: id,
                            fine_date: fine_date,
                            fine_type: fine_type,
                            fine_amount: fine_amount,
                            description: description,
                            status: status
                        },
                        success: function (result) {
                            alert(result);
                            location.reload();
                        }
                    });
                });

            });
        </script>
    </body>

    </html>


    <!--editing details-->
    <form method="post" action="fine.php">
        <div class="modal fade" id="mdlEdit" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit This Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Fine_date</label>
                            <input type="date" class="form-control" id="upt_fine_date" autocomplete="off" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="fine_type" class="form-label">Fine_type</label>
                            <select id="upt_fine_type" class="form-select form-select-sm mb-3" disabled="true">
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
                            <input type="upt_fine_amount" class="form-control" id="upt_fine_amount" autocomplete="off"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="upt_text" class="form-control" id="upt_description" autocomplete="off"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="upt_status" class="form-select form-select-sm mb-3">

                                <option>Pending</option>
                                <option>Paid</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="submit" class="update_user btn btn-secondary" id="userUpdate"
                            data-bs-dismiss="modal" value="Update" />
                    </div>
                </div>
            </div>
        </div>