@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

    <h1>Tambah Buku</h1>

    <p>
        <a href="{{ route('books.index') }}">← Kembali ke daftar</a>
    </p>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="judul">Judul Buku</label>
            <input
                type="text"
                name="judul"
                id="judul"
                value="{{ old('judul') }}"
            >

            @error('judul')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penulis">Penulis</label>
            <input
                type="text"
                name="penulis"
                id="penulis"
                value="{{ old('penulis') }}"
            >

            @error('penulis')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penerbit">Penerbit</label>
            <input
                type="text"
                name="penerbit"
                id="penerbit"
                value="{{ old('penerbit') }}"
            >

            @error('penerbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="tahun_terbit">Tahun Terbit</label>
            <input
                type="number"
                name="tahun_terbit"
                id="tahun_terbit"
                value="{{ old('tahun_terbit') }}"
            >

            @error('tahun_terbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="stok">Stok</label>
            <input
                type="number"
                name="stok"
                id="stok"
                value="{{ old('stok') }}"
            >

            @error('stok')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button type="submit">Simpan</button>

        <a href="{{ route('books.index') }}">Batal</a>

    </form>

@endsection