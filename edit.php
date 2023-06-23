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

    $id = $_GET['ID'];

    $sql   = "SELECT * FROM book_list WHERE id = '$id'";
    $books = $con->query($sql) or die($con->error);
    $row   = $books->fetch_assoc();

    if (isset($_POST['submit'])) {
        $accNumber = $_POST['account_number'];
        $title     = $_POST['title'];
        $author    = $_POST['author'];
        $publisher = $_POST['publisher'];
        $copyright = $_POST['copyright'];
        $edition   = $_POST['edition'];
        $fund      = $_POST['fund'];
        $year      = $_POST['year'];

        $sql = "UPDATE book_list SET account_number='$accNumber', title='$title', author='$author', publisher='$publisher', copyright='$copyright', edition='$edition', fund='$fund', year='$year' WHERE id='$id'";
        $result = $con->query($sql);
        $con->query($sql) or die ($con->error);

        header("Location: details.php?ID=".$id);
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
            <legend><u>Edit Book Form</u></legend>
            <form action="" method="post" id="addBookForm" class="w-100">
                <div class="form-group">
                    <label class="col-form-label col-form-label-lg mt-2" for="account_number">Acc. No.</label>
                    <input type="number" name="account_number" id="account_number" class="form-control form-control-lg" value="<?php echo $row['account_number'];?>" placeholder="Enter Account Number" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control form-control-lg" value="<?php echo $row['title'];?>" placeholder="Enter Title" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="author">Author</label>
                    <input type="text" name="author" id="author" class="form-control form-control-lg"value="<?php echo $row['author'];?>" placeholder="Enter Author" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="publisher">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="form-control form-control-lg"value="<?php echo $row['publisher'];?>" placeholder="Enter Publisher" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="copyright">Copyright</label>
                    <input type="number" name="copyright" id="copyright" class="form-control form-control-lg"value="<?php echo $row['copyright'];?>" placeholder="Enter Copyright" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="edition">Edition</label>
                    <input type="text" name="edition" id="edition" class="form-control form-control-lg"value="<?php echo $row['edition'];?>" placeholder="Enter Edition" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="fund">Fund</label>
                    <input type="number" name="fund" id="fund" class="form-control form-control-lg" value="<?php echo $row['fund'];?>" placeholder="Enter Fund" autocomplete="off">

                    <label class="col-form-label col-form-label-lg mt-2" for="year">Year</label>
                    <input type="number" name="year" id="year" class="form-control form-control-lg" value="<?php echo $row['year'];?>" placeholder="Enter Year" autocomplete="off">

                    <div class="d-flex justify-content-end mt-3">
                        <a class="btn btn-secondary btn-lg me-2" href="#" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</a>
                        <button class="btn btn-primary btn-lg me-2" type="button" id="addButton">Update</button>
                        <input class="btn btn-primary btn-lg d-none" type="submit" name="submit" value="Update" id="submitButton">
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
                <a class="btn btn-primary" href="details.php?ID=<?php echo $row['id'] ?>">Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to edit the data of this book?
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
