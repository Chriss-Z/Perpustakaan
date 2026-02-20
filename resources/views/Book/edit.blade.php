@extends('layout.app')

@section('title', 'Edit Buku')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">Edit Buku</h4>
                <small class="text-muted">Perbarui data buku di sistem</small>
            </div>

            <button type="submit" form="form-book" class="btn btn-primary btn-sm">
                Update
            </button>
        </div>
    </div>

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="form-book"
                action="{{ route('books.update', $book->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                {{-- Kode Buku --}}
                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text"
                        name="kd_buku"
                        value="{{ old('kd_buku', $book->kd_buku) }}"
                        class="form-control @error('kd_buku') is-invalid @enderror">

                    @error('kd_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text"
                        name="judul"
                        value="{{ old('judul', $book->judul) }}"
                        class="form-control @error('judul') is-invalid @enderror">

                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text"
                        name="pengarang"
                        value="{{ old('pengarang', $book->pengarang) }}"
                        class="form-control @error('pengarang') is-invalid @enderror">

                    @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text"
                        name="penerbit"
                        value="{{ old('penerbit', $book->penerbit) }}"
                        class="form-control @error('penerbit') is-invalid @enderror">

                    @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number"
                        name="tahun"
                        value="{{ old('tahun', $book->tahun) }}"
                        class="form-control @error('tahun') is-invalid @enderror">

                    @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>

</div>
@endsection