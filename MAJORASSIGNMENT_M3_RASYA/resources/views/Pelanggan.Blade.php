<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Data Module - Laravel</title>
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
        button.btn-add, button.btn-update {
            background: #1c2b4a;
        }
        button.btn-delete {
            background: #A0333F;
        }
        button:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

<div class="page" style="margin-top: 30px;">

    <h1>Customer Data Module (Laravel)</h1>

    <!-- Form Add Customer -->
    <div class="card">
        <h2>Add customer</h2>
        <form action="{{ route('pelanggan.store') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="nama" placeholder="Name" required>
            <input type="text" name="telepon" placeholder="Phone number" required>
            <input type="text" name="alamat" placeholder="Address">
            <input type="text" name="catatan" placeholder="Special handling notes">
            <button type="submit" class="btn-add">Add</button>
        </form>
    </div>

    <!-- Table Data Customer -->
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

            @forelse ($pelanggan as $index => $p)
            <tr>
                <td>
                    <form action="{{ route('pelanggan.update', $p->id) }}" method="POST" id="update-form-{{ $p->id }}">
                        @csrf
                        @method('PUT')
                        {{ $index + 1 }}
                </td>
                <td><input type="text" name="nama_{{ $p->id }}" value="{{ old('nama_' . $p->id, $p->nama) }}"></td>
                <td><input type="text" name="telepon_{{ $p->id }}" value="{{ old('telepon_' . $p->id, $p->telepon) }}"></td>
                <td><input type="text" name="alamat_{{ $p->id }}" value="{{ old('alamat_' . $p->id, $p->alamat) }}"></td>
                <td><input type="text" name="catatan_{{ $p->id }}" value="{{ old('catatan_' . $p->id, $p->catatan) }}"></td>
                <td>
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Delete this customer?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">No customers yet.</td>
            </tr>
            @endforelse
        </table>
    </div>

</div>
</body>
</html>