<!DOCTYPE html>
<html>
<head>
    <title>Update Delivery Status</title>
    <link rel="stylesheet" href="./css/bootstrap.css"> <!-- Update the path to your local Bootstrap CSS file -->
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
        /* Center the "About us" section */
        .center-about-us {
            text-align: center;
        }

        /* Style for the message box */
        .message-box {
            border: 2px solid #007BFF;
            padding: 10px;
            margin: 10px 0;
        }

        /* Style for success message */
        .message-success {
            background-color: #D4EDDA;
            border-color: #C3E6CB;
            color: #155724;
        }

        /* Style for error message */
        .message-error {
            background-color: #F8D7DA;
            border-color: #F5C6CB;
            color: #721C24;
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
        <h1 class="mb-4">Update Delivery Status</h1>

        <?php
        if (!isset($_POST["delivery_id"])) {
            echo "Back to <a href='For_Delivery.php'>For Delivery</a><br><br>";
            die("Parameter delivery_id not submitted to the page!");
        } else {
            $selected_delivery_id = $_POST["delivery_id"];
        }

        $delivery_status = $_POST["delivery_status"];

        include 'db.include.php';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL update query to update the "delivery_status" field
        $stmt = $conn->prepare("UPDATE delivery SET delivery_status=? WHERE delivery_id=?");
        $stmt->bind_param("si", $delivery_status, $selected_delivery_id);

        if ($stmt->execute()) {
            // Success message in a box
            echo '<div class="message-box message-success">';
            echo "Successfully updated delivery status for Delivery ID = " . $selected_delivery_id;
            echo '</div>';

            // Add a button to go back to For_Delivery.php
            echo '<br><a href="For_Delivery.php" class="btn btn-primary">Back to Delivery</a>';
        } else {
            // Error message in a box
            echo '<div class="message-box message-error">';
            echo "Error updating delivery status: " . $stmt->error;
            echo '</div>';
        }

        $stmt->close();
        $conn->close();
        ?>
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
