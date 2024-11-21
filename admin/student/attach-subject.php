<?php
    ob_start();
    include '../../functions.php';
    guard();

    $titlePage = "Attach Subject to Student";
    include '../partials/header.php';
    include '../partials/side-bar.php';

    global $conn;

    $errorMessages = "";
    $editId = $_GET['id'];
    $studentId ='';
    $studentFirstname = '';
    $studentLastname = '';

    $_SESSION['page'] = "admin/student/attach-subject.php?id=" . $editId;

    //save attach subject to students
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnStudent'])) {
        $submit = attachStudentToSubject($editId);
        if (!$submit['success']) {
            $errorMessages = $submit['error']; 
        } 
        
    }

    //display student's data
    $studentData = studentData($editId);
    if ($studentData['success']) {
        $studentId = $studentData['data']['student_id'];
        $studentFirstname = $studentData['data']['first_name'];
        $studentLastname = $studentData['data']['last_name'];
    } 


    // display checkbox subjects
    $subjectCheckbox = subjectCheckbox($editId);
    $result = $subjectCheckbox['data'];
    

    // display students subject and grade
    $resultSubjectsAndGrade = joinStudentAndSubject($editId);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">

<div class="container w-10 position-relative">
        <h4>Attach Subject to Student</h4>
        <div class="row mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="./register.php">Register Student</a></li>
                    <li class="breadcrumb-item" aria-current="page">Attach Subject to Student</li>
                </ol>
            </nav>
        </div>

        <form method="post" class="mt-4 p-3 border rounded p-5">
        <?php echo renderErrorMessages($errorMessages); ?>
            <label style="font-size: 20px">Selected Student Information</label>
            <ul>
                <li><span style="font-weight: bold"> Student ID: <span style="font-weight: normal"> <?php echo $studentId ?> </span></li>
                <li><span style="font-weight: bold"> Name: <span style="font-weight: normal"> <?php echo $studentFirstname . ' ' . $studentLastname ?> </span></li>

                <hr>
            </ul>

            <?php
                 if ($result->num_rows > 0) {
                    // Display checkboxes if subjects are available
                    while ($rowSubject = $result->fetch_assoc()) {
                        echo '<div class="form-check">
                                <input class="form-check-input" name="selected_ids[]" type="checkbox" value="' . $rowSubject['id'] . '">
                                <label class="form-check-label">
                                    ' . $rowSubject['subject_code'] . ' - ' . $rowSubject['subject_name'] . '
                                </label>
                              </div>';
                    }
                } else {
                    // Display message if no subjects are available
                    echo "<p class='text-muted'>No subject available to attach.</p>";
                }
            ?>

            <button type="submit" name="btnStudent" class="btn btn-primary mt-3 mb-5">Attach Subject</button>
        </form>

       

    <h4 class="mt-5">Student List</h4>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Subject Code</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Grade</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (!$resultSubjectsAndGrade) {
                    echo "<tr><td colspan='4'>Error: " . $conn->error . "</td></tr>";
                } else {
                    if ($resultSubjectsAndGrade->num_rows > 0) {
                        // Loop through the results and populate the table
                        while ($rowSubjectAndGrades = $resultSubjectsAndGrade->fetch_assoc()) {
                            echo "<tr>
                                <td>{$rowSubjectAndGrades['subject_code']}</td>
                                <td>{$rowSubjectAndGrades['subject_name']}</td>
                                <td>" . (!is_null($rowSubjectAndGrades['grade']) ? number_format($rowSubjectAndGrades['grade'], 2) : "N/A") . "</td>
                                <td>
                                    <a href='../student/dettach-subject.php?student_id={$rowSubjectAndGrades['student_id']}&subject_id={$rowSubjectAndGrades['subject_id']}' class='btn btn-danger'>Detach Subject</a>
                                    <a href='../student/assign-grade.php?student_id={$rowSubjectAndGrades['student_id']}&subject_id={$rowSubjectAndGrades['subject_id']}' class='btn btn-success'>Assign Grade</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        // No records found
                        echo "<tr><td colspan='4' class='text-center'>No subjects found.</td></tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</form>



<?php
include '../partials/footer.php';

?>