<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct(Group $Group){
        $this->group = $Group;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->group->with('cities')->get(), 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->group->rules(), $this->group->feedback());

        $group = $this->group::create($request->all());
        
        return response()->json([$group], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->group->with('cities')->find($id);

        if($group === null){
            return response()->json(["error"=>"group not found"], 404);
        }
        return response()->json($group, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = $this->group->find($id);
        
        if($group === null){
            return response()->json(['error'=>"group not found"], 404);
        }

        if($request->method() === "PATCH"){
            foreach($group->rules() as $key => $rule){
                if(array_key_exists($key, $request->all())){
                    $dynamicRule[$key] = $rule;
                    $request->validate($dynamicRule, $group->feedback());

                }
            }
        }else{
            $request->validate($group->rules(), $group->feedback());
        }

        $group->update($request->all());
        // dd($request->all());
        return response()->json($group, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $group = $this->group->find($id);

        if($group === null){
            return response()->json(['error'=>"group not found"], 404);
        }

        $group->delete();

        return response()->json("group $group->name has been deleted");


    }
    
}
