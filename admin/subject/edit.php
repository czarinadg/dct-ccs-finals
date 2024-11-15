<?php
$titlePage = "Edit Subject";
include '../partials/header.php';
include '../partials/side-bar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="container w-10 position-relative">
        <h3>Edit Subject</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="add.php">Add Subject</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="subjectCode" placeholder="Subject ID" name="subject_code" value="" readonly>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="subjectName" placeholder="Subject Name" name="subject_name" value="">
            </div>
            <a href="../subject/add.php" type="submit" class="btn btn-primary w-100" name="btnSubject">Update Subject</a>
        </form>


<?php
include '../partials/footer.php';

?>