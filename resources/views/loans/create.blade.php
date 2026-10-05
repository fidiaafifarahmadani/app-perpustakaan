@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')

    <h1>Tambah Peminjaman</h1>

    <p>
        <a href="{{ route('loans.index') }}">
            &larr; Kembali
        </a>
    </p>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div>
            <label for="member_id">Anggota</label>

            <select name="member_id" id="member_id" required>
                <option value="">-- Pilih Anggota --</option>

                @foreach ($members as $member)
                    <option value="{{ $member->id }}"
                        @selected(old('member_id') == $member->id)>
                        {{ $member->nama }} - {{ $member->nim }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="user_id">Petugas</label>

            <select name="user_id" id="user_id" required>
                <option value="">-- Pilih Petugas --</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        @selected(old('user_id') == $user->id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam</label>

            <input
                type="date"
                name="tanggal_pinjam"
                id="tanggal_pinjam"
                value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="tanggal_kembali">Tanggal Kembali</label>

            <input
                type="date"
                name="tanggal_kembali"
                id="tanggal_kembali"
                value="{{ old('tanggal_kembali') }}"
                required
            >
        </div>

        <br>

        <div>
            <strong>Pilih Buku</strong>

            @forelse ($books as $book)
                <div>
                    <label>
                        <input
                            type="checkbox"
                            name="book_ids[]"
                            value="{{ $book->id }}"
                            @checked(in_array($book->id, old('book_ids', [])))
                        >

                        {{ $book->judul }}
                        — Stok: {{ $book->stok }}
                    </label>
                </div>
            @empty
                <p>Belum ada data buku.</p>
            @endforelse
        </div>

        <br>

        <button type="submit">
            Simpan Peminjaman
        </button>

    </form>

@endsection