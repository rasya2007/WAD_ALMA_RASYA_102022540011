<?php
session_start();

/* ===== 1. DEFAULT DATA ===== */
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [
        ['brand' => 'Rinso', 'category' => 'Detergent', 'supplier' => 'PT Unilever', 'stock' => 12, 'status' => 'Still Available'],
        ['brand' => 'Downy', 'category' => 'Softener',  'supplier' => 'PT P&G',      'stock' => 3,  'status' => 'Need Order'],
        ['brand' => 'Glade', 'category' => 'Fragrance', 'supplier' => 'PT Johnson',  'stock' => 8,  'status' => 'Still Available'],
    ];
}

/* ===== 2. ADD ITEM ===== */
if (isset($_POST['add'])) {
    $_SESSION['items'][] = [
        'brand'    => $_POST['brand'],
        'category' => $_POST['category'],
        'supplier' => $_POST['supplier'],
        'stock'    => (int)$_POST['stock'],
        'status'   => $_POST['status'],
    ];
}

/* ===== 3. UPDATE ITEM ===== */
if (isset($_POST['update'])) {
    $i = (int)$_POST['index'];
    $_SESSION['items'][$i]['stock']  = (int)$_POST['stock'];
    $_SESSION['items'][$i]['status'] = $_POST['status'];
}

/* ===== 4. DELETE ITEM ===== */
if (isset($_GET['delete'])) {
    unset($_SESSION['items'][$_GET['delete']]);
    $_SESSION['items'] = array_values($_SESSION['items']);
}

$items = $_SESSION['items'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cleaning Material - Don N Done</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #3368A0;
            color: #C8DFDB;
            margin: 0;
            padding: 0;
        }


        .box {
            background: #66A3BF;
            padding: 20px;
            max-width: 900px;
            margin: 0 auto 30px;
            border-radius: 8px;
        }
        h1 {
            color: #F2EFE7;
            text-align: center;
            margin-top: 0;
        }
        h3 {
            color: #F2EFE7;
            border-bottom: 1px solid #3368A0;
            padding-bottom: 4px;
        }
        label {
            display: block;
            margin-top: 8px;
            font-size: 13px;
            color: #F2EFE7;
            font-weight: bold;
        }
        select, input[type=text], input[type=number] {
            padding: 6px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #3368A0;
            border-radius: 4px;
            margin-bottom: 8px;
            background: #ffffff;
            color: #1c2b4a;
        }
        button {
            background: #1c2b4a;
            color: #F2EFE7;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover { background: #3368A0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #ffffff;
        }
        th {
            background: #1c2b4a;
            color: #F2EFE7;
            padding: 8px;
            border: 1px solid #1c2b4a;
            font-size: 13px;
        }
        td {
            padding: 6px;
            border: 1px solid #66A3BF;
            color: #1c2b4a;
            text-align: center;
            font-size: 13px;
        }
        td input[type=number] {
            width: 70px;
            margin: 0;
            padding: 4px;
            text-align: center;
        }
        td select {
            width: 130px;
            margin: 0;
            padding: 4px;
            font-size: 12px;
        }
        td form { margin: 0; }

        .btn-small { padding: 4px 8px; font-size: 12px; }
        .btn-update { background: #3368A0; }
        .btn-update:hover { background: #1c2b4a; }

        .delete {
            color: #cc0000;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
        }
        .delete:hover { text-decoration: underline; }
    </style>
</head>
<body>

<?php $active = 'cleaning'; include 'header.php'; ?>

<div class="box">
    <h1>Cleaning Material Module</h1>

    <!-- ===== ADD FORM ===== -->
    <h3>Add New Material</h3>
    <form method="POST">
        <label>Category</label>
        <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="Fragrance">Fragrance</option>
            <option value="Detergent">Detergent</option>
            <option value="Softener">Softener</option>
        </select>

        <label>Brand</label>
        <input type="text" name="brand" placeholder="e.g. Rinso" required>

        <label>Supplier</label>
        <input type="text" name="supplier" placeholder="e.g. PT Unilever" required>

        <label>Stock</label>
        <input type="number" name="stock" min="0" required>

        <label>Status</label>
        <select name="status" required>
            <option value="">-- Select Status --</option>
            <option value="Still Available">Still Available</option>
            <option value="Need Order">Need Order</option>
        </select>

        <button type="submit" name="add">+ Add Item</button>
    </form>

    <!-- ===== TABLE ===== -->
    <h3>Material List</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Unit</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if (count($items) == 0): ?>
            <tr><td colspan="8">No data yet.</td></tr>
        <?php else: ?>
            <?php foreach ($items as $i => $item): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($item['brand']) ?></td>
                <td><?= htmlspecialchars($item['category']) ?></td>
                <td><?= htmlspecialchars($item['supplier'] ?? '-') ?></td>
                <td>5 liter</td>

                <td colspan="3">
                    <form method="POST">
                        <input type="hidden" name="index" value="<?= $i ?>">

                        <input type="number" name="stock" min="0"
                               value="<?= (int)$item['stock'] ?>" required>

                        <select name="status" required>
                            <option value="Still Available"
                                <?= ($item['status'] ?? '') == 'Still Available' ? 'selected' : '' ?>>
                                Still Available
                            </option>
                            <option value="Need Order"
                                <?= ($item['status'] ?? '') == 'Need Order' ? 'selected' : '' ?>>
                                Need Order
                            </option>
                        </select>

                        <button type="submit" name="update" class="btn-small btn-update">Update</button>
                        &nbsp;
                        <a class="delete" href="?delete=<?= $i ?>"
                           onclick="return confirm('Delete this item?')">Delete</a>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>

</body>
</html>