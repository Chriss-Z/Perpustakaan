@extends('layout.app')

@section('title', 'Dashboard Transaksi')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Dashboard Transaksi</h4>
            <small class="text-muted">Data peminjaman & pengembalian buku</small>
        </div>

        @if (Auth::user()->role == 'admin')
        <a href="{{ route('transactions.create') }}"
            class="btn btn-dark btn-sm rounded-pill px-3">
            + Tambah
        </a>
        @endif
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Kode Buku</th>
                        <th>Judul Buku</th>

                        @if (Auth::user()->role == 'admin')
                        <th>Peminjam</th>
                        @endif

                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>

                        <td class="ps-4 fw-medium">
                            {{ $transaction->book->kd_buku }}
                        </td>

                        <td>{{ $transaction->book->judul }}</td>

                        @if (Auth::user()->role == 'admin')
                        <td>{{ $transaction->user->nama }}</td>
                        @endif

                        <td>
                            {{ \Carbon\Carbon::parse($transaction->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <td>
                            {{ $transaction->tanggal_kembali
                                ? \Carbon\Carbon::parse($transaction->tanggal_kembali)->format('d M Y')
                                : '-' }}
                        </td>

                        {{-- Status --}}
                        <td class="text-center">
                            @if ($transaction->status === 'dipinjam')
                            <span class="badge bg-warning text-dark rounded-pill px-3">
                                Dipinjam
                            </span>
                            @else
                            <span class="badge bg-success rounded-pill px-3">
                                Dikembalikan
                            </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center pe-4">
                            @if ($transaction->status === 'dipinjam')
                            <form action="{{ route('transactions.return', $transaction->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Kembalikan
                                </button>
                            </form>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            Tidak ada data transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection