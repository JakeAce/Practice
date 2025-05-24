<?php
include_once "../config/dbconnect.php";  // Include the DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collecting form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];

    // Prepare and execute SQL query to insert new customer
    $stmt = $conn->prepare("INSERT INTO costumer (first_name, last_name, email, contact_no, isAdmin, registered_at) VALUES (?, ?, ?, ?, 0, NOW())");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $contact_no);

    if ($stmt->execute()) {
        // Redirect to the customer list page or refresh the page to show the new customer
        header("Location: viewCustomers.php");  // Change to the page where your table is
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='admin.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
