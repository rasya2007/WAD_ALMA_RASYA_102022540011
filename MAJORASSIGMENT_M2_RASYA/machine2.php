<?php
session_start();

// Only set the starting data once per session, so Update/Delete "stick"
// when the page reloads. Refresh the session (or close the browser) to reset.
if (!isset($_SESSION["machines"])) {
    $_SESSION["machines"] = [
        ["machinetype" => "Washer", "brand" => "LG",         "capacity" => 11, "status" => true],
        ["machinetype" => "Dryer",  "brand" => "Samsung",    "capacity" => 9,  "status" => true],
        ["machinetype" => "Washer", "brand" => "Electrolux", "capacity" => 14, "status" => false],
        ["machinetype" => "Dryer",  "brand" => "Panasonic",  "capacity" => 12, "status" => true],
        ["machinetype" => "Washer", "brand" => "Sharp",      "capacity" => 8,  "status" => true],
        ["machinetype" => "Dryer",  "brand" => "Haier",      "capacity" => 10, "status" => false],
    ];
}
$machines = &$_SESSION["machines"];

// Handle Add / Update / Delete, then reload the page (Post/Redirect/Get pattern)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        $machines[] = [
            "machinetype" => $_POST["machinetype"],
            "brand"       => $_POST["brand"],
            "capacity"    => (int) $_POST["capacity"],
            "status"      => $_POST["status"] === "1",
        ];
    }

    if (isset($_POST["update"])) {
        $i = (int) $_POST["update"];
        if (isset($machines[$i])) {
            $machines[$i]["status"] = $_POST["status_" . $i] === "1";
        }
    }

    if (isset($_POST["delete"])) {
        $i = (int) $_POST["delete"];
        unset($machines[$i]);
        $machines = array_values($machines); // re-number the array
    }

    header("Location: machine2.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Machinery &amp; Equipment Module</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #3368A0;
            color: #F2EFE7;
            margin: 0;
            padding: 0 0 32px;
        }
        .page {
            max-width: 720px;
            margin: 0 auto;
            padding: 0 16px;
        }
        h1 {
            color: #C8DFDB;
            font-size: 26px;
            margin: 0 0 20px;
            text-align: center;
        }
        h2 {
            color: #C8DFDB;
            font-size: 18px;
            margin: 0 0 14px;
        }
        .card {
            background: #66A3BF;
            border-radius: 8px;
            padding: 20px 24px;
            margin-bottom: 20px;
            overflow-x: auto;
        }
        .add-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .add-form input,
        .add-form select {
            flex: 1;
            min-width: 120px;
        }
        .add-form button {
            flex: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }
        th {
            background: #1c2b4a;
            color: #F2EFE7;
            text-align: left;
            padding: 10px;
            font-size: 14px;
        }
        td {
            padding: 10px;
            border: 1px solid #66A3BF;
            color: #1c2b4a;
            font-size: 14px;
        }
        select,
        input[type="text"],
        input[type="number"] {
            font-size: 14px;
            padding: 6px 8px;
            border: 1px solid #3368A0;
            border-radius: 6px;
            background: #ffffff;
            color: #1c2b4a;
        }
        button {
            padding: 6px 12px;
            font-size: 13px;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            color: #F2EFE7;
            font-weight: bold;
        }
        button[name="add"] {
            background: #1c2b4a;
        }
        button[name="update"] {
            background: #1c2b4a;
        }
        button[name="delete"] {
            background: #A0333F;
        }
        button:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

<?php $active = 'machine'; include 'header.php'; ?>

<div class="page">

    <h1>Machinery &amp; Equipment Module</h1>

    <div class="card">
        <h2>Add machine</h2>
        <form method="POST" action="" class="add-form">
            <select name="machinetype" required>
                <option value="Washer">Washer</option>
                <option value="Dryer">Dryer</option>
            </select>
            <input type="text" name="brand" placeholder="Brand" required>
            <input type="number" name="capacity" placeholder="Capacity (kg)" required>
            <select name="status">
                <option value="1">Operational</option>
                <option value="0">Not Operational</option>
            </select>
            <button type="submit" name="add" value="1">Add</button>
        </form>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Machine</th>
                <th>Brand</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($machines as $i => $m): ?>
            <tr>
                <form method="POST" action="">
                    <td><?= $m["machinetype"] ?></td>
                    <td><?= $m["brand"] ?></td>
                    <td><?= $m["capacity"] ?> kg</td>
                    <td>
                        <select name="status_<?= $i ?>">
                            <option value="1" <?= $m["status"] ? "selected" : "" ?>>Operational</option>
                            <option value="0" <?= !$m["status"] ? "selected" : "" ?>>Not Operational</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="update" value="<?= $i ?>">Update</button>
                    </td>
                    <td>
                        <button type="submit" name="delete" value="<?= $i ?>"
                                onclick="return confirm('Delete this machine?')">Delete</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($machines)): ?>
            <tr>
                <td colspan="6">No machines yet.</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

</div>
</body>
</html>