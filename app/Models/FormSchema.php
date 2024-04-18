<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class FormSchema extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = ['form_id', 'type', 'properties'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
