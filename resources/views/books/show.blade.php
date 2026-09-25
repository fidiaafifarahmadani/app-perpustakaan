@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

    <div class="page-header">
        <h1>Detail Buku</h1>
        <a href="{{ route('books.index') }}">Kembali</a>
    </div>

    <div>
        <p>
            <strong>ID:</strong>
            {{ $book['id'] }}
        </p>

        <p>
            <strong>Judul:</strong>
            {{ $book['judul'] }}
        </p>

        <p>
            <strong>Penulis:</strong>
            {{ $book['penulis'] }}
        </p>

        <p>
            <strong>Penerbit:</strong>
            {{ $book['penerbit'] }}
        </p>

        <p>
            <strong>Tahun Terbit:</strong>
            {{ $book['tahun_terbit'] }}
        </p>

        <p>
            <strong>Stok:</strong>
            {{ $book['stok'] }}
        </p>

        <p>
            <strong>ID Kategori:</strong>
            {{ $book['category_id'] }}
        </p>
    </div>

@endsection