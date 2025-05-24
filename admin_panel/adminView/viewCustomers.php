<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
include_once "../config/dbconnect.php";

if (isset($_POST['add_customer'])) {
    // Sanitize inputs
    $firstName = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactNo = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $address = mysqli_real_escape_string($conn, $_POST['user_address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $registeredAt = date('Y-m-d');

    // Insert query
    $sql = "INSERT INTO costumer (first_name, last_name, email, password, contact_no, registered_at, isAdmin, user_address)
            VALUES ('$firstName', '$lastName', '$email', '$password', '$contactNo', '$registeredAt', 0, '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Customer added successfully!'); window.location.href='../admin.php?customers';</script>";
        exit();
    } else {
        die("Error adding customer: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2>All Customers</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">Contact</th>
        <th class="text-center">Registered At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM costumer WHERE isAdmin=0";
      $result = $conn->query($sql);
      $count = 1;
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td class='text-center'>{$count}</td>
                      <td class='text-center'>{$row['first_name']} {$row['last_name']}</td>
                      <td class='text-center'>{$row['email']}</td>
                      <td class='text-center'>{$row['contact_no']}</td>
                      <td class='text-center'>{$row['registered_at']}</td>
                    </tr>";
              $count++;
          }
      } else {
          echo "<tr><td colspan='5' class='text-center'>No customers found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- Button to trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
    Add Customer
  </button>

  <!-- Modal -->
  <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" name="first_name" required>
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" name="last_name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input type="text" class="form-control" name="contact_no" required>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" name="user_address" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="add_customer" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>

<!-- Bootstrap JS and jQuery (required for modal to work) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>