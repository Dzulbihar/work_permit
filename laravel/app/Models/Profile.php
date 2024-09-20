<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

	protected $table = 'profile';
    protected $fillable = 
    		[
            'user_id',
            'foto',
            'keterangan',
        	];

            public function get_foto()
            {
                if (!$this->foto) {
                    return asset('logo/user.png'); // Path default gambar jika belum ada foto
                }
                return asset('storage/' . $this->foto);
            }
            
            
}
