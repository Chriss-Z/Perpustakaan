@extends('layout.app')

@section('title', 'Kelola User')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Kelola User</h4>
            <small class="text-muted">Manajemen keanggotaan perpustakaan</small>
        </div>

        @if (Auth::user()->role === 'admin')
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            + Tambah User
        </a>
        @endif
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Table --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>ID Sekolah</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->id_Sekolah }}</td>
                            <td>{{ $user->jurusan }}</td>
                            <td>{{ $user->kelas }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>
                                @if ($user->role === 'admin')
                                <span class="badge bg-primary">Admin</span>
                                @else
                                <span class="badge bg-success">Member</span>
                                @endif
                            </td>
                            <td class="text-center">

                                @if (Auth::user()->role === 'admin')
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                @if (Auth::id() !== $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
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
                            <td colspan="7" class="text-center text-muted">
                                Tidak ada data user
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