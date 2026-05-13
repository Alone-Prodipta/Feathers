<?php
// 1. DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "Prodipta_007#"; 
$dbname = "fasion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : 'formal';

// FETCH PRODUCTS
$sql = "SELECT * FROM product WHERE category = '$type'";
$result = $conn->query($sql);
?>
<html>
<head>
    <title>Showing <?php echo ucfirst($type); ?> Wear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Lemon" rel="stylesheet">
</head>
<body style="background-color: bisque;">
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: bisque;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="font-family:lobster;color:rgb(4, 72, 4);"><u>Feathers</u>.</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="home.html">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Shop</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="brain.php?type=formal">Formal</a></li>
                        <li><a class="dropdown-item" href="brain.php?type=casual">Casual</a></li>
                    </ul>
                </li>
            </ul>
            <a href="cart.php" class="btn btn-outline-success">Cart</a>
        </div>
    </div>
</nav>

<div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 100px; padding: 20px;">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div style="border: 2px solid green; padding: 10px; width: 220px; text-align: center; border-radius: 8px; background: white;">
                <img src="<?php echo $row['image_name']; ?>" style="width:100%; height:250px; object-fit:cover; border-radius: 5px;">
                <div style="margin-top: 10px;">
                    <b><?php echo $row['name']; ?></b><br>
                    <span style="color: #058f3e; font-weight: bold;">$<?php echo $row['price']; ?></span><br>
                    <a href="details.php?id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                        <button style="margin-top: 10px; font-family: Lemon; color: white; background-color: green; padding: 8px 15px; border-radius: 10px; border: none; cursor: pointer;">
                            View Details
                        </button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>