<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Customer as CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $customers = Customer::all();
        return $this->sendResponse(CustomerResource::collection($customers), 'Customers fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:5','unique:customers,name'],
            'email' => ['nullable','email','unique:customers,email'],
            'phone' => ['nullable','numeric','digits_between:10,11'],
            'birthday' => ['nullable','date'],
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->birthday = $request->birthday;
        $customer->save();
        return $this->sendResponse(new CustomerResource($customer), 'Customer created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer){
        return $this->sendResponse(new CustomerResource($customer), 'Customer fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer){
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','min:5','unique:customers,name,'.$customer->id],
            'email' => ['nullable','email','unique:customers,email,'.$customer->id],
            'phone' => ['nullable','numeric','digits_between:10,11'],
            'birthday' => ['nullable','date'],
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->birthday = $request->birthday;
        $customer->save();
        return $this->sendResponse(new CustomerResource($customer), 'Customer updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer){
        $customer->delete();
        return $this->sendResponse([], 'Customer deleted.');
    }
}
