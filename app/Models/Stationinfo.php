<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\StationFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Stationinfo extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $table = 'stations_info';
     protected $fillable = [
        'name',
        'code',
        'total_no_platforms',
    ];
    protected static function newFactory()
    {
        return StationFactory::new();
    }
    public function schedule(): HasMany
    {
          return $this->hasMany(Train_Schedule_per_station::class,'station_id');
    }
}
