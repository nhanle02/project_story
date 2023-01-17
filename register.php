<!DOCTYPE html>
<html lang="en">
<?php 
    require ('./backend/common/head.php');
    $title = "<title>Register</title>";
    echo $title;
    if(isset($_POST['submit'])) {
        $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        $sql = "select email from users where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(empty($full_name)) {
            $errors['full_name'] = "Full name is not null!";
        } 
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
        if (empty($gender)) {
            $errors['gender'] = "gender is not null!";
        }
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if(empty($errors)) {
            $sql1 = "INSERT INTO users(full_name, email, password, gender) value ('$full_name', '$email', '$password_hash', $gender)";
            if (mysqli_query($conn, $sql1)) {
                echo '<h2 style="margin-top:10px; text-align:center;">Successful account creation please login</h2>';
            } else {
                echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form_register" action="" method="POST" >
                                        <div class="row mb-3" >
                                            <div class="col-md-6" style="width: 100%;">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" name="full_name" type="text" placeholder="Enter your full name" />
                                                    <label for="inputFirstName">Full name</label>
                                                    <?php if(isset($errors['full_name'])) {?>
                                                        <span class="text-danger"><?php echo $errors['full_name']; ?></span>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                            <?php if(isset($errors['email'])) {?>
                                                <span class="text-danger"><?php echo $errors['email']; ?></span>
                                            <?php }?>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                    <?php if(isset($errors['password'])) {?>
                                                        <span class="text-danger"><?php echo $errors['password']; ?></span>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" name="confirm_password" type="password" placeholder="Confirm password" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                    <?php if(isset($errors['confirm_password'])) {?>
                                                        <span class="text-danger"><?php echo $errors['confirm_password']; ?></span>
                                                    <?php }?>
                                                </div>
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
                                        <div class="mt-4 mb-0" >
                                            <input class="btn btn-primary btn-block" style="width: 100%;" name="submit" type="submit" value="Create Account"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <?php require ('./backend/common/footer.php'); ?>
        </div>
    </div>
</body>
    <?php
    $script = 1;
    require ('./backend/common/script.php');
    ?>
</html>