@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 rounded">
                <h2 class="fw-bold text-primary text-center">Edit Foto</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-3">
                        <img id="imagePreview" src="{{ asset('storage/' . $photo->image_path) }}" 
                             class="img-thumbnail rounded" style="max-height: 250px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                        <input type="file" name="photo" class="form-control" id="imageInput">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <input type="text" name="description" class="form-control" value="{{ $photo->description }}" required>
                    </div>
                    <div class="mb-3 form-check">
                <input type="hidden" name="is_comment_enabled" value="0">
                <input type="checkbox" class="form-check-input" id="is_comment_enabled" name="is_comment_enabled" value="1" {{ old('is_comment_enabled', $photo->is_comment_enabled) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_comment_enabled">Aktifkan Komentar</label>
            </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-outline-secondary">Kembali ke Profil</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
