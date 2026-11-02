<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'nim', 'email', 'nomor_telepon', 'alamat', 'status',
    ];
    public function loans()
{
    return $this->hasMany(Loan::class);
}
}