<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'loan_id', 'user_id', 'book_id', 'returned_at', 'late_days', 'fine', 'status', 'condition'
    ];

    protected $casts = [
        'returned_at' => 'date',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
