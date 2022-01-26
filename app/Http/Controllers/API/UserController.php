<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'email' => ['sometimes','required','email','min:5','unique:users,email,'.$user->id],
            'password' => ['sometimes','required','string','min:6','confirmed']
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

    }
}
