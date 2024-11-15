<?php
$titlePage = "Register Student";
include '../partials/header.php';
include '../partials/side-bar.php';
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="container w-10 position-relative">
        <h4>Register a New Student</h4>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <div class="form-group mb-3">
                <input type="text" name="student_id" class="form-control" id="studentId" placeholder="Student ID ">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name">
            </div>
            <button type="submit" name="btnStudent" class="btn btn-primary w-100">Add Student</button>
        </form>
        <form class="mt-4 p-3 border rounded p-5">
    <h4>Student List</h4>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1001</td>
                <td>Renmark</td>
                <td>Salalila</td>
                <td>
                    <a href="../student/edit.php" class="btn btn-info">Edit</a href="">
                    <a href="../student/delete.php" class="btn btn-danger">Delete</a href="">
                    <a href="../student/attach-subject.php" type="button" class="btn btn-warning">Attach Subject</a href="">
                </td>
            </tr>
        </tbody>
    </table>
</form>


<?php
include '../partials/footer.php';

?>