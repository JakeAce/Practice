<?php
include_once "../config/dbconnect.php";
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['record']) || !is_numeric($_POST['record'])) {
    echo json_encode(["status" => "error", "message" => "Invalid order ID"]);
    exit;
}

$order_id = intval($_POST['record']);
$sql = "SELECT pay_status FROM orders WHERE order_id = $order_id";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Order not found"]);
    exit;
}

$row = $result->fetch_assoc();
$newStatus = $row['pay_status'] == 1 ? 0 : 1;
$update = $conn->query("UPDATE orders SET pay_status = $newStatus WHERE order_id = $order_id");

if ($update) {
    echo json_encode(["status" => "success", "newStatus" => $newStatus]);
} else {
    echo json_encode(["status" => "error", "message" => "Update failed"]);
}
?>
