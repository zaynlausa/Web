<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Database connection
    $host = 'localhost';
    $dbname = 'ActivityPHP';
    $user = 'postgres';
    $password = 'lausa2004';

    $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$conn) {
        echo "Error: Unable to connect to database.\n";
        exit;
    }

    // Fetch product details
    $result = pg_query_params($conn, "SELECT * FROM Products WHERE product_id = $1", array($product_id));

    if (pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);

        // Display product details and purchase form
        echo "<h2>Product Details</h2>";
        echo "<p><strong>Product Name:</strong> " . $row['product_name'] . "</p>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";

        // Purchase form
        echo "<h3>Enter Quantity and Proceed to Checkout</h3>";
        echo "<form action='checkout.php' method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
        echo "<label for='quantity'>Quantity:</label>";
        echo "<input type='number' name='quantity' id='quantity' min='1' required>";
        echo "<br><br>";
        echo "<input type='submit' value='Checkout'>";
        echo "</form>";
    } else {
        echo "Product not found.";
    }

    pg_close($conn);
} else {
    echo "Invalid request.";
}
?>
