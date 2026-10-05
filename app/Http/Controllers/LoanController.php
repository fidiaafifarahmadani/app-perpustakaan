<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
{
    $loans = \App\Models\Loan::with([
        'member',
        'user',
        'loanItems.book',
    ])->paginate(10);

    return view('loans.index', compact('loans'));
}

    public function create()
{
    $members = \App\Models\Member::where('status', 'aktif')
        ->orderBy('nama')
        ->get();

    $users = \App\Models\User::orderBy('name')->get();

    $books = \App\Models\Book::orderBy('judul')->get();

    return view('loans.create', compact('members', 'users', 'books'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'member_id' => 'required|exists:members,id',
        'user_id' => 'required|exists:users,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'book_ids' => 'required|array|min:1',
        'book_ids.*' => 'required|exists:books,id',
    ]);

    $loan = \App\Models\Loan::create([
        'member_id' => $validated['member_id'],
        'user_id' => $validated['user_id'],
        'tanggal_pinjam' => $validated['tanggal_pinjam'],
        'tanggal_kembali' => $validated['tanggal_kembali'],
        'status' => 'dipinjam',
    ]);

    foreach ($validated['book_ids'] as $bookId) {
        \App\Models\LoanItem::create([
            'loan_id' => $loan->id,
            'book_id' => $bookId,
        ]);
    }

    return redirect()->route('loans.index')
        ->with('success', 'Peminjaman berhasil ditambahkan.');
}

    public function show(string $id)
{
    $loan = \App\Models\Loan::with([
        'member',
        'user',
        'loanItems.book',
    ])->findOrFail($id);

    return view('loans.show', compact('loan'));
}

    public function edit(string $id)
{
    $loan = \App\Models\Loan::with('loanItems')->findOrFail($id);

    $members = \App\Models\Member::where('status', 'aktif')
        ->orderBy('nama')
        ->get();

    $users = \App\Models\User::orderBy('name')->get();

    $books = \App\Models\Book::orderBy('judul')->get();

    $selectedBooks = $loan->loanItems
        ->pluck('book_id')
        ->toArray();

    return view('loans.edit', compact(
        'loan',
        'members',
        'users',
        'books',
        'selectedBooks'
    ));
}

    public function update(Request $request, string $id)
{
    $loan = \App\Models\Loan::findOrFail($id);

    $validated = $request->validate([
        'member_id' => 'required|exists:members,id',
        'user_id' => 'required|exists:users,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'book_ids' => 'required|array|min:1',
        'book_ids.*' => 'required|exists:books,id',
    ]);

    $loan->update([
        'member_id' => $validated['member_id'],
        'user_id' => $validated['user_id'],
        'tanggal_pinjam' => $validated['tanggal_pinjam'],
        'tanggal_kembali' => $validated['tanggal_kembali'],
    ]);

    \App\Models\LoanItem::where('loan_id', $loan->id)->delete();

    foreach ($validated['book_ids'] as $bookId) {
        \App\Models\LoanItem::create([
            'loan_id' => $loan->id,
            'book_id' => $bookId,
        ]);
    }

    return redirect()->route('loans.index')
        ->with('success', 'Peminjaman berhasil diperbarui.');
}

    public function destroy(string $id)
{
    $loan = \App\Models\Loan::findOrFail($id);

    \App\Models\LoanItem::where('loan_id', $loan->id)->delete();

    $loan->delete();

    return redirect()->route('loans.index')
        ->with('success', 'Peminjaman berhasil dihapus.');
}

   public function kembalikan(string $id)
{
    $loan = \App\Models\Loan::findOrFail($id);

    $loan->update([
        'status' => 'dikembalikan',
        'tanggal_dikembalikan' => now()->toDateString(),
    ]);

    return redirect()->route('loans.index')
        ->with('success', 'Buku berhasil dikembalikan.');
}
}