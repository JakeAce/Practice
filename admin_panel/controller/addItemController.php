<?php
include_once "../config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProductName = $_POST['p_name'];
    $desc = $_POST['p_desc'];
    $price = $_POST['p_price'];
    $category = $_POST['category'];
    $top_sale = isset($_POST['top_sale']) ? 1 : 0;

    $name = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $upload_dir = "../uploads/";
    $image_path = "./uploads/" . $name;
    $final_path = $upload_dir . $name;

    if (move_uploaded_file($temp, $final_path)) {
        $sql = "INSERT INTO product (product_name, product_image, price, product_desc, category_id, top_sale)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $ProductName, $image_path, $price, $desc, $category, $top_sale);

        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Database error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "Invalid request method.";
}
?>
