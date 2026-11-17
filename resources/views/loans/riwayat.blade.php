@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
    <h1>Riwayat Peminjaman</h1>

    <p>
        <a href="{{ route('loans.index') }}" class="btn">
            &larr; Kembali ke Peminjaman
        </a>
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Anggota</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan['member']['nama'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_pinjam'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_kembali'] ?? '-' }}</td>
                    <td>{{ $loan['tanggal_dikembalikan'] ?? '-' }}</td>
                    <td>{{ ucfirst($loan['status'] ?? '-') }}</td>
                    <td>
                        Rp {{ number_format($loan['denda'] ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada riwayat peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection