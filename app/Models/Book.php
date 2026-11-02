<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\LoanItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit',
        'isbn', 'stok', 'category_id', 'sampul',
    ];
    public function category(){
     return $this->belongsTo(Category::class);
}
 public function loanItems()
{
    return $this->hasMany(LoanItem::class);
}
}