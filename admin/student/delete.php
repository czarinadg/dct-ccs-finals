<?php
    ob_start();
    include '../../functions.php';
    guard();

    $titlePage = "Delete Student Record";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $_SESSION['page'] = "admin/student/edit.php";

    global $conn;
    $errorMessages = "";
    $deleteId = $_GET['id'];

    //this is for delete
    if (isset($_POST['btnStudent'])) {
    
        $validate = deleteStudent($deleteId);
    
        if (!$validate['success']) {
            $errorMessages = $validate['error'];
        } else {
            header("location: ./register.php");
            exit;
        }
    }
    

    //this is for display
    $studentId ='';
    $studentFirstname = '';
    $studentLastname = '';

    $sql = "SELECT * FROM students WHERE id = ?";
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
        $studentId = $row['student_id'];
        $studentFirstname = $row['first_name'];
        $studentLastname = $row['last_name'];
    }

    ob_end_flush();
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
                <li><span style="font-weight: bold"> Student ID: <span style="font-weight:normal"> <?php echo $studentId ?> </span></li>
                <li><span style="font-weight: bold"> First Name: <span style="font-weight:normal"> <?php echo $studentFirstname ?> </span></li>
                <li><span style="font-weight: bold"> Last Name: <span style="font-weight:normal"> <?php echo $studentLastname ?> </span></li>
            </ul>
            <a href="register.php" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="btnStudent">Delete Student Record</button>
        </form>

<?php
include '../partials/footer.php';

?>