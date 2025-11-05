<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Transaksi POLGAN MART</title>
<style>
    body {
        background-color: #f2f2f2;
        font-family: 'Courier New', monospace;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .struk {
        background-color: white;
        width: 320px;
        padding: 20px;
        border: 1px dashed #000;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    td {
        padding: 4px 3px;
        vertical-align: top;
    }

    .right {
        text-align: right;
    }

    .right {
        text-align: center;
    }

    /* Lebar kolom agar sejajar */
    td:nth-child(1) { width: 40%; } /* Nama barang */
    td:nth-child(2) { width: 15%; } /* Qty */
    td:nth-child(3) { width: 15%; } /* Harga */
    td:nth-child(4) { width: 30%; } /* Total */

    /* Tambahan untuk merapikan posisi Rp */
    .rupiah {
        display: flex;
        justify-content: space-between;
    }

    .rupiah span:first-child {
        min-width: 25px; /* agar "Rp" sejajar */
        text-align: left;
    }

    .total {
        border-top: 1px dashed black;
        font-weight: bold;
        padding-top: 5px;
    }

    .header, .footer {
        text-align: center;
        border-bottom: 1px dashed black;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .footer {
        border-top: 1px dashed black;
        border-bottom: none;
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="struk">
<?php
/*Setup awal */

// Buat array nama barang dan harga barang
$nama_barang = [
    "Sabun" => 4000,
    "Sampo" => 12000,
    "Odol" => 8000,
    "Teh" => 5000,
    "Kopi" => 15000,
    "Susu" => 18000,
    "Mie Instan" => 3500,
    "Gula" => 14000,
    "Beras" => 60000,
    "Minyak Goreng" => 28000
];

// Cetak header struk
echo "<div class='header'>";
echo "<h2>===POLGAN MART===</h2>";
echo "<p>Jl. Veteran Jl. Manunggal No.194,<br>
Helvetia, Kec. Sunggal, Kab. Deli Serdang,<br>
Sumatera Utara 20116<br>
Politeknik Teknik Ganesha Medan</p>";
echo "<p>Tanggal: " . date('d/m/Y H:i:s') . "</p>";
echo "</div>";

/*Logika pembelian*/
$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

$keys = array_keys($nama_barang);
shuffle($keys);
$jumlah_produk = rand(3, 6);

for ($i = 0; $i < $jumlah_produk; $i++) {
    $barang = $keys[$i];
    $harga = $nama_barang[$barang];
    $qty = rand(1, 5);
    $subtotal = $harga * $qty;

    $beli[] = $barang;
    $jumlah[] = $qty;
    $total[] = $subtotal;
    $grandtotal += $subtotal;
}
?>
