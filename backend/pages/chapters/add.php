
<!DOCTYPE html>
<html lang="en">
<?php 
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/head.php';
    $title = "<title>Add Chapters</title>";
    echo $title;
    $sql = "SELECT id, name from stories";
    $result = mysqli_query($conn, $sql);
    $stories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $stories[] = $row;
    }
?>
<style>
    .add-image {
        margin-top: 10px;
        display: flex;
        border: 1px solid #eee;
        width: 100%;
        max-width: 400px;
        color: #808A9D;
        cursor: pointer;
    }

    .add-image:hover {
        background-color: #eee;
    }

    .list-item {
        display: flex;
        flex-wrap: wrap;
    }

    .item {
        border: 1px solid #eee;
        display: flex;
        width: 31.333%;
        margin: 5px 1%;
    }

    .icon {
        color: #808A9D;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .icon:hover {
        background-color: #eee;
    }
</style>
<body class="sb-nav-fixed">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/header.php';
    ?>

    <div id="layoutSidenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/project_story/backend/common/nav.php'; ?>
        <div id="layoutSidenav_content">
            <select class="form-control" style="width: 400px; margin: 10px;" name="story" id="">
                    <?php foreach($stories as $story) {?>
                    <option value="<?php echo $story['id']; ?>"><?php echo $story['name'] ?></option>
                    <?php }?>
            </select>
            <main>
                <div class="container-fluid px-4" style="display: flex; flex-direction: column; align-items: center;">
                   <h2>Add chapters</h2>   
                   <form action="" method="POST" style="width: 100%;">
                        <div>
                            <label for="number">number</label>
                            <input class="form-control" type="text" placeholder="number" name="number">
                        </div>
                        <div style="margin-top: 10px;">
                            <label for="name">Tên chương</label>
                            <input class="form-control" type="text" placeholder="name" name="name">
                        </div>
                        <div class="add-image">
                            <span class="icon-sm icon-add" style="margin-right: 5px;"><i class="fas fa-plus"></i></span>
                            <span class="js-add-a-card">Add a image</span>
                        </div>
                        <div class="list-item">
                            
                        </div>
                   </form>  
                </div>
            </main>
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
    <script>
        $(function() {
            $('.add-image').click(function() {
                $('.list-item').append('<div class="item"><div class="file"><input type="file"/></div><div class="icon"><i class="fas fa-times"></i></div></div>');
            });

            $('.icon').click(function() {
                $('.item').remove();
            });
        });
    </script>
</html>