<?php
// 1. Connect to XAMPP MySQL
$conn = new mysqli("localhost", "root", "", "fashion_db");

// 2. Look at the URL to see what the user wants (e.g., category.php?type=formal)
$type = $_GET['type']; 

// 3. The "Filter" - Get ONLY the distinct items for this category
$result = $conn->query("SELECT * FROM products WHERE category = '$type'");

echo "<h1>Showing $type Wear</h1>";
echo "<div style='display: flex; gap: 20px;'>";

// 4. THE MAGIC LOOP: This draws a unique box for every row in the DB
while($row = $result->fetch_assoc()) {
    echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
    // This looks for the image name stored in the DB
    echo "<img src='images/" . $row['image_name'] . "' width='150'><br>";
    echo "<b>" . $row['name'] . "</b><br>";
    echo "$" . $row['price'] . "<br>";
    echo "<button>View Details</button>";
    echo "</div>";
}
echo "</div>";
?>