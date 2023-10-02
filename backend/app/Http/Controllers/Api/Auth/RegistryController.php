<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistryController extends Controller
{
    public function registry(Request $request)
    {
        // Validação dos dados do formulário de registro
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Criação de um novo usuário
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            // Gere um token de acesso para o novo usuário
            $token = $user->createToken('authToken')->plainTextToken;

            DB::commit();

            return response()->json(['token' => $token], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error when registering a user'], 500);
        }
    }
}
