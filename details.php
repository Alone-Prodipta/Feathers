<?php
$host = "sql206.infinityfree.com"; // From your screenshot image_47f05b.png
$user = "if0_41907840";
$pass = "1PwMWAiitxQv8y"; // Your FTP/Account password
$db   = "if0_41907840_fasion";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. GET THE ID FROM THE URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 1;

// 3. FETCH ONLY THAT PRODUCT
$sql = "SELECT * FROM product WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found!");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $product['name']; ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Kenia" rel="stylesheet">
    <style>
        body {
            background-color: bisque;
            padding-top: 100px;
        }

        .product-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            border: 2px solid green;
        }

        .price {
            font-size: 24px;
            color: green;
            font-weight: bold;
        }

        .sizebtn {

            float: left;
            margin: 10px;
            border-style: none;
            border-radius: 10px;
            padding: 10px;
            width: 50px;
        }

        .size-container .color-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .navbar {
            background-color: bisque;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-bisque fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-family:lobster;color:rgb(4, 72, 4);"><u>Feathers</u>.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.html" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;">
                            Shop
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="brain.php?type=formal">Formal wear</a></li>
                            <li><a class="dropdown-item" href="brain.php?type=casual">Casual wear</a></li>
                            <li><a class="dropdown-item" href="brain.php?type=traditional">Traditional wear</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;">Contact Us</a>
                    </li>

                </ul>
                <form class="d-flex w-50" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Cart</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row product-container shadow">
            <div class="col-md-6">
                <img src="<?php echo $product['image_name']; ?>" class="img-fluid rounded border">
            </div>
            <div class="col-md-6">
                <h1 style="font-family: 'Lobster';"><?php echo $product['name']; ?></h1>
                <p class="badge bg-success"><?php echo ucfirst($product['category']); ?></p>
                <hr>
                <p class="price">$<?php echo $product['price']; ?></p>
                <p>This is a premium quality garment designed for comfort and style. Perfect for your <?php echo $product['category']; ?> collection.</p>

                <div class="mt-4">
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">

                        <div class="color-container">
                            <button class="sizebtn" style="background-color: green;"></button>
                            <button class="sizebtn" style="background-color: green;"></button>
                            <button class="sizebtn" style="background-color: green;"></button>
                            <button class="sizebtn" style="background-color: green;"></button>
                            <button class="sizebtn" style="background-color: green;"></button>
                        </div>

                        <div class="size-container">
                            <button class="sizebtn" style="background-color: green; color: white;">S</button>
                            <button class="sizebtn" style="background-color: green; color: white;">M</button>
                            <button class="sizebtn" style="background-color: green; color: white;">L</button>
                            <button class="sizebtn" style="background-color: green; color: white;">XL</button>
                            <button class="sizebtn" style="background-color: green; color: white;">2XL</button>
                        </div>
                        <button type="submit" name="add_to_cart" class="btn btn-outline-success">
                            Add to Cart
                            (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
                        </button>

                        <a href="brain.php?type=<?php echo $product['category']; ?>" class="btn btn-outline-secondary">
                            Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>