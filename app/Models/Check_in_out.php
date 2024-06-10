<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_in_out extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'datacenter_id',
        'guest_id',
        'activities_id',
        'rack_id',
        'image',
        'checkin',
        'checkout',
    ];
    public function datacenter()
    {
        return $this->belongsTo(Datacenter::class);
    }
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function activities()
    {
        return $this->belongsTo(Activities::class);
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
