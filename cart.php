<?php
session_start();

// 1. Handle Adding Items with Size & Colour Choices
if (isset($_POST['add_to_cart'])) {
    $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $size = isset($_POST['product_size']) ? $_POST['product_size'] : 'M';
    $colour = isset($_POST['product_colour']) ? $_POST['product_colour'] : 'Standard';
    
    $item = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'quantity' => $qty,
        'size' => $size,
        'colour' => $colour
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Match matching ID AND variations to increment quantity correctly
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id'] && $cart_item['size'] == $size && $cart_item['colour'] == $colour) {
            $cart_item['quantity'] += $qty;
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
    
    header("Location: cart.php");
    exit();
}

// 2. Handle Removing Items
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header("Location: cart.php");
    exit();
}

// 3. Handle Quantity Updates
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            if ($_GET['action'] == 'add') $item['quantity']++;
            if ($_GET['action'] == 'sub' && $item['quantity'] > 1) $item['quantity']--;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Boutique Cart | Your Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .cart-container { background: white; border-radius: 20px; padding: 40px; margin-top: 50px; }
        .btn-qty { background: #eee; border: none; padding: 2px 10px; border-radius: 5px; text-decoration: none; color: black; }
        .checkout-box { background: #fff; border-left: 1px solid #eee; padding-left: 20px; }
    </style>
</head>
<body>
    <div class="container cart-container shadow-sm">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4">Shopping Bag <span class="text-muted fs-5">(<?php echo count($_SESSION['cart'] ?? []); ?> items)</span></h2>
                
                <?php if (!empty($_SESSION['cart'])): ?>
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Colour</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        foreach ($_SESSION['cart'] as $key => $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $grand_total += $subtotal;
                        ?>
                        <tr>
                            <td>
                                <div class="ms-3">
                                    <p class="fw-bold mb-0"><?php echo $item['name']; ?></p>
                                    <small class="text-muted">ID: <?php echo $item['id']; ?></small>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            
                            <td class="text-muted fw-bold"><?php echo htmlspecialchars($item['size']); ?></td>
                            <td class="text-muted"><?php echo htmlspecialchars($item['colour']); ?></td>
                            
                            <td>
                                <a href="cart.php?action=sub&id=<?php echo $item['id']; ?>" class="btn-qty">-</a>
                                <span class="mx-2"><?php echo $item['quantity']; ?></span>
                                <a href="cart.php?action=add&id=<?php echo $item['id']; ?>" class="btn-qty">+</a>
                            </td>
                            <td class="fw-bold">$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <a href="cart.php?remove=<?php echo $key; ?>" class="text-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fa fa-shopping-bag fa-4x text-light mb-3"></i>
                        <p class="fs-4 text-muted">Your bag is empty</p>
                        <a href="brain.php" class="btn btn-dark px-4">Browse Collection</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4 checkout-box">
                <h4 class="mb-4">Summary</h4>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($grand_total ?? 0, 2); ?></span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span>Shipping</span>
                    <span class="text-success">FREE</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4 fs-4 fw-bold">
                    <span>Total</span>
                    <span>$<?php echo number_format($grand_total ?? 0, 2); ?></span>
                </div>
                <button class="btn btn-dark w-100 py-3 mb-3 rounded-pill" <?php echo empty($_SESSION['cart']) ? 'disabled' : ''; ?>>
                    Proceed to Checkout
                </button>
                <a href="brain.php" class="btn btn-outline-secondary w-100 py-3 rounded-pill">Continue Shopping</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>