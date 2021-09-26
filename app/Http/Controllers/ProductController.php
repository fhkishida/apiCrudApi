<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->product->with("values")->get(), 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->product->rules(), $this->product->feedback());

        $product = $this->product::create($request->all());
        
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('cities')->find($id);

        if($product === null){
            return response()->json(["error"=>"group not found"], 404);
        }
        return response()->json($product, 200);
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
        $product = $this->product->find($id);
        
        if($product === null){
            return response()->json(['error'=>"product not found"], 404);
        }

        if($request->method() === "PATCH"){
            foreach($product->rules() as $key => $rule){
                if(array_key_exists($key, $request->all())){
                    $dynamicRule[$key] = $rule;
                    $request->validate($dynamicRule, $product->feedback());
                }
            }
        }else{
            $request->validate($product->rules(), $product->feedback());
        }

        $product->update($request->all());
        // dd($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);

        if($product === null){
            return response()->json(['error'=>"product not found"], 404);
        }

        $product->delete();

        return response()->json("group $product->name has been deleted");

    }
}
