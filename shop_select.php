<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css"> <!-- Update the path to your local Bootstrap CSS file -->
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
    
    <!-- Main Content -->
    <div class="container mt-5">
        <h1>Shop Selection</h1>
        <?php
        // Check if rice_name is provided in the URL
        if (isset($_REQUEST['rice_name'])) {
            // Get the rice_name from the URL
            $riceName = $_REQUEST['rice_name'];

            include 'db.include.php';

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connect failed: " . $conn->connect_error);
            }

            // Prepare and execute the SQL query to select listing where its a certain rice type
            $sql = "SELECT listing_id, farm_name, rice_type, rice_price FROM farmer WHERE rice_type = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $riceName);
            $stmt->execute();

            // Get the query results
            $result = $stmt->get_result();

            // Display the results in a table
            if ($result->num_rows > 0) {
                echo "<table class='table'>";
                echo "<thead><tr><th>Listing ID</th><th>Farm Name</th><th>Rice Type</th><th>Rice Price</th><th>Action</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["listing_id"] . "</td>";
                    echo "<td>" . $row["farm_name"] . "</td>";
                    echo "<td>" . $row["rice_type"] . "</td>";
                    echo "<td>" . $row["rice_price"] . "</td>";
                    // Add a "Buy" button that links to shop_action.php with listing_id as a query parameter
                    echo "<td><a href='shop_form.php?rice_name=" . urlencode($riceName) . "&listing_id=" . $row["listing_id"] . "' class='btn btn-primary'>Buy</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No listings found for this rice type.";
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        } else {
            echo "Rice type not specified.";
        }
        ?>

        <!-- Add a "Go Back" button -->
        <a href="shop.php" class="btn btn-primary">Go Back to Shop</a>
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
</body>
</html>
