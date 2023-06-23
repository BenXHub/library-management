<?php

    require_once("config/conn.php");
    require_once("navbar.php");

    $con = connection();

    $sql      = "SELECT * FROM borrower";
    $borrower = $con->query($sql) or die($con->error);
    $row      = $borrower->fetch_assoc();
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
    <div class="table">
        <table class="table table-hover table-light mx-auto m-4" style="width: 95%;">
            <thead class="w-100" style="border-bottom: 2px solid #000000;">
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Year Level</th>
                <th>Course/Strand</th>
                <th>Contact No</th>
                <th>Book Title</th>
                <th>Date of Borrowing</th>
                <th>Date of Return</th>
            </tr>
            </thead>
            <tbody class="w-100">
            <?php
            if ($row !== null) {
                do {
                    ?>
                    <tr>
                        <td><?php echo $row['Firstname']; ?></td>
                        <td><?php echo $row['Lastname']; ?></td>
                        <td><?php echo $row['YearLevel']; ?></td>
                        <td><?php echo $row['Course_Strand']; ?></td>
                        <td><?php echo $row['ContactNo']; ?></td>
                        <td><?php echo $row['BookTitle']; ?></td>
                        <td><?php echo $row['Created_at']; ?></td>
                        <td><?php echo $row['Updated_at']; ?></td>
                    </tr>
                    <?php
                } while ($row = $borrower->fetch_assoc());
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
