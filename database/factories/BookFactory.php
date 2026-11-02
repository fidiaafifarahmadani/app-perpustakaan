<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        $judulBuku = [
            'Novel' => ['Laskar Pelangi', 'Bumi Manusia', 'Negeri 5 Menara'],
            'Komik' => ['Detektif Conan', 'Doraemon', 'One Piece'],
            'Sains' => ['Fisika Dasar', 'Mengenal Alam Semesta', 'Biologi Modern'],
            'Teknologi' => ['Clean Code', 'Belajar Laravel', 'Dasar Pemrograman'],
            'Sejarah' => ['Sejarah Indonesia', 'Perang Dunia', 'Sejarah Peradaban'],
        ];

        $judul = $judulBuku[$category->nama_kategori] ?? ['Buku Pengetahuan'];

        return [
            'judul' => fake()->randomElement($judul),
            'penulis' => fake()->name(),
            'penerbit' => fake()->randomElement([
                'Gramedia',
                'Erlangga',
                'Informatika',
                'Andi Publisher',
                'Mizan',
            ]),
            'tahun_terbit' => fake()->numberBetween(2000, 2026),
            'isbn' => fake()->unique()->numerify('978##########'),
            'stok' => fake()->numberBetween(1, 20),
            'category_id' => $category->id,
        ];
    }
}