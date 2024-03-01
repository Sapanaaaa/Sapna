<?php
                $fine_date=$_POST['fine_date'];
                $fine_type=$_POST['fine_type'];
                $fine_amount=$_POST['fine_amount'];
                $status=$_POST['status'];
                $description=$_POST['description'];
                

                $conn=new mysqli("localhost","root","","driver");
                if($conn->connect_error)
                 {
                 die("Connection Error");
                }
                $sql="INSERT INTO fine(fine_date,fine_type,fine_amount,status,description) VALUES ('$fine_date','$fine_type','$fine_amount','$status','$description')";
               
                $result =$conn->query($sql);
                if ($result) {
                    echo "User Inserted Successfully";
                } else {
                    die(mysqli_error($conn));
                }         
?>