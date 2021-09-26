<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct(Campaign $campaign){
        $this->campaign = $campaign;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->campaign->with("group")->with("values")->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->campaign->rules(), $this->campaign->feedback());

        $campaign = $this->campaign::create($request->all());
        
        return response()->json([$campaign], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = $this->campaign->find($id);

        if($campaign === null){
            return response()->json(["error"=>"campaign not found"], 404);
        }
        return response()->json($campaign, 200);
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
        $campaign = $this->campaign->find($id);
        
        if($campaign === null){
            return response()->json(['error'=>"campaign not found"], 404);
        }

        $request->validate($campaign->rules(), $campaign->feedback());

        $campaign->update($request->all());
        return response()->json($campaign, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = $this->campaign->find($id);

        if($campaign === null){
            return response()->json(['error'=>"group not found"], 404);
        }

        $campaign->delete();

        return response()->json("campaign $campaign->name has been deleted");
    }
}
