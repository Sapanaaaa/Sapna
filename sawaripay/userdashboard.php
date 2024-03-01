<?php
$pageTitle = "User Dashboard";
?>
<?php include('layout/user/header.php'); ?>
<!--Content Container start--->
<div class="container-fluid">
    <div class="row">
        <?php include('layout/user/sidebar.php');
        $row = $_SESSION['user']; ?>
        <div class="col-9">
            <div class="mb-3">
                <?php
                echo $row['name'];
                ?><br>
            </div>
        </div>
        <!--Content Container end--->
        <?php include('layout/user/footer.php'); ?>