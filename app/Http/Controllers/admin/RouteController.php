<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Stationinfo;
use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
class RouteController extends Controller
{
    public function index(){
    //    $route_stations = Route::with(['stations' => function ($q) {
    //         $q->where('stations_info.total_no_platforms', 10);
    //     }])
    //     ->whereHas('stations', function ($q) {
    //         $q->where('stations_info.total_no_platforms', 10);
    //     })
    //     ->get();
         $route_stations=Route::with('stations')->get();
       return view('admin.route.index',['route_stations'=>$route_stations]);

    }
    public function create(){
        $station_list=Stationinfo::all();
        return view('admin.route.create',['station_list'=>$station_list]);
    }
    public function store(Request $request)
    {
       if($request->has('orders_json')) {
            $request->merge([
                'orders_json' => json_decode($request->input('orders_json'), true),
            ]);
        }
       
       $request->validate([
        'orders_json' =>'required|array|min:1',
        'name' => 'required|unique:routes,name',
        'total_distances' => 'required|integer',
        ]);
        
        $route = Route::create([
            'name'            => $request->name,
            'total_distances' => $request->total_distances,
        ]);
        $stations = $request->orders_json;
        $attachData=[]; 
        foreach ($stations as $index => $id) {
            $attachData[$id] = ['orderOfstations' => $index];
        }
        
        $route->stations()->attach($attachData);
        return redirect()->route('admin.route_info.index');
    }

    public function destroy(Route $routeinfo){
        $routeinfo->stations()->detach();
        $routeinfo->delete();
        return redirect()->route('admin.route_info.index');
    }
    public function edit(Route $routeinfo)
    {
        $station_list = Stationinfo::all();
        $currentStation = $routeinfo->stations->pluck('id','name')->all();
        return view('admin.route.edit', compact('routeinfo', 'station_list', 'currentStation'));
    }
    public function update(Route $routeinfo,Request $request){
       $routeinfo->name=$request->name;
       $routeinfo->total_distances=$request->total_distances;
       $routeinfo->save();

        $stations = json_decode($request->orders_json);
        $attachData=[]; 
        foreach ($stations as $index => $id) {
            $attachData[$id] = ['orderOfstations' => $index];
        }
       
        $routeinfo->stations()->sync($attachData);
        return redirect()->route('admin.route_info.index');
       
    }
}
