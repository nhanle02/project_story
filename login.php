<!DOCTYPE html>
<html lang="en">
<?php 
    require ('./backend/common/head.php');
    $title = "<title>Login</title>";
    echo $title;
    if(isset($_SESSION['admin'])) {
        header('location: http://localhost:600/project_story/backend/index.php');
    }
    if(isset($_SESSION['user'])) {
        header('location: http://localhost:600/project_story/index.php');
    }
    if(isset($_POST['submit'])) {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if (empty($password)) {
            $errors['password'] = "Password is not null!";
        }
        $sql = "select * from users where email='$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(empty($email)) {
            $errors['email'] = "Email is not null!";
        } else if(empty($row)) {
            $errors['email'] = "email incorrect";
        } else if (!password_verify($password, $row['password'])) {
            $errors['password'] = "password incorrect";
        } else if ($row['role'] == 1) {
            $_SESSION['admin'] = $row;
            header('location: http://localhost:600/project_story/backend/index.php');
        } else {
            $_SESSION['user'] = $row;
            header('location: http://localhost:600/project_story/index.php');
        }
    }
?>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form class="login" action="" method="POST" enctype="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" value="<?php if(isset($email)) {echo $email;}?>" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                            <?php if(isset($errors['email'])) { ?>
                                                <span class="text-danger"><?php echo $errors['email']; ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" value="<?php if(isset($password)) {echo $password;}?>" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                            <?php if(isset($errors['password'])) { ?>
                                                <span class="text-danger"><?php echo $errors['password']; ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Forgot Password?</a>
                                            <input class="button btn btn-primary" name="submit" type="submit" value="Login" />
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
           
