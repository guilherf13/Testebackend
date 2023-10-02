<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function savePassword(Request $request)
    {

        // Valide os dados
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'max:12'],
            'user_id' => ['required']
        ]);

        // Verifique se a validação falhou
        if ($validator->fails()) {
            return $validator->getMessageBag();
        }
       

        $dados = $request->all();

        DB::beginTransaction();
        try {    
            $user = User::find($dados['user_id']);

            $user->update([
                'password' => $dados['password']
            ]);

            DB::commit();

            $dado = ['message' => 'Senha redefinida com sucesso'];
            
            return json_encode($dado, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error when registering a user'], 500);
        }

        }

    public function resetPasswordForm(Request $request)
    {
        $userid = $request->all();
        return view('reset-password', ['id' => $userid['user_id']]);  
    }
}
