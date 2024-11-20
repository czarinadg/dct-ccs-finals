<?php
    ob_start();
    include '../../functions.php';
    guard();


    $titlePage = "Dettach Subject from Student";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    $studentId = $_GET['student_id'];
    $subjectId = $_GET['subject_id'];

    $_SESSION['page'] = "admin/student/dettach-subject.php?student_id=" .$studentId. "&subject_id=" . $subjectId; 

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnStudent'])) {
        dettachSubjectToStudent($studentId, $subjectId);
    }
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
<div class="container w-10 position-relative">
        <h3>Delete a Student</h3>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="./attach-subject.php?id=<?php echo  $studentId ?>"> Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
            <label style="font-size: 15px">Are you sure you want to delete the following student record?</label>
            <ul>
                <li><span style="font-weight: bold"> Student ID:<span style="font-weight: normal"> <?php echo $studentCode ?></span> </li>
                <li><span style="font-weight: bold"> First Name: <span style="font-weight: normal"><?php echo $studentFirstname ?></span> </li>
                <li><span style="font-weight: bold"> Last Name: <span style="font-weight: normal"><?php echo $studentLastname ?> </span></li>
                <li><span style="font-weight: bold"> Subject Code: <span style="font-weight: normal"><?php echo $subjectCode ?> </span></li>
                <li><span style="font-weight: bold"> Subject Name: <span style="font-weight: normal"><?php echo $subjectName ?>  </span></li>
            </ul>
            <a href="./attach-subject.php?id=<?php echo $studentId ?>" class="btn btn-secondary btn-sm">Cancel</a>
            <button type="submit" class="btn btn-primary btn-sm" name="btnStudent">Dettach Subject from Student</button>
        </form>


<?php
include '../partials/footer.php';

?>