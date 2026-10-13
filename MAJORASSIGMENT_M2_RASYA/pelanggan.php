<?php
session_start();

// Default data, kept in session so it survives page reloads (no database yet)
if (!isset($_SESSION["pelanggan"])) {
    $_SESSION["pelanggan"] = [
        ["nama" => "Budi Santoso", "telepon" => "081234567890", "alamat" => "Jl. Dago No. 10, Bandung",      "catatan" => "Kemeja putih, jangan pakai pemutih"],
        ["nama" => "Siti Aminah",  "telepon" => "081298765432", "alamat" => "Jl. Braga No. 5, Bandung",       "catatan" => "Bahan sutra, cuci lembut"],
        ["nama" => "Andi Pratama", "telepon" => "085711223344", "alamat" => "Jl. Cihampelas No. 21, Bandung", "catatan" => "Jaket kulit, jangan diperas"],
    ];
}
$pelanggan = &$_SESSION["pelanggan"];

// Add / Update / Delete, then reload the page (Post/Redirect/Get pattern)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["add"])) {
        $pelanggan[] = [
            "nama"    => $_POST["nama"],
            "telepon" => $_POST["telepon"],
            "alamat"  => $_POST["alamat"],
            "catatan" => $_POST["catatan"],
        ];
    }

    if (isset($_POST["update"])) {
        $i = (int) $_POST["update"];
        if (isset($pelanggan[$i])) {
            $pelanggan[$i] = [
                "nama"    => $_POST["nama_" . $i],
                "telepon" => $_POST["telepon_" . $i],
                "alamat"  => $_POST["alamat_" . $i],
                "catatan" => $_POST["catatan_" . $i],
            ];
        }
    }

    if (isset($_POST["delete"])) {
        $i = (int) $_POST["delete"];
        unset($pelanggan[$i]);
        $pelanggan = array_values($pelanggan);
    }

    header("Location: pelanggan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Data Module</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #3368A0;
            color: #F2EFE7;
            margin: 0;
            padding: 0 0 32px;
        }
        .page {
            max-width: 900px;
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
        .add-form input {
            flex: 1;
            min-width: 140px;
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
            padding: 8px 10px;
            border: 1px solid #66A3BF;
            color: #1c2b4a;
            font-size: 14px;
        }
        input[type="text"] {
            font-size: 14px;
            padding: 6px 8px;
            border: 1px solid #3368A0;
            border-radius: 6px;
            background: #ffffff;
            color: #1c2b4a;
            width: 100%;
            box-sizing: border-box;
        }
        td input[type="text"] {
            min-width: 110px;
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
        button[name="add"], button[name="update"] {
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

<?php $active = 'pelanggan'; include 'header.php'; ?>

<div class="page">

    <h1>Customer Data Module</h1>

    <div class="card">
        <h2>Add customer</h2>
        <form method="POST" action="" class="add-form">
            <input type="text" name="nama" placeholder="Name" required>
            <input type="text" name="telepon" placeholder="Phone number" required>
            <input type="text" name="alamat" placeholder="Address">
            <input type="text" name="catatan" placeholder="Special handling notes">
            <button type="submit" name="add" value="1">Add</button>
        </form>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Notes</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($pelanggan as $i => $p): ?>
            <tr>
                <form method="POST" action="">
                    <td><?= $i + 1 ?></td>
                    <td><input type="text" name="nama_<?= $i ?>" value="<?= htmlspecialchars($p["nama"]) ?>"></td>
                    <td><input type="text" name="telepon_<?= $i ?>" value="<?= htmlspecialchars($p["telepon"]) ?>"></td>
                    <td><input type="text" name="alamat_<?= $i ?>" value="<?= htmlspecialchars($p["alamat"]) ?>"></td>
                    <td><input type="text" name="catatan_<?= $i ?>" value="<?= htmlspecialchars($p["catatan"]) ?>"></td>
                    <td>
                        <button type="submit" name="update" value="<?= $i ?>">Update</button>
                    </td>
                    <td>
                        <button type="submit" name="delete" value="<?= $i ?>"
                                onclick="return confirm('Delete this customer?')">Delete</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($pelanggan)): ?>
            <tr>
                <td colspan="7">No customers yet.</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

</div>
</body>
</html>