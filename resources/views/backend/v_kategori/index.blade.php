@extends('backend.v_layouts.app')

@section('title', 'Data Kategori')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Data Kategori</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar Kategori</h4>

                    <a href="{{ route('backend.kategori.create') }}"
                       class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Tambah Kategori
                    </a>
                </div>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="tableKategori" class="display table table-striped table-hover">

                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Kategori</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($index as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $row->nama_kategori }}</td>

                                    <td>
                                        <a href="{{ route('backend.kategori.edit', $row->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('backend.kategori.destroy', $row->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori {{ $row->nama_kategori }}?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                                Hapus
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
        $('#tableKategori').DataTable({
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