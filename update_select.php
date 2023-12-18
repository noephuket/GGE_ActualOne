<!DOCTYPE html>
<html>
<head>
    <title>Update Factory Data</title>
    <link rel="stylesheet" href="./css/bootstrap.css"> <!-- Update the path to your local Bootstrap CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
    <?php
    if (!isset($_GET["order_id"])) {
        echo "Back to <a href='update.php'>update page</a><br><br>";
        die("Parameter order_id not submitted to page!");
    } else {
        $selected_order_id = $_GET["order_id"];
    }

    include 'db.include.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connect failed: " . $conn->connect_error);
    }
    // Create the SQL Statement to display the table factory joined with customer
    $sql = "SELECT c.order_id, c.customer_name, c.quantity AS customer_ordered_quantity, c.ordered_rice_type AS customer_rice_type, c.date_ordered, fa.expected_delivery, fa.delivery_status
            FROM customer c
            LEFT JOIN factory fa ON c.order_id = fa.order_id
            WHERE c.order_id = " . $selected_order_id;

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $order_id = $row["order_id"];
        $customer_name = $row["customer_name"];
        $customer_ordered_quantity = $row["customer_ordered_quantity"];
        $customer_rice_type = $row["customer_rice_type"];
        $date_ordered = $row["date_ordered"];
        $expected_delivery = $row["expected_delivery"];
        $delivery_status = $row["delivery_status"];
    } else {
        print_r("No result found");
    }

    $conn->close();
    ?>

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
        <h1 class="mb-4">Updating Factory Data</h1>
        <form action="update_action.php" method="post">
            <table class="table table-striped">
                <tr>
                    <td>Order ID:</td>
                    <td><?php echo $order_id; ?></td>
                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id; ?>">
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><?php echo $customer_name; ?></td>
                    <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>">
                </tr>
                <tr>
                    <td>Customer Ordered Quantity:</td>
                    <td><?php echo $customer_ordered_quantity; ?></td>
                    <input type="hidden" name="customer_ordered_quantity" value="<?php echo $customer_ordered_quantity; ?>">
                </tr>
                <tr>
                    <td>Customer Rice Type:</td>
                    <td><?php echo $customer_rice_type; ?></td>
                    <input type="hidden" name="customer_rice_type" value="<?php echo $customer_rice_type; ?>">
                </tr>
                <tr>
                    <td>Date Ordered:</td>
                    <td><?php echo $date_ordered; ?></td>
                    <input type="hidden" name="date_ordered" value="<?php echo $date_ordered; ?>">
                </tr>
                <tr>
                    <td>Expected Delivery:</td>
                    <td>
                        <input type="text" id="expected_delivery" name="expected_delivery" class="form-control datepicker" value="<?php echo $expected_delivery; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Delivery Status:</td>
                    <td>
                        <select name="delivery_status" id="delivery_status" class="form-control">
                            <option value="Received" <?php if ($delivery_status === "Received") echo "selected"; ?>>Received</option>
                            <option value="Processing" <?php if ($delivery_status === "Processing") echo "selected"; ?>>Processing</option>
                            <option value="Sent" <?php if ($delivery_status === "Sent") echo "selected"; ?>>Sent</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                <input type="submit" value="Update" class="btn btn-primary">
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });
        });
    </script>
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
