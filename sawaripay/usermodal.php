<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

    <!-- Scripting Code for Inserting Book Starts  -->
    <script>
        $(document).ready(function(){

            $('.btnDelete').click(function(){
                var user_id=this.id;
                $('#hidden_id').val(uid);
                $("#deletemdl").modal("show");
            });

            $('#userDelete').click(function(e){
                e.preventDefault();
                
                var uid=$('#hidden_id').val();
                alert(uid);      
                $.ajax({
                    url: "delete.php", 
                    type:'POST',
                    data:{uid:uid},
                    success: function(result){
                        alert(result);
                        
                        location.reload();
                    }
                    });
                    

            });
            


            $('#New').click(function(){
               $("#testmdl").modal("show");
            });
            $('#userInsert').click(function(e){
                e.preventDefault();
                var id=$('#id').val();
                var name=$('#name').val();
                var fine_amount=$('#fine_amount').val();
               var user_id=$('#user_id').val();
                
                $.ajax({
                    url: "insert.php", 
                    type:'POST',
                    data:{id:id,name:name,fine_amount:fine_amount,user_id:user_id,},
                    success: function(result){
                        alert(result);
                        location.reload();
                    }
                    });
                    

            });
            /*Product Insertion Finished*/


            /*Product Update Started*/
            $('.btnUpdate').click(function(){
                var id=this.id;
                $.ajax({
                    url: "edit.php", 
                    type:'POST',
                    data:{id:id},
                    success: function(result){
                       var jData=JSON.parse(result);
                       $('#up_id').val(jData[0].id);
                       $('#up_name').val(jData[0].name);
                       $('#up_fine_amount').val(jData[0].fine_amount);
                       $('#hidden_id').val(id);
                       $("#updatemdl").modal("show");
                    }
                    });
                
                
            });

            $('#userUpdate').click(function(e){
                e.preventDefault();
                var id=$('#up_id').val();
                var name=$('#up_name').val();
                var fine_amount=$('#up_fine_amount').val();
                var id=$('#hidden_id').val();
               
                
                $.ajax({
                    url: "updateuser.php", 
                    type:'POST',
                    data:{id:id,name:name,fine_amount:fine_amount},
                    success: function(result){
                        alert(result);
                        location.reload();
                    }
                    });
            });
        });
        
    </script> 
    <!-- Scripting Code for Inserting Book Details Ends  -->
    
</body>
</html>

    <!-- Modal for inserting book Begins-->
    <div class="modal fade" tabindex="-1" id="testmdl">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Insert New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <form action="" method="post">
                <div class="form-group">
                        <label>
                            User Name
                        </label>
                        <input type="text" class="form-control" placeholder="Enter  User Name" id="u_name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Fine_amount</label>
                        <input type="number" class="form-control" placeholder="Enter Fine_amount" id="fine_amount" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="type" id="p_status">
                            <option value="Published">Publish this product for Market</option>
                            <option value="Not-Published">Not Now</option>
                        </select>
                    </div>
                    <button type="submit"id="userInsert" class="btn btn-primary" name="submit">Submit</button>
                    <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal for Inserting Book Ends-->


    <!-- Modal for Udating Book Starts-->
    <div class="modal fade" tabindex="-1" id="updatemdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">        
                    <form action="updateproduct.php" method="post">
                    <div class="form-group">
                        <label>
                            User Name
                        </label>
                        <input type="text" class="form-control" placeholder="Enter  User Name" id="up_name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Fine_amount</label>
                        <input type="number" class="form-control" placeholder="Enter Fine_amount" id="up_fine_amount" autocomplete="off">
                    </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="type" id="up_status">
                            <option value="Published">Publish this product for Market</option>
                            <option value="Not-Published">Not Now</option>
                        </select>
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id">
                        <button type="submit" class="btn btn-primary" id="userUpdate">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Udating Book Ends-->

    <!-- Modal for Deleting Book Starts-->
    <div class="modal fade" tabindex="-1" id="deletemdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <img src="img/cross.jpg" width="auto" height="100 px" >
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                
                </div>

                    <div class="modal-body ">
                    <form  method="post">  
                    <p>Do you really want to delete these records? This process cannot be undone.</p>      
                   
                    
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <button type="submit" class="btn btn-secondary" id="cancel">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="productDelete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>   