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

function logout()
{
    unset($_SESSION['email']);
    header('Location: ../index.php');
}

?>