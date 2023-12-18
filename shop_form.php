<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="boot.css">
    <!-- Common CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Shop Form</title>
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
            flex: 1; /* This makes the container fill the remaining vertical space */
        }

        /* Adjust the footer styles for better visibility */
        footer {
            background-color: #343a40;
            color: white;
            flex-shrink: 0; /* This prevents the footer from shrinking when content is short */
        }
    </style>
</head>
<body>
<script src="./js/bootstrap.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 " href="#">Golden Grain Exchange</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    <div class="container mt-5">
        <h1>Shop Selection</h1>
        <?php
        include 'db.include.php';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }
        // Check if rice_name is provided in the URL
        if (isset($_GET['rice_name'])) {
            // Get the rice_name from the URL
            $riceName = $_GET['rice_name'];

            // Display the rice type
            echo "<p>Selected Rice Type: $riceName</p>";
        } else {
            echo "Rice type not specified.";
        }
        ?>

        <!-- Add a form for user input with a payment method field -->
        <form method="POST" action="shop_action.php">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Customer Address</label>
                <input type="text" class="form-control" id="customer_address" name="customer_address" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <!-- Include a hidden input for order_rice_type -->
            <input type="hidden" name="order_rice_type" value="<?php echo $riceName; ?>">
            
            <!-- Payment Method Selection -->
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select class="form-control" id="payment_method" name="payment_method" required onchange="toggleCardFields()">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Credit/Debit Card">Credit/Debit Card</option>
                </select>
            </div>
            
            <!-- Card Information Fields (Initially Hidden) -->
            <div id="card_fields" style="display: none;">
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" class="form-control" id="card_number" name="card_number">
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date">
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Buy</button>
        </form>
    </div>
    
    <footer class="bg-dark text-white py-4">
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

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript function to toggle card fields visibility
        function toggleCardFields() {
            var paymentMethod = document.getElementById("payment_method").value;
            var cardFields = document.getElementById("card_fields");
            if (paymentMethod === "Credit/Debit Card") {
                cardFields.style.display = "block";
            } else {
                cardFields.style.display = "none";
            }
        }
    </script>
</body>
</html>
