<?php $active = 'service'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Laundry</title>

    <style>
        body {
            background-color: #3368A0;
            font-family: Arial;
            margin: 0;
        }


        .box {
            width: 400px;
            background-color: #66A3BF;
            margin: 50px auto 100px;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #C8DFDB;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #F2EFE7;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .option {
            display: block;
            background: #ffffff;
            color: #1c2b4a;
            border-radius: 6px;
            padding: 10px 12px;
            margin-top: 8px;
            cursor: pointer;
        }
        .option input {
            margin-right: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>


    <div class="box">

        <h2>Input Your Laundry Details</h2>

        <form action="data.php" method="POST">

            <label>Package Type</label>

            <label class="option">
                <input type="radio" name="package" value="kg" checked>
                Kg &mdash; Rp7.000 (2 days)
            </label>

            <label class="option">
                <input type="radio" name="package" value="piece">
                Piece &mdash; Rp10.000 (1 day)
            </label>

            <label class="option">
                <input type="radio" name="package" value="express">
                Express &mdash; Rp15.000 (7 hours)
            </label>

            <button type="submit">
                Save
            </button>

        </form>

    </div>

</body>
</html>