<?php

    session_start();
    require_once("config/conn.php");
    $con = connection();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACLC Iriga Library</title>

    <link rel="icon" href="./img/oldBook.png">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap-morph.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <div class="brand-content">
                    <img src="img/ACLC-Logo.png" alt="ACLC Iriga Library Logo" height="60">
                    <h1><b>ACLC Iriga Library</b></h1>
                </div>
            </a>
            <form action="result.php" method="get" class="d-flex ms-auto" style="width: 30%" role="search">
                <label for="search"></label>
                <input class="form-control" type="text" name="search" id="search" autocomplete="off" placeholder="Search">
                <button class="btn btn-light" type="submit">Search</button>
            </form>
            <?php if (isset($_SESSION['Access']) && $_SESSION['Access'] === 'admin') : ?>
                <a class="btn btn-outline-light ms-auto me-2 addNew" href="insert.php" data-toggle="modal"
                   data-target="#insertmodal">Add
                    New Book</a>
                <a class="btn btn-outline-secondary request ms-3" href="request.php">Request</a>
                <a class="btn btn-outline-danger sign-out me-2" href="logout.php">Sign Out</a>
            <?php else : ?>
                <a class="btn btn-outline-primary sign-in ms-3" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <script src="dist/bootstrap/js/bootstrap-5.2.3.bundle.min.js"></script>
    </body>
</html>
