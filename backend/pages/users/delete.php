<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/configs/connect.php';
    if (isset($_GET['id'])) 
        $id = intval($_GET['id']); 
    else 
        $id=0;
    
    $sql6 = "SELECT * from users where id=$id";
    $result = mysqli_query($conn, $sql6);
    $user = mysqli_fetch_assoc($result);
    if ((int)$user['role'] === 1) {
        echo '<h2 class="text-danger" style="text-align: center;">Tài khoản admin không thể xóa</h2>';
    } else {
        $sql = "DELETE FROM reviews WHERE user_id='$id'";
        $sql1 = "DELETE FROM favorites WHERE user_id='$id'";
        $sql2 = "DELETE FROM follows WHERE user_id='$id'";
        $sql3 = "DELETE FROM comment WHERE user_id='$id'";
        $sql4 = "DELETE FROM comment_replies WHERE user_id='$id'";
        $sql5 = "DELETE FROM users WHERE id='$id'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
        mysqli_query($conn, $sql2);
        mysqli_query($conn, $sql3);
        mysqli_query($conn, $sql4);
        mysqli_query($conn, $sql5);
        header('location: http://localhost:600/project_story/backend/pages/users/index.php');
    }  
?>
<a href="http://localhost:600/project_story/backend/pages/users/index.php" 
style="
    text-decoration: none; 
    border-radius: 5px; 
    padding: 10px 12px; 
    border: 1px solid #ffcd39;
    color: #000;
    background-color: #ffcd39;
    border-color: #ffc720;
    display: flex;
    width: 34px;
    margin: 10px auto;">Ok :)</a>