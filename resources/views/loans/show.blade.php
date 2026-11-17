@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <h1>Detail Peminjaman</h1>

    <p>
        <a href="{{ route('loans.index') }}" class="btn">
            &larr; Kembali ke daftar peminjaman
        </a>
    </p>

    <table>
        <tr>
            <th>Anggota</th>
            <td>{{ $loan['member']['nama'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Petugas</th>
            <td>{{ $loan['petugas']['name'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Pinjam</th>
            <td>{{ $loan['tanggal_pinjam'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Kembali</th>
            <td>{{ $loan['tanggal_kembali'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Dikembalikan</th>
            <td>{{ $loan['tanggal_dikembalikan'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($loan['status'] ?? '-') }}</td>
        </tr>
        <tr>
            <th>Denda</th>
            <td>
                Rp {{ number_format($loan['denda'] ?? 0, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <h2>Buku yang Dipinjam</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Buku</th>
            </tr>
        </thead>
        <tbody>
            @forelse (($loan['books'] ?? []) as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book['judul'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Tidak ada buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection