<?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT'] . '/project_story/configs/connect.php';
    include($_SERVER['DOCUMENT_ROOT'] . '/project_story/configs/helpers.php');
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?php assets('project_story/assets/backend/css/styles.css');?>" rel="stylesheet" />
    <script src="<?php assets('project_story/assets/vendor/fontawesome/js/all.js');?>" crossorigin="anonymous"></script>
</head>