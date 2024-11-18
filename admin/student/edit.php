<?php
    ob_start();
    include '../../functions.php';
    guard();
    
    $titlePage = "Edit Student Record";
    include '../partials/header.php';
    include '../partials/side-bar.php';
   
    $_SESSION['page'] = "admin/student/edit.php";

    global $conn;
    $errorMessages = "";

    //this is for saving edit
    if (isset($_POST['btnStudent'])) {
        $studentId = $_POST['student_id'];
        $studentFirstName = $_POST['first_name'];
        $studentLastName = $_POST['last_name'];
    
        $validate = editStudent($studentId, $studentFirstName, $studentLastName);
    
        if (!$validate['success']) {
            $errorMessages = $validate['error'];
        } else {
            header("location: ./register.php");
            exit;
        }
    }
    
    
    //this is for display
    $editId = $_GET['id'];
    $studentId ='';
    $studentFirstname = '';
    $studentLastname = '';

    $sql = "SELECT * FROM students WHERE id = ?";
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
        $studentId = $row['student_id'];
        $studentFirstname = $row['first_name'];
        $studentLastname = $row['last_name'];
    }

    ob_end_flush();
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
            <?php echo renderErrorMessages($errorMessages); ?>
            <div class="form-group mb-3">
                <input type="text" name="student_id" class="form-control" id="studentId" placeholder="Student ID " value="<?php echo $studentId ?>" readonly>
            </div>
            <div class="form-group mb-3">
                <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $studentFirstname ?>">
            </div>
            <div class="form-group mb-3">
                <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $studentLastname ?>">
            </div>
            <button type="submit" name="btnStudent" class="btn btn-primary w-100">Update Student</button>
        </form>
 


<?php
include '../partials/footer.php';

?>