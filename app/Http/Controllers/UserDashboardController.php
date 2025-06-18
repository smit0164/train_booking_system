<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
class UserDashboardController extends Controller
{
    public function index(){
        $train=$trainInfo=Train::with(['Train_Schedule_per_stations.station','trains_class','route.stations'])->get();
        return view('dashboard',['train'=>$train]);
    }
}
