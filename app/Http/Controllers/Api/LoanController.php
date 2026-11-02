<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Menampilkan daftar peminjaman
    public function index()
    {
        $loans = Loan::with([
            'member',
            'user',
            'loanItems.book'
        ])->paginate(10);

        return LoanResource::collection($loans);
    }
    public function report(Request $request)
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

    return view('loans.report', [
        'loans' => $body['data'] ?? [],
        'meta' => $body['meta'] ?? null,
    ]);
}

    // Menambahkan peminjaman
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'user_id' => 'required|integer|exists:users,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'required|integer|exists:books,id',
        ]);

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => $validated['user_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'dipinjam',
        ]);

        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanItems()->create([
                'book_id' => $bookId,
            ]);
        }

        $loan->refresh()->load([
            'member',
            'user',
            'loanItems.book'
        ]);

        return (new LoanResource($loan))
            ->response()
            ->setStatusCode(201);
    }

    // Memproses pengembalian buku
    public function kembalikan(string $id)
    {
        $loan = Loan::with([
            'member',
            'user',
            'loanItems.book'
        ])->findOrFail($id);

        $loan->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now()->toDateString(),
        ]);

        return new LoanResource($loan->fresh()->load([
            'member',
            'user',
            'loanItems.book'
        ]));
    }
}