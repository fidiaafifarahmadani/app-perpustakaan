<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books;

class Category extends Model
{
    protected $fillable = ['nama_kategori', 'deskripsi'];
    public function books() {
         return $this->hasMany(Book::class);
    }
}

