<?php 
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'dct-ccs-finals';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}



function login($email, $password) 
{
    global $conn; 

    $errorPassword = "";

    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $conn->error;
        return false;
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();  
        if (md5($password) == $row['password']) {
            $_SESSION['email'] = $email;
            header('Location: admin/dashboard.php');
            exit;
        } else {
            $errorPassword .= '<li>Invalid Password.</li>';
        }

    } else {
        $errorPassword .= 'No user found with the provided email.';
    }

    if ($errorPassword != '') {
        return [
            'success' => false,
            'error' => $errorPassword
        ];
    }

    $stmt->close();

}

function loginValidation($email, $password)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $htmlError = "";
        if (empty($email)) {
            $htmlError .= '<li>Please Enter your email address.</li>';
        }

        if (empty($password)) {
            $htmlError .= '<li>Please enter your password.</li>';
        }

        if (!empty($htmlError)) {
            return [
                "success" => false,
                "error" => $htmlError
            ];
                
        } else {
            return [
                "success" => true,
            ];
        }
    }
    
}


function logout()
{
    unset($_SESSION['email']);
    header('Location: ../index.php');
}

function validateStudent($studentId, $studentFirstName, $studentLastName)
{
    global $conn;

    $htmlError = '';
    if (empty($studentId)) {
        $htmlError .= '<li>Student ID is required.</li>';
    }
    if (empty($studentFirstName)) {
        $htmlError .= '<li>Firstname is required.</li>';
    }
    if (empty($studentLastName)) {
        $htmlError .= '<li>Lastname is required.</li>';
    }
    
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $conn->error;
        return false;
    }
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();  
        if (($studentId) == $row['student_id']) {
            $htmlError .= '<li>Duplicate Student ID is not allowed.</li>';
        }
    }
    if (!empty($htmlError)) {
        return [
            "success" => false,
            "error" => $htmlError
        ];
            
    } else {
        $sql = "INSERT INTO students (student_id, first_name, last_name) VALUES ('$studentId', '$studentFirstName', '$studentLastName')";
        if ($conn->query($sql) === TRUE) {
            return [
                "success" => true,
            ];
        }  else {
            return [
                "success" => false,
                "error" => '<li>Not save.</li>'
            ];
        }
        
    }

}


function renderErrorMessages($htmlError)
{
    if ($htmlError != "") {
       return '<div id="errorContainer" class="card card-container p-0" style="background:none; border:none; box-shadow:none">
                                <div class="alert alert-danger" role="alert">
                                    <div class="position-relative">
                                        <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" onClick="hideError()"></button>
                                        <div style="font-size: 20px">
                                            System Error
                                        </div>
                                    <ul>   ' . $htmlError . ' </ul>
                                    </div>
                                </div>
                            </div>';
    } else {
        return '';
    }
}

function guard()
{
    if (empty($_SESSION['email'])) {
        header("location: ../index.php");
        exit;
    }
}

function checkUserSessionIsActive() 
{
    if (!empty($_SESSION['email'])) {
        if (!empty($_SESSION['page'])) {
            header("location:" .$_SESSION['page']);
            exit;
        }
    }
}

function editStudent($studentId, $studentFirstName, $studentLastName)
{
    global $conn;

    $htmlError = '';
    if (empty($studentId)) {
        $htmlError .= '<li>Student ID is required.</li>';
    }
    if (empty($studentFirstName)) {
        $htmlError .= '<li>Firstname is required.</li>';
    }
    if (empty($studentLastName)) {
        $htmlError .= '<li>Lastname is required.</li>';
    }

    if (!empty($htmlError)) {
        return [
            "success" => false,
            "error" => $htmlError
        ];
    } else {
        $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ? WHERE student_id = ?");
        $stmt->bind_param("ssi", $studentFirstName, $studentLastName, $studentId);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "error" => null
            ];
        } else {
            return [
                "success" => false,
                "error" => '<li>Unable to save changes. Please try again later.</li>'
            ];
        }

        $stmt->close();
    }
}

function deleteStudent($studentId)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        return [
            "success" => true,
            "error" => null
        ];
    } else {
        return [
            "success" => false,
            "error" => '<li>Unable to delete the student. Please try again later.</li>'
        ];
    }

    $stmt->close();

    
}

function validateSubject($subjectCode, $subjectName)
{
    global $conn;

    $htmlError = '';
    if (empty($subjectCode)) {
        $htmlError .= '<li>Subject Code is required.</li>';
    }
    if (empty($subjectName)) {
        $htmlError .= '<li>Subject Name is required.</li>';
    }
    
    $sql = "SELECT * FROM subjects WHERE subject_code = ? OR subject_name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error: " . $conn->error;
        return false;
    }

    $stmt->bind_param("ss", $subjectCode, $subjectName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($subjectCode == $row['subject_code']) {
                $htmlError .= '<li>Duplicate Subject Code is not allowed.</li>';
            }
            if ($subjectName == $row['subject_name']) {
                $htmlError .= '<li>Duplicate Subject Name is not allowed.</li>';
            }
        }
    }
  
    if (!empty($htmlError)) {
        return [
            "success" => false,
            "error" => $htmlError
        ];
            
    } else {
        $sql = "INSERT INTO subjects (subject_code, subject_name) VALUES ('$subjectCode', '$subjectName')";
        if ($conn->query($sql) === TRUE) {
            return [
                "success" => true,
            ];
        }  else {
            return [
                "success" => false,
                "error" => '<li>Not save.</li>'
            ];
        }
        
    }

}

function editSubject($subjectCode, $subjectName)
{
    global $conn;

    $htmlError = '';

    if (empty($subjectCode)) {
        $htmlError .= '<li>Subject Code is required.</li>';
    }
    if (empty($subjectName)) {
        $htmlError .= '<li>Subject Name is required.</li>';
    }

    if (!empty($htmlError)) {
        return [
            "success" => false,
            "error" => $htmlError
        ];
    }

    $sql = "SELECT * FROM subjects WHERE (subject_code = ? OR subject_name = ?) AND subject_code != ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [
            "success" => false,
            "error" => '<li>Database error: Unable to prepare the statement.</li>'
        ];
    }

    $stmt->bind_param("sss", $subjectCode, $subjectName, $subjectCode);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if ($subjectName === $row['subject_name']) {
            $htmlError .= '<li>Duplicate Subject Name is not allowed.</li>';
        }
    }

    $stmt->close();

    if (!empty($htmlError)) {
        return [
            "success" => false,
            "error" => $htmlError
        ];
    }
    
    $stmt = $conn->prepare("UPDATE subjects SET subject_name = ? WHERE subject_code = ?");
    if (!$stmt) {
        return [
            "success" => false,
            "error" => '<li>Database error: Unable to prepare the statement.</li>'
        ];
    }

    $stmt->bind_param("ss", $subjectName, $subjectCode);

    if ($stmt->execute()) {
        $stmt->close();
        return [
            "success" => true,
            "error" => null
        ];
    } else {
        $stmt->close();
        return [
            "success" => false,
            "error" => '<li>Unable to save changes. Please try again later.</li>'
        ];
    }
}

function deleteSubject($subjectCode)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $subjectCode);

    if ($stmt->execute()) {
        return [
            "success" => true,
            "error" => null
        ];
    } else {
        return [
            "success" => false,
            "error" => '<li>Unable to delete the subject. Please try again later.</li>'
        ];
    }

    $stmt->close();

    
}


?>