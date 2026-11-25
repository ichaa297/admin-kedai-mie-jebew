
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        h2, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #eee;
            text-align: center;
        }

        .total {
            text-align: right;
            margin-top: 15px;
            font-weight: bold;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>LAPORAN DATA PESANAN</h2>
    <p>KEDAI MIE JEBEW</p>

    <p>
        Periode:
        {{ date('d-m-Y', strtotime($tanggalAwal)) }}
        s/d
        {{ date('d-m-Y', strtotime($tanggalAkhir)) }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pesanan</th>
                <th>Customer</th>
                <th>Tanggal Pesanan</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($cetak as $key => $pesanan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $pesanan->id }}</td>
                    <td>{{ $pesanan->customer }}</td>
                    <td>{{ date('d-m-Y', strtotime($pesanan->created_at)) }}</td>
                    <td>{{ $pesanan->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center">
                        Tidak ada data pesanan pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">
        Jumlah Pesanan: {{ $cetak->count() }}
    </p>

    <div class="no-print" style="margin-top:20px">
        <button onclick="window.print()">Cetak</button>
    </div>

</body>
</html>
