<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="container">
        <div class="row">
            <h1>User Details</h1>
        </div>
        <div class="row d-flex justify-content-end"> 
            <div class="col-3 d-flex justify-content-end">
                <button id="Newuser" class="btn btn-success">New</button>
            </div>   
        </div>

        <!--table start-->
        <div class="row">  
            <table class="table">
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>user_id </th>
                    <th>Fine_amount</th>
                    <th>Action</th>
                </tr>
                <?php
                
                $conn=new mysqli("localhost","root","","driver");
                if($conn->connect_error)
                {
                    die("Connection Error");
                }
                $sql="SELECT * from user u WHERE user_id='$user_id'";
                $result=$conn->query($sql);
                $i=1;
                
                foreach($result as $row)
                {
                    echo"<tr>";
                    echo("<td>".$i++."</td><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['fine_amount']."</td>");
                    echo("<td>"."</td><td>"."</td>");
                    echo "
                    <td>
                    <button id='".$row['user_id']."'class='btnUpdate btn btn-info'>View</button>
                    <button id='".$row['user_id']."'class='btnDelete btn btn-danger'>Delete</button>
                    </td>
                    </tr>
                    ";
                }
                ?>  
            </table>
            
        </div>
    </div>
    </main>
  </div>
</div>