<?php
    include '../../functions.php';
    guard();

    $titlePage = "Add Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $_SESSION['page'] = "admin/subject/add.php";

    global $conn;

    $errorMessages = "";

    if (isset($_POST['btnSubject'])) {
        $subjectCode = $_POST['subject_code'];
        $subjectName = $_POST['subject_name'];

        $validate = validateSubject($subjectCode, $subjectName);
        if (!$validate['success']) {
            $errorMessages = $validate['error']; 
        } 

        
    }

    $sql = "SELECT * FROM subjects";
    $result = $conn->query($sql);



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
        <?php echo renderErrorMessages($errorMessages); ?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="exampleInputCode" name="subject_code" placeholder="Enter Subject Code">
                <label for="exampleInputCode">Subject Code</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="exampleInputName" name="subject_name" placeholder="Enter Subject Name">
                <label for="exampleInputName">Subject Name</label>
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
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $row['subject_code']. '</td>
                            <td>' . $row['subject_name']. '</td>
                            <td>
                                <a href="edit.php?id=' .$row['id']. '" class="btn btn-info">Edit</a>
                                <a href="delete.php?id=' .$row['id']. '" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>';
                }
            ?>
                
            
            <!-- <tr>
                <td>1001</td>
                <td>English</td>
                <td>
                    <a href="../subject/edit.php" class="btn btn-info">Edit</a>
                    <a href="../subject/delete.php" class="btn btn-danger">Delete</a>
                </td>
            </tr> -->
                </tbody>
            </table>
        </div>


<?php
    include '../partials/footer.php';
?>