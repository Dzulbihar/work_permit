<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';
    protected $fillable = 
            [
                'job_id',
                'name',
                'status'
            ];     

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
