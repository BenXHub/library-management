<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['UserLogin'])) {
        header("Location: login.php");
        exit(); // Terminate script execution after redirecting
    }

    require_once("config/conn.php");

    $con = connection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $account_number = $_POST['account_number'];
        $title     = $_POST['title'];
        $author    = $_POST['author'];
        $publisher = $_POST['publisher'];
        $copyright = $_POST['copyright'];
        $edition   = $_POST['edition'];
        $fund      = $_POST['fund'];
        $year      = $_POST['year'];

        $sql = "INSERT INTO `book_list` (`account_number`, `title`, `author`, `publisher`, `copyright`, `edition`, `fund`, `year`)
                VALUES ('$account_number', '$title', '$author', '$publisher', '$copyright', '$edition', '$fund', '$year')";
        $result = $con->query($sql);

        // Check for query error
        if (!$result) {
            die("Error inserting data: " . $con->error);
        }

        header("Location: index.php");
        exit(); // Terminate script execution after redirecting
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
    <link rel="stylesheet" href="dist/bootstrap/css/bootstrap-morph.min.css">
</head>
<body>
    <div class="card mx-auto m-4" style="width: 85%;">
        <div class="card-body">
            <fieldset>
                <legend><b>Adding Book Form</b></legend>
                <form action="" method="post" id="addBookForm" class="w-100">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-lg mt-3" for="account_number">Acc. No.</label>
                        <input type="number" name="account_number" id="account_number" class="form-control form-control-lg" placeholder="Enter Account Number" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="author">Author</label>
                        <input type="text" name="author" id="author" class="form-control form-control-lg" placeholder="Enter Author" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="publisher">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control form-control-lg" placeholder="Enter Publisher" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="copyright">Copyright</label>
                        <input type="number" name="copyright" id="copyright" class="form-control form-control-lg" placeholder="Enter Copyright" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="edition">Edition</label>
                        <input type="text" name="edition" id="edition" class="form-control form-control-lg" placeholder="Enter Edition" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="fund">Fund</label>
                        <input type="number" name="fund" id="fund" class="form-control form-control-lg" placeholder="Enter Fund" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="year">Year</label>
                        <input type="number" name="year" id="year" class="form-control form-control-lg" placeholder="Enter Year" autocomplete="off">

                        <div class="d-flex justify-content-end mt-4">
                            <a class="btn btn-secondary btn-lg me-2" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</a>
                            <button class="btn btn-primary btn-lg me-2" type="button" id="addButton">Add</button>
                            <input class="btn btn-primary btn-lg d-none" type="submit" name="submit" value="Add" id="submitButton">
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
    <!-- Cancel Modal -->
    <div class="modal fade mt-5" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-primary" href="index.php">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade mt-5" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to add the book?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit" form="addBookForm">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addButton').addEventListener('click', function() {
            $('#addModal').modal('show'); // Show the modal dialog
        });

        // Submit the form when the modal's "Add" button is clicked
        document.getElementById('addModal').addEventListener('click', function(event) {
            if (event.target.classList.contains('add-modal-confirm')) {
                document.getElementById('submitButton').click(); // Trigger form submission
            }
        });
    </script>
    <script src="dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/bootstrap/js/jquery-3.6.0.min.js"></script>
</body>
</html>
