<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Multiple Values and Display with PHP</title>
</head>

<body>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['values'])) {
        // Retrieve selected values from the POST data
        $selectedValues = $_POST['values'];

        // Display selected values
        echo "<h2>Selected Values:</h2>";
        echo "<ul>";
        foreach ($selectedValues as $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Select multiple values:</label><br>
        <select name="values[]" multiple>
            <option value="Value 1" selected>Value 1</option>
            <option value="Value 2" selected>Value 2</option>
            <option value="Value 3">Value 3</option>
            <!-- Add more options for additional values -->
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>