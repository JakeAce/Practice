<?php
// === PHP backend logic to handle booking form submission ===

// Database credentials
$host = 'localhost';
$db   = 'swiss_collection';
$user = 'root';    // change if needed
$pass = '';        // change if you have a password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$bookingSuccess = false;
$errorMessage = '';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $date = $_POST['date'] ?? '';

    if (!$name || !$email || !$service || !$date) {
        $errorMessage = "Please fill in all required fields.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO bookings (name, email, service, preferred_date) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $service, $date]);

            // Clear POST data to prevent resubmission on refresh
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit;
        } catch (PDOException $e) {
            $errorMessage = "Failed to save booking: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_tool_request'])) {
    $name = trim($_POST['tool_name'] ?? '');
    $email = trim($_POST['tool_email'] ?? '');
    $tool = trim($_POST['tool'] ?? '');
    $supplier = trim($_POST['supplier'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$tool || !$supplier) {
        $errorMessage = "Please fill in all required fields for tool request.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO tool_requests (name, email, tool, supplier, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $tool, $supplier, $message]);

            header("Location: " . $_SERVER['PHP_SELF'] . "?tool_success=1");
            exit;
        } catch (PDOException $e) {
            $errorMessage = "Failed to submit tool request: " . $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_order'])) {
    $user_id = intval($_POST['user_id'] ?? 0);
    $delivered_to = trim($_POST['delivered_to'] ?? '');
    $phone_no = trim($_POST['phone_no'] ?? '');
    $deliver_address = trim($_POST['deliver_address'] ?? '');
    $pay_method = trim($_POST['pay_method'] ?? '');
    $pay_status = 0; // default unpaid
    $order_status = 0; // default pending

    if (!$user_id || !$delivered_to || !$phone_no || !$deliver_address || !$pay_method) {
        $errorMessage = "All order fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, delivered_to, phone_no, deliver_address, pay_method, pay_status, order_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $delivered_to, $phone_no, $deliver_address, $pay_method, $pay_status, $order_status]);

            header("Location: " . $_SERVER['PHP_SELF'] . "?order_success=1");
            exit;
        } catch (PDOException $e) {
            $errorMessage = "Failed to place order: " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Motor Service Website" />
    <meta name="author" content="Motor Service Team" />
    <title>Motor Service - Dashboard</title>

    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-image: url("assets/images/pexels-maltelu-2244746.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        /* Navbar brand spacing */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-brand img {
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-right: 0.6rem;
            width: 40px;
            height: 40px;
        }

        /* Sidebar (optional) */
        #layoutSidenav_nav {
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            min-height: 100vh;
        }

        .sb-sidenav-menu-heading {
            font-size: 0.9rem;
            font-weight: 600;
            padding-left: 1.2rem;
            color: #6c757d;
            text-transform: uppercase;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .sb-sidenav a.nav-link {
            color: #495057;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .sb-sidenav a.nav-link:hover {
            background-color: #e9ecef;
            border-left: 4px solid #0d6efd;
            color: #0d6efd;
        }


        /* Main content */
        main {
            padding: 2rem 2rem 4rem;
        }

        /* Cards for forms */
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        }

        /* Form label style */
        label.form-label {
            font-weight: 600;
            color: #495057;
        }

        /* Buttons */
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        /* Alert styles */
        .alert {
            border-radius: 0.375rem;
            max-width: 600px;
            margin: 1rem auto;
            box-shadow: 0 2px 10px rgb(0 0 0 / 0.05);
        }

        /* Modal enhancements */
        .modal-content {
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            main {
                padding: 1rem;
            }
        }

        footer {
            background-color: whitesmoke;
        }

        form {
            background: #22C1C3;
            background: linear-gradient(0deg, rgba(34, 193, 195, 1) 0%, rgba(253, 187, 45, 1) 100%);
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- Styled Navbar -->
    <nav class="sb-topnav navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="assets/images/pexels-pixabay-279949.jpg" alt="Logo" width="32" height="32" class="d-inline-block align-text-top rounded-circle" />
                <span class="fs-4 fw-bold">Motor Service</span>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a
                            href="#"
                            class="btn btn-primary btn-sm rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#bookingModal">
                            Book a Service
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user fa-fw fs-5 me-2"></i>
                            <span class="d-none d-lg-inline">User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="index.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Layout Wrapper -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <!-- Change this link to trigger modal -->
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                            Book a Service
                        </a>
                        <a class="nav-link" href="Costumer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Buy Product
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Motor Service Admin
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                    <div class="alert alert-success text-center">
                        Booking submitted successfully! We will contact you soon.
                    </div>
                <?php elseif ($errorMessage): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['order_success'])): ?>
                    <div class="alert alert-success">Your order has been placed successfully!</div>
                <?php endif; ?>
                <h2 class="mb-4" style="text-align: center; color: white; font-variant: small-caps;">Place an Order</h2>

                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="p-4 fw-bolder rounded shadow-sm">
                    <input type="hidden" name="user_id" value="2"> <!-- You may replace 2 with a dynamic user ID -->

                    <div class="mb-3">
                        <label for="delivered_to" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="delivered_to" name="delivered_to" required />
                    </div>

                    <div class="mb-3">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" required />
                    </div>

                    <div class="mb-3">
                        <label for="deliver_address" class="form-label">Delivery Address</label>
                        <input type="text" class="form-control" id="deliver_address" name="deliver_address" required />
                    </div>

                    <div class="mb-3">
                        <label for="pay_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="pay_method" name="pay_method" required>
                            <option value="">-- Select Payment Method --</option>
                            <option value="Cash">Cash</option>
                            <option value="Khalti">Khalti</option>
                        </select>
                    </div>

                    <button type="submit" name="submit_order" class="btn btn-primary">Submit Order</button>
                </form>

            </main>

            <!-- Footer -->
            <footer class="py-4 bg-bolder mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Motor Service 2025</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Form posts back to this same file -->
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Book a Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
                        </div>
                        <div class="mb-3">
                            <label for="service" class="form-label">Where to Buy Tools</label>
                            <select class="form-select" id="service" name="service" required>
                                <?php
                                $services = [
                                    'Local Hardware Store',
                                    'Online Retailers (Amazon, eBay)',
                                    'Specialty Tool Shops',
                                    'Automotive Parts Stores',
                                    'Wholesale Suppliers',
                                ];
                                $selected_service = $_POST['service'] ?? '';
                                foreach ($services as $option) {
                                    $selected = ($option === $selected_service) ? 'selected' : '';
                                    echo "<option value=\"" . htmlspecialchars($option) . "\" $selected>$option</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="date" name="date" required
                                value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit_booking" class="btn btn-primary">Submit Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: auto-open modal if error occurs -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if ($errorMessage): ?>
                var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                bookingModal.show();
            <?php endif; ?>
        });
    </script>
</body>

</html>