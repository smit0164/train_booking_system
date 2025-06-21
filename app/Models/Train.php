<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class Train extends Model
{
     use Searchable;
     protected $table = 'trains';
     protected $fillable = [
        'name',
        'code',
        'route-id',
        'start-time',
        'end-time',
        'date'
    ];
    public function toSearchableArray()
    {
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'code' => $this->code,
            'route_id' =>$this['route-id'],
            'date'=>$this->date,
        ];
    }

    public function route(){
         return $this->belongsTo(Route::class,'route-id');
    }
    public function Train_Schedule_per_stations(): HasMany
    {
        return $this->hasMany(Train_Schedule_per_station::class);
    }
    public function trains_class(): HasMany
    {
        return $this->hasMany(Trains_class::class);
    }
}
