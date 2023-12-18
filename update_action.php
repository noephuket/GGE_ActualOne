<!DOCTYPE html>
<html>
<head>
    <title>Update Page</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="boot.css">
    <!--common.css  -->
    <link rel="stylesheet" href="style.css">
    <style>
        /* Increase the font size for the entire page */
        body {
            font-size: 18px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-custom {
            background-color: grey;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: black;
        }

        .navbar-nav {
            justify-content: center;
        }

        /* Center the "About us" section */
        .center-about-us {
            text-align: center;
        }

        /* Give some margin to the main content */
        .container {
            margin-top: 20px;
        }

        /* Adjust the footer styles for better visibility */
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <script src="./js/bootstrap.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 " href="#">Golden Grain Exchange</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html" style="color: black">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="select.php">Database</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="update.php">For Factory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="For_Delivery.php">For Delivery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="insert.php">For Farmer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="delete.php">Delete</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-text" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link navbar-text" href="completed_orders.php">Check Completed Orders</a>
                  </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    if (!isset($_POST["order_id"])) {
        echo "Back to <a href='update.php'>update page</a><br><br>";
        die("Parameter order_id not submitted to page!");
    } else {
        $selected_order_id = $_POST["order_id"];
    }

    $delivery_status = $_POST["delivery_status"];
    $expected_delivery = $_POST["expected_delivery"];

    include 'db.include.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connect failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL update query to update the "delivery_status" and "expected_delivery" fields
    $stmt = $conn->prepare("UPDATE factory SET delivery_status=?, expected_delivery=? WHERE order_id=?");
    $stmt->bind_param("ssi", $delivery_status, $expected_delivery, $selected_order_id);

    // ... Your previous PHP code ...

    if ($stmt->execute()) {
        $successMessage = "Successfully updated delivery status and expected delivery for Order ID = " . $selected_order_id;
    } else {
        $errorMessage = "Error updating delivery status and expected delivery: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    ?>

    <!-- HTML content with added div for message -->
    <div class="container">
        <h1 class="mt-5">Update Delivery Status</h1>
        
        <!-- Success message box -->
        <?php if (isset($successMessage)) : ?>
        <div class="alert alert-success mt-3">
            <?php echo $successMessage; ?>
        </div>
        <?php endif; ?>

        <!-- Error message box -->
        <?php if (isset($errorMessage)) : ?>
        <div class="alert alert-danger mt-3">
            <?php echo $errorMessage; ?>
        </div>
        <?php endif; ?>

        <!-- Button to go back to the home page (index.html) -->
        <div class="back-button">
        <a href="update.php"><button class="btn btn-primary">Back to Factory</button></a>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-auto">
      <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <h5>Contact Information</h5>
                  <p>Email: GoldenGrainExchange@gmail.com</p>
                  <p>Phone: (123) 456-7890</p>
              </div>
              <div class="col-md-6">
                  <h5>Follow Us</h5>
                  <a href="#" class="text-white">Facebook</a><br>
                  <a href="#" class="text-white">Twitter</a><br>
                  <a href="#" class="text-white">Instagram</a>
              </div>
          </div>
          <div class="row mt-3">
              <div class="col">
                  <!-- Add your logo image here -->
                  <img src="./Assets/logo_new.png" alt="GoldenGrainExchange Logo" style="max-width: 100px;">
                  <p>&copy; 2023 GoldenGrainExchange. All rights reserved.</p>
              </div>
          </div>
      </div>
    </footer>
</body>
</html>
