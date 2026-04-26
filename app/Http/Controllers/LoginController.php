<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';
        
        if($request->route('erro') == 1){
            $erro = 'Usuário ou senha não existe';
        }

        if($request->route('erro') == 2){
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {   
        //Regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //Mensagens de feedback de validção
        $feedback = [
            'usuario.email' => 'O campo usuário (email) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        //Se não passar pela validção volta aqui
        $request->validate($regras, $feedback);

        //Recuperando os parametros do form
        $email = $request->get('usuario');
        $password = $request->get('senha');

        echo $email;
        echo '<br>';
        echo $password;

        //Iniciar o Model User
        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->first();

        if(isset($usuario->name)){
            
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
