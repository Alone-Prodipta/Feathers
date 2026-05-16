<?php
session_start();

// 1. HANDLE ADDING ITEMS
if (isset($_POST['add_to_cart'])) {
    $qty = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    // FIXED: Corrected array syntax for color and size
    $item = [
        'id'       => $_POST['product_id'],
        'name'     => $_POST['product_name'],
        'price'    => $_POST['product_price'],
        'color'    => $_POST['color'], 
        'size'     => $_POST['size'],  
        'quantity' => $qty
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if item with SAME ID, SIZE, and COLOR already exists
    $found = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $item['id'] && $cart_item['color'] == $item['color'] && $cart_item['size'] == $item['size']) {
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

// 2. HANDLE REMOVING ITEMS (Code remains the same)
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header("Location: cart.php");
    exit();
}

// 3. HANDLE QUANTITY UPDATES
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    // We need the key to ensure we update the right variation (size/color)
    foreach ($_SESSION['cart'] as $key => &$item) {
        if ($item['id'] == $id && $key == $_GET['key']) { // Added key check for uniqueness
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
        .color-badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; background: #f0f0f0; }
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
                                    <p class="fw-bold mb-0"><?php echo htmlspecialchars($item['name']); ?></p>
                                    <small class="text-muted">ID: <?php echo $item['id']; ?></small>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            
                            <!-- FIXED: Displaying actual Size and Color from Session -->
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($item['size']); ?></span></td>
                            <td><span class="color-badge"><?php echo htmlspecialchars($item['color']); ?></span></td>
                            
                            <td>
                                <a href="cart.php?action=sub&id=<?php echo $item['id']; ?>&key=<?php echo $key; ?>" class="btn-qty">-</a>
                                <span class="mx-2"><?php echo $item['quantity']; ?></span>
                                <a href="cart.php?action=add&id=<?php echo $item['id']; ?>&key=<?php echo $key; ?>" class="btn-qty">+</a>
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
                        <p class="fs-4 text-muted">Your bag is empty</p>
                        <a href="index.php" class="btn btn-dark px-4">Browse Collection</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Summary Column -->
            <div class="col-md-4">
                <div class="p-4 border rounded-4 bg-light">
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>