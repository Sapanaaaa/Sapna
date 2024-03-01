<?php
$pageTitle = "Fine Details";
?>
<?php
require('layout/user/header.php');
?>
<!--Content Container start--->
<div class="container-fluid">
    <div class="row">
        <?php
        include('layout/user/sidebar.php');
        ?>

        <div class="col-9">
            <h1>Fine Details</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Name</th>
                                <th scope="col">Addess</th>
                                <th scope="col">Fine_date</th>
                                <th scope="col">Fine_type</th>
                                <th scope="col">Fine_amount</th>
                                <th scope="col">Status</th>


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

                            $uid = $data['id'];
                            $sql = "SELECT * FROM user,fine WHERE user.id=fine.user_id AND user.id='$uid'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $fineType = isset($fineTypeMapping[$row['fine_type']]) ? $fineTypeMapping[$row['fine_type']] : 'Unknown';
                                echo "
                <tr>
               
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['fine_date'] . "</td>
                    <td>" . $fineType . "</td>
                    <td>" . $row['fine_amount'] . "</td>
                    <td>" . $row['status'] . "</td>
               

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

    </html>