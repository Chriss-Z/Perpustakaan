@extends('layout.app')

@section('title', 'Tambah User')

@section('content')
<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Tambah User</h4>
            <small class="text-muted">Buat akun & keanggotaan perpustakaan</small>
        </div>

        <button form="form-user" type="submit" class="btn btn-primary btn-sm">
            Simpan
        </button>
    </div>

    {{-- Form --}}
    <div class="card">
        <div class="card-body">
            <form id="form-user" action="{{ route('users.store') }}" method="POST">
                @csrf

                {{-- NIS --}}
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text"
                        name="id_sekolah"
                        class="form-control"
                        value="{{ old('id_sekolah') }}"
                        placeholder="9 digit">
                    @error('id_sekolah')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jurusan --}}
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <input type="text"
                        name="jurusan"
                        class="form-control"
                        value="{{ old('jurusan') }}"
                        placeholder="RPL / TKJ / DKV">
                    @error('jurusan')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text"
                        name="kelas"
                        class="form-control"
                        value="{{ old('kelas') }}"
                        placeholder="XI RPL 1">
                    @error('kelas')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                        name="username"
                        class="form-control"
                        value="{{ old('username') }}">
                    @error('username')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}">
                    @error('nama')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                        name="password"
                        class="form-control">
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </div>

</div>
@endsection