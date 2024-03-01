<?php
$pageTitle = "Admin Dashboard";
?>
<?php include('layout/admin/header.php'); ?>
<!--Content Container start--->
<div class="container-fluid">
  <div class="row">
    <?php include('layout/admin/sidebar.php');
    $row = $_SESSION['user'];
    ?>
    <div class="col-9">
      <div class="mb-3">
        <?php
        echo $row['email'];
        ?><br>
      </div>
    </div>