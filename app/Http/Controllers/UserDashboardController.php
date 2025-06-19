<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index(){
        $trains=Train::with(['Train_Schedule_per_stations.station','trains_class','route.stations'])->get();
        return view('dashboard',['trains'=>$trains]);
    }
    public function viewtrainBookingPage(Train $train){
          return view('book',['train'=>$train]);
    }
    public function trainBooking(Train $train){
      
        DB::transaction(function () {
             Book::create([
               'user_id'=>Auth::guard('user')->user()->id,
               'train_id'=>$train->id,
             ]);
        });
    }
}
