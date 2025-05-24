<?php
include_once "../config/dbconnect.php";

if (!isset($_GET['orderID'])) {
    echo "<div class='alert alert-danger'>Error: No order ID provided.</div>";
    exit;
}

$orderID = $_GET['orderID'];

$sql = "
SELECT 
    order_id,
    delivered_to,
    phone_no,
    deliver_address,
    pay_method,
    pay_status,
    order_status,
    order_date
FROM orders
WHERE order_id = '$orderID'";

$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-warning'>Order not found.</div>";
    exit;
}

$order = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<div class="card shadow p-4">
    <h4 class="mb-4 text-primary">
        <i class="fas fa-receipt"></i> Order #<?= $order['order_id']; ?>
    </h4>
    
    <table class="table table-borderless table-hover">
        <tr>
            <th><i class="fas fa-user"></i> Customer Name</th>
            <td><?= htmlspecialchars($order['delivered_to']); ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-phone-alt"></i> Phone Number</th>
            <td><?= htmlspecialchars($order['phone_no']); ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-map-marker-alt"></i> Delivery Address</th>
            <td><?= htmlspecialchars($order['deliver_address']); ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-calendar-alt"></i> Order Date</th>
            <td><?= $order['order_date']; ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-wallet"></i> Payment Method</th>
            <td><?= htmlspecialchars($order['pay_method']); ?></td>
        </tr>
        <tr>
            <th><i class="fas fa-money-check-alt"></i> Payment Status</th>
            <td>
                <?= $order['pay_status'] == 1 
                    ? '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Paid</span>' 
                    : '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Unpaid</span>'; ?>
            </td>
        </tr>
        <tr>
            <th><i class="fas fa-shipping-fast"></i> Order Status</th>
            <td>
                <?= $order['order_status'] == 1 
                    ? '<span class="badge badge-success"><i class="fas fa-box"></i> Delivered</span>' 
                    : '<span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>'; ?>
            </td>
        </tr>
    </table>
</div>


