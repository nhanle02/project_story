<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/configs/connect.php';
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    $sql = "DELETE FROM stories WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('location: http://localhost:600/project_story/backend/pages/story/stories.php');
?>