<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use App\User;
use App\Staff;


class AuthController extends Controller
{

    public function userLogin(Request $request) //Sisteme müşteri giriş api
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $data['token'] = $user->createToken('UserToken')->accessToken;
            $data['name']  = $user->name;
            return response()->json($data, 200);
        }

        return response()->json(['error'=>'Unauthorized'], 401);
    }

    public function userRegister(Request $request) //Sisteme müşteri kayıt api
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        $user = User::create($user);
        $success['token'] =  $user->createToken('StaffToken')-> accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], 200);
    }

    public function staffLogin(Request $request) //Sisteme personel giriş api
    {

        if (Auth::guard('staff')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $staff = Auth::guard('staff')->user();
            $data['token'] = $staff->createToken('StaffToken')->accessToken;
            $data['name']  = $staff->name;
            return response()->json($data, 200);
        }

        return response()->json(['error'=>'Unauthorized'], 401);
    }

    public function staffRegister(Request $request) //Sisteme personel kayıt api
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $staff = $request->all();
        $staff['password'] = Hash::make($staff['password']);
        $staff = Staff::create($staff);
        $success['token'] =  $staff->createToken('StaffToken')-> accessToken;
        $success['name'] =  $staff->name;

        return response()->json(['success'=>$success], 200);
    }

}
