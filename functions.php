<?php 

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
        if ($password == $row['password']) {
            $_SESSION['email'] == $email;
            header('Location: admin/dashboard.php');
            exit;
    } else {
        echo "Invalid password.";
        return false;
    }

} else {
    echo "No user found with the provided email.";
    return false;
}

$stmt->close();

}

?>