
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Quản lý truyện</title>";
    echo $title;
    $sql = "select * from stories";
    $result = mysqli_query($conn, $sql);
    $story = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $story[] = $row;
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
    <a href="http://localhost:600/project_story/backend/pages/story/add.php" class="btn btn-primary pull-right"><i
            class="glyphicon glyphicon-plus"></i> Thêm mới</a>

            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Danh sách truyện</b>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cate">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>avatar</th>
                                <th>author</th>
                                <th>description</th>
                                <th>update_date</th>
                                <th>created_date</th>
                                <th>status</th>
                                <th>view</th>
                                <th>count_like</th>
                                <th>follow</th>
                                <th>tác vụ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($story as $story): ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $story['id']; ?></td>
                                    <td><?php echo $story['name']; ?></td>
                                    <td><img src="http://localhost:600/project_story/assets/backend/images/<?php echo $story['avatar'];?>" alt="" style="width: 100px; height: 140px;"></td>
                                    <td><?php echo $story['author']; ?></td>
                                    <td><?php echo $story['description']; ?></td>
                                    <td><?php echo $story['updated_date']; ?></td>
                                    <td><?php echo $story['created_date']; ?></td>
                                    <td>
                                        <?php 
                                            if ((int)$story['status'] === 1) {
                                                echo 'Đang cập nhật';
                                            } else {
                                                echo 'Drop';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $story['view']; ?></td>
                                    <td><?php echo $story['count_like']; ?></td>
                                    <td><?php echo $story['follow']; ?></td>
                                    <td>
                                        <a href="http://localhost:600/project_story/backend/pages/story/edit.php?<?php echo 'id=' . $story['id']; ?>" class="btn btn-primary">edit</a>
                                        <a href="http://localhost:600/project_story/backend/pages/story/delete.php?<?php echo 'id=' . $story['id']; ?>" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
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