<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "Gagal Login"
            ]);
    }
    

    $token= $user->createToken("Berhasil Login")->plainTextToken;
    return response()->json([
        'status' => true,
        'access_token' => $token,
        'message'=>'Berhasil Login'
    ]);
    
}
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "status" => true,
            "message" => "Berhasil Logout"
        ]);
    }

    public function profile(Request $request)
    {   
        return response()->json([
            "status" => true,
            "Data" => Auth::user(),
            "message" => "Sukses"
            ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => '',
            'email' => 'unique:users'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json([
            "status" => true,
            'data' => $user,
            "message" => "Update berhasil"
        ]);
    }

    public function users()
    {
        $users = User::all();
        return response()->json([
            "success" => true,
            "data" => $users,
            "message" => "sukses"
            ]);
    }
}