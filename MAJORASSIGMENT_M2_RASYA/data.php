<?php
$active = null; // no module tab is "current" on this receipt page

// PHP decides the price and time from the package name,
// instead of trusting whatever the browser sends for price/time.
$packages = [
    "kg"      => ["label" => "Kg",      "price" => "Rp7.000",  "time" => "2 days"],
    "piece"   => ["label" => "Piece",   "price" => "Rp10.000", "time" => "1 day"],
    "express" => ["label" => "Express", "price" => "Rp15.000", "time" => "7 hours"],
];

$choice = $_POST["package"] ?? "kg";
$selected = $packages[$choice] ?? $packages["kg"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laundry Data</title>

    <style>
        body {
            background-color: #3368A0;
            font-family: Arial;
            margin: 0;
        }

        .box {
            width: 400px;
            background-color: #66A3BF;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #C8DFDB;
        }

        p {
            color: #F2EFE7;
            font-size: 16px;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: white;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>


    <div class="box">

        <h2>Laundry Details</h2>

        <p>
            <b>Package Type:</b>
            <?= htmlspecialchars($selected["label"]) ?>
        </p>

        <p>
            <b>Price List:</b>
            <?= htmlspecialchars($selected["price"]) ?>
        </p>

        <p>
            <b>Time Estimate:</b>
            <?= htmlspecialchars($selected["time"]) ?>
        </p>

        <a class="back" href="service.php">
            Back to Form
        </a>

    </div>

</body>
</html>