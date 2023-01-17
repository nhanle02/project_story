
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Quản lý người dùng</title>";
    echo $title;
    $sql = "select * from users";
    $result = mysqli_query($conn, $sql);
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
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
            <a href="http://localhost:600/project_story/backend/pages/users/admin.php" 
            class="btn btn-primary pull-right">quản lý admin</a>
            <a href="http://localhost:600/project_story/backend/pages/users/index.php" 
            class="btn btn-warning pull-right">Quay về</a>

            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Danh sách users</b>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cate">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Full name</th>
                                <th>email</th>
                                <th>avatar</th>
                                <th>role</th>
                                <th>status</th>
                                <th>gender</th>
                                <th>tác vụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                              <?php if ((int)$user['role']===2) { ?>  
                                <tr class="odd gradeX">
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['full_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><img src="http://localhost:600/project_story/assets/backend/images/<?php echo $user['avatar'];?>" alt="" style="width: 140px; height: 140px;"></td>
                                    <td>
                                        <?php if((int)$user['role'] === 1) {
                                            echo 'admin';
                                        } else {
                                            echo 'người dùng';
                                        }
                                        
                                        ?>
                                    </td>
                                    <td><?php 
                                        if((int)$user['status'] === 1) {
                                            echo '<span class="text-success">active</span>';
                                        } else {
                                            echo '<span class="text-danger">De_active</span>';
                                        }
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php if((int)$user['gender'] === 1) {
                                            echo '<span class="text-success">Nam</span>';
                                        } else {
                                            echo '<span class="text-warning">Nữ</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="http://localhost:600/project_story/backend/pages/users/edit.php?<?php echo 'id=' . $user['id']; ?>" class="btn btn-primary">edit</a>
                                        <a href="http://localhost:600/project_story/backend/pages/users/delete.php?<?php echo 'id=' . $user['id']; ?>" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                                <?php } ?> 
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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