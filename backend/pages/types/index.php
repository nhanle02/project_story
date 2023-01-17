
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Quản lý thể loại</title>";
    echo $title;
    $sql = "select * from types";
    $result = mysqli_query($conn, $sql);
    $types = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $types[] = $row;
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
            <a href="http://localhost:600/project_story/backend/pages/types/add.php" class="btn btn-primary pull-right">Thêm mới</a>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Danh sách thể loại</b>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-cate">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($types as $types): ?>
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $types['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $types['name']; ?>
                                    </td>
                                    <td>
                                        <a href="http://localhost:600/project_story/backend/pages/types/edit.php?<?php echo 'id=' . $types['id']; ?>" class="btn btn-primary">edit</a>
                                        <a href="http://localhost:600/project_story/backend/pages/types/delete.php?<?php echo 'id=' . $types['id']; ?>" class="btn btn-danger">delete</a>
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