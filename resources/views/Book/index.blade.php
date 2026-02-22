@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Dashboard Buku</h4>
            <small class="text-muted">Ringkasan data buku di sistem</small>
        </div>

        @if (Auth::user()->role == 'admin')
        <a href="{{ route('books.create') }}" class="btn btn-dark btn-sm rounded-pill px-3">
            + Tambah
        </a>
        @endif
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $book->judul }}</td>
                        <td>{{ $book->pengarang }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->tahun }}</td>
                        <td class="text-center pe-4">

                            @if (Auth::user()->role == 'admin')
                            <a href="{{ route('books.edit', $book->id) }}"
                                class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    Hapus
                                </button>
                            </form>
                            @else
                            @if (!$book->dipinjam)
                            <form method="POST"
                                action="{{ route('transactions.borrow', $book->id) }}"
                                class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-dark rounded-pill px-3">
                                    Pinjam
                                </button>
                            </form>
                            @else
                            <span class="badge bg-secondary rounded-pill px-3">
                                Tidak Tersedia
                            </span>
                            @endif
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            Tidak ada data buku
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection