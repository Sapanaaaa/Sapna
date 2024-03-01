<?php
$conn=new mysqli("localhost","root","","driver");
if($conn->connect_error!=0)
 {
 die("Connection Error");
}
$user_id=$_POST['user_id'];
$sql="SELECT * FROM user u,registration r WHERE user_id='$user_id'";

if($r=$conn->query($sql))
{
    $data=array();
    while($row=$r->fetch_assoc())
    {
        array_push($data,$row);
    }
}
    echo json_encode($data);
?>