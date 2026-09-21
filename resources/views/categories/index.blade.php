@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')

    <div class="page-header">
        <h1>Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}">+ Tambah Kategori</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['nama'] }}</td>
                    <td>{{ $category['deskripsi'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection