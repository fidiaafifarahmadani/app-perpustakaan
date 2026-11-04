<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;

class LoanController extends Controller
{
    // Menampilkan form tambah peminjaman
    public function create()
    {
        $members = Member::all();

        $users = User::where('role', 'petugas')->get();

        $books = Book::where('stok', '>', 0)->get();

        return view('loans.create', compact(
            'members',
            'users',
            'books'
        ));
    }

    // Menampilkan daftar peminjaman
    public function index(Request $request)
    {
        $body = ['data' => [], 'meta' => null];

        try {
            $response = Http::get(
                config('services.internal_api.base_url') . '/api/loans',
                [
                    'page' => $request->query('page', 1),
                ]
            );

            if ($response->successful()) {
                $body = $response->json();
            }
        } catch (ConnectionException $e) {
            // Server API internal tidak bisa dihubungi.
        }

        return view('loans.index', [
            'loans' => $body['data'] ?? [],
            'meta' => $body['meta'] ?? null,
        ]);
    }
   public function report(Request $request)
{
    try {
        $response = Http::get(
            config('services.internal_api.base_url') . '/api/loans',
            [
                'page' => $request->query('page', 1),
            ]
        );

        if ($response->successful()) {
            $data = $response->json();
            
            $loans = $data['data'] ?? [];
            $meta = $data['meta'] ?? null;

            return view('loans.report', compact('loans', 'meta'));
        }

        return back()->with('error', 'Gagal mengambil data laporan.');

    } catch (ConnectionException $e) {
        return back()->with('error', 'Server API tidak dapat dihubungi.');
    }
}
    // Menampilkan detail peminjaman
public function show($id)
{
    try {
        $response = Http::get(
            config('services.internal_api.base_url') . '/api/loans/' . $id
        );

        if ($response->successful()) {
            $loan = $response->json('data');

            return view('loans.show', compact('loan'));
        }

        return redirect()
            ->route('loans.index')
            ->with('error', 'Data peminjaman tidak ditemukan.');

    } catch (ConnectionException $e) {
        return redirect()
            ->route('loans.index')
            ->with('error', 'Server API tidak dapat dihubungi.');
    }
}
// Menampilkan form edit peminjaman
public function edit($id)
{
    try {
        $response = Http::get(
            config('services.internal_api.base_url') . '/api/loans/' . $id
        );

        if ($response->successful()) {
            $loan = $response->json('data');

            $members = Member::all();
            $users = User::where('role', 'petugas')->get();
            $books = Book::all();

            $selectedBooks = collect($loan['books'] ?? [])
                ->pluck('id')
                ->all();

            return view('loans.edit', compact(
                'loan',
                'members',
                'users',
                'books',
                'selectedBooks'
            ));
        }

        return redirect()
            ->route('loans.index')
            ->with('error', 'Data peminjaman tidak ditemukan.');

    } catch (ConnectionException $e) {
        return redirect()
            ->route('loans.index')
            ->with('error', 'Server API tidak dapat dihubungi.');
    }
}
    // Menyimpan data peminjaman melalui API
    public function store(Request $request)
    {
        try {
            $response = Http::post(
                config('services.internal_api.base_url') . '/api/loans',
                $request->only([
                    'member_id',
                    'user_id',
                    'tanggal_pinjam',
                    'tanggal_kembali',
                    'book_ids',
                ])
            );

            if ($response->successful()) {
                return redirect()
                    ->route('loans.index')
                    ->with('success', 'Peminjaman berhasil ditambahkan.');
            }

            if ($response->status() === 422) {
                return back()
                    ->withErrors($response->json('errors') ?? [])
                    ->withInput();
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan peminjaman.');

        } catch (ConnectionException $e) {
            return back()
                ->withInput()
                ->with('error', 'Server API tidak dapat dihubungi.');
        }
    }
    // Memperbarui data peminjaman melalui API
public function update(Request $request, $id)
{
    try {
        $response = Http::put(
            config('services.internal_api.base_url') . '/api/loans/' . $id,
            $request->only([
                'member_id',
                'user_id',
                'tanggal_pinjam',
                'tanggal_kembali',
                'book_ids',
            ])
        );

        if ($response->successful()) {
            return redirect()
                ->route('loans.index')
                ->with('success', 'Peminjaman berhasil diperbarui.');
        }

        if ($response->status() === 422) {
            return back()
                ->withErrors($response->json('errors') ?? [])
                ->withInput();
        }

        return back()
            ->withInput()
            ->with('error', 'Gagal memperbarui peminjaman.');

    } catch (ConnectionException $e) {
        return back()
            ->withInput()
            ->with('error', 'Server API tidak dapat dihubungi.');
    }
}
    public function kembalikan($id)
{
    try {
        $response = Http::put(
            config('services.internal_api.base_url') . '/api/loans/' . $id . '/kembalikan'
        );

        if ($response->successful()) {
            return redirect()
                ->route('loans.index')
                ->with('success', 'Buku berhasil dikembalikan.');
        }

        return back()->with('error', 'Gagal mengembalikan buku.');

    } catch (ConnectionException $e) {
        return back()->with('error', 'Server API tidak dapat dihubungi.');
    }
}
}