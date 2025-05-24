<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swiss_collection";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password_input = $_POST['password'];

    // Use the correct table and fields
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name, password, isAdmin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $first_name, $last_name, $hashed_password, $isAdmin);
        $stmt->fetch();

        if (password_verify($password_input, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['isAdmin'] = $isAdmin;

            // Redirect based on isAdmin value
            if ($isAdmin == 1) {
                header("Location: admin.php");
            } else {
                header("Location: user.php");
            }
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid email or password!'); window.location.href='index.php';</script>";
        }
    } else {
        // Email not found
        echo "<script>alert('Invalid email or password!'); window.location.href='index.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

