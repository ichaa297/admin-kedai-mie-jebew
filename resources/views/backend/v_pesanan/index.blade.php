@extends('backend.v_layouts.app')
@section('title', 'Data Pesanan')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $judul }}</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('backend.pesanan.index') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari ID atau customer..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="Dikemas" {{ request('status') == 'Dikemas' ? 'selected' : '' }}>Dikemas</option>
                                <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Cari
                                </button>

                                <a href="{{ route('backend.pesanan.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>

                                <a href="{{ route('backend.pesanan.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pesanan</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($index as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>#{{ $row->id }}</td>
                                <td>{{ $row->customer }}</td>
                                <td>Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                                <td>
                                    @if ($row->status == 'Dikemas')
                                        <span class="badge badge-warning">Dikemas</span>
                                    @elseif ($row->status == 'Dibatalkan')
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @else
                                        <span class="badge badge-success">Diterima</span>
                                    @endif
                                </td>
                                <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('backend.pesanan.show', $row->id) }}"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection