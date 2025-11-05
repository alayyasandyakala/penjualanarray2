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
        width: 400px;
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
        padding: 5px 10px;
        vertical-align: top;
    }

    .right {
        text-align: right;
    }

    .center{
        text-align: center;
    }

    /* Lebar kolom agar sejajar */
    td:nth-child(1) { width: 30%; } /* Nama barang */
    td:nth-child(2) { width: 15%; } /* Kode */
    td:nth-child(3) { width: 10%; } /* Qty */
    td:nth-child(4) { width: 20%; } /* Harga */
    td:nth-child(5) { width: 25%; } /* Total */

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
        padding-top: 5px;
    }

    .total td:first-child,
    .total td[colspan='4'] {
        font-weight: bold;
    }

    .total .rupiah span:last-child {
        font-weight: normal;
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

// Membuat kode unik untuk tiap barang
$kode_barang = [
    "Sabun" => "BR001",
    "Sampo" => "BR002",
    "Odol" => "BR003",
    "Teh" => "BR004",
    "Kopi" => "BR005",
    "Susu" => "BR006",
    "Mie Instan" => "BR007",
    "Gula" => "BR008",
    "Beras" => "BR009",
    "Minyak Goreng" => "BR010"
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
$kode = [];
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
    $kode[] = $kode_barang[$barang];
    $jumlah[] = $qty;
    $total[] = $subtotal;
    $grandtotal += $subtotal;
}

/*Perhitungan total*/
echo "<table>";
echo "<tr>
        <td><b>Barang</b></td>
         <td class='center'><b>Kode</b></td>
        <td class='center'><b>Qty</b></td>
        <td class='right'><b>Harga</b></td>
        <td class='right'><b>Total</b></td>
      </tr>";

foreach ($beli as $i => $barang) {
    $harga = $nama_barang[$barang];
    echo "<tr>
            <td>$barang</td>
            <td class='center'>{$kode[$i]}</td>
            <td class='center'>{$jumlah[$i]}</td>
            <td class='right'>
                <div class='rupiah'>
                    <span>Rp</span>
                    <span>" . number_format($harga, 0, ',', '.') . "</span>
                </div>
            </td>
            <td class='right'>
                <div class='rupiah'>
                    <span>Rp</span>
                    <span>" . number_format($total[$i], 0, ',', '.') . "</span>
                </div>
            </td>
          </tr>";
}

/*Output akhir*/
echo"<tr class='total'>
        <td colspan='4'>TOTAL BELANJA</td>
        <td class='right'>
            <div class='rupiah'>
                <span>Rp</span>
                <span>" . number_format($grandtotal, 0, ',', '.') . "</span>
            </div>
        </td>
      </tr>";
      if ($grandtotal <= 50000) {
    $diskon_persen = 5;
} elseif ($grandtotal > 50000 && $grandtotal <= 100000) {
    $diskon_persen = 10;
} else {
    $diskon_persen = 20;
}

$nilai_diskon = ($grandtotal * $diskon_persen) / 100;
$total_setelah_diskon = $grandtotal - $nilai_diskon;

// Tampilkan baris diskon
echo "<tr class='total'>
        <td colspan='4' ><b>Diskon ({$diskon_persen}%)</b></td>
        <td class='right'>
            <div class='rupiah'>
                <span>-Rp</span>
                <span>" . number_format($nilai_diskon, 0, ',', '.') . "</span>
            </div>
        </td>
      </tr>";

echo "</table>";

echo "<div class='footer'>
        <p>Terima kasih telah berbelanja di POLGAN MART!</p>
        <p>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
        <p>~ Have a Nice Day ~</p>
      </div>";
?>
</div>

</body>
</html>
