<?php
$pageTitle = "Repeat Offenders";
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
            <h1>Repeat Offenders</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Addess</th>
                                <th scope="col">License</th>
                                <th scope="col">Vehicle Number</th>
                                <th scope="col">Total Offences</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            // Connect to your database
                            $conn = new mysqli("localhost", "root", "", "driver");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Retrieve data from the 'fine' table
                            $sql = "SELECT user_id FROM fine";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $offenderCounts = array();

                                // Loop through the results and count the offenses for each user
                                while ($row = $result->fetch_assoc()) {
                                    $userId = $row['user_id'];

                                    if (isset($offenderCounts[$userId])) {
                                        $offenderCounts[$userId]++;
                                    } else {
                                        $offenderCounts[$userId] = 1;
                                    }
                                }
                            } else {
                                echo "No results found.";
                            }

                            // Retrieve user details from the 'register' table
                            $sql = "SELECT id, name, address, lno, vehicle_no FROM user";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Loop through the results and display user details with total offenses
                                while ($row = $result->fetch_assoc()) {
                                    $userId = $row['id'];
                                    $name = $row['name'];
                                    $address = $row['address'];
                                    $license = $row['lno'];
                                    $vehicleNumber = $row['vehicle_no'];
                                    $totalOffenses = isset($offenderCounts[$userId]) ? $offenderCounts[$userId] : 0;

                                    if ($totalOffenses > 0) {
                                        echo '<tr>';
                                        echo "<td>$userId</td>";
                                        echo "<td>$name</td>";
                                        echo "<td>$address</td>";
                                        echo "<td>$license</td>";
                                        echo "<td>$vehicleNumber</td>";
                                        echo "<td>$totalOffenses</td>";
                                        echo '</tr>';
                                    }
                                }

                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo "No results found.";
                            }

                            // Close the database connection
                            $conn->close();
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <html>