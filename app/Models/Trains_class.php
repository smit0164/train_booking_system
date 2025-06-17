<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trains_class extends Model
{
    protected $table = 'trains_class';
     protected $fillable = [
        'name',
        'train-id',
        'total_count',
        'available_count'
    ];
}
