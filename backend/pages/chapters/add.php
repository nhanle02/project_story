
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
        max-width: 120px;
        color: #808A9D;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .add-image:hover {
        background-color: #eee;
    }

    .list-item {
        display: flex;
        flex-wrap: wrap;
    }

    .items {
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
        width: 18%;
        height: 180px;
        margin: 5px 1%;
        position: relative;
        z-index: 101;
    }

    .wrap {
        display: flex;
    }
    .icon {
        color: #808A9D;
        width: 25px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: absolute;
        z-index: 100;
    }

    .icon:hover {
        background-color: #eee;
    }

    .button {
        position: absolute;
        top: 86%;
        display: none;
    }

    .remove, .change {
        margin: 5px;
        cursor: pointer;
    }

    .icon-plus {
        color: #808A9D;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 180px;
        position: absolute;
    }

    .icon-plus:hover {
        color: black;
    }

    .img {
        width: 100%;
        height: 180px;
        display: none;
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
                            <span class="icon-sm icon-add" style="margin-right: 5px; margin-left: 5px;"><i class="fas fa-plus"></i></span>
                            <span class="js-add-a-card">Add a image</span>
                        </div>
                        <div class="list-item">
                            <div class="items">
                                <div class="wrap">
                                    <input hidden class="file" type="file" accept="image/*" onchange="loadFile(event)"/>
                                </div>
                                <div class="image">
                                    <img src="#" alt="" class="img" id="output">
                                </div>
                                <div class="icon-plus"><i class="fas fa-plus"></i></div>
                                <div class="button"> 
                                    <span class="remove text-danger">remove</span> 
                                    <span class="change text-warning">change</span> 
                                </div>
                            </div>    
                        </div>
                        <input type="submit" name="Create" class="btn btn-success" >
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
                $('.list-item').append('<div class="items"> <div class="wrap"> <input type="file" class="file" hidden accept="image/*" onchange="loadFile(event)"/><div class="icon"><i class="fas fa-times"></i></div> </div> <div class="image"> <img src="#" alt="" class="img" id="output"> </div><div class="icon-plus"> <i class="fas fa-plus"></i> </div> <div class="button"> <span class="remove text-danger">remove</span> <span class="change text-warning">change</span> </div> </div>');
            });

            $(document).on('click', '.icon', function() {
                $(this).closest('.items').remove();
            });

            $(document).on('click', '.items .icon-plus', function() {
                $(this).closest('.items').find('.file').trigger('click');
                $(this).closest('.items').find('.button').css('display', 'block');
                $(this).closest('.items').find('.img').css('display', 'block');
            });
        });
            var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
                }
            };
    </script>
</html>