
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Edit chapters</title>";
    echo $title;
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "SELECT * from chapters where id = $id";
    $result = mysqli_query($conn, $sql);
    $chapters = mysqli_fetch_assoc($result);
    $img = explode('/', $chapters['content']);
    
    
    

echo '<pre>';
echo '</pre>';
    ?>
<body class="sb-nav-fixed">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/header.php';
    ?>

    <div id="layoutSidenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/nav.php'; ?>
        <div id="layoutSidenav_content">
        <div id="page-wrapper">
             <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <a class="btn btn-warning" href="http://localhost:600/project_story/backend/pages/chapters/index.php">Trở về</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h2>Edit Chapters</h2>
                </div>
                <div class="panel-body" style="margin-top: 20px">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên chapters</label>
                            <div class="col-sm-9">
                                <input name="name" type="text" value="<?php echo isset($name) ? $name : $chapters['name']; ?>" class="form-control" id="name" placeholder="nhập tên cho chapters">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Number chapters</label>
                            <div class="col-sm-9">
                                <input name="number" type="text" value="<?php echo isset($number) ? $number : $chapters['number']; ?>" class="form-control" id="name" placeholder="number truyện">
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <label class="col-sm-3 control-label">Edit ảnh</label> 
                            <div style="display: flex; max-width:1124px; flex-wrap:wrap; justify-content: space-between;">
                                <?php
                                    foreach($img as $key => $im){ 
                                ?>
                                <div style="width: 552px; margin-left: 4px; margin-right:4px; border: 1px solid #eee;">
                                    <label style="display: flex; justify-content: center; font-weight: 700; font-size: 16px;">Ảnh <?php echo (int) $key + 1; ?></label>
                                    <img style="border: 1px solid #eee;" src="http://localhost:600/project_story/assets/backend/images/<?php echo $im; ?>" alt="" width="200px" height="200px"/>
                                    <div style="display: flex; margin: 10px;">
                                        <input type="file" name="image<?php echo (int)$key +1; ?>">
                                        <input type="submit" name="Cập nhật" class="btn btn-success">
                                    </div>
                                </div>
                                <?php }?>
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