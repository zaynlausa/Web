<!-- FINAL CODE -->

<?php
// Start or resume the session

// Include necessary files
include 'nav.php'; // Assuming this file includes database connection and other functions

// Initialize total price variable
$total_price = 0;

// Assuming $user_id is obtained from the database or session
if (isset($user_id)) {
    // Fetch cart items for the user from the cart table based on $user_id
    $query_cart_items = "SELECT c.product_id, p.product_name, p.price, p.stock_quantity, SUM(c.quantity) AS total_quantity
                         FROM cart c
                         INNER JOIN products p ON c.product_id = p.product_id
                         WHERE c.user_id = ?
                         GROUP BY c.product_id, p.product_name, p.price, p.stock_quantity";
    $stmt_cart_items = $db->prepare($query_cart_items);
    $stmt_cart_items->execute([$user_id]);
    $cart_items = $stmt_cart_items->fetchAll(PDO::FETCH_ASSOC);

    // Display cart items and calculate total price
    if ($cart_items) {
        echo "<h2>Cart Items</h2>";
        echo "<ul>";
        foreach ($cart_items as $item) {
            echo "<li>";
            echo "Product ID: " . $item['product_id'] . "<br>";
            echo "Product Name: " . $item['product_name'] . "<br>";
            echo "Price: $" . $item['price'] . "<br>";
            echo "Quantity: " . $item['total_quantity'] . "<br>";
            echo "</li>";

            // Calculate total price for each item and add to the total
            $total_price += ($item['price'] * $item['total_quantity']);
        }
        echo "</ul>";

        // Handle checkout process
        if (isset($_POST['checkout'])) {
            // Check if the available stock is sufficient for each product
            $insufficient_stock = false;
            foreach ($cart_items as $item) {
                if ($item['total_quantity'] > $item['stock_quantity']) {
                    $insufficient_stock = true;
                    break;
                }
            }

            if (!$insufficient_stock) {
                // Begin a transaction
                $db->beginTransaction();

                try {
                    // Insert order details into the orders table
                    $order_date = date('Y-m-d H:i:s'); // Current date and time
                    $status = 'Pending'; // Initial status
                    $insert_order_query = "INSERT INTO orders (user_id, order_date, total_amount, status)
                                           VALUES (?, ?, ?, ?)";
                    $stmt_insert_order = $db->prepare($insert_order_query);
                    $stmt_insert_order->execute([$user_id, $order_date, $total_price, $status]);

                    // Get the last inserted order ID
                    $order_id = $db->lastInsertId();

                    // Update product quantities in the products table
                    foreach ($cart_items as $item) {
                        $new_quantity = $item['stock_quantity'] - $item['total_quantity'];
                        $update_quantity_query = "UPDATE products SET stock_quantity = ? WHERE product_id = ?";
                        $stmt_update_quantity = $db->prepare($update_quantity_query);
                        $stmt_update_quantity->execute([$new_quantity, $item['product_id']]);
                    }

                    // Remove all products from the user's cart
                    $delete_cart_items = "DELETE FROM cart WHERE user_id = ?";
                    $stmt_delete_cart = $db->prepare($delete_cart_items);
                    $stmt_delete_cart->execute([$user_id]);

                    // Commit the transaction
                    $db->commit();

                    // Redirect to confirmation page
                    header("Location: checkout_confirmation.php?order_id=$order_id");
                    exit(); // Stop further execution
                } catch (PDOException $e) {
                    // Rollback the transaction if an error occurs
                    $db->rollback();
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "<p>Insufficient stock for some products. Please remove items or reduce quantities.</p>";
            }
        }
    } else {
        echo "<p>No items in the cart.</p>";
    }
} else {
    echo "<p>User ID not found.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Additional styles for checkout page */
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
        <form method="post">
            <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
        </form>
        <a href="myorder.php">My Orders</a>
    </div>
</body>
</html>
