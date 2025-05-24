<?php
include_once "../config/dbconnect.php";

$product_id = $_POST['product_id'];
$p_name = $_POST['p_name'];
$p_desc = $_POST['p_desc'];
$p_price = $_POST['p_price'];
$category = $_POST['category'];
$top_sale = isset($_POST['top_sale']) ? intval($_POST['top_sale']) : 0; // default to 0 if not set

// Handle image upload/update
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $location = "./uploads/";
    $img = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $dir = '../uploads/';
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');

    if (in_array($ext, $valid_extensions)) {
        $image = rand(1000, 1000000) . "." . $ext;
        $final_image = $location . $image;
        move_uploaded_file($tmp, $dir . $image);
    } else {
        // Invalid image extension, fallback to existing image or handle error
        $final_image = $_POST['existingImage'];
    }
} else {
    // No new image uploaded, use existing
    $final_image = $_POST['existingImage'];
}

// Run the update query
$updateItem = mysqli_query($conn, "UPDATE product SET 
    product_name = '$p_name', 
    product_desc = '$p_desc', 
    price = $p_price,
    category_id = $category,
    product_image = '$final_image',
    top_sale = $top_sale
    WHERE product_id = $product_id");

if ($updateItem) {
    echo "Product updated successfully!";
} else {
    echo "Error updating product: " . mysqli_error($conn);
}
?>

