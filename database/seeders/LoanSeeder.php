<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use App\Models\Book;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $memberIds = Member::pluck('id');
        $userIds = User::pluck('id');
        $bookIds = Book::pluck('id');

        if ($memberIds->isEmpty() || $userIds->isEmpty() || $bookIds->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $tanggalPinjam = now()->subDays(rand(10, 30));

            $status = fake()->randomElement([
                'dipinjam',
                'dikembalikan',
                'dikembalikan',
                'terlambat',
            ]);

            $tanggalKembali = (clone $tanggalPinjam)->addDays(7);

            $tanggalDikembalikan = $status === 'dikembalikan'
                ? (clone $tanggalKembali)->subDays(rand(0, 3))
                : null;

            $loan = Loan::create([
                'member_id' => $memberIds->random(),
                'user_id' => $userIds->random(),
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'tanggal_dikembalikan' => $tanggalDikembalikan,
                'status' => $status,
            ]);

            $jumlahBuku = rand(1, min(3, $bookIds->count()));

            $bukuTerpilih = $bookIds->shuffle()->take($jumlahBuku);

            foreach ($bukuTerpilih as $bookId) {
                $loan->loanItems()->create([
                    'book_id' => $bookId,
                ]);
            }
        }
    }
}