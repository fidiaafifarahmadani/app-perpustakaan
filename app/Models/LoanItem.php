<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;
use App\Models\Book;
use App\Models\LoanItem;

class LoanItem extends Model
{
    protected $fillable = [
        'loan_id',
        'book_id',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function loanItems()
    {
        return $this->belongsTo(LoanItem::class);
    }
}