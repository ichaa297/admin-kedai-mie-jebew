@extends('backend.v_layouts.app')

@section('title', 'Data User')

@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Data User</h3>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Daftar User</h4>

                    <a href="{{ route('backend.user.create') }}"
                       class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Tambah User
                    </a>
                </div>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="tableUser" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Nomor HP</th>
                                <th width="18%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @if ($user->role == 1)
                                            <span class="badge badge-primary">Super Admin</span>
                                        @elseif ($user->role == 0)
                                            <span class="badge badge-info">Admin</span>
                                        @else
                                            <span class="badge badge-secondary">Customer</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>

                                    <td>{{ $user->hp ?? '-' }}</td>

                                    <td>
                                        <a href="{{ route('backend.user.edit', $user->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('backend.user.destroy', $user->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">

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
        $('#tableUser').DataTable({
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