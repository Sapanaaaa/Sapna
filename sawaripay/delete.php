<?php
                $uid=$_POST['id'];                
               $conn=new mysqli("localhost","root","","driver");
                if($conn->connect_error!=0)
                 {
                 die("Connection Error".$conn->connect_errno);
                }               
                $sql="DELETE FROM register WHERE id='$uid'";
                $result =$conn->query($sql);
                if ($result) {
                    echo ("User Deleted Successfully");
                } else {
                    echo(mysqli_error($conn));
                }         
?>