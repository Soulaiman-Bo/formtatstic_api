<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';


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
