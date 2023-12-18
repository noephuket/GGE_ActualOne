<!DOCTYPE html>
<html>
<head>
    <title>Farmer Database</title>
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
        /* Style the table */
        table {
            width: 100%;
        }
        th, td {
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        /* Style the delete button */
        .btn-danger {
            background-color: #DC3545;
            border-color: #DC3545;
        }
        /* Style the footer */
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

    <div class="container mt-5">
        <h1>Farmer Database</h1>
        
        <?php
        include 'db.include.php';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }
        ?>

        <?php
        // Create the SQL Statement
        $sql = "SELECT * FROM farmer"; // Assuming your table name is "farmer"
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr><th>Listing ID</th><th>Farm Name</th><th>Rice Type</th><th>Rice Price</th><th>Action</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["listing_id"] . '</td>';
                echo '<td>' . $row["farm_name"] . '</td>';
                echo '<td>' . $row["rice_type"] . '</td>';
                echo '<td>' . $row["rice_price"] . '</td>';
                echo '<td><a href="delete_action.php?listing_id=' . $row["listing_id"] . '" class="btn btn-danger">Delete</a></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No results found.</p>';
        }
        ?>

        <?php
        $conn->close();
        ?>
    </div>

    <div class="container mt-5">
        <h1>Customer Database</h1>
        
        <?php
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }
        ?>

        <?php
        // Create the SQL Statement to select customer table
        $sql = "SELECT * FROM customer"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr><th>Order ID</th><th>Customer Name</th><th>Ordered Rice Type</th><th>Customer Address</th><th>Quantity</th><th>Date Ordered</th><th>Action</th></tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["order_id"] . '</td>';
                echo '<td>' . $row["customer_name"] . '</td>';
                echo '<td>' . $row["ordered_rice_type"] . '</td>';
                echo '<td>' . $row["customer_address"] . '</td>';
                echo '<td>' . $row["quantity"] . '</td>';
                echo '<td>' . $row["date_ordered"] . '</td>';
                echo '<td><a href="delete_action.php?order_id=' . $row["order_id"] . '" class="btn btn-danger">Delete</a></td>';

                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No results found.</p>';
        }
        ?>

        <?php
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
