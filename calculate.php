
<?php
include_once "cal.php";

// Module 2: Display Area Result
function displayResult($area) {
    return "Rectangle Area: " . $area . " square units";
}

$area = "";
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $length = $_POST["length"];
    $width = $_POST["width"];

    // Validate input
    if (
        $length === "" || $width === "" ||
        !is_numeric($length) || !is_numeric($width) ||
        $length <= 0 || $width <= 0
    ) {
        $error = "Please enter valid length and width.";
    } else {

        // Calling Module 1 from cal.php
        $area = calculateArea($length, $width);

        // Calling Module 2
        $result = displayResult($area);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Area Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Area Calculator</h2>

    <p class="subtitle">Calculate Rectangle Area</p>

    <form method="POST" action="">

        <label>Length</label>

        <input
            type="number"
            name="length"
            step="any"
            min="0.1"
            placeholder="Enter length"
            value="<?php echo htmlspecialchars($_POST['length'] ?? ''); ?>"
            required
        >

        <label>Width</label>

        <input
            type="number"
            name="width"
            step="any"
            min="0.1"
            placeholder="Enter width"
            value="<?php echo htmlspecialchars($_POST['width'] ?? ''); ?>"
            required
        >

        <button type="submit">Calculate Area</button>

    </form>

    <?php if ($error != "") { ?>

        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php } ?>

    <?php if ($result != "") { ?>

        <div class="result">

            <h3>Calculation Result</h3>

            <p>
                Length:
                <strong><?php echo htmlspecialchars($length); ?></strong>
            </p>

            <p>
                Width:
                <strong><?php echo htmlspecialchars($width); ?></strong>
            </p>

            <p class="total">
                <?php echo htmlspecialchars($result); ?>
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>
