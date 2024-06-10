<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;



    protected $fillable = [
        'activity',
    ];

    public function checkinout()
    {
        // membuat relasi ke table lain dengan tipe one to many
        // dalam kurung merupakan nama model yang akan disambungkan (tempat fk)
        return $this->hasMany(Check_in_out::class);
    }


}
    


