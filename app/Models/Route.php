<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use SoftDeletes;
     protected $table = 'routes';
     protected $fillable = [
        'name',
        'total_distances',
    ];

    public function stations()
    {
        return $this->belongsToMany(Stationinfo::class, 'route_stops','route_id','station_id')->withPivot('orderOfstations','created_at')->orderByPivot('orderOfstations', 'asc');
    }
    public function trains()
    {
        return $this->hasMany(Train::class, 'route-id');
    }
}
