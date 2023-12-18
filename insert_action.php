<!DOCTYPE html>
<html>
<head>
    <title>Insert Result</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="boot.css">
    <!-- Common CSS -->
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
        /* Center the content */
        .container {
            text-align: center;
            margin-top: 50px;
            flex: 1; /* This makes the container fill the remaining vertical space */
        }
        /* Style the result message box */
        .result-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        /* Style the back button */
        .back-button {
            margin-top: 20px;
        }
        /* Adjust the footer styles for better visibility */
        footer {
            background-color: #343a40;
            color: white;
            flex-shrink: 0; /* This prevents the footer from shrinking when content is short */
            padding: 20px 0;
            text-align: center;
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

    <div class="container">
        <h1>Congratulations on your listing</h1>
        
        <div class="result-message">
            <?php
            include 'db.include.php';

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connect failed: " . $conn->connect_error);
            }

            // Taking values from the form data (input)
            $farm_name = $_REQUEST['farm_name'];
            $rice_type = $_REQUEST['rice_type'];
            $rice_price = $_REQUEST['rice_price'];

            // Performing insert query execution, excluding the listing_id as its auto increment
            $sql = "INSERT INTO Farmer (farm_name, rice_type, rice_price) 
                    VALUES ('$farm_name', '$rice_type', $rice_price)";

            $result = $conn->query($sql);

            if ($result) {
                echo "Rice listed successfully!";
            } else {
                echo "Rice listed not completed!";
            }

            $conn->close();
            ?>
        </div>

        <!-- Button to go back to the home page (index.html) -->
        <div class="back-button">
            <a href="index.html"><button class="btn btn-primary">Go Back to Home Page</button></a>
        </div>
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
</body>
</html>
