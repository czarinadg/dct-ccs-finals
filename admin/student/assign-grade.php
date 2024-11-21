<?php
    ob_start();
    include '../../functions.php';
    guard();
    
    $titlePage = "Assign Grade to Subject";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $studentId = $_GET['student_id'];
    $subjectId = $_GET['subject_id'];

    $_SESSION['page'] = "admin/student/assign-grade.php?student_id=" .$studentId. "&subject_id=" . $subjectId;

    $errorMessages = "";

    global $conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnStudent'])) {
        $grade = $_POST['grade'];
        $validate = attachGradeToStudentSubject($studentId, $subjectId, $grade);
        if (!$validate['success']) {
            $errorMessages = $validate['error']; 
        } 
    }

    $studentData = studentData($studentId);
    if ($studentData['success']) {
        $studentCode = $studentData['data']['student_id'];
        $studentFirstname = $studentData['data']['first_name'];
        $studentLastname = $studentData['data']['last_name'];
    } 

    $subjectData = subjectData($subjectId);
    if ($subjectData['success']) {
        $subjectCode = $subjectData['data']['subject_code'];
        $subjectName = $subjectData['data']['subject_name'];
    } 

   
   

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
<div class="container w-10 position-relative">
        <h3>Delete a Student</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="./register.php"> Register Student</a></li>
                    <li class="breadcrumb-item"><a href="./attach-subject.php?id=<?php echo  $studentId ?>">Add Subject to Students</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
        <?php echo renderErrorMessages($errorMessages); ?>
            <label style="font-size: 15px">Are you sure you want to delete the following student record?</label>
            <ul>
                <li><span style="font-weight: bold"> Student ID: <span style="font-weight: normal"> <?php echo $studentCode ?></span></li>
                <li><span style="font-weight: bold"> Name: <span style="font-weight: normal"> <?php echo $studentFirstname . ' ' . $studentLastname ?></span></li>
                <li><span style="font-weight: bold"> Subject Code: <span style="font-weight: normal"> <?php echo $subjectCode ?></span></li>
                <li><span style="font-weight: bold"> Subject Name: <span style="font-weight: normal"> <?php echo $subjectName ?></span></li>
            </ul>
            <hr>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="grade" id="grade" placeholder="Grade" aria-label="Grade" min="0.00" max="100.00">
                <label for="grade">Grade</label>
            </div>

            <a href="./attach-subject.php?id=<?php echo $studentId ?>" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="btnStudent">Assign Grade to Subject</button>
        </form>


<?php
include '../partials/footer.php';

?>