<?php
session_start();

// 1. Handle Adding Items
if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'quantity' => 1
    ];

    // If cart is empty, start it. If not, append to it.
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if item already exists to just increase quantity
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id']) {
            $cart_item['quantity']++;
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
}

// 2. Handle Removing Items
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset array keys
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: bisque; padding: 50px; }
        .cart-container { background: white; padding: 30px; border-radius: 15px; border: 2px solid green; }
    </style>
</head>
<body>
    <div class="container cart-container shadow">
        <h2 style="font-family: 'Lobster'; color: #054805;">Your Shopping Cart</h2>
        <hr>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grand_total = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $grand_total += $subtotal;
                        echo "<tr>
                                <td>{$item['name']}</td>
                                <td>\${$item['price']}</td>
                                <td>{$item['quantity']}</td>
                                <td>\${$subtotal}</td>
                                <td><a href='cart.php?remove={$item['id']}' class='btn btn-sm btn-danger'>Remove</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Your cart is empty!</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Grand Total: <span style="color: green;">$<?php echo $grand_total; ?></span></h4>
            <div>
                <a href="brain.php" class="btn btn-outline-success">Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>