                <?php
               
                $fine_type = $_POST['fine_type'];
                $fine_amount=$_POST['fine_amount'];
                $description=$_POST['description'];
                $user_id=$_POST['user_id'];

                echo $user_id;
                                

                $conn=new mysqli("localhost","root","","driver");
                if($conn->connect_error)
                 {
                 die("Connection Error");
                }
                $sql="INSERT INTO fine(user_id,fine_type,fine_amount,description) VALUES ('$user_id','$fine_type','$fine_amount','$description')";               
                $result =$conn->query($sql);
                if ($result) {
                    echo "User Inserted Successfully";
                } 
                else {
                    die(mysqli_error($conn));
                }         
?>