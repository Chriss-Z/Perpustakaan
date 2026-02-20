@extends('layout.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">Tambah Buku</h4>
                <small class="text-muted">Masukkan data buku baru ke sistem</small>
            </div>

            <button type="submit" form="form-book" class="btn btn-primary btn-sm">
                Simpan
            </button>
        </div>
    </div>

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="form-book" action="{{ route('books.store') }}" method="POST">
                @csrf

                {{-- Kode Buku --}}
                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text"
                        name="book_code"
                        value="{{ old('kd_buku') }}"
                        class="form-control @error('kd_buku') is-invalid @enderror"
                        placeholder="AA456">
                    @error('kd_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text"
                        name="title"
                        value="{{ old('judul') }}"
                        class="form-control @error('judul') is-invalid @enderror"
                        placeholder="Contoh: Laravel Untuk Pemula">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text"
                        name="author"
                        value="{{ old('penulis') }}"
                        class="form-control @error('penulis') is-invalid @enderror"
                        placeholder="Nama penulis">
                    @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text"
                        name="publisher"
                        value="{{ old('penerbit') }}"
                        class="form-control @error('penerbit') is-invalid @enderror"
                        placeholder="Nama penerbit">
                    @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number"
                        name="year"
                        value="{{ old('tahun') }}"
                        class="form-control @error('tahun') is-invalid @enderror"
                        placeholder="2024">
                    @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>

</div>
@endsection