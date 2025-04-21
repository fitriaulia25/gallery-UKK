@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
  <div class="card shadow rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
      <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Daftar Pengguna</h5>
      <a href="{{ route('admin.pengguna.create') }}" class="btn btn-light btn-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Pengguna
      </a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Peran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ Str::limit($user->name, 30) }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge px-3 py-2 bg-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                    {{ ucfirst($user->role) }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" 
                       class="btn btn-sm btn-warning" title="Edit">
                      <i class="bi bi-pencil-fill"></i>
                    </a>
                    <form action="{{ route('admin.pengguna.destroy', $user->id) }}" 
                          method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-4 text-muted">
                  <i class="bi bi-exclamation-circle me-1"></i>Belum ada pengguna yang terdaftar.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
