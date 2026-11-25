
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan #{{ $pesanan->id }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            margin: 0;
            padding: 20px;
        }

        .struk {
            width: 300px;
            margin: auto;
            padding: 20px;
            background: white;
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 12px;
        }

        .header img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        .header h3 {
            margin: 5px 0;
        }

        .info {
            font-size: 12px;
            margin: 12px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            padding: 6px 0;
            text-align: left;
        }

        .kanan {
            text-align: right;
        }

        .total {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
        }

        .tombol {
            text-align: center;
            margin-top: 20px;
        }

        button, a {
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            color: white;
        }

        button {
            background: #1572E8;
        }

        a {
            background: #6c757d;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk {
                width: 300px;
                margin: 0 auto;
            }

            .tombol {
                display: none;
            }

            @page {
                margin: 5mm;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <div class="header">
        <img src="{{ asset('image/logo-mie-jebew.png') }}" alt="Logo">
        <h3>KEDAI MIE JEBEW</h3>
        <p>Terima kasih telah memesan</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>No. Pesanan</td>
                <td class="kanan">#{{ $pesanan->id }}</td>
            </tr>
            <tr>
                <td>Customer</td>
                <td class="kanan">{{ $pesanan->customer }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="kanan">
                    {{ $pesanan->created_at->format('d-m-Y H:i') }}
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td class="kanan">{{ $pesanan->status }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr style="border-bottom: 1px dashed #000;">
                <th>Produk</th>
                <th class="kanan">Jumlah</th>
                <th class="kanan">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pesanan->detailPesanan as $detail)
            <tr>
                <td>{{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}</td>
                <td class="kanan">{{ $detail->jumlah }}</td>
                <td class="kanan">
                    {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="total">
        <tr>
            <td>TOTAL</td>
            <td class="kanan">
                Rp {{ number_format($pesanan->total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>Selamat menikmati Mie Jebew</p>
    </div>

</div>

<div class="tombol">
    <button onclick="window.print()">Cetak Struk</button>
    <a href="{{ route('backend.pesanan.show', $pesanan->id) }}">Kembali</a>
</div>

</body>
</html>
