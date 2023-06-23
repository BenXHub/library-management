<?php
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("config/conn.php");

    $con = connection();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql   = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $user  = $con->query($sql) or die ($con->error);
        $row   = $user->fetch_assoc();
        $total = $user->num_rows;

        if($total > 0){
            $_SESSION['UserLogin'] = $row['username'];
            $_SESSION['Access']    = $row['access'];

            header("Location: index.php");
        }else{
            echo "No user Found";
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACLC Iriga Library</title>

    <link rel="icon" href="img/oldBook.png">
    <link rel="stylesheet" href="dist/bootstrap/css/bootstrap-sketchy.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

</head>
<body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <div class="d-flex justify-content-center mb-4">
                    <img src="img/oldBook.png" alt="Book" style="width: 100px;">
                </div>
                <h1 class="card-title text-center">Login Page</h1>
                <br>
                <form action="" method="post">
                    <div class="form-group">
                        <label class="col-form-label" for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label mt-3" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

