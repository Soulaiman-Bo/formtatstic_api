<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'workspace_id',
        'name',
        'description',
        'visits',
        'submittions',
        'fields',
        'published',
        'owner_id'
    ];

    protected $casts = [
        'fields' => 'array',
        'published' => 'boolean',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function formschema()
    {
        return $this->hasMany(FormSchema::class);
    }
}
