@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

    <div class="page-header">
        <h1>Edit Buku</h1>
        <a href="{{ route('books.index') }}">Kembali</a>
    </div>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="judul">Judul Buku</label>
            <input type="text" name="judul" id="judul"
                   value="{{ old('judul', $book->judul) }}">
            @error('judul')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penulis">Penulis</label>
            <input type="text" name="penulis" id="penulis"
                   value="{{ old('penulis', $book->penulis) }}">
            @error('penulis')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit"
                   value="{{ old('penerbit', $book->penerbit) }}">
            @error('penerbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit"
                   value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
            @error('tahun_terbit')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn"
                   value="{{ old('isbn', $book->isbn) }}">
            @error('isbn')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok"
                   value="{{ old('stok', $book->stok) }}">
            @error('stok')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="category_id">Kategori</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $book->category_id) == $category->id)>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button type="submit">Perbarui Buku</button>
        <a href="{{ route('books.index') }}">Batal</a>

    </form>

@endsection