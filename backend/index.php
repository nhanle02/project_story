
<!DOCTYPE html>
<html lang="en">
<?php 
    require ('./common/head.php');
    $title = "<title>Dashboard - SB Admin</title>";
    echo $title;
    if(empty($_SESSION['admin'])) {
        header('location: ' . redirect_url('project_story/login.php'));        
    }
?>
<body class="sb-nav-fixed">
    <?php
    require('./common/header.php');
    ?>

    <div id="layoutSidenav">
        <?php require('./common/nav.php'); ?>
        <div id="layoutSidenav_content">
            <?php require('./common/main.php'); ?>
            <div id="layoutAuthentication_footer">
            <?php require ('./common/footer.php'); ?>
            </div>
        </div> 
    </div>
</body>
    <?php
    $script = 2;
    require ('./common/script.php');
    ?>
</html>