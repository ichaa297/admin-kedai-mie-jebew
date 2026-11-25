@extends('backend.v_layouts.app')
@section('title', 'Data Produk')
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Data Produk</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Produk</h4>

                    <a href="{{ route('backend.produk.create') }}"
                       class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Tambah Produk
                    </a>
                </div>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="tableProduk"
                           class="display table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Berat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($index as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if ($row->foto)
                                            <img
                                                src="{{ asset('storage/' . $row->foto) }}"
                                                width="65"
                                                height="65"
                                                style="object-fit: cover; border-radius: 8px;">
                                        @elseif ($row->fotoProduk->count() > 0)
                                            <img
                                                src="{{ asset('storage/' . $row->fotoProduk->first()->foto) }}"
                                                width="65"
                                                height="65"
                                                style="object-fit: cover; border-radius: 8px;">
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>{{ $row->nama_produk }}</td>

                                    <td>
                                        {{ $row->kategori->nama_kategori ?? '-' }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($row->harga, 0, ',', '.') }}
                                    </td>

                                    <td>{{ $row->stok }}</td>

                                    <td>{{ $row->berat }}</td>

                                    <td>
                                        @if ($row->status == 1)
                                            <span class="badge badge-success">Publis</span>
                                        @else
                                            <span class="badge badge-danger">Blok</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('backend.produk.edit', $row->id) }}"
                                        class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a href="{{ route('backend.foto_produk.index', $row->id) }}"
                                        class="btn btn-info btn-sm">
                                            <i class="fa fa-images"></i> Foto Produk
                                        </a>

                                        <form
                                            action="{{ route('backend.produk.destroy', $row->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tableProduk').DataTable({
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya"
                },
                zeroRecords: "Data tidak ditemukan"
            }
        });
    });
</script>
@endpush