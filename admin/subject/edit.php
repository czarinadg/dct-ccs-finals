<?php
    ob_start();
    include '../../functions.php';
    guard();

    $titlePage = "Edit Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $_SESSION['page'] = "admin/subject/edit.php";

    global $conn;
    $errorMessages = "";

    //this is for saving edit
    if (isset($_POST['btnSubject'])) {
        $subjectCode = $_POST['subject_code'];
        $subjectName = $_POST['subject_name'];
    
        $validate = editSubject($subjectCode, $subjectName);
    
        if (!$validate['success']) {
            $errorMessages = $validate['error'];
        } else {
            header("location: ./add.php");
            exit;
        }
    }
    
    
    //this is for display
    $editId = $_GET['id'];
    $subjectCode ='';
    $subjectName = '';

    $sql = "SELECT * FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $conn->error;
        return false;
    }
    $stmt->bind_param("s", $editId);
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
        <?php echo renderErrorMessages($errorMessages); ?>
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="subjectCode" placeholder="Subject ID" name="subject_code" value="<?php echo $subjectCode ?>" readonly>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="subjectName" placeholder="Subject Name" name="subject_name" value="<?php echo $subjectName ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btnSubject">Update Subject</button>
        </form>


<?php
include '../partials/footer.php';

?>