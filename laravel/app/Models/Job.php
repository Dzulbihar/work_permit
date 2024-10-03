<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';
    protected $fillable = [
        'user_id',
        'status',
        'job_no',
        'job_class',
        'job_name',
        'location',
        'area',
        'document', // Ubah dari 'document' ke 'documents'

        'fungsional_name',
        'fungsional_email',
        'fungsional_nohp',
        'hsse_name',
        'hsse_email',
        'hsse_area',

        'start_work',
        'end_work',
        'meeting_date',
        'description'
    ];


    public function getDocument()
    {
        if(!$this->document){
            return asset('images/default.jpg');
        }           
        return asset('images/' .$this->document);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->hasMany(Person::class);
    }

    public function tool()
    {
        return $this->hasMany(Tool::class);
    }

    public function tool2()
    {
        return $this->hasMany(Tool2::class);
    }

    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }

}
