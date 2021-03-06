<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Supplier as SupplierResource;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Products fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:5'],
            'sku' => ['required','string','min:5','unique:products,sku'],
            'description' => ['nullable','string'],
            'in_stock' => ['nullable','numeric', 'gte:0'],
            'supplier_id' => ['required','numeric', 'gt:0'],
            'price' => ['nullable','numeric', 'gte:0'],
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        if(!Supplier::find($request->supplier_id)){
            return $this->sendError([],'Supplier not found');
        }
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->in_stock = $request->in_stock ? $request->in_stock : 0;
        $product->supplier_id = $request->supplier_id;
        $product->price = $request->price ? $request->price : 0;
        $product->save();
        return $this->sendResponse(new ProductResource($product), 'Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        return $this->sendResponse(new ProductResource($product), 'Product fetched.');
    }

    /**
     * Return the Product's Supplier.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function getSupplier(Product $product){
        return $this->sendResponse(new SupplierResource($product->supplier), 'Supplier fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes','required','string','min:5'],
            'sku' => ['sometimes','required','string','min:5','unique:products,sku,'.$product->id],
            'description' => ['sometimes','nullable','string'],
            'in_stock' => ['sometimes','nullable','numeric', 'gte:0'],
            'supplier_id' => ['sometimes','nullable','numeric', 'gt:0'],
            'price' => ['sometimes','nullable','numeric', 'gte:0'],
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        if(!Supplier::find($request->supplier_id)){
            return $this->sendError([],'Supplier not found');
        }
        $product->name = $request->name ? $request->name : $product->name;
        $product->sku = $request->sku ? $request->sku : $product->sku;
        $product->description = $request->description ? $request->description : $product->description;
        $product->in_stock = $request->in_stock ? $request->in_stock : $product->in_stock;
        $product->supplier_id = $request->supplier_id ? $request->supplier_id : $product->supplier_id;
        $product->price = $request->price ? $request->price : $product->price;
        $product->save();
        return $this->sendResponse(new ProductResource($product), 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        $product->delete();
        return $this->sendResponse([], 'Product deleted.');
    }
}
