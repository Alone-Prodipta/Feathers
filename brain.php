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

echo "<html><head><title>Showing $type Wear</title></head><body>";
echo "<h1>Showing " . ucfirst($type) . " Wear</h1>";

// 4. THE MAGIC LOOP
echo "<div style='display: flex; flex-wrap: wrap; gap: 20px;'>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; width: 220px; text-align: center; border-radius: 8px;'>";
        
        // Use the live URL directly from the database
        echo "<img src='" . $row['image_name'] . "' style='width:100%; height:250px; object-fit:cover; border-radius: 5px;'>";
        
        echo "<div style='margin-top: 10px;'>";
        echo "<b>" . $row['name'] . "</b><br>";
        echo "<span style='color: #2ecc71; font-weight: bold;'>$" . $row['price'] . "</span><br>";
        echo "<button style='margin-top: 10px; cursor: pointer;'>View Details</button>";
        echo "</div>";
        
        echo "</div>";
    }
} else {
    echo "<p>No products found in this category.</p>";
}

echo "</div>";
echo "</body></html>";

$conn->close();
?>