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

        /* Your existing styles... */
        #layoutSidenav {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        #layoutSidenav_nav {
            width: 250px;
            flex-shrink: 0;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        #layoutSidenav_content {
            flex-grow: 1;
            overflow-y: auto;
            background-color: #fff;
            padding: 30px 40px;
            display: flex;
            flex-direction: column;
            background-image: url("assets/images/pexels-maltelu-2244746.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .hero-section {
            min-height: 40vh;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 40px 20px;
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 12px;
            max-width: 700px;
            margin: 0 auto;
            margin-bottom: 40px;
            margin-top: 40px;
        }

        .hero-image-container {
            background: white;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            animation: floatUp 1.5s ease forwards;
        }

        .hero-image {
            width: 140px;
            height: 140px;
            object-fit: contain;
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            animation: fadeInUp 1.5s ease forwards;
        }

        .hero-description {
            max-width: 600px;
            font-size: 1.3rem;
            margin: 0 auto;
            color: #dce6f1;
            animation: fadeInUp 2s ease forwards;
        }

        .hero-btn {
            font-weight: 600;
            padding: 0.85rem 2.5rem;
            border-radius: 50px;
            margin-top: 30px;
        }

        .hero-btn:hover {
            background-color: #1c6dd0;
            transform: scale(1.05);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1.1rem;
                padding: 0 15px;
            }

            .hero-image {
                width: 100px;
                height: 100px;
            }

            #layoutSidenav_nav {
                width: 200px;
            }

            #layoutSidenav_content {
                padding: 20px;
            }
        }

        footer {
            /* Removed the fixed huge width */
            width: 1289px;
            height: 110px;
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
                        <a class="nav-link" href="index.php">
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


                <section class="hero-section">
                    <div class="hero-image-container mb-4">
                        <img src="assets/images/pexels-pixabay-279949.jpg" alt="Motor Service Logo" class="hero-image" />
                    </div>
                    <h1 class="hero-title">Motor Service</h1>
                    <p class="hero-description">
                        We offer expert motor service and repair to keep your vehicle running smoothly.
                        Trusted by hundreds of customers, our experienced technicians provide top-quality
                        care tailored to your needs.
                    </p>
                    <!-- Change this button to trigger modal -->
                    <a href="#" class="btn btn-primary btn-lg hero-btn" data-bs-toggle="modal"
                        data-bs-target="#bookingModal">Book a Service</a>
                </section>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
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