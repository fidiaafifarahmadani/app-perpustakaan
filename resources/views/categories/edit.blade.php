
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

    <div class="page-header">
        <h1>Edit Kategori</h1>
        <a href="{{ route('categories.index') }}">Kembali</a>
    </div>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text"
                   name="nama_kategori"
                   id="nama_kategori"
                   value="{{ old('nama_kategori', $category->nama_kategori) }}">

            @error('nama_kategori')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi"
                      id="deskripsi">{{ old('deskripsi', $category->deskripsi) }}</textarea>

            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Perbarui</button>
    </form>

@endsection
