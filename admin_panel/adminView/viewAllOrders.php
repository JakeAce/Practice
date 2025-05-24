<?php include_once "../config/dbconnect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Order Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>

  <div class="container mt-4">
    <div class="card shadow-lg">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-shopping-cart"></i> Order Details</h3>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="thead-light">
              <tr>
                <th>O.N.</th>
                <th>Customer</th>
                <th>Contact</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>More Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM orders";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
              ?>
                  <tr>
                    <td><?= $row["order_id"] ?></td>
                    <td><?= htmlspecialchars($row["delivered_to"]) ?></td>
                    <td><?= htmlspecialchars($row["phone_no"]) ?></td>
                    <td><?= $row["order_date"] ?></td>
                    <td><?= htmlspecialchars($row["pay_method"]) ?></td>

                    <!-- Order Status -->
                    <td>
                      <button class="btn btn-sm <?= $row["order_status"] == 1 ? 'btn-success' : 'btn-warning' ?>"
                        onclick="ChangeOrderStatus('<?= $row['order_id'] ?>')">
                        <i class="fas <?= $row["order_status"] == 1 ? 'fa-check-circle' : 'fa-clock' ?>"></i>
                        <?= $row["order_status"] == 1 ? 'Delivered' : 'Pending' ?>
                      </button>

                    </td>

                    <!-- Payment Status -->
                    <td>
                      <button class="btn btn-sm <?= $row["pay_status"] == 1 ? 'btn-success' : 'btn-danger' ?>"
                        onclick="ChangePayStatus('<?= $row['order_id'] ?>')">
                        <i class="fas <?= $row["pay_status"] == 1 ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                        <?= $row["pay_status"] == 1 ? 'Paid' : 'Unpaid' ?>
                      </button>
                    </td>

                    <td>
                      <a class="btn btn-outline-primary btn-sm openPopup"
                        data-href="./adminView/viewEachOrder.php?orderID=<?= $row['order_id'] ?>"
                        href="javascript:void(0);">
                        <i class="fas fa-eye"></i> View
                      </a>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="fas fa-info-circle"></i> Order Details</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body order-view-modal"></div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.openPopup').on('click', function() {
        var dataURL = $(this).attr('data-href');
        $('.order-view-modal').load(dataURL, function() {
          $('#viewModal').modal({
            show: true
          });
        });
      });
    });

    function ChangePayStatus(orderId) {
      if (confirm("Change payment status for Order #" + orderId + "?")) {
        $.ajax({
          url: 'controller/updatePayStatus.php',
          type: 'POST',
          data: {
            record: orderId
          },
          dataType: 'json',
          success: function(response) {
            if (response.status === "success") {
              alert("Payment status updated to " + (response.newStatus === 1 ? "Paid" : "Unpaid"));
              location.reload();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function(xhr, status, error) {
            alert("Request failed. Please try again.");
            console.error("AJAX error:", error);
          }
        });
      }
    }

    function ChangeOrderStatus(orderId) {
      if (confirm("Change order status for Order #" + orderId + "?")) {
        $.ajax({
          url: 'controller/updateOrderStatus.php', // or '../controller/...' if needed
          type: 'POST',
          data: {
            record: orderId
          },
          dataType: 'json',
          success: function(response) {
            if (response.status === "success") {
              alert("Order status updated to " + (response.newStatus === 1 ? "Delivered" : "Pending"));
              location.reload();
            } else {
              alert("Error: " + response.message);
            }
          },
          error: function() {
            alert("Request failed. Please try again.");
          }
        });
      }
    }
  </script>

</body>

</html>