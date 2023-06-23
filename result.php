<?php
require_once("config/conn.php");
require_once("navbar.php");

$con = connection();

$search = $_GET['search'];
$sql = "SELECT * FROM book_list WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR copyright LIKE '%$search%' ORDER BY title ASC";
$books = $con->query($sql) or die($con->error);
$row = $books->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACLC Iriga Library</title>

    <link rel="icon" href="img/oldBook.png">
    <link rel="stylesheet" href="./dist/bootstrap/css/bootstrap-morph.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="table">
    <?php if ($books->num_rows > 0) : ?>
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
    <?php else : ?>
        <table class="table table-hover table-light mx-auto m-4" style="width: 90%;">
            <thead class="w-100" style="border-bottom: 2px solid #000000;">
                <tr class="d-flex justify-content-between px-5">
                    <th>Title</th>
                    <th>Author</th>
                    <th>Copyright</th>
                </tr>
            </thead>
            <tbody class="w-100">
                <tr>
                    <td colspan="3" class="p-5" style="text-align: center"><h1>No records Found</h1></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
