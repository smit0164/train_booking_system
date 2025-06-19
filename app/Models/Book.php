<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book_info';
    protected $fillable = [
        'user_id',
        'train_id',
        'price',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function train(){
        return $this->belongsTo(Train::class,'train_id');
    }
}
