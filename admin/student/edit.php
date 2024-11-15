<?php
    $titlePage = "Edit Student Record";
    include '../partials/header.php';
    include '../partials/side-bar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
<div class="container w-10 position-relative">
        <h3>Edit Student</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <div class="form-group mb-3">
                <input type="text" name="student_id" class="form-control" id="studentId" placeholder="Student ID " value="" readonly>
            </div>
            <div class="form-group mb-3">
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" value="">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" value="">
            </div>
            <button type="submit" name="btnStudent" class="btn btn-primary w-100">Update Student</button>
        </form>
 


<?php
include '../partials/footer.php';

?>