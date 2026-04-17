<?php
include '../connect.php';

// Allowed tables for count
$allowedTables = ['customers', 'orders', 'activity_log'];

// Safe count function
function getCount($conn, $table) {
    global $allowedTables;
    if (!in_array($table, $allowedTables)) return 0;
    $res = $conn->query("SELECT COUNT(*) as total FROM $table");
    if ($res) {
        return (int)$res->fetch_assoc()['total'];
    }
    return 0;
}

$customers = getCount($conn, "customers");
$orders = getCount($conn, "orders");
$logs = getCount($conn, "activity_log");

// Prepare chart data
$labels = [];
$data = [];
$res = $conn->query("SELECT name FROM customers LIMIT 5");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $labels[] = htmlspecialchars($row['name']);
        $data[] = rand(1, 10); // Replace with real data if needed
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; background: #f4f6f9; margin: 0; padding: 0; }
        h1, h2 { text-align: center; }
        .cards { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .card { padding: 20px; color: white; width: 150px; text-align: center; border-radius: 10px; }
        .blue { background: #007bff; }
        .green { background: #28a745; }
        .orange { background: #ffc107; color: black; }
        table { width: 90%; margin: 20px auto; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
        .section { margin-top: 30px; }
    </style>
</head>
<body>

<h1>📊 DASHBOARD</h1>

<div class="cards">
    <div class="card blue">
        <h3>Customers</h3>
        <h2><?php echo $customers; ?></h2>
    </div>
    <div class="card green">
        <h3>Orders</h3>
        <h2><?php echo $orders; ?></h2>
    </div>
    <div class="card orange">
        <h3>Logs</h3>
        <h2><?php echo $logs; ?></h2>
    </div>
</div>

<div class="section">
<h2>📈 Customers Chart</h2>
<canvas id="chart" style="max-width:600px; margin:auto;"></canvas>
</div>

<script>
new Chart(document.getElementById("chart"), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Orders',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: '#007bff'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

<div class="section">
<h2>📦 Orders</h2>
<table>
<tr>
<th>Customer</th>
<th>Product</th>
<th>Qty</th>
<th>Total</th>
</tr>

<?php
$sql = "SELECT c.name, p.product_name, o.quantity,
IFNULL(o.quantity * p.price, 0) AS total
FROM orders o
JOIN customers c ON o.customer_id = c.customer_id
JOIN products p ON o.product_id = p.product_id
LIMIT 5";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . htmlspecialchars($row['name']) . "</td>
        <td>" . htmlspecialchars($row['product_name']) . "</td>
        <td>" . (int)$row['quantity'] . "</td>
        <td>" . number_format($row['total'], 2) . "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data</td></tr>";
}
?>
</table>
</div>

</body>
</html>
