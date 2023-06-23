<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once("config/conn.php");

    $con = connection();

    if(isset($_POST['delete'])){
        $id = $_POST['ID'];
        $sql = "DELETE FROM book_list WHERE id='$id'";
        $con->query($sql) or die($con->error);

        header("Location: index.php");
    }