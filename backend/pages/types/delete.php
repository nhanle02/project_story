<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/configs/connect.php';
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "DELETE FROM story_types WHERE type_id='$id'";
    $sql1 = "DELETE FROM types WHERE id='$id'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    header('location: http://localhost:600/project_story/backend/pages/types/index.php');
?>