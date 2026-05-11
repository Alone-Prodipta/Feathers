<?php
// 1. DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "Prodipta_007#"; // Default XAMPP password is empty
$dbname = "fasion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. GET THE CATEGORY FROM URL (e.g., category.php?type=formal)
$type = isset($_GET['type']) ? $_GET['type'] : 'formal';

// 3. FETCH PRODUCTS
// We use 'product' as the table name
$sql = "SELECT * FROM product WHERE category = '$type'";
$result = $conn->query($sql);

echo '<html>
<head>
    <title>Showing ' . $type . ' Wear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Kenia&family=Lemon" rel="stylesheet">
</head>
<body style="background-color: bisque;">
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: bisque;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-family:lobster;color:rgb(4, 72, 4);"><u>Paris Londoner</u>.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.html" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Shop
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="brain.php?type=formal">Formal wear</a></li>
                        <li><a class="dropdown-item" href="brain.php?type=casual">Casual wear</a></li>
                        <li><a class="dropdown-item" href="brain.php?type=traditional">Traditional wear</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: rgb(4, 72, 4); font-weight: bold; text-decoration: underline;" href="contact.html">Contact Us</a>
                </li>
            </ul>
            <form class="d-flex w-50" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cart</button>
            </form>
        </div>
    </div>
</nav>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';

echo "<div style='display: flex; flex-wrap: wrap; gap: 20px; margin-top: 80px; margin-left: 20px;'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 2px solid green; padding: 10px; width: 220px; text-align: center; border-radius: 8px;'>";

        echo "<img src='" . $row['image_name'] . "' style='width:100%; height:250px; object-fit:cover; border-radius: 5px;'>";

        echo "<div style='margin-top: 10px;'>";
        echo "<b>" . $row['name'] . "</b><br>";
        echo "<span style='color: #058f3e; font-weight: bold;'>$" . $row['price'] . "</span><br>";
        // Wrap the button in a link that passes the product ID to details.php
        echo "<a href='details.php?id=" . $row['id'] . "' style='text-decoration: none;'>";
        echo "<button id='details' style='margin-top: 10px; font-family: Lemon; color: white; cursor: pointer; background-color: green; padding: 10px; border-radius: 10px; border: none;'>";
        echo "View Details";
        echo "</button>";
        echo "</a>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "<p style='margin-top:80px;'>No products found in this category.</p>";
}
// 2. GET THE SEARCH OR CATEGORY FROM URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// 3. DYNAMIC FETCH LOGIC
if (!empty($search)) {
    // If there is a search term, prioritize the search results
    $sql = "SELECT * FROM product WHERE name LIKE '%$search%' OR category LIKE '%$search%'";
    $title = "Search Results for: " . htmlspecialchars($search);
} elseif (!empty($type)) {
    // If a category link was clicked, filter by that category
    $sql = "SELECT * FROM product WHERE category = '$type'";
    $title = "Showing " . ucfirst($type) . " Wear";
} else {
    // Only show Formal Wear as a last resort if both search and type are empty
    $sql = "SELECT * FROM product WHERE category = 'formal'";
    $title = "Showing Formal Wear";
}

$result = $conn->query($sql);



echo "</div>";
echo "</body></html>";

$conn->close();
