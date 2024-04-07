<style>
    .btns { 
        color: red;
    }
</style>

<?php
// Include necessary files and initialize session if needed
include 'client/shop.php'; // Assuming this file includes database connection and other functions

// Check if product_id is provided in the URL
if (isset($_GET['product_id'])) {
    // Get the product ID from the URL
    $product_id = $_GET['product_id'];

    // Fetch product details from the database based on the product ID
    $query_product = "SELECT * FROM products WHERE product_id = ?";
    $stmt_product = $db->prepare($query_product);
    $stmt_product->execute([$product_id]);
    $product = $stmt_product->fetch(PDO::FETCH_ASSOC);

    // Display product details
    if ($product) {
        echo "<h2>Product Details</h2>";
        echo "<p>Product ID: " . $product['product_id'] . "</p>";
        echo "<p>Product Name: " . $product['product_name'] . "</p>";
        echo "<p>Description: " . $product['description'] . "</p>";
        echo "<p>Price: $" . $product['price'] . "</p>";
        echo "<p>Stock Quantity: " . $product['stock_quantity'] . "</p>";
        echo "<a href='shop.php'>back</a>";
        // Add to Cart button with form for posting product_id
       
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>Product ID not provided.</p>";
}
?>
