<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController{

    /**
     * Try to get a auth token based on the provided credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $validator = Validator::make($request->all(), [
                'email' => ['required','email'],
                'password' => ['required','string'],
                'token_name' => ['sometimes','required','string']
            ]);
            if($validator->fails()){
                return $this->sendError('Error validation', $validator->errors());       
            }
            $user = Auth::user(); 
            $success['name'] =  $user->name;
            $success['token_name'] = $request->token_name ? $request->token_name : "app_token";
            $success['token'] =  $user->createToken($success['token_name'])->plainTextToken; 
            return $this->sendResponse($success, 'User signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 401);
        } 
    }
}