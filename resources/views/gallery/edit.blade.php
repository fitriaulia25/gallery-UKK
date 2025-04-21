@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm rounded-4 p-4 mx-auto" style="max-width: 600px;">
        <h4 class="mb-4 text-center">Edit Foto Galeri</h4>

        <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <input type="text" name="description" class="form-control" value="{{ old('description', $photo->description) }}" placeholder="Masukkan deskripsi foto...">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label><br>
                <img src="{{ asset('storage/' . $photo->image_path) }}" class="img-fluid rounded mb-2 shadow-sm" style="max-height: 250px;">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">← Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
