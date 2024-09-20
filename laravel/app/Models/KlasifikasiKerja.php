<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiKerja extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi_kerja'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['nama', 'status']; // Sesuaikan dengan kolom di tabel
}
