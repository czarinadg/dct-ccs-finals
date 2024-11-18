<?php
    ob_start();
    include '../../functions.php';
    guard();

    $titlePage = "Delete Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $_SESSION['page'] = "admin/subject/delete.php";

    global $conn;
    $errorMessages = "";
    $deleteId = $_GET['id'];

    //this is for delete
    if (isset($_POST['btnSubject'])) {
    
        $validate = deleteSubject($deleteId);
    
        if (!$validate['success']) {
            $errorMessages = $validate['error'];
        } else {
            header("location: ./add.php");
            exit;
        }
    }
    

    //this is for display
    $subjectCode ='';
    $subjectName = '';

    $sql = "SELECT * FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $conn->error;
        return false;
    }
    $stmt->bind_param("s", $deleteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); 
        $subjectCode = $row['subject_code'];
        $subjectName = $row['subject_name'];
    }

    ob_end_flush();

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
                <li><span style="font-weight: bold"> Subject Code: <?php echo $subjectCode ?> </span></li>
                <li><span style="font-weight: bold"> Subject Name: <?php echo $subjectName ?></li>
            </ul>
            <a href="add.php" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="btnSubject">Delete Subject Record</button>
        </form>

<?php
include '../partials/footer.php';

?>