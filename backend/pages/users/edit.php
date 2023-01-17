
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Edit users</title>";
    echo $title;
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "SELECT * from users where id = $id";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_assoc($result);

    $sql1 = "SELECT id, email from users where id not in (select id from users where id = $id)";
    $result1 = mysqli_query($conn, $sql1);
    $check_email = array();
    while($row = mysqli_fetch_assoc($result1)) {
        $check_email[] = $row; 
    }

    if(isset($_POST['submit'])) {
        $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '' ;
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '' ;
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '' ;
        $status = isset($_POST['status']) ? $_POST['status'] : '' ;
        
        if (empty($full_name)) {
            $errors['full_name'] = "Full name is not null!";
        }
        if (empty($email)) {
            $errors['email'] = "email is not null!";
        } else {
            foreach ($check_email as $email1) {
                if ($email == $email1['email']) {
                    $errors['email'] = "Email đã có người sử dụng!";
                }
            }
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
        if (empty($status)) {
            $errors['status'] = "status is not null!";
        }
        if (empty($gender)) {
            $errors['gender'] = "gender is not null!";
        }
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        if (empty($errors)) {
            if (empty($hash_pass)) {
                if ($avatar['error'] === 0) {
                    $oldAvatar = '../../../assets/backend/images/' . $users['avatar'];
                    $pathSave = '../../../assets/backend/images/' . $avatar['name']; 
                    move_uploaded_file($avatar['tmp_name'], $pathSave);   
                    if(file_exists($oldAvatar)) {
                        unlink($oldAvatar);
                    }
                    $filename = $avatar['name']; 
                    $sql1 = "UPDATE users SET full_name='$full_name',email='$email', avatar='$filename', status=$status , gender=$gender where id=$id";
                    mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    header('location: http://localhost:600/project_story/backend/pages/users/index.php');
                } else {
                    $filename = $users['avatar']; 
                    $sql1 = "UPDATE users SET full_name='$full_name',email='$email', avatar='$filename' , status=$status , gender=$gender where id=$id";
                    mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    header('location: http://localhost:600/project_story/backend/pages/users/index.php');
                }
            } else {
                if ($avatar['error'] === 0) {
                    $oldAvatar = '../../../assets/backend/images/' . $users['avatar'];
                    $pathSave = '../../../assets/backend/images/' . $avatar['name']; 
                    move_uploaded_file($avatar['tmp_name'], $pathSave);   
                    if(file_exists($oldAvatar)) {
                        unlink($oldAvatar);
                    }
                    $filename = $avatar['name']; 
                    $sql1 = "UPDATE users SET full_name='$full_name', avatar='$filename',email='$email', password='$hash_pass', status=$status , gender=$gender where id=$id";
                    mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    header('location: http://localhost:600/project_story/backend/pages/users/index.php');
                } else {
                    $filename = $users['avatar']; 
                    $sql1 = "UPDATE users SET full_name='$full_name', avatar='$filename' ,email='$email', password='$hash_pass' , status=$status , gender=$gender where id=$id";
                    mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                    header('location: http://localhost:600/project_story/backend/pages/users/index.php');
                }
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
                    <b>Edit user</b>
                </div>
    
                <div class="panel-body" style="margin-left: 200px;">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label  class="col-sm-3 control-label">Full name</label>

                            <div class="col-sm-9">
                                <input name="full_name" type="text" value="<?php echo isset($users['full_name']) ? $users['full_name'] : '' ?>"
                                    class="form-control" id="name" placeholder="Full name" />
                                <?php if (isset($errors['ful_name'])) {  ?>
                                    <span class="text-danger"><?php echo $errors['full_name'] ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input name="email" type="email" value="<?php echo isset($users['email']) ? $users['email'] : '' ?>"
                                    class="form-control" id="name" placeholder="nhập email" />
                                    <?php if (isset($errors['email'])) {  ?>
                                    <span class="text-danger"><?php echo $errors['email'] ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>

                            <div class="col-sm-9">
                                <input name="password" type="password" value="<?php ?>"
                                    class="form-control" id="name" placeholder="nhập password muốn thay đổi" />
                                <?php if (isset($errors['password'])) {  ?>
                                    <span class="text-danger"><?php echo $errors['password'] ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">avatar</label>
                            <div class="col-sm-9">
                                <img src="http://localhost:600/project_story/assets/backend/images/<?php echo $users['avatar'];?>" 
                                alt="" width="140px" height="140px" >
                            </div>
                            <?php if (isset($errors['avatar'])) {  ?>
                                    <p class="text-danger"><?php echo $errors['avatar'] ?></p>
                                <?php } ?>
                            <input name="avatar" type="file" name="file"/>
                        </div>

                        <div style="display: flex; margin-top: 10px;">
                            <div>
                                <input type="radio"  name="gender" value="1">
                                <label for="huey">Nam</label>
                            </div>
                            <div style="margin-left: 10px;">
                                <input type="radio" name="gender" value="2">
                                <label for="dewey">Nữ</label>
                            </div>
                        </div>
                        <?php 
                            if (isset($errors['gender'])) {  ?>
                            <span class="text-danger"><?php echo $errors['gender'] ?></span>
                        <?php } ?>
                        <div class="form-group" style="display: flex; margin-top: 10px;">
                            <div>
                                <input type="radio"  name="status" value="1">
                                <label for="huey">active</label>
                            </div>
                            <div style="margin-left: 10px;">
                                <input type="radio"  name="status" value="2">
                                <label for="dewey">De active</label>
                            </div>
                        </div>
                        <?php 
                            if (isset($errors['status'])) {  ?>
                            <span class="text-danger"><?php echo $errors['status'] ?></span>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Cập nhật" name="submit"/>
                                <a class="btn btn-warning" href="http://localhost:600/project_story/backend/pages/users/index.php">Trở về</a>
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