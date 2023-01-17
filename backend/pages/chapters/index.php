
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Quản lý chapters</title>";
    echo $title;
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "SELECT * from stories";
    $result = mysqli_query($conn, $sql);
    $story = array();
    while($row = mysqli_fetch_assoc($result)) {
        $story[] = $row;
    }   
    if (isset($_POST['submit'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        header('location: http://localhost:600/project_story/backend/pages/chapters/index.php?id=' . $id);
    }
    $query = '';
    if (!empty($id)) {
        $query = 'where story_id = ' . $id;
    }

    $sql1 = "SELECT * from chapters $query";

    $result1 = mysqli_query($conn, $sql1);
    $chapters = array();
    while($row = mysqli_fetch_assoc($result1)) {
        $chapters[] = $row;
    }

    ?>
<body class="sb-nav-fixed">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/header.php';
    ?>

        <div id="layoutSidenav">
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/nav.php'; ?>
           
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="col-sm-9" style="margin-top: 10px; margin-left:10px;">
                            <form method="POST" action="">
                                <select class="form-control"style="width:100%; max-width:400px; display: inline;" name="id">
                                    <option value="0">Tất cả</option>
                                    <?php foreach ($story as $str): ?>
                                        <?php if (!empty($_GET['id']) && $str['id'] == $_GET['id']): ?>
                                        <option selected value="<?php echo $str['id']; ?>"><?php echo $str['name']; ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo $str['id']; ?>"><?php echo $str['name']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach;?>
                                </select>
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="manager chapters">
                            </form>
                        </div>
                        <div class="panel panel-default" style="margin-top: 20px;">
                            
                            <div class="panel-heading text-center">
                                <b>Danh sách chapters</b>
                            </div>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-cate">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>images</th>
                                                <th>Number</th>
                                                <th>Tên</th>
                                                <th>views</th>
                                                <th>Tác vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($chapters as $chap): ?>
                                                <tr class="odd gradeX">
                                                    <td>
                                                        <?php echo $chap['id']; ?>
                                                    </td>
                                                    
                                                    <td><img src="http://localhost:600/project_story/assets/backend/images/<?php
                                                    $img = explode('/', $chap['content']);
                                                    echo $img[0];
                                                    ?>"
                                                    alt="" style="width: 140px; height: 140px;"></td>
                                                    </td>
                                                    <td>
                                                        <?php echo $chap['number']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $chap['name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $chap['views']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="http://localhost:600/project_story/backend/pages/chapters/edit.php?<?php echo 'id=' . $chap['id']; ?>" class="btn btn-primary">edit</a>
                                                        <a href="http://localhost:600/project_story/backend/pages/chapters/delete.php?<?php echo 'id=' . $chap['id']; ?>" class="btn btn-danger">delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="http://localhost:600/project_story/backend/pages/chapters/add.php" class="btn btn-primary pull-right" >Thêm mới</a>
                            <a href="http://localhost:600/project_story/backend/pages/chapters/index.php" class="btn btn-warning pull-right" style="margin-right: 10px;" >Quay về</a>
                        </div>
                        <div id="layoutAuthentication_footer">
                            <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/footer.php'; ?>
                        </div>
                    </div>
                    </div>
                </main>
                
            </div>
</body>
    <?php
    $script = 2;
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/script.php';
    ?>
</html>