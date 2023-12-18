<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="boot.css">
    <!--common.css  -->
    <link rel="stylesheet" href="style.css">
    <title>Shop</title>
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
        <h1>Shop Items</h1>
        <!-- Row 1 -->
        <div class="row">
            <?php
            // Define an array of rice types and their descriptions
            $riceTypes = [
                "Valencia rice" => "Valencia rice, also known as 'arroz de Valencia' in Spanish, is a variety of short-grain rice primarily cultivated in the region of Valencia, Spain. It is renowned for its unique characteristics, which make it the preferred rice for classic Spanish dishes like paella and other rice-based dishes.",
                "Brown basari rice" => "Literally spelt as 'The fragrant one' in Sanskrit. Brown basari rice is often cultivated in India and Pakistan. Rice of this type is fragrant long grain rice that has a distinctive and appealing flavor different from other varieties of rice.",
                "Arborio rice" => "Arborio rice is a short-grain Italian rice variety known for its starchy and creamy texture when cooked. It is one of the most popular types of rice used in risotto dishes, a classic Italian preparation that relies on the rice's ability to absorb liquid and create a velvety consistency.",
                "Red rice" => "Red rice is a type of whole grain rice that is often characterized by its distinct reddish-brown color. It is not a specific rice variety but rather a general term that can refer to several types of rice with varying shades of red or brown.",
                "Jasmine rice" => "Jasmine rice, also known as Thai fragrant rice, is a type of long-grain rice known for its distinctive aroma, fragrant flavor, and slightly sticky texture when cooked. It is a popular rice variety in many Southeast Asian cuisines, especially Thai cuisine.",
                "Basmati rice" => "Basmati rice is a premium, long-grain rice variety known for its unique aroma, slender grains, and delicate flavor. It is primarily grown in the Indian subcontinent, particularly in India and Pakistan, and is one of the most famous and sought-after rice varieties worldwide.",
                "Black rice" => "Black rice, also known as forbidden rice or purple rice, is a unique and nutrient-rich rice variety with a striking dark color. It has gained popularity in recent years due to its health benefits and culinary versatility.",
                "Sushi rice" => "Sushi rice, also known as shari or sumeshi, is a specially prepared short-grain rice that serves as the foundation for sushi, the iconic Japanese dish known for its vinegared rice combined with various ingredients such as fish, seafood, vegetables, and occasionally tropical fruits.",
                "Sticky rice" => "Sticky rice, also known as glutinous rice or sweet rice, is a type of rice that has a distinctly sticky and chewy texture when cooked. Despite its name, sticky rice is gluten-free and does not contain gluten. It is a staple in many Asian cuisines and is used in a variety of dishes, both savory and sweet."
            ];

            // Loop through the rice types and generate a card for each
            foreach ($riceTypes as $riceName => $riceDescription) {
                echo "<div class='col-md-4'>";
                echo "<div class='card mb-4'>";
                echo "<img src='./Assets/{$riceName}.png' class='card-img-top'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$riceName}</h5>";
                echo "<p class='card-text'>{$riceDescription}</p>";
                echo "<a href='shop_select.php?rice_name={$riceName}' class='btn btn-primary btn-sm'>View listings</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
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

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
