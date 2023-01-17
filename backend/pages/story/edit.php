
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Edit truyện</title>";
    echo $title;
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "select * from stories where id='$id'";
    $result = mysqli_query($conn, $sql);
    $story = mysqli_fetch_assoc($result);
    if(isset($_POST['submit'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
        $author = isset($_POST['author']) ? $_POST['author'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        if (empty($_POST['name'])) {
            $errors['name'] = "Vui lòng nhập tên cho truyện!";
        }
        if (empty($_POST['author'])) {
            $errors['author'] = "Vui lòng nhập tên tác giả cho truyện!";
        }
        if (empty($_POST['status'])) {
            $errors['status'] = "Vui lòng chọn tình trạng truyện";
        }
        if ($avatar['error'] === 0) {
            $types = [
                'image/png', 'image/jpg', 'image/jepg' , 'image/webg',
            ];
            if (!in_array($avatar['type'], $types) ) {
                $errors['avatar'] = 'File đã chọn chưa đúng định dạng';
            } else if ($avatar['size'] > 2048* 1000) {
                $errors['avatar'] = 'Vui lòng chọn file không quá 2MB';
            } 
        }
        $date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
        if (empty($errors)) {
            if ($avatar['error'] === 0) {
                $oldAvatar = '../../../assets/backend/images/' . $story['avatar'];
                $pathSave = '../../../assets/backend/images/' . $avatar['name']; 
                move_uploaded_file($avatar['tmp_name'], $pathSave);   
                if(file_exists($oldAvatar)) {
                    unlink($oldAvatar);
                }
                $filename = $avatar['name']; 
                $sql1 = "UPDATE stories SET name='$name', avatar='$filename', author='$author',description='$description', updated_date='$date', status=$status where id=$id";
                mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                header('location: http://localhost:600/project_story/backend/pages/story/stories.php');
            }
            if ($avatar['error'] !== 0) {
                $filename = $story['avatar']; 
                $sql1 = "UPDATE stories SET name='$name', avatar='$filename', author='$author',description='$description', updated_date='$date', status=$status where id=$id";
                mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                header('location: http://localhost:600/project_story/backend/pages/story/stories.php');
            }
            
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
                    <b>Edit story</b>
                </div>
    
                <div class="panel-body" style="margin-left: 200px;">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                        <input name="id" type="hidden" value="<?php echo $story ? $story['id'] : '0'; ?>"/>

                        <div class="form-group">
                            <label  class="col-sm-3 control-label">Tên truyện</label>

                            <div class="col-sm-9">
                                <input name="name" type="text" value="<?php echo $story ? $story['name'] : ''; ?>"
                                    class="form-control" id="name" placeholder="Tên truyện" />
                                <?php if(isset($errors['name'])) {?>
                                    <span class="text-danger"><?php echo $errors['name']; ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">avatar truyện</label>
                            <div class="col-sm-9">
                                <img src="http://localhost:600/project_story/assets/backend/images/<?php echo $story['avatar'];?>" alt="">
                            </div>
                            <?php if(isset($errors['avatar'])) {?>
                                <p class="text-danger"><?php echo $errors['avatar']; ?></p>
                            <?php } ?>
                            <input name="avatar" type="file" name="file"/>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tác giả</label>

                            <div class="col-sm-9">
                                <input name="author" type="text" value="<?php echo $story ? $story['author'] : ''; ?>"
                                    class="form-control" id="name" placeholder="tác giả" />
                                <?php if(isset($errors['author'])) {?>
                                    <span class="text-danger"><?php echo $errors['author']; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link" class="col-sm-3 control-label">Mô tả</label>

                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" 
                                cols="30" rows="10"placeholder="Mô tả"><?php echo $story ? $story['description'] : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                        <div style="display: flex; margin-top: 10px;">
                            <div>
                                <input type="radio" id="un_drop" name="status" value="1">
                                <label for="huey">Đang cập nhật</label>
                            </div>
                            <div style="margin-left: 10px;">
                                <input type="radio" id="Drop" name="status" value="2">
                                <label for="dewey">Drop</label>
                            </div>
                        </div>
                        <?php if(isset($errors['status'])) {?>
                                    <span class="text-danger"><?php echo $errors['status']; ?></span>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Cập nhật" name="submit"/>
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