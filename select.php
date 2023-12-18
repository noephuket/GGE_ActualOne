<!DOCTYPE html>
<html>
<head>
    <title>Farmer and Factory Listing</title>
    <link rel="stylesheet" href="./css/bootstrap.css"> <!-- Link to your Bootstrap CSS file -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="boot.css">
    <!--common.css  -->
    <link rel="stylesheet" href="style.css">
    <style> 
        /* Increase the font size for the entire page */
        body {
            font-size: 18px;
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
        <h1 class="mb-4">Farmer Database</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Listing ID</th>
                    <th>Farm Name</th>
                    <th>Rice Type</th>
                    <th>Rice Price ($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.include.php'; // DB Connection Details

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connect failed: " . $conn->connect_error);
                }

                // Create the SQL Statement to display the farmer table
                $sql = "SELECT listing_id, farm_name, rice_type, rice_price FROM farmer";

                // Run the SQL Statement on the Server
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["listing_id"] . "</td>";
                        echo "<td>" . $row["farm_name"] . "</td>";
                        echo "<td>" . $row["rice_type"] . "</td>";
                        echo "<td>" . $row["rice_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <h1 class="mt-5 mb-4">Factory Database</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Ordered Quantity</th>
                    <th>Customer Rice Type</th>
                    <th>Date Ordered</th>
                    <th>Expected Delivery</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.include.php'; // DB Connection Details

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connect failed: " . $conn->connect_error);
                }

                // Create the SQL Statement to display the customer joined with factory table
                $sql = "SELECT c.order_id, c.customer_name, c.quantity AS customer_ordered_quantity, c.ordered_rice_type AS customer_rice_type, c.date_ordered, fa.expected_delivery, fa.delivery_status
                        FROM customer c
                        LEFT JOIN factory fa ON c.order_id = fa.order_id";

                // Run the SQL Statement on the Server
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["customer_ordered_quantity"] . "</td>";
                        echo "<td>" . $row["customer_rice_type"] . "</td>";
                        echo "<td>" . $row["date_ordered"] . "</td>";
                        echo "<td>" . $row["expected_delivery"] . "</td>";
                        echo "<td>" . $row["delivery_status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Add a new section to display customer data -->
        <h1 class="mt-5 mb-4">Customer Database</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Ordered Rice Type</th>
                    <th>Customer Address</th>
                    <th>Quantity</th>
                    <th>Date Ordered</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.include.php'; // DB Connection Details

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connect failed: " . $conn->connect_error);
                }

                // Create the SQL Statement
                $sql = "SELECT order_id, customer_name, ordered_rice_type, customer_address, quantity, date_ordered FROM customer";

                // Run the SQL Statement on the Server
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["ordered_rice_type"] . "</td>";
                        echo "<td>" . $row["customer_address"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["date_ordered"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Add a new section to display Delivery data -->
        <h1 class="mt-5 mb-4">Delivery Database</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Customer Ordered Quantity</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.include.php'; // DB Connection Details

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connect failed: " . $conn->connect_error);
                }

                // Create the SQL Statement to display the delivery joined with customer table
                $sql = "SELECT d.delivery_id, c.order_id, c.customer_name, c.customer_address, c.quantity AS customer_ordered_quantity, d.delivery_status
                        FROM customer c
                        LEFT JOIN delivery d ON c.order_id = d.order_id";

                // Run the SQL Statement on the Server
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["delivery_id"] . "</td>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["customer_address"] . "</td>";
                        echo "<td>" . $row["customer_ordered_quantity"] . "</td>";
                        echo "<td>" . $row["delivery_status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        </table>

        <!-- Add a new section to display Delivery data -->
        <h1 class="mt-5 mb-4">Completed Orders</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Customer Name</th>
                    <th>Customer Ordered Rice Type</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.include.php'; // DB Connection Details

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connect failed: " . $conn->connect_error);
                }

                // Create the SQL Statement to display the completed_orders table
                $sql = "SELECT *
                        FROM completed_orders";

                // Run the SQL Statement on the Server
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["delivery_id"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["ordered_rice_type"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No results found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

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
