@extends('layouts.app')

@section('title', 'Total Denda')

@section('content')
    <h1>Total Denda Peminjaman</h1>

    <p>
        <a href="{{ route('loans.index') }}" class="btn">
            &larr; Kembali ke Peminjaman
        </a>
    </p>

    <div class="stat-card">
        <div class="label">Total Seluruh Denda</div>

        <div class="value">
            Rp {{ number_format($totalDenda, 0, ',', '.') }}
        </div>
    </div>
@endsection