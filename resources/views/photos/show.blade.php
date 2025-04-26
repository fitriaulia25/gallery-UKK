@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row g-4 bg-white shadow-lg rounded p-4">
        <div class="col-md-7 d-flex justify-content-center align-items-center bg-light rounded">
            <img src="{{ asset('storage/' . $photo->image_path) }}" class="rounded img-fluid w-75 shadow">
        </div>

        <div class="col-md-5">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-user-circle text-primary fs-3"></i>
                <span class="fw-semibold fs-5 ms-2">{{ $photo->user->name ?? 'Pengguna' }}</span>
            </div>

            @unless($photo->is_comment_enabled)
                <div class="alert alert-warning mb-3">Komentar telah dimatikan untuk foto ini.</div>
            @endunless

            {{-- Cek apakah foto ini diupload oleh pengguna yang sedang login --}}
            @if(auth()->id() === $photo->user_id)
                <form action="{{ route('photos.toggle-comment', $photo->id) }}" method="POST" class="mb-3">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn {{ $photo->is_comment_enabled ? 'btn-warning' : 'btn-success' }}">
                        {{ $photo->is_comment_enabled ? 'Matikan Komentar' : 'Nyalakan Komentar' }}
                    </button>
                </form>
            @endif

            <div class="d-flex align-items-center mb-3">
                <form action="{{ route('photos.like', $photo->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent p-0 d-flex align-items-center">
                        @if ($photo->likes->where('user_id', auth()->id())->count() > 0)
                            <i class="fas fa-heart text-danger fs-4"></i>
                            <span class="ms-2 text-danger fs-5">Unlike</span>
                        @else
                            <i class="far fa-heart text-dark fs-4"></i>
                            <span class="ms-2 text-dark fs-5">Like</span>
                        @endif
                        <span class="ms-2 text-muted fs-5">({{ $photo->likes->count() }})</span>
                    </button>
                </form>
            </div>
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-comment text-secondary fs-5"></i>
                <span class="ms-2 fs-5">{{ $photo->comments->count() }} Komentar</span>
            </div>

            @if($photo->is_comment_enabled)
                <div class="overflow-auto border-top pt-3 mb-3" style="max-height: 200px;">
                    @foreach ($photo->comments as $comment)
                        <div class="position-relative border rounded p-2 mb-2 bg-light">
                            <div class="fw-semibold">{{ $comment->user->name }}</div>
                            <div>{{ $comment->body ?? $comment->content }}</div>
                            <div class="text-muted small mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                            @if (auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                      class="position-absolute top-0 end-0 mt-2 me-2"
                                      onsubmit="return confirm('Yakin ingin hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-link text-danger p-0" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                <form action="{{ route('comments.store', $photo->id) }}" method="POST" class="mt-2">
                    @csrf
                    <input type="text" name="content" class="form-control mb-2" placeholder="Tambahkan komentar..." required>
                    <button type="submit" class="btn btn-danger w-100">Kirim</button>
                </form>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
