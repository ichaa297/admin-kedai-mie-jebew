
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <h2>{{ $judul }}</h2>

    <p>
        Periode:
        {{ \Carbon\Carbon::parse($tanggalAwal)->format('d-m-Y') }}
        sampai
        {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cetak as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        @if ($row->role == 1)
                            Super Admin
                        @elseif ($row->role == 0)
                            Admin
                        @else
                            Customer
                        @endif
                    </td>
                    <td>
                        {{ $row->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                    </td>
                    <td>{{ $row->hp }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center">
                        Tidak ada data user pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>
</html>
