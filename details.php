<?php
session_start();

// Check if user is logged in
$loggedInUser = isset($_SESSION['UserLogin']) ? $_SESSION['UserLogin'] : "Guest";

require_once("config/conn.php");
$con = connection();

$id = $_GET['ID'];

$sql   = "SELECT * FROM book_list WHERE id = '$id'";
$books = $con->query($sql) or die($con->error);
$row   = $books->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACLC Iriga Library</title>

    <link rel="icon" href="img/oldBook.png">
    <link rel="stylesheet" href="dist/bootstrap/css/bootstrap-morph.min.css">
    <style>
        body {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 70%;
        }

        .book-image {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            /*padding: 5%;*/
            margin: 12% 0 12% 0;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-body h6,
        .card-body h2,
        .card-body h5 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mb-3" style="width: 100%; height: 100%">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="./img/defaultBook.jpg" class="img-fluid rounded-start book-image" alt="Book Cover">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h6>Account No. <?php echo $row['account_number']; ?></h6>
                        <h2 class="mt-3">Title: <b><?php echo $row['title']; ?></b></h2>
                        <h5 class="mt-3">Author: <b><?php echo $row['author']; ?></b></h5>
                        <h5 class="mt-2">Publisher: <b><?php echo $row['publisher']; ?></b></h5>
                        <h6 class="mt-2">Copyright <b><?php echo $row['copyright']; ?></b></h6>
                        <div class="d-flex ms-auto justify-content-between mt-4">
                        <h6 class="me-5">Edition: <?php echo $row['edition']; ?></h6>
                        <h6 class="me-5">Fund: <?php echo $row['fund']; ?></h6>
                        <h6>Year: <?php echo $row['year']; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-container">
            <a href="index.php" class="btn btn-primary me-2">Back</a>
            
            <?php if (isset($_SESSION['Access']) && $_SESSION['Access'] === 'admin') : ?>
                <a href="edit.php?ID=<?php echo $row['id'] ?>" class="btn btn-primary me-2">Edit</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
            <?php else : ?>
                <a href="borrow.php?ID=<?php echo $row['id'] ?>" class="btn btn-primary me-2">Borrow</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade mt-5" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the data of this book?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="delete.php" method="post" id="deleteBookForm" style="display: inline-block;">
                        <button type="submit" name="delete" id="submitButton" class="btn btn-primary">Yes</button>
                        <input type="hidden" name="ID" value="<?php echo $row['id'] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./dist/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
