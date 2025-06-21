<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stationinfo;
use Illuminate\Database\Eloquent\Collection;

class stationinfoController extends Controller
{
    public function index(){
        // $station_info=Stationinfo::where('total_no_platforms','>','3')->get();
        // $station_info = $station_info->reject(function (Stationinfo $Stationinfo) {
        //     return $Stationinfo->total_no_platforms<10;
        // });
        // dd($station_info);

        

        // Stationinfo::chunkById(5, function ($stations) {
        //     // $stations is a Collection of up to 5 models
        //     foreach ($stations as $station) {
        //        $station->total_no_platforms=5;
        //           $station->save();
        //     }

            
        // },column: 'id');

      // Stationinfo::where('total_no_platforms', '=','10')->chunkById(5, function ( Collection $stations)  {
      //       foreach ($stations as $station) {
      //          $station->update(['total_no_platforms'=>9]);
      //       }
      // },column: 'id');

    // foreach (Stationinfo::lazy(5) as $station) {
    //     $station->total_no_platforms = 10;
    //     $station->save();
    // }
    // foreach (Stationinfo::lazyById(5, column: 'id') as $station) {
    //     $station->total_no_platforms = 10;
    //     $station->save();
    // }
    // foreach (Stationinfo::cursor() as $station) {
    //     $station->total_no_platforms = 101;
    //     $station->save();
    // }
    //$station_info=Stationinfo::where('total_no_platforms','>','167')->first();
    // dd($station_info);
    // $station_info = Stationinfo::where('total_no_platforms','>','11')->firstOr(function () {
    //     dd("hii");
    // });
     // dd($station_info);
//    $station_info=Stationinfo::where('total_no_platforms','>','3')->firstOrFail();
//    dd($station_info);
    // $station_info=Stationinfo::firstOrCreate(
    //     ['total_no_platforms'=> '15'],
    //     ['name'=>'smit','code'=>'SMIT056'],
    // );
//    $station_info=Stationinfo::firstOrNew(
//         ['total_no_platforms'=> '210'],
//         ['name'=>'smit111','code'=>'SMIT056111'],
//     );
   // $station_info->save();
//    $new_station_info=new Stationinfo;
//    $new_station_info->name='vishal';
//    $new_station_info->code='VIH';
//    $new_station_info->total_no_platforms=50;
//    $new_station_info->save();
    //  Stationinfo::create([
    //     'name'=>'ajay',
    //     'code'=>'AJY',
    //     'total_no_platforms'=>90,
    //  ]);
    // Stationinfo::destroy([3,4,5,6]);
   // $station_info=Stationinfo::onlyTrashed()->restore();
     $stations_info = Stationinfo::orderBy('id')->cursorPaginate(5);
     $stationCount = Stationinfo::count();
    return view('admin.stations_info.index', ['station_info' => $stations_info,'stationCount'=>$stationCount]);

    }
    public function create(){
      return view('admin.stations_info.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:stations_info,name',
            'code' => 'required|unique:stations_info,code',
            'total_no_platforms' => 'required|integer|min:1',
        ]);
        //$station_info=new Stationinfo;
        // $station_info->name=$validatedData['name'];
        // $station_info->code=$validatedData['code'];
        // $station_info->total_no_platforms=$validatedData['total_no_platforms'];
        // $station_info->save();
        Stationinfo::create([
            'name' => $validatedData['name'],
            'code'=>$validatedData['code'],
            'total_no_platforms'=>$validatedData['total_no_platforms'],
        ]);
        return redirect()->route('admin.station_info.index');
    }
    public function destroy($id){
      try {

      //   $id=1000;
      //  Stationinfo::destroy($id);
       $station_info=Stationinfo::findOrfail($id);
       $station_info->delete();
       return redirect()->route('admin.station_info.index');

      } catch (\Exception $e) {
        dd($e);
      }
      
    }
    public function edit($id){
      $station_info=Stationinfo::findOrfail($id);
      return view('admin.stations_info.edit',["station_info"=>$station_info]);
    }

    public function update(Request $request,$id){
      $validatedData = $request->validate([
          'name' => 'required|unique:stations_info,name,'.$id,
          'code' => 'required|unique:stations_info,code,'.$id,
          'total_no_platforms' => 'required|integer|min:1',
      ]);
       $station_info=Stationinfo::findOrfail($id);
       $station_info->update($validatedData);
       return redirect()->route('admin.station_info.index');
    }


}
