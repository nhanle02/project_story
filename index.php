<?php
    session_start();
    unset($_SESSION['user']);
    header('location: http://localhost:600/project_story/login.php');