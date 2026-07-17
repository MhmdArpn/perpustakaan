<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak menggunakan aturan penamaan default jamak (wishlists)
    protected $table = 'wishlists';

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'user_id',
        'book_id',
    ];

    /**
     * Relasi ke model User (Many-to-One)
     * Setiap item wishlist dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Book (Many-to-One)
     * Setiap item wishlist merujuk ke satu Buku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
