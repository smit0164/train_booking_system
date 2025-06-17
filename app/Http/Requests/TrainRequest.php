<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Train;
class TrainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->store():$this->update();
    }

    public function store(){
         return [
             'name'=>'required|string|unique:trains,name',
             'code'=>'required|string|unique:trains,code',
             'start-time'=>'required|date_format:H:i',
             'end-time'=>'required|date_format:H:i',
             'date'=>'required|date|date_format:Y-m-d',
             'route-id'=>'required'
         ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startTime = $this->input('start-time');
            $endTime = $this->input('end-time');
            $date = $this->input('date');
            $routeId=$this->input('route-id');
            if($this->isMethod('PUT')){
               $id = $this->route('trainInfo')->id;
            }else{
                $id=null;
            }
            
            if($startTime!=null && $endTime!=null && $date!=null && $routeId!=null){
                
                if($id!=null){
                    $slotNotAvaible=Train::where('date',$date)->where(function($query) use($startTime,$endTime){
                    $query->where('start-time','=',$startTime)->orWhere('end-time','=',$endTime)->orWhere(function($query) use($startTime,$endTime){
                        $query->where('start-time', '<=', $startTime)->where('end-time', '>=', $endTime);
                        });
                    })->where('id','!=',$id)->exists();
                }else{
                        $slotNotAvaible=Train::where('date',$date)->where(function($query) use($startTime,$endTime){
                        $query->where('start-time','=',$startTime)->orWhere('end-time','=',$endTime)->orWhere(function($query) use($startTime,$endTime){
                            $query->where('start-time', '<=', $startTime)->where('end-time', '>=', $endTime);
                            });
                        })->exists();
                }
                if($slotNotAvaible){
                    $validator->errors()->add('start-time', 'The train schedule overlaps with an existing schedule on the selected date.');
                }
            }
           
        });
    }

    
    public function update(){
        $id = $this->route('trainInfo')->id;
         return [
             'name'=>'required|string|unique:trains,name,'.$id,
             'code'=>'required|string|unique:trains,code,'.$id,
             'start-time'=>'required|date_format:H:i',
             'end-time'=>'required|date_format:H:i',
             'date'=>'required|date|date_format:Y-m-d',
             'route-id'=>'required',
             'schedule_train_info'=>'required'
         ];
    }
     
}
