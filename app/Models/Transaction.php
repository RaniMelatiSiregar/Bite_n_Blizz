<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di database
    protected $table = 'transaction'; // Ini hanya diperlukan jika nama tabel tidak sesuai dengan konvensi

    protected $fillable = [
        'status',
        // Tambahkan kolom lainnya sesuai kebutuhan
    ];
}
