<?php
    
     $fine_type=$_POST['fine_type'];
     $fine_amount=$_POST['fine_amount'];
     $description=$_POST['description'];
    
     $uid=$_POST['id'];
                
     $conn=new mysqli("localhost","root","","driver");
    if($conn->connect_errno!=0)
     {
         die("Connection Error".$conn->connect_errno);
     }
     $sql="INSERT INTO fine(fine_type,fine_amount,description) VALUES ('$fine_type','$fine_amount','$description')";
     $result =$conn->query($sql);
     if ($result) {
         echo "User Inserted Successfully";
     } else {
         die(mysqli_error($conn));
     }        
?>