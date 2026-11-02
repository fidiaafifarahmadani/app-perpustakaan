<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Novel', 'deskripsi' => 'Buku cerita fiksi dan nonfiksi'],
            ['nama_kategori' => 'Komik', 'deskripsi' => 'Buku cerita bergambar'],
            ['nama_kategori' => 'Sains', 'deskripsi' => 'Buku ilmu pengetahuan'],
            ['nama_kategori' => 'Teknologi', 'deskripsi' => 'Buku teknologi dan komputer'],
            ['nama_kategori' => 'Sejarah', 'deskripsi' => 'Buku tentang sejarah'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                $category
            );
        }
    }
}