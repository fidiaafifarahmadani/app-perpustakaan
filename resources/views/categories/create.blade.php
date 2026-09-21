@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <h1>Tambah Kategori</h1>

    <p>
        <a href="{{ route('categories.index') }}">← Kembali ke daftar</a>
    </p>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="nama">Nama Kategori</label>
            <input
                type="text"
                name="nama"
                id="nama"
                value="{{ old('nama') }}"
            >

            @error('nama')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
            >{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button type="submit">Simpan</button>

        <a href="{{ route('categories.index') }}">Batal</a>

    </form>

@endsection