<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
</head>
<body>
    <h2>Electricity Bill Calculator</h2>

    <?php
    // Define the tariff (in cents per unit)
    $tariff = 12; // For example, 12 cents per unit

    // Initialize variables
    $unitsConsumed = "";
    $totalAmount = 0;

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $unitsConsumed = $_POST["unitsConsumed"];

        // Validate input
        if (!empty($unitsConsumed) && is_numeric($unitsConsumed) && $unitsConsumed >= 0) {
            // Calculate total amount
            $totalAmount = $unitsConsumed * $tariff / 100; // Convert tariff to dollars

            // Display the bill
            echo "<h3>Electricity Bill</h3>";
            echo "<p>Units Consumed: $unitsConsumed</p>";
            echo "<p>Tariff: $tariff cents per unit</p>";
            echo "<p>Total Amount: $$totalAmount</p>";
        } else {
            echo "<p style='color: red;'>Please enter a valid number of units consumed.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="unitsConsumed">Enter Units Consumed:</label>
        <input type="number" name="unitsConsumed" value="<?php echo $unitsConsumed; ?>" required>
        <br><br>
        <input type="submit" value="Calculate Bill">
    </form>
</body>
</html>
