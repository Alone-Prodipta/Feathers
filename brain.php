<?php
// 1. Connect to XAMPP MySQL
$conn = new mysqli("localhost", "root", "Prodipta_007#", "fasion");

// 2. Look at the URL to see what the user wants (e.g., category.php?type=formal)
$type = $_GET['type']; 

// 3. The "Filter" - Get ONLY the distinct items for this category
$result = $conn->query("SELECT * FROM product WHERE category = '$type'");

echo "<h1>Showing $type Wear</h1>";
echo "<div style='display: flex; gap: 20px;'>";

// 4. THE MAGIC LOOP: This draws a unique box for every row in the DB
while($row = $result->fetch_assoc()) {
    echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
    // This looks for the image name stored in the DB
    <img src="images/<?php echo $row['image_name']; ?>">
<img src="<?php echo $row['image_name']; ?>" style="width:100%; height:250px; object-fit:cover;">
    echo "<b>" . $row['name'] . "</b><br>";
    echo "$" . $row['price'] . "<br>";
    echo "<button>View Details</button>";
    echo "</div>";
}
echo "</div>";
?>