<?php

namespace App\Http\Controllers;

use App\Models\ProductValue;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductValueController extends Controller
{
    public function __construct(ProductValue $productValue){
        $this->productValue = $productValue;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->productValue->with("product")->with("campaign")->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $discountExists = ProductValue::select()
        ->where("product_id", $request->product_id)
        ->where("campaign_id", $request->campaign_id)
        ->count();

        if($discountExists > 0 ){
            return response()->json(["error"=>"data already exists"], 403);
        }

        $request->validate($this->productValue->rules(), $this->productValue->feedback());


        $productValue = $this->productValue::create($request->all());
        
        return response()->json($productValue, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productValue = $this->productValue->with('cities')->find($id);

        if($productValue === null){
            return response()->json(["error"=>"group not found"], 404);
        }
        return response()->json($productValue, 200);
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
        $productValue = $this->productValue->find($id);
        
        if($productValue === null){
            return response()->json(['error'=>"productValue not found"], 404);
        }

        if($request->value > Product::get()->where("id", $productValue->id)->first()->value){
            return response()->json(['error'=>"discount must be less then the product value"], 400);
        }

        if($request->method() === "PATCH"){
            foreach($productValue->rules() as $key => $rule){
                if(array_key_exists($key, $request->all())){
                    $dynamicRule[$key] = $rule;
                    $request->validate($dynamicRule, $productValue->feedback());
                }
            }
        }else{
            $request->validate($productValue->rules(), $productValue->feedback());
        }
        

        $productValue->update($request->all());
        // dd($request->all());
        return response()->json($productValue, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productValue = $this->productValue->find($id);

        if($productValue === null){
            return response()->json(['error'=>"productValue not found"], 404);
        }

        $productValue->delete();

        return response()->json("group $productValue->name has been deleted");
    }
}
