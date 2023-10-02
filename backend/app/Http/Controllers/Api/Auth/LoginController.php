<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->only([
            'email',
            'password',
            'device_name'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        //Verifica se o email e senha estão na base de dados
        if(!$user || !Hash::check($credentials['password'], $user->password)){
            return response()->json('Incorrect email or password', 404);
        }

        //Cria um novo token para o user
        $token = $user->createToken($credentials['device_name'])->plainTextToken;

        $dado = ['message' => 'Login efetuado com sucesso', 'token' => $token];
        
        return json_encode($dado, JSON_UNESCAPED_UNICODE);
    }

    public function requestPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return response()->json(['message' => 'E-mail não encontrado'], 404);
        }
    
        // Gerar um token de redefinição de senha
        $token = Str::random(60);
        $user->update([
            'reset_token' => $token
        ]);
    
        // Enviar o e-mail com o link para redefinir a senha
        Mail::to($user->email)->send(new PasswordResetMail($user, $token));

        $dado = ['message' => 'E-mail de redefinição de senha enviado com sucesso'];
        
        return json_encode($dado, JSON_UNESCAPED_UNICODE);
    }

}
