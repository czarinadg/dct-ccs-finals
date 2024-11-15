<?php
$titlePage = "Delete Subject";
include '../partials/header.php';
include '../partials/side-bar.php';
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="container w-10 position-relative">
        <h3>Delete Subject</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="add.php">Add Subject</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <label style="font-size: 15px">Are you sure you want to delete the following subject record?</label>
            <ul>
                <li><span style="font-weight: bold"> Subject Code:</li>
                <li><span style="font-weight: bold"> Subject Name:</li>
            </ul>
            <a href="../subject/add.php" class="btn btn-secondary btn-sm">Cancel</a>
            <a href="" type="submit" class="btn btn-primary btn-sm" name="btnSubject">Delete Subject Record</a>
        </form>

<?php
include '../partials/footer.php';

?>