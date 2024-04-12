<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id'
    ];
    
    public $timestamps = true;

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}
