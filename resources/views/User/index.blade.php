@extends('layout.app')

@section('title', 'Kelola User')

@section('content')
<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-semibold mb-1">Kelola User</h4>
            <small class="text-muted">Manajemen keanggotaan perpustakaan</small>
        </div>

        @if (Auth::user()->role === 'admin')
        <a href="{{ route('users.create') }}"
            class="btn btn-dark btn-sm rounded-pill px-3">
            + Tambah
        </a>
        @endif
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
    <div class="alert alert-success border-0 shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>ID Sekolah</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td>{{ $user->id_Sekolah }}</td>
                        <td>{{ $user->jurusan }}</td>
                        <td>{{ $user->kelas }}</td>
                        <td class="fw-medium">{{ $user->nama }}</td>
                        <td>
                            @if ($user->role === 'admin')
                            <span class="badge bg-dark rounded-pill px-3">
                                Admin
                            </span>
                            @else
                            <span class="badge bg-secondary rounded-pill px-3">
                                Member
                            </span>
                            @endif
                        </td>
                        <td class="text-center pe-4">

                            @if (Auth::user()->role === 'admin')
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                Edit
                            </a>

                            @if (Auth::id() !== $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    Hapus
                                </button>
                            </form>
                            @endif
                            @else
                            <span class="text-muted">-</span>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            Tidak ada data user
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection