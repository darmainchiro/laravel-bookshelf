<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class AuthController extends BaseController
{
    // register

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('user_token')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User Berhasil Terdaftar.');
    }
}
