<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    public function ninja(){
        return $this->belongsToMany(Ninja::class);
    }
    
    protected $fillable = [
        'date',
        'description',
        'number_of_ninjas',
        'pay',
        'client_id',
        'state',
    ];
}
