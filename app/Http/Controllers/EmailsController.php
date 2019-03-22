<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Requests\RedefinirSenhaRequest;
use App\User;

class EmailsController extends Controller
{


    public function emailsenha(RedefinirSenhaRequest $request)
    {
        $user = User::where('email', $request->input('email'))->get();
        if ($user->count() > 0) {
            $rand = rand(100000, 999999);
            $data = array('name' => $user[0]->name, "novaSenha" => $rand);
            $user[0]->password = bcrypt($rand);
            $user[0]->save();
            Mail::send('emails.emailsenha', $data, function ($message) use ($user) {
                $message->to($user[0]->email, $user[0]->name)
                    ->subject('+Serviço - SENHA REDEFINIDA');
                $message->from('maisservicoprojeto@gmail.com', '+Serviço');
            });
            return redirect('login');
        }
    }
}
