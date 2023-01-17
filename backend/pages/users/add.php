
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Add admin</title>";
    echo $title;
    if (isset($_POST['submit'])) {
        $name = 'admin';
        $role = 1;
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $sql = "select email from users where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $types = [
            'image/jpg', 'image/png', 'image/jepg' , 'image/webg',
        ];
        if (empty($email)) {
            $errors['email'] = "Email is not null!";
        } else if(isset($row)) {
            $errors['email'] = "Email already used!";
        }
        if(empty($password)) {
            $errors['password'] = "Password is not null!";
        } else if(strlen($password) < 6 || strlen($password) > 100) {
            $errors['password'] = "Please enter 6 to 100 characters!";
        }
        if($password != $confirm_password) {
            $errors['confirm_password'] = "please enter confirm password!";
        }
        if ($avatar['error'] === 0) {
            if ($avatar['size'] > 2048*1000) {
                $errors['avatar'] = "Kích thước file không lớn hơn 2MB!";
            } else if (!in_array($avatar['type'], $types)) {
                $errors['avatar'] = "File không đúng định dạng!";
            }
        }
        if (empty($gender)) {
            $errors['gender'] = "gender is not null!";
        }
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if (empty($errors)) {
            if ($avatar['error'] === 0) {
                $pathSave = '../../../assets/backend/images/' . $avatar['name'];
                move_uploaded_file($avatar['tmp_name'], $pathSave);
            }
            $filename = $avatar['name'];
            $sql = "INSERT INTO users (full_name, email, password, avatar, role, gender)
            VALUES('$name', '$email', '$password_hash', '$filename', $role, $gender)";
            mysqli_query($conn, $sql);
            header('location: http://localhost:600/project_story/backend/pages/users/admin.php');
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
                    <b>Add admin</b>
                </div>
    
                <div class="panel-body" style="margin-left: 200px;">
                    <form id="category-form" action="" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">

                        <div class="form-group" style="margin-top: 10px;">
                            <label  class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input name="email" type="text" value="<?php echo isset($email) ? $email : ''; ?>"
                                    class="form-control" id="email" placeholder="Email admin" />
                                <?php if(isset($errors['email'])) {?>
                                    <span class="text-danger"><?php echo $errors['email'];?></span>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-sm-9" style="width: 693px;">
                                    <label for="inputPassword">Password</label>
                                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                    <?php if(isset($errors['password'])) {?>
                                        <span class="text-danger"><?php echo $errors['password']; ?></span>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-sm-9" style="width: 693px;">
                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                    <input class="form-control" id="inputPasswordConfirm" name="confirm_password" type="password" placeholder="Confirm password" />
                                    <?php if(isset($errors['confirm_password'])) {?>
                                        <span class="text-danger"><?php echo $errors['confirm_password']; ?></span>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-3 control-label">avatar</label>

                            <div class="col-sm-9">
                                <input type="file" name="avatar">
                                <?php if(isset($errors['avatar'])) {?>
                                    <span class="text-danger"><?php echo $errors['avatar'];?></span>
                                <?php }?>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <div>
                                <input type="radio" id="male" name="gender" value="1">
                                <label for="huey">Nam</label>
                            </div>
                            <div style="margin-left: 10px;">
                                <input type="radio" id="female" name="gender" value="2">
                                <label for="dewey">Nữ</label>
                            </div>
                        </div>
                        <?php if(isset($errors['gender'])) {?>
                            <span class="text-danger"><?php echo $errors['gender']; ?></span>
                        <?php }?>
                        <div class="form-group" style="margin-top: 10px;">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Thêm mới" name="submit"/>
                                <a class="btn btn-warning" href="http://localhost:600/project_story/backend/pages/users/adimn.php">Trở về</a>
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