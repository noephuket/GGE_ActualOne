<!DOCTYPE html>
<html>
<head>
    <title>Insert Form</title>
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
    <div class="container">
        <h1 class="mt-5">Listing Rice</h1>
        <form action="insert_action.php" method="post">
            <div class="form-group">
                <label for="farm_name">Farm name:</label>
                <input type="text" id="farm_name" name="farm_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rice_type">Rice type:</label>
                <select id="rice_type" name="rice_type" class="form-control" required>
                    <option value="Valencia rice">Valencia rice</option>
                    <option value="Brown basari rice">Brown basari rice</option>
                    <option value="Arborio rice">Arborio rice</option>
                    <option value="Red rice">Red rice</option>
                    <option value="Jasmine rice">Jasmine rice</option>
                    <option value="Basmati rice">Basmati rice</option>
                    <option value="Black rice">Black rice</option>
                    <option value="Sushi rice">Sushi rice</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rice_price">Rice price ($):</label>
                <input type="number" id="rice_price" name="rice_price" step="0.01" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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
