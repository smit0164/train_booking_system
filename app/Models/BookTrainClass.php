<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookTrainClass extends Model
{
    protected $table = 'booked_train_class';
    protected $fillable = [
        'book_id',
        'class_name',
        'count',
    ];
    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
