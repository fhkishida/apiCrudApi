<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(City $city){
        $this->city = $city;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->city->with('group')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->city->rules(),$this->city->feedback()); 
        $city = $this->city::create($request->all());
        return response()->json([$city], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = $this->city->with('group')->find($id);

        if($city === null){
            return response()->json(["error"=>"city not found"], 404);
        }
        return response($city, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = $this->city->find($id);
        
        if($city === null){
            return response()->json(['error'=>"city not found"], 404);
        }

        if($request->method() === "PATCH"){
            foreach($city->rules() as $key => $rule){
                if(array_key_exists($key, $request->all())){
                    $dynamicRule[$key] = $rule;
                    $request->validate($dynamicRule, $city->feedback());

                }
            }
        }else{
            $request->validate($city->rules(), $city->feedback());
        }

        $city->update($request->all());
        // dd($request->all());
        return response()->json($city, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = $this->city->find($id);

        if($city === null){
            return response()->json(['error'=>"city not found"], 404);
        }

        $city->delete();

        return response()->json("city $city->name has been deleted");
    }
}
