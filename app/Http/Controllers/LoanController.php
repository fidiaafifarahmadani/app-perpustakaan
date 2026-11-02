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
}