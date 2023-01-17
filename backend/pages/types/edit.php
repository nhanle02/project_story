
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Edit thể loại</title>";
    echo $title;
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "SELECT stories.id, stories.name, stories.avatar, stories.author , stories.created_date, stories.status 
    FROM story_types join  stories ON story_types.story_id = stories.id JOIN types 
    on types.id = story_types.type_id where types.id = $id";
    $result = mysqli_query($conn, $sql);
    $story = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $story[] = $row;
    }
    $sql1 = "SELECT id,name from stories where id not in
    (SELECT stories.id from stories join story_types on story_types.story_id=stories.id 
     join types on types.id=story_types.type_id WHERE types.id = $id)";
    $result1 = mysqli_query($conn, $sql1);
    $stories = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $stories[] = $row;
    }
    if(isset($_POST['submit'])) {
        $story_id = isset($_POST['id']) ? $_POST['id'] : '';
        $sql2 = "INSERT INTO story_types(story_id, type_id) values($story_id, $id)";
        mysqli_query($conn, $sql2);
        header('location: http://localhost:600/project_story/backend/pages/types/index.php');
    }
    if(isset($_POST['remove'])) {
        $id_story = isset($_POST['id_story']) ? $_POST['id_story'] : '';
        $sql3 = "DELETE From story_types where story_id=$id_story and type_id=$id";
        mysqli_query($conn, $sql3);
        header('location: http://localhost:600/project_story/backend/pages/types/edit.php' . '?' . 'id=' . $id);
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
                    <div class="col-sm-9" style="margin-top: 10px; margin-left:10px;">
                        <form method="POST" action="">
                            <select class="form-control"style="width:100%; max-width:400px; display: inline;" name="id">
                                <?php foreach ($stories as $stories): ?>
                                <option value="<?php echo $stories['id']; ?>"><?php echo $stories['name']; ?></option>
                                <?php endforeach;?>
                            </select>
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Add story in type">
                        </form>
                    </div>
                    
                    <div class="panel panel-default" style="margin-top: 30px;">
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
                                            <th>Avatar</th>
                                            <th>Author</th>
                                            <th>Ngày tạo</th>
                                            <th>Status</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($story as $story): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php echo $story['id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $story['name']; ?>
                                            </td>
                                            <td><img src="http://localhost:600/project_story/assets/backend/images/<?php echo $story['avatar'];?>" alt="" style="width: 100px; height: 140px;"></td>
                                            <td>
                                                <?php echo $story['author']; ?>
                                            </td>
                                            <td>
                                                <?php echo $story['created_date']; ?>
                                            </td>
                                            <td>
                                            <?php 
                                                if ((int)$story['status'] === 1) {
                                                    echo 'Đang cập nhật';
                                                } else {
                                                    echo 'Drop';
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <form action="" method="POST">
                                                    <input class="form-control" style="display:none;" type="text" name="id_story" value="<?php echo $story['id'];?>">
                                                    <input class="btn btn-danger" type="submit" value="Remove" name="remove"/>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="http://localhost:600/project_story/backend/pages/types/index.php" class="btn btn-warning pull-right">Quay về</a>
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