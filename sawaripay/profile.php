<?php
$pageTitle = "User Profile";
?>
<?php
include('layout/user/header.php');
?>

<div class="col-15">
    <div class="container-fluid">
        <div class="row">
            <?php
                  include('layout/user/sidebar.php');
                  ?>
            <div class="col-9">
                <div class="card" style="width: 20rem">
                    <div class="card-header d-flex justify-content-left">
                        <h1>Welcome</h1>
                    </div>
                    <div class="card-body">
                        <?php
                                    $conn = new mysqli("localhost", "root", "", "driver");
                                    if ($conn->connect_error) {
                                          die("Connection error");
                                    }
                                    $uid = $data['id'];
                                    $sql = "SELECT * FROM user where id='$uid'";
                                    // where register.id=card.user_id and card.id=register.id"
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc(); {
                                          echo "    
                <tr>
              
                <td><label><b>Name: </b></label>  " . $row['name'] . "</td></br>
                <td><label><b>address: </b></label>  " . $row['address'] . "</td></br>
              
                <td><label><b>Vehicle No: </b></label>  " . $row['vehicle_no'] . "</td></br> 
                <td><label><b>Licence: </b></label>  " . $row['lno'] . "</td></br>
                <td><label><b>Phone No: </b></label>  " . $row['phone_no'] . "</td></br>
             
            </tr>
            ";
                                    }
                                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>