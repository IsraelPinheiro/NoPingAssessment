<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Sale as SaleResource;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sales = Sale::all();
        return $this->sendResponse(SaleResource::collection($sales), 'Sales fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required','numeric', 'gt:0']
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        if(!Customer::find($request->customer_id)){
            return $this->sendError([],'Customer not found');
        }
        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->save();
        return $this->sendResponse(new SaleResource($sale), 'Sale created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale){
        return $this->sendResponse(new SaleResource($sale), 'Sale fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale){
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required','numeric', 'gt:0']
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        if(!Customer::find($request->customer_id)){
            return $this->sendError([],'Customer not found');
        }
        $sale->customer_id = $request->customer_id;
        $sale->save();
        return $this->sendResponse(new SaleResource($sale), 'Sale updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale){
        $sale->delete();
        return $this->sendResponse([], 'Sale deleted.');
    }
}
