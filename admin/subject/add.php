<?php
    $titlePage = "Add Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5"> 
<div class="container w-10 position-relative">
        <h3>Add a new Subject</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <div class="form-group mb-3">
                <label for="exampleInputSubjectCode">Subject Code</label>
                <input type="text" class="form-control" id="exampleInputCode" name="subject_code" placeholder="Enter Subject Code">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputSubjectName">Subject Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="subject_name" placeholder="Enter Subject Name">
            </div>
            <button type="submit" name="btnSubject" class="btn btn-primary w-100">Add Subject</button>
        </form>

        <div class="mt-4 p-3 border rounded p-5">
            <h4>Subject List</h4>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Option</th> 
                    </tr>
                </thead>
            <tbody>
            <tr>
                <td>1001</td>
                <td>English</td>
                <td>
                    <a href="" class="btn btn-info">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                </td>
            </tr>
                </tbody>
            </table>
        </div>


<?php
    include '../partials/footer.php';
?>