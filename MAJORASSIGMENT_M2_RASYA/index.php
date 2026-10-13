<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Don N Done</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #3368A0;
            color: #F2EFE7;
            margin: 0;
            padding: 0 0 32px;
        }
        .page {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 16px;
        }
        h1 {
            color: #C8DFDB;
            font-size: 40px;
            margin: 24px 0 8px;
            text-align: center;
        }
        p.intro {
            text-align: center;
            margin: 0 0 24px;
            font-size: 15px;
        }
        .card {
            background: #66A3BF;
            border-radius: 8px;
            padding: 10px 24px;
        }
        .card a {
            display: block;
            padding: 14px 0;
            border-bottom: 1px solid #3368A0;
            color: #F2EFE7;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
        }
        .card a:last-child {
            border-bottom: none;
        }
        .card a:hover {
            color: #C8DFDB;
        }

        header {
            background: #1c2b4a;
            color: #C8DFDB;
            padding: 16px 24px;
            margin-bottom: 24px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <h1 class="brand">Don N Done</h1>
</header>

<div class="page">
    <h1>Don N Done Laundry System</h1>
    <p class="intro">Pick a module to get started.</p>

    <div class="card">
        <a href="service.php">Service &amp; Rate Module</a>
        <a href="machine2.php">Machinery &amp; Equipment Module</a>
        <a href="pelanggan.php">Customer Data Module</a>
        <a href="cleaning.php">Cleaning Material Module</a>
    </div>
</div>

</body>
</html>
