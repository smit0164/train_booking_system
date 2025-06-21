<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use App\Models\Book;
use App\Models\User;
use App\Models\Stationinfo;
use App\Models\BookTrainClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserDashboardController extends Controller
{
    public function index(){
        $trains=Train::with(['Train_Schedule_per_stations.station','trains_class','route.stations'])->cursorPaginate(3);
        $stations = Stationinfo::all();
        return view('dashboard',['trains'=>$trains,'stations'=>$stations]);
    }
    public function viewtrainBookingPage(Train $train){
          return view('book',['train'=>$train]);
    }
    public function trainBooking(Train $train,Request $request){
       $train_class=@json_decode($request->input('class_info',true));
       DB::transaction(function () use ($train, $request, $train_class){
            $book=Book::create([
            'user_id'=>Auth::guard('user')->user()->id,
            'train_id'=>$train->id,
            'price'=>500
            ]);
            foreach($train_class as $class=>$count){
                $class_update=$train->trains_class()->where('name','=',$class)->firstOrFail();
                $newAvailableCount=$class_update->available_count - $count;
                $class_update->available_count=$newAvailableCount;
                $class_update->save();
                BookTrainClass::create([
                    'book_id'=>$book->id,
                    'class_name'=>$class,
                    'count'=>$count
                ]);
             }
            
        });

        return redirect()->route('user.dashboard');
    }
    public function showTickets(User $user){
            return view('ticket',['user'=>$user]);
    }
}
