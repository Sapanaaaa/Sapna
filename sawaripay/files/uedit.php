<?php
$conn=new mysqli("localhost","root","","driver");
if($conn->connect_error!=0)
 {
 die("Connection Error");
}
$id=$_POST['id'];
$sql="SELECT * FROM fine WHERE id='$id'";

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