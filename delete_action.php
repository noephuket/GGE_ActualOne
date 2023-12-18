<?php
// Include the database configuration
include 'db.include.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connect failed: " . $conn->connect_error);
}

// Check if listing_id or order_id is provided in the URL
if (isset($_GET["listing_id"])) {
    // Delete farmer record based on listing_id
    $selected_listing_id = $_GET["listing_id"];
    $sql = "DELETE FROM farmer WHERE listing_id = " . $selected_listing_id;
} elseif (isset($_GET["order_id"])) {
    // Delete customer record based on order_id
    $selected_order_id = $_GET["order_id"];
    $sql = "DELETE FROM customer WHERE order_id = " . $selected_order_id;
} else {
    echo "Back to <a href='delete.php'>delete page</a><br><br>";
    die("Parameter listing_id or order_id not submitted to page!");
}

// Execute the SQL query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Action</title>
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
        <h1 class="mt-5">Delete Action</h1>

        <?php
        if ($result == TRUE) {
            echo '<div class="alert alert-success mt-3">';
            echo "Successfully deleted record";
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger mt-3">';
            echo "No result found";
            echo '</div>';
        }

        $conn->close();
        ?>

        <br><br>
        <a href='delete.php' class="btn btn-primary">Go Back to Delete Page</a>
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
                    <!-- Add your social media links here -->
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
