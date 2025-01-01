<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            padding: 30px;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #ff7a00;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .card-body h4 {
            font-size: 24px;
            color: #333;
        }
        .card-body p {
            font-size: 36px;
            color: #ff7a00;
            font-weight: bold;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #ff7a00;
            color: white;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .btn {
            background-color: #ff7a00;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn:hover {
            background-color: #e66c00;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mb-4">Laporan Penjualan</h1>

    <!-- Statistik Laporan -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Transaksi
                </div>
                <div class="card-body">
                    <h4>Total Transaksi</h4>
                    <p>150</p>
                    <button class="btn">Lihat Detail</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Jumlah Penjualan
                </div>
                <div class="card-body">
                    <h4>Total Jumlah Penjualan</h4>
                    <p>1,200</p>
                    <button class="btn">Lihat Detail</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran
                </div>
                <div class="card-body">
                    <h4>Total Pembayaran</h4>
                    <p>12,000,000</p>
                    <button class="btn">Lihat Detail</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card mt-4">
        <div class="card-header">
            Daftar Transaksi
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jumlah Penjualan</th>
                        <th>Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2025-01-01</td>
                        <td>10</td>
                        <td>1,000,000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2025-01-02</td>
                        <td>15</td>
                        <td>1,500,000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>2025-01-03</td>
                        <td>7</td>
                        <td>700,000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>2025-01-04</td>
                        <td>25</td>
                        <td>2,500,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
