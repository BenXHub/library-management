<?php

    require_once("config/conn.php");

    $con = connection();
    
    $id = $_GET['ID'];

    // Fetch book title from the database based on the ID
    $sql       = "SELECT title FROM book_list WHERE id = '$id'";
    $result    = $con->query($sql);
    $row       = $result->fetch_assoc();
    $BookTitle = $row['title'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $Firstname     = $_POST['Firstname'];
        $Lastname      = $_POST['Lastname'];
        $YearLevel     = $_POST['YearLevel'];
        $Course_Strand = $_POST['Course_Strand'];
        $ContactNo     = $_POST['ContactNo'];
        $BookTitle     = $_POST['BookTitle'];

        $sql = "INSERT INTO `borrower`(`Firstname`, `Lastname`, `YearLevel`, `Course_Strand`, `ContactNo`, `BookTitle`) 
        VALUES ('$Firstname','$Lastname','$YearLevel','$Course_Strand','$ContactNo','$BookTitle')";

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
                <legend><b>Book Slip</b></legend>
                <form action="" method="post" id="addBookForm" class="w-100">
                    <div class="form-group">
                        
                        <label class="col-form-label col-form-label-lg mt-3" for="Firstname">Firstname</label>
                        <input type="text" name="Firstname" id="Firstname" class="form-control form-control-lg" placeholder="Enter Firstname" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="Lastname">Lastname</label>
                        <input type="text" name="Lastname" id="Lastname" class="form-control form-control-lg" placeholder="Enter Lastname" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="YearLevel">Year Level</label>
                        <input type="number" name="YearLevel" id="YearLevel" class="form-control form-control-lg" placeholder="Enter Year Level" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="Course_Strand">Course/Strand</label>
                        <input type="text" name="Course_Strand" id="Course_Strand" class="form-control form-control-lg" placeholder="Enter Course/Strand" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="ContactNo">Contact No</label>
                        <input type="number" name="ContactNo" id="ContactNo" class="form-control form-control-lg" placeholder="Enter Contact No" autocomplete="off">

                        <label class="col-form-label col-form-label-lg mt-3" for="BookTitle">Book Title</label>
                        <input type="text" name="BookTitle" id="BookTitle" class="form-control form-control-lg" placeholder="Enter Book Title" autocomplete="off" value="<?php echo $BookTitle; ?>">
                        
                        <br>
                        <p class="text-center"><b><i>Note:</b> *** Please ensure that the borrowed book is returned within <b>three (3) days</b> from the date of borrowing. As part of the borrowing process, we kindly ask that you leave your ID with our library staff during this period. Please be assured that your ID will be securely stored and returned to you once the book is successfully returned. Thank you. *** </i></p>

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
                    Are you sure you want to borrow the book?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit" form="addBookForm" onclick="handleFormSubmit()">
                </div>
            </div>
        </div>
    </div>

    <script>
    function handleFormSubmit() {
            $.ajax({
                url: "request.php",
                type: "POST",
                data: $("#addBookForm").serialize(),
                success: function (response) {
                    // Show success notification
                    showNotification("Request successfully sent!");
                },
                error: function (xhr, status, error) {
                    // Show error notification
                    showNotification("Your request wasn't sent. Please try again later.");
                }
            });
        }

        function showNotification(message) {
            // Replace this with your preferred notification method (e.g., using a library like Bootstrap Notify)
            alert(message);
        }
    </script>
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
