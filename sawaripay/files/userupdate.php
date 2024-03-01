<?php

    $fine_date=$_POST['fine_date'];
    $fine_type=$_POST['fine_type'];
    $description=$_POST['description'];
    $status=$_POST['status'];
    $uid=$_POST['id'];
                
     $conn=new mysqli("localhost","root","","driver");
    if($conn->connect_errno!=0)
     {
         die("Connection Error".$conn->connect_errno);
     }
     $sql="UPDATE fine SET  fine_date='$fine_date',fine_type='$fine_type',status='$status',description='$description' WHERE id='$uid'";
     $result =$conn->query($sql);
     if ($result) {
         echo "User Updated Successfully";
     } else {
         die(mysqli_error($conn));
    }       
?>