
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Add story</title>";
    echo $title;
    if (isset($_POST['submit'])) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
        $author = isset($_POST['author']) ? $_POST['author'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $types = [
            'image/jpg', 'image/png', 'image/jepg' , 'image/webg',
        ];
        if (empty($name)) {
            $errors['name'] = "Name is not null!";
        }
        if (empty($author)) {
            $errors['author'] = "author is not null!";
        }
        if ($avatar['error'] != 0) {
            $errors['avatar'] = "avatar is not null!";
        }
        if ($avatar['error'] === 0) {
            if ($avatar['size'] > 2048*1000) {
                $errors['avatar'] = "Kích thước file không lớn hơn 2MB!";
            } else if (!in_array($avatar['type'], $types)) {
                $errors['avatar'] = "File không đúng định dạng!";
            }
        }
        $date = date('Y/m/d H:i:s' , time() + 7 * 3600);
        if (empty($errors)) {
            if ($avatar['error'] === 0) {
                $pathSave = '../../../assets/backend/images/' . $avatar['name'];
                move_uploaded_file($avatar['tmp_name'], $pathSave);
            }
            $filename = $avatar['name'];
            $sql = "INSERT INTO stories (name, avatar, author, description, updated_date, created_date)
            VALUES('$name', '$filename', '$author', '$description', '$date', '$date')";
            mysqli_query($conn, $sql);
            header('location: http://localhost:600/project_story/backend/pages/story/stories.php');
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
                    <b>Add story</b>
                </div>
    
                <div class="panel-body" style="margin-left: 200px;">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">

                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Tên truyện</label>

                            <div class="col-sm-9">
                                <input name="name" type="text" value=""
                                    class="form-control" id="name" placeholder="Tên truyện" />
                                <?php if(isset($errors['name'])) {?>
                                    <span class="text-danger"><?php echo $errors['name'];?></span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Ảnh truyện</label>

                            <div class="col-sm-9">
                                <input name="avatar" type="file" id="avatar"  />
                                <?php if(isset($errors['avatar'])) {?>
                                    <p class="text-danger"><?php echo $errors['avatar'];?></p>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Tên tác giả</label>

                            <div class="col-sm-9">
                                <input name="author" type="text" value=""
                                    class="form-control" id="author" placeholder="Tên tác giả" />
                                <?php if(isset($errors['author'])) {?>
                                    <span class="text-danger"><?php echo $errors['author'];?></span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Mô tả</label>

                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"placeholder="Mô tả"></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Thêm mới" name="submit"/>
                                <a class="btn btn-warning" href="http://localhost:600/project_story/backend/pages/story/stories.php">Trở về</a>
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