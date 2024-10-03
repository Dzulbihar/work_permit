<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi', 'tanggal', 'status', 'job_id'];

    /**
     * Relasi ke model Job.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
