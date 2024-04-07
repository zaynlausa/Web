<?php
// Start or resume the session

include 'nav.php';

// Initialize the cart session variable if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, retrieve cart items from the database based on user ID

    // Fetch user ID based on username from the session
    $username = $_SESSION['username']; // Assuming the username is stored in $_SESSION['username']

    // Fetch user ID from the database
    $query_user_id = "SELECT user_id FROM students WHERE username = ?";
    $stmt_user_id = $db->prepare($query_user_id);
    $stmt_user_id->execute([$username]);
    $user_id_row = $stmt_user_id->fetch(PDO::FETCH_ASSOC);

    if ($user_id_row) {
        $user_id = $user_id_row['user_id']; // Extract the user ID from the fetched row

        // Fetch cart items for the user from the cart table
        $query_cart_items = "SELECT product_id FROM cart WHERE user_id = ?";
        $stmt_cart_items = $db->prepare($query_cart_items);
        $stmt_cart_items->execute([$user_id]);
        $cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_COLUMN);

        // Populate the cart session variable with retrieved cart items
        $_SESSION['cart'] = $cart_items;
    }
}

// Handle adding product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    // Fetch user ID based on username from the session
    $query_user_id = "SELECT user_id FROM students WHERE username = ?";
    $stmt_user_id = $db->prepare($query_user_id);
    $stmt_user_id->execute([$_SESSION['username']]);
    $user_id_row = $stmt_user_id->fetch(PDO::FETCH_ASSOC);

    if ($user_id_row) {
        $user_id = $user_id_row['user_id']; // Extract the user ID from the fetched row

        // Retrieve the quantity input value directly from the POST data
        $quantity_to_add = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        // Check if the input quantity is valid (greater than 0)
        if ($quantity_to_add > 0) {
            // Insert cart item into the database with the correct quantity
            $insert_query = "INSERT INTO cart (product_id, user_id, quantity) VALUES (?, ?, ?)";
            $stmt_insert = $db->prepare($insert_query);
            $stmt_insert->execute([$product_id, $user_id, $quantity_to_add]);

            // Add product to cart session variable with the selected quantity
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'quantity' => $quantity_to_add,
            ];

            echo "<script>alert('Product added to cart successfully.');</script>";
        } else {
            echo "<script>alert('Invalid quantity. Please enter a valid quantity.');</script>";
        }
    }

    header("Location: shop.php"); // Redirect back to the shop page after adding to cart
    exit();
}

// Fetch products data using PDO prepared statement
include 'server/connect.php'; // Include the file that establishes the PDO database connection
$query = "SELECT product_id, product_name, description, price, stock_quantity, image_url FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
