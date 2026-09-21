@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

    <div class="page-header">
        <h1>Tambah Buku</h1>
        <a href="{{ route('books.index') }}">Kembali</a>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="judul">Judul Buku</label>
            <input type="text"
                   name="judul"
                   id="judul"
                   value="{{ old('judul') }}">

            @error('judul')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penulis">Penulis</label>
            <input type="text"
                   name="penulis"
                   id="penulis"
                   value="{{ old('penulis') }}">

            @error('penulis')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label for="penerbit">Penerbit</label>
            <input type="text"
                   name="penerbit"
                   id="p