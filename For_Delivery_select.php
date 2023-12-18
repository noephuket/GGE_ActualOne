<!DOCTYPE html>
<html>
<head>
    <title>Update Delivery Status</title>
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
    <div class="container mt-5">
        <h1 class="mb-4">Update Delivery Status</h1>

        <?php
        include 'db.include.php';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }

        if (!isset($_GET["delivery_id"])) {
            echo "Back to <a href='For_Delivery.php'>For Delivery</a><br><br>";
            die("Parameter delivery_id not submitted to page!");
        } else {
            $selected_delivery_id = $_GET["delivery_id"];
        }
        // Create the SQL Statement for selecting the attributes to display as table
        $sql = "SELECT d.delivery_id, c.order_id, c.customer_name, c.customer_address, c.quantity AS customer_ordered_quantity, d.delivery_status
                FROM customer c
                LEFT JOIN delivery d ON c.order_id = d.order_id
                WHERE d.delivery_id = " . $selected_delivery_id;
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $delivery_id = $row["delivery_id"];
            $order_id = $row["order_id"];
            $customer_name = $row["customer_name"];
            $customer_address = $row["customer_address"];
            $customer_ordered_quantity = $row["customer_ordered_quantity"];
            $delivery_status = $row["delivery_status"];
        } else {
            print_r("No result found");
        }

        $conn->close();
        ?>

        <form action="For_Delivery_action.php" method="post">
            <table class="table table-striped">
                <tr>
                    <td>Delivery ID:</td>
                    <td><?php echo $delivery_id; ?></td>
                    <input type="hidden" name="delivery_id" value="<?php echo $delivery_id; ?>">
                </tr>
                <tr>
                    <td>Order ID:</td>
                    <td><?php echo $order_id; ?></td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><?php echo $customer_name; ?></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><?php echo $customer_address; ?></td>
                </tr>
                <tr>
                    <td>Customer Ordered Quantity:</td>
                    <td><?php echo $customer_ordered_quantity; ?></td>
                </tr>
                <tr>
                    <td>Delivery Status:</td>
                    <td>
                        <select name="delivery_status" id="delivery_status" class="form-control">
                            <option value="Received" <?php if ($delivery_status === "Received") echo "selected"; ?>>Received</option>
                            <option value="On The Way" <?php if ($delivery_status === "On The Way") echo "selected"; ?>>On The Way</option>
                            <option value="Delivered" <?php if ($delivery_status === "Delivered") echo "selected"; ?>>Delivered</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
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
</body>
</html>
