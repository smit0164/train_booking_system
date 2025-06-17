<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train_Schedule_per_station extends Model
{
     protected $table = 'trains_per_station_schedule';
     protected $fillable = [
        'train_id',
        'station_id',
        'arrival_time',
        'departure_time',
    ];
    public function station(){
        return $this->belongsTo(Stationinfo::class,'station_id');
    }
}
