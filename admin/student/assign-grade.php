<?php
    $titlePage = "Assign Grade to Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
<div class="container w-10 position-relative">
        <h3>Delete a Student</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="../student/register.php"> Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <label style="font-size: 15px">Are you sure you want to delete the following student record?</label>
            <ul>
                <li><span style="font-weight: bold"> Student ID:</li>
                <li><span style="font-weight: bold"> Name:</li>
                <li><span style="font-weight: bold"> Subject Code:</li>
                <li><span style="font-weight: bold"> Subject Name:</li>
            </ul>
            <hr>
            <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Grade" aria-label="Grade">
            </div>

            <a href="../student/attach-subject.php" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="btnStudent">Assign Grade to Subject</button>
        </form>


<?php
include '../partials/footer.php';

?>