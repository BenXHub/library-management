<?php

    require_once("config/conn.php");
    require_once ("navbar.php");

    $con = connection();

    $sql   = "SELECT * FROM book_list ORDER BY title ASC";
    $books = $con->query($sql) or die($con->error);
    $row   = $books->fetch_assoc();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ACLC Iriga Library</title>

    <link rel="icon" href="img/oldBook.png">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap-5.2.3.min.css">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap-morph.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="table" >
        <table class="table table-hover table-light mx-auto m-4" style="width: 95%;">
            <thead class="w-100" style="border-bottom: 2px solid #000000;">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Copyright</th>
                </tr>
            </thead>
            <tbody class="w-100">
            <?php do { ?>
                <tr>
                    <td><a href="details.php?ID=<?php echo $row['id'] ?>" style="text-decoration: none"><?php echo $row['title']; ?></a></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['copyright']; ?></td>
                </tr>
            <?php } while ($row = $books->fetch_assoc()); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
