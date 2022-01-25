<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Supplier as SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $supliers = Supplier::all();
        return $this->sendResponse(SupplierResource::collection($supliers), 'Supliers fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:5','unique:suppliers,name'],
            'email' => ['required','email','min:5','unique:suppliers,email']
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->save();
        return $this->sendResponse(new SupplierResource($supplier), 'Supplier created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier){
        return $this->sendResponse(new SupplierResource($supplier), 'Supplier fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier){
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes','required','string','min:5','unique:suppliers,name,'.$supplier->id],
            'email' => ['sometimes','required','email','min:5','unique:suppliers,email,'.$supplier->id]
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $supplier->name = $request->name ? $request->name : $supplier->name;
        $supplier->email = $request->email ? $request->email : $supplier->email;
        $supplier->save();
        return $this->sendResponse(new SupplierResource($supplier), 'Supplier updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
