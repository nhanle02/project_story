<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Add types</title>";
    echo $title;
    $sql1 = "select * from types";
    $result = mysqli_query($conn, $sql1);
    $types = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $types[] = $row;
    }
    if (isset($_POST['submit'])) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        if (empty($name)) {
        $errors['name'] = "Name is not null!";
        } else {
            foreach($types as $types) {
                if($types['name'] == $name) {
                    $errors['name'] = "please enter another name!";
                }
            }      
        }
        if (empty($errors)) {
            $sql = "INSERT INTO types(name) VALUES ('$name')";
            mysqli_query($conn, $sql);
            header('location: http://localhost:600/project_story/backend/pages/types/index.php');
        }
    }
?>
<body class="sb-nav-fixed">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/header.php';
    ?>

    <div id="layoutSidenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/nav.php'; ?>
        <div id="layoutSidenav_content">
        <div id="page-wrapper">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Add type</b>
                </div>
    
                <div class="panel-body" style="margin-left: 200px;">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">

                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Tên thể loại</label>

                            <div class="col-sm-9">
                                <input name="name" type="text" value=""
                                    class="form-control" id="name" placeholder="Nhập tên thể loại" />
                                <?php if(isset($errors['name'])) {?>
                                    <span class="text-danger"><?php echo $errors['name'];?></span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Thêm mới" name="submit"/>
                                <a class="btn btn-warning" href="http://localhost:600/project_story/backend/pages/types/index.php">Trở về</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="layoutAuthentication_footer">
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/footer.php'; ?>
            </div>
        </div> 
    </div>
</body>
    <?php
    $script = 2;
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/script.php';
    ?>
</html>