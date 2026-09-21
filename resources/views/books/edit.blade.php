@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

    <div class="page-header">
        <h1>Edit Buku</h1>
        <a href="{{ route('books.index') }}">Kembali</a>
    </div>

    <form action="{{ route('books.update', $id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="judul">Judul Buku</label>
            <input type="text" name="judul" id="judul"
                   value="{{ old('judul', $book['judul'] ?? '') }}">

            @error('judul')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" id="penulis"
                   value="{{ old('penulis', $book['penulis'] ?? '') }}">

            @error('penulis')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit"
                   value="{{ old('penerbit', $book['penerbit'] ?? '') }}">

            @error('penerbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit"
                   value="{{ old('tahun_terbit', $book['tahun_terbit'] ?? '') }}">

            @error('tahun_terbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok"
                   value="{{ old('stok', $book['stok'] ?? '') }}">

            @error('stok')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button type="submit">Update</button>
        <a href="{{ route('books.index') }}">Batal</a>

    </form>

@endsection