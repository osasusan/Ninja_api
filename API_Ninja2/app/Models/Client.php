<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function missiones()
    {
    return $this->hasMany(Mission::class);
    }

    protected $fillable = [
        'code',
        'preference',
        'antiquity'
    ];
}
