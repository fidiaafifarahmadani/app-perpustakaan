@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

    <h1>Tambah Anggota</h1>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama"
                   value="{{ old('nama') }}">
        </div>

        <br>

        <div>
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim"
                   value="{{ old('nim') }}">
        </div>

        <br>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email') }}">
        </div>

        <br>

        <div>
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon"
                   value="{{ old('nomor_telepon') }}">
        </div>

        <br>

        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat">{{ old('alamat') }}</textarea>
        </div>

        <br>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="">-- Pilih Status --</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('members.index') }}">Kembali</a>

    </form>

@endsection