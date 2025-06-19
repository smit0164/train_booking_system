<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Train;
use App\Models\Stationinfo;
use App\Http\Requests\TrainRequest;
use Illuminate\Support\Facades\DB;
class TrainController extends Controller
{
    public function index(){
        $trainInfo=Train::all();
        return view('admin.trains.index',['trainInfo'=>$trainInfo]);
    }
    public function create(){
        $routes=Route::all();
        return view('admin.trains.create',['routes'=>$routes]);
    }

    

public function store(TrainRequest $request)
{
    DB::transaction(function () use ($request) {
        $train = Train::create($request->validated());
        $scheduleInfo = json_decode($request->input('schedule_train_info'), true);
        if (is_array($scheduleInfo) && count($scheduleInfo) > 0) {
            $hasArrivalTime = false;
            foreach ($scheduleInfo as $times) {
                if (!empty($times['arrival_time']) && !empty($times['departure_time'])) {
                    $hasArrivalTime = true;
                    break;
                }
            }
            if ($hasArrivalTime) {
                $scheduleItems = [];
                foreach ($scheduleInfo as $stationId => $times) {
                    $scheduleItems[] = [
                        'station_id'     => $stationId,
                        'arrival_time'   => $times['arrival_time'] ?? null,
                        'departure_time' => $times['departure_time'] ?? null,
                    ];
                }
                $train->Train_Schedule_per_stations()->createMany($scheduleItems);
            }
        }

        if (count($request->input('class_name')) > 0 && count($request->input('class_count')) > 0) {
            $class_name = $request->input('class_name');
            $class_count = $request->input('class_count');
            if ($class_name[0] != null && $class_count[0] != null) {
                $classCount = [];
                for ($i = 0; $i < min(count($class_name), count($class_count)); $i++) {
                    $classCount[] = [
                        'name'            => $class_name[$i],
                        'total_count'     => $class_count[$i],
                        'available_count' => $class_count[$i],
                    ];
                }
                $train->trains_class()->createMany($classCount);
            }
        }
    });

    return redirect()->route('admin.train_info.index');
}

    public function destroy(Train $trainInfo){
        // $trainInfo->Train_Schedule_per_stations()->delete();

        // // Delete related classes
        // $trainInfo->trains_class()->delete();

        // // Finally delete the train itself
        $trainInfo->delete();
        return redirect()->route('admin.train_info.index');
    }
    public function edit(Train $trainInfo){
        $train_info=$trainInfo->load(['Train_Schedule_per_stations.station','trains_class','route']);
         $routes=Route::with('stations')->get();
         return view('admin.trains.edit',['train_info'=>$train_info,'routes'=>$routes]);
    }

    public function update(Train $trainInfo,TrainRequest $request){
            $data = $request->validated();
            $trainInfo->update([
                'name' => $data['name'],
                'code' => $data['code'],
                'start-time' => $data['start-time'],
                'end-time' => $data['end-time'],
                'date' => $data['date'],
                'route-id' => $data['route-id'],
            ]);
            if($request->has('schedule_train_info')){
                $scheduleInfo = json_decode($request->input('schedule_train_info'), true);
                if (is_array($scheduleInfo) && count($scheduleInfo) > 0) {
                    $hasArrivalTime = true;
                    foreach ($scheduleInfo as $times) {
                        if (empty($times['arrival_time']) || empty($times['departure_time'])) {
                            $hasArrivalTime = false;
                            break;
                        }
                    }
                    if ($hasArrivalTime) {
                        $scheduleItems = [];
                        foreach ($scheduleInfo as $stationId => $times) {
                            $scheduleItems[] = [
                                'station_id'     => $stationId,
                                'arrival_time'   => $times['arrival_time'] ?? null,
                                'departure_time' => $times['departure_time'] ?? null,
                            ];
                        }
                        foreach($scheduleItems as $schedule){
                            
                            $existingSchedule = $trainInfo->Train_Schedule_per_stations()
                                ->where('station_id', '=',$schedule['station_id'])
                                ->first();
                            
                            if ($existingSchedule) {
                                // Update the existing schedule record
                                
                                $existingSchedule->update([
                                    'arrival_time' => $schedule['arrival_time'],
                                    'departure_time' => $schedule['departure_time'],
                                ]);
                            } else {
                                // Optionally create a new schedule if none exists for this station
                                $trainInfo->Train_Schedule_per_stations()->create($schedule);
                            }
                        } 
                        
                    }
                }
            }
            if($request->has('class_name') && $request->has('class_count')){
                if (count($request->input('class_name')) > 0 && count($request->input('class_count')) > 0) {
                    $class_name = $request->input('class_name');
                    $class_count = $request->input('class_count');
                    if ($class_name[0] != null && $class_count[0] != null) {
                        $classCount = [];
                        for ($i = 0; $i < min(count($class_name), count($class_count)); $i++) {
                            $classCount[] = [
                                'name'            => $class_name[$i],
                                'total_count'     => $class_count[$i],
                                'available_count' => $class_count[$i],
                            ];
                        }
                      foreach ($classCount as $class) {
                        // Find existing class by name
                        $existingClass = $trainInfo->trains_class()->where('name', $class['name'])->first();

                        if ($existingClass) {
                            // Calculate new available_count based on difference between old and new total_count
                            $oldTotal = $existingClass->total_count;
                            $oldAvailable = $existingClass->available_count;
                            $newTotal = $class['total_count'];

                            // Adjust available_count by adding the difference in total_count
                            $difference = $newTotal - $oldTotal;
                            $newAvailable = max(0, $oldAvailable + $difference);

                            // Update existing record
                            $existingClass->update([
                                'total_count' => $newTotal,
                                'available_count' => $newAvailable,
                            ]);
                        } else {
                            // Create new record with available_count equal to total_count
                            $trainInfo->trains_class()->create([
                                'name' => $class['name'],
                                'total_count' => $class['total_count'],
                                'available_count' => $class['total_count'],
                            ]);
                        }
                    }

                       
                    }
                }
            } 
            return redirect()->route('admin.train_info.index');
    }
}
