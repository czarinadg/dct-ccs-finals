<?php
    $titlePage = "Attach Subject to Student";
    include '../partials/header.php';
    include '../partials/side-bar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">

<div class="container w-10 position-relative">
        <h4>Attach Subject to Student</h4>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <label style="font-size: 20px">Selected Student Information</label>
            <ul>
                <li><span style="font-weight: bold"> Subject Code:</li>
                <li><span style="font-weight: bold"> Subject Name:</li>

                <hr>
            </ul>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    1001 - English
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    1002 - Mathematics
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    1003 - Science
                </label>
            </div>

            <button type="submit" name="btnStudent" class="btn btn-primary mt-3 mb-5">Attach Subject</button>
        </form>

       

    <h4 class="mt-5">Student List</h4>
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
                <td>English</td>
                <td>99.00</td>
                <td>
                    <a href="../student/dettach-subject.php" type="button" class="btn btn-danger">Detach Subject</a>
                    <a href="../student/assign-grade.php" type="button" class="btn btn-success">Assign Grade</a>
                </td>
            </tr>
        </tbody>
    </table>
</form>



<?php
include '../partials/footer.php';

?>