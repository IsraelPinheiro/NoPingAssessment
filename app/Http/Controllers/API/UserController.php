<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return $this->sendResponse(UserResource::collection($users), 'Users fetched.');
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
            'email' => ['required','email','unique:users,email'],
            'password' => [
                'sometimes',
                'required',
                'confirmed',
                Password::min(6)->mixedCase()->letters()->numbers()->symbols()->uncompromised(),
            ]
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->sendResponse(new UserResource($user), 'User created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        return $this->sendResponse(new UserResource($user), 'User fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes','required','string','min:5'],
            'email' => ['sometimes','required','email','unique:users,email,'.$user->id],
            'password' => [
                'sometimes',
                'required',
                'confirmed',
                Password::min(6)->mixedCase()->letters()->numbers()->symbols()->uncompromised(),
            ]
        ]);
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
        $user->name = $request->name ? $request->name : $user->name;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->save();
        return $this->sendResponse(new UserResource($user), 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        if($user->id != request()->user()->id){
            $user->delete();
            return $this->sendResponse([], 'User deleted.');
        }
        else{
            return $this->sendError([],"User can't delete itself.", 401);
        }
    }
}
