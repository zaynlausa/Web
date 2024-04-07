<?php
include 'client/shop.php';

// Handle adding product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    // Check if the quantity for this product ID is set in the $_POST array
    if (isset($_POST['quantity']) && isset($_POST['quantity'][$product_id])) {
        $quantity_to_add = intval($_POST['quantity'][$product_id]);

        // Check if the input quantity is valid (greater than 0)
        if ($quantity_to_add > 0) {
            // Fetch product details including stock quantity from the database
            $query_product = "SELECT product_name, stock_quantity, price FROM products WHERE product_id = ?";
            $stmt_product = $db->prepare($query_product);
            $stmt_product->execute([$product_id]);
            $product_data = $stmt_product->fetch(PDO::FETCH_ASSOC);

            if ($product_data && isset($product_data['stock_quantity'])) {
                $available_quantity = $product_data['stock_quantity'];

                // Check if adding the item to the cart will exceed the available stock quantity
                if ($quantity_to_add > $available_quantity) {
                    $quantity_to_add = $available_quantity; // Limit quantity to available stock
                }

                // Check if the product is already in the cart
                $cart_index = array_search($product_id, array_column($_SESSION['cart'], 'product_id'));
                if ($cart_index !== false) {
                    // If the product is already in the cart, update its quantity to the input quantity
                    $_SESSION['cart'][$cart_index]['quantity'] += $quantity_to_add;

                    // Ensure the updated quantity does not exceed the available stock
                    if ($_SESSION['cart'][$cart_index]['quantity'] > $available_quantity) {
                        $_SESSION['cart'][$cart_index]['quantity'] = $available_quantity;
                    }
                } else {
                    // Add the product to the cart session with the selected quantity
                    $_SESSION['cart'][] = [
                        'product_id' => $product_id,
                        'quantity' => $quantity_to_add > $available_quantity ? $available_quantity : $quantity_to_add,
                    ];
                }
                echo "<script>alert('Product added to cart successfully.');</script>";
            } else {
                echo "<script>alert('Product not found or stock quantity not available.');</script>";
            }
        } else {
            echo "<script>alert('Invalid quantity. Please enter a valid quantity.');</script>";
        }
    } else {
        echo "<script>alert('Quantity not set for product ID: " . $product_id . "');</script>";
    }
}

$query = "SELECT product_id, product_name, description, price, stock_quantity, image_url FROM products";
$stmt = $db->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Additional styles for product cards and cart */
        * {
            color: red;
        }
        .container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product-container {
            width: 70%;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product-image img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-details {
            flex-grow: 1;
            padding: 0 10px;
        }

        .cart {
            width: 25%;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .cart h2 {
            margin-bottom: 10px;
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
        }

        .cart-item {
            margin-bottom: 10px;
        }

        .total-price {
            margin-top: 20px;
            font-weight: bold;
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
        .btns {
            color: red;
        }
        .out-of-stock {
            color: #777;
            cursor: not-allowed;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .quantity-input {
            width: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="product-container">
        <?php
            // Display product cards
            foreach ($products as $product) {
                $product_id = $product['product_id'];
                $stock_quantity = $product['stock_quantity'];
                
                if (isset($array['stock_quantity'])) {
                    // The 'stock_quantity' key exists in the array, so it's safe to use it.
                    $stockQuantity = $array['stock_quantity'];
                } else {
                    // The 'stock_quantity' key does not exist, handle the case appropriately.
                    $stockQuantity = 0; // or some default value
                }

                $add_to_cart_btn_class = $stock_quantity > 0 ? 'btns' : 'out-of-stock'; // Use 'out-of-stock' class if stock is 0

                echo "<div class='product-card'>";
                echo "<div class='product-image'>";
                if (!empty($product['image_url'])) {
                    echo "<img src='" . $product['image_url'] . "' alt='" . $product['product_name'] . "' />";
                } else {
                    echo "<p>No image available</p>";
                }
                echo "</div>";
                echo "<div class='product-details'>";
                echo "<h3>" . $product['product_name'] . "</h3>";
                echo "<p>Description: " . $product['description'] . "</p>";
                echo "<p>Price: $" . $product['price'] . "</p>";
                echo "<p>Stocks Available: " . $stock_quantity . "</p>";
                if ($stock_quantity > 0) { // Check if stock is available
                    echo "<form method='post'>"; // Form for "Add to Cart" button
                    echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
                    echo "<label for='quantity[" . $product_id . "]'>Quantity:</label>";
                    echo "<input type='number' class='quantity-input' name='quantity[" . $product_id . "]' min='1' max='" . $stock_quantity . "' value='1'>"; // Set default value to 1
                    echo "<button type='submit' name='add_to_cart' class='" . $add_to_cart_btn_class . "'>Add to Cart</button>";
                    echo "</form>";
                } else {
                    echo "<a href='#' class='out-of-stock'>Out of Stock</a>"; // Display "Out of Stock" link
                }
                echo "<form method='get' action='product_details.php'>";
                echo "<input type='hidden' name='product_id' value='" . $product_id . "'>";
                echo "<button type='submit' name='view_product' class='btns'>View Product</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        ?>
        </div>
        <div class="cart">
            <h2>Your Cart</h2>
            <?php
            // Display cart items with merged duplicates
            if (!empty($_SESSION['cart'])) {
                $cart_items = array_count_values($_SESSION['cart']); // Count occurrences of each product ID in the cart
                $total_price = 0; // Initialize total price
                echo "<div class='cart-items'>";
                foreach ($cart_items as $product_id => $quantity) {
                    // Fetch product details from database
                    $query_cart = "SELECT product_name, price FROM products WHERE product_id = ?";
                    $stmt_cart = $db->prepare($query_cart);
                    $stmt_cart->execute([$product_id]);
                    $cart_product = $stmt_cart->fetch(PDO::FETCH_ASSOC);

                    if ($cart_product) {
                        echo "<div class='cart-item'>";
                        echo "<p>Name: " . $cart_product['product_name'] . "</p>";
                        echo "<p>Quantity: " . $quantity  . "</p>";
                        $total_item_price = $quantity * $cart_product['price']; // Calculate total price for this item
                        echo "<p>Price: $" . $total_item_price . "</p>";
                        echo "</div>";
                        $total_price += $total_item_price; // Update total price
                    }
                }
                echo "</div>";
                echo "<div class='total-price'>";
                echo "<p>Total Price: $" . $total_price . "</p>";
                echo "</div>";
                echo "<a href='checkout.php' class='checkout-btn'>Checkout</a>"; // Checkout button
            } else {
                echo "<p>Your cart is empty</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>


