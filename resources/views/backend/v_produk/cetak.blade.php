
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
        padding: 6px;
    }
</style>

<table>
    <tr>
        <th colspan="5">
            <h3>{{ $judul }}</h3>
            <p>
                Periode:
                {{ $tanggalAwal }} sampai {{ $tanggalAkhir }}
            </p>
        </th>
    </tr>
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Status</th>
    </tr>

    @foreach ($cetak as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row->nama_produk }}</td>
        <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
        <td>{{ $row->stok }}</td>
        <td>
            @if ($row->status == 1)
                Publis
            @elseif ($row->status == 0)
                Blok
            @endif
        </td>
    </tr>
    @endforeach
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>
