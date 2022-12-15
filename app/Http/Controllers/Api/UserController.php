<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        if(count($users) > 0){
            return response([
                'message' => 'Daftar data User',
                'data' => $users
            ], 200);
        }

        return response([
            'message' => 'users empty',
            'data' => null
        ], 400);
    }

    
    public function store(Request $request)
    {
        $storeData = $request->all();
        
        $validate = Validator::make($storeData, [
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'email' => 'required|email',
            'tanggal' => 'required',
            'telpon' => 'required|regex:/^[08]{2}[0-9]{4,5}$/',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $user = User::create($storeData);
        return response()->json([
            'success' => true,
            'message' => 'Tambah User berhasil',
            'data' => $user
        ], 200);
    }

    
    public function show($id)
    {
        $user = User::find($id);

        if(!is_null($user)) {
            return response([
                'message' => 'Retrieve User Success',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 400);
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
                'data' => ''
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'username' => 'required|min:6',
            'password' => 'required|min:6',
            'email' => 'required|email',
            'tanggal' => 'required',
            'telpon' => 'required|regex:/^[08]{2}[0-9]{4,5}$/',
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $user->username = $updateData['username'];
        $user->password = $updateData['password'];
        $user->email = $updateData['email'];
        $user->tanggal = $updateData['tanggal'];
        $user->telpon = $updateData['telpon'];
        $user->save();

         return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $user
        ], 200);
    }

}