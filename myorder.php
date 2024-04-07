<?php
// Start or resume the session

// Include necessary files
include 'nav.php'; // Assuming this file includes database connection and other functions

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user ID based on username from the session
    $query_user_id = "SELECT user_id FROM students WHERE username = ?";
    $stmt_user_id = $db->prepare($query_user_id);
    $stmt_user_id->execute([$username]);
    $user_id_row = $stmt_user_id->fetch(PDO::FETCH_ASSOC);

    if ($user_id_row) {
        $user_id = $user_id_row['user_id']; // Extract the user ID from the fetched row

        // Fetch orders for the user from the orders table
        $query_orders = "SELECT order_id, order_date, total_amount, status FROM orders WHERE user_id = ?";
        $stmt_orders = $db->prepare($query_orders);
        $stmt_orders->execute([$user_id]);
        $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

        if ($orders) {
            echo "<h2>Your Orders</h2>";
            echo "<table>";
            echo "<tr><th>Order ID</th><th>Order Date</th><th>Total Amount</th><th>Status</th></tr>";
            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . $order['order_id'] . "</td>";
                echo "<td>" . $order['order_date'] . "</td>";
                echo "<td>$" . number_format($order['total_amount'], 2) . "</td>";
                echo "<td>" . $order['status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No orders found.</p>";
        }
    } else {
        echo "<p>User ID not found.</p>";
    }
} else {
    echo "<p>User not logged in.</p>";
}
?>
