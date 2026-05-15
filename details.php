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
                        <!--span class="badge rounded-pill text-bg-dark">Light</span>
                        <button style="background-color: green; color: white;">L</button-->


                        <div id="inline-twister-row-size_name" data-csa-c-content-id="inline-twister-row-size_name" data-csa-c-slot-id="inline-twister-row-size_name" data-csa-c-type="widget" class="a-section a-spacing-none inline-twister-row" data-csa-c-id="s8vf7i-z61yla-jizz4b-budny1">
                            <div id="inline-twister-expander-header-size_name" data-csa-c-content-id="inline-twister-expander-header-size_name" data-csa-c-slot-id="inline-twister-expander-header-size_name" data-csa-c-type="widget" aria-label="Selected Size is M. Tap to collapse." class="a-section a-spacing-none dimension-heading" data-csa-c-id="mk9kgm-jfgznn-mddl8v-8rm3bj">
                                <div id="inline-twister-dim-title-size_name" class="a-section a-spacing-none dimension-text">
                                    <div class="a-section a-spacing-none a-padding-none inline-twister-dim-title-value-truncate-expanded"> <span class="a-size-base a-color-secondary"> Size: </span> <span id="inline-twister-expanded-dimension-text-size_name" class="a-size-base a-color-base inline-twister-dim-title-value a-text-bold">M</span> </div>
                                </div>
                            </div>
                            <div id="inline-twister-expander-content-size_name" data-totalvariationcount="10" aria-label="There are 10 options." class="a-section a-spacing-none dimension-expander-content dimension-expander-content-expand">
                                <div class="a-section"> <span id="dim-values-aria-label-size_name" style="display:none">
                                        Make a Size selection </span>
                                    <div id="tp-inline-twister-dim-values-container" aria-labelledby="dim-values-aria-label-size_name" class="a-section a-spacing-none" role="group">
                                        <ul class="a-unordered-list a-nostyle a-button-list a-declarative a-button-toggle-group a-horizontal dimension-values-list" role="radiogroup" data-action="a-button-group" data-a-button-group="{&quot;name&quot;:&quot;size_name&quot;}">
                                            <li data-asin="B0DPKMZND2" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKMZND2" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="0" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="sp2vd4-5zwo7q-nbando-bdcyzr"><span class="a-list-item"> <span id="size_name_0" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="0" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_0-announce" aria-posinset="1" aria-setsize="10"><span id="size_name_0-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> S </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKMPH5P" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKMPH5P" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="1" data-initiallyselected="true" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="jrqxtq-76w2q-o9y0g6-2dprko"><span class="a-list-item"> <span id="size_name_1" class="a-button a-button-selected a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="1" role="radio" aria-checked="true" class="a-button-input" type="submit" aria-labelledby="size_name_1-announce" aria-posinset="2" aria-setsize="10"><span id="size_name_1-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> M </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKP6N75" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKP6N75" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="2" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="e19pr4-qj1udt-7h27n0-grs2md"><span class="a-list-item"> <span id="size_name_2" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="2" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_2-announce" aria-posinset="3" aria-setsize="10"><span id="size_name_2-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> L </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKNWTHC" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKNWTHC" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="3" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="hajdej-82d172-ugjyng-4p3iy8"><span class="a-list-item"> <span id="size_name_3" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="3" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_3-announce" aria-posinset="4" aria-setsize="10"><span id="size_name_3-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKP15R8" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKP15R8" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="4" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="nm3vk3-d3d9p5-k894b8-4ouq3r"><span class="a-list-item"> <span id="size_name_4" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="4" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_4-announce" aria-posinset="5" aria-setsize="10"><span id="size_name_4-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 2XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKNGH7W" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKNGH7W" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="5" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="uck9ae-b2o07n-kee3ma-6cpcz6"><span class="a-list-item"> <span id="size_name_5" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="5" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_5-announce" aria-posinset="6" aria-setsize="10"><span id="size_name_5-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 3XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0DPKPQCKG" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0DPKPQCKG" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="6" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="1q3ghl-9ts1sv-kbnq9h-wjehs6"><span class="a-list-item"> <span id="size_name_6" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="6" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_6-announce" aria-posinset="7" aria-setsize="10"><span id="size_name_6-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 4XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0FBWYV2MW" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0FBWYV2MW" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="7" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-0" data-csa-c-id="spqwlr-75s7bb-keas2-t7cr9g"><span class="a-list-item"> <span id="size_name_7" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="7" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_7-announce" aria-posinset="8" aria-setsize="10"><span id="size_name_7-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 5XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0FBX4K1S5" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0FBX4K1S5" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="8" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-1" data-csa-c-id="luwfy5-1ala6a-n5nqyp-4wdgxu"><span class="a-list-item"> <span id="size_name_8" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="8" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_8-announce" aria-posinset="9" aria-setsize="10"><span id="size_name_8-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 6XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                            <li data-asin="B0FBX1KH7S" data-collapsed-view="true" data-csa-c-content-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-item-id="B0FBX1KH7S" data-csa-c-slot-id="twister-desktop-twister-swatch-swatchAvailable" data-csa-c-type="item" data-idxintoggleswatchlist="9" data-initiallyselected="false" data-initiallyunavailable="false" class="swatch-list-item-text inline-twister-swatch a-declarative desktop-twister-dim-row-1" data-csa-c-id="h3483f-ecvhr6-3khx3r-v691ht"><span class="a-list-item"> <span id="size_name_9" class="a-button a-button-toggle text-swatch-button"><span class="a-button-inner"><input name="9" role="radio" aria-checked="false" class="a-button-input" type="submit" aria-labelledby="size_name_9-announce" aria-posinset="10" aria-setsize="10"><span id="size_name_9-announce" class="a-button-text" aria-hidden="true">
                                                                <div class="a-section text-swatch-container">
                                                                    <div class="a-section a-spacing-none swatch-title-text-container"> <span class="a-size-base swatch-title-text-display swatch-title-text-single-line" style="height: 20px;"> 7XL </span> </div>
                                                                </div>
                                                            </span></span></span> </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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