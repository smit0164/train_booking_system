<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    public function search(Request $request){
        if($request->has('query')){
              $query = $request->input('query');
            if(empty($query)){
                $trains=Train::search()->get();
            }else{
                 $trains=Train::search($query)->get();
            }
           
        }else if($request->has('startStationId') || $request->has('endStationId') ){
            $startStationId=$request->input('startStationId');
            $endStationId=$request->input('endStationId');
            if($startStationId && $endStationId){
                $routeIds = DB::table('route_stops')->where('station_id', $endStationId)->orWhere('station_id',$startStationId )->pluck('route_id');
                // $filters = collect($routeIds)->map(fn($id) => "`route-id`:$id")->implode(' OR ');
                // $trains=Train::search('')->with(['filters' => $filters])->get();
                // dd($trains);
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
