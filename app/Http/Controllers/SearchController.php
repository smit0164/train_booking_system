<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->input('query');
        $startStationId=$request->input('startStationId') ?? null;
        $endStationId=$request->input('endStationId') ?? null;
        
        if($request->has('query')){
            $trains=Train::search($query)->get();
        }else{
            if($startStationId && $endStationId){
                $routeIds = DB::table('route_stops')->where('station_id', $endStationId)->orWhere('station_id',$startStationId )->pluck('route_id');
                $trains = Train::whereIn('route-id', $routeIds)->get();
            }else{
                 if($startStationId){
                    $routeIds = DB::table('route_stops')->where('station_id', $startStationId)->pluck('route_id');
                    $trains = Train::whereIn('route-id', $routeIds)->get();
                }
                if($endStationId){
                    $routeIds = DB::table('route_stops')->where('station_id', $endStationId)->pluck('route_id');
                    $trains = Train::whereIn('route-id', $routeIds)->get();
                }
           
            }
           
        }
        return view('partials.train-card', compact('trains'));
    }
}
