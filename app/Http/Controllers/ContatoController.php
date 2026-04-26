<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required|digits_between:8,15',
            'email' => 'required|email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedbacks = [
            'nome.min' => 'Preencha o nome com o mínimo de 3 caracteres.',
            'nome.max' => 'Preencha o nome com o máximo de 40 caracteres.',
            'telefone.digits_between' => 'O telefone dever ser numérico de 8 a 15 caracteres.',
            'email.email' => 'O email informado não é válido.',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caratecteres.',

            'required' => 'O campo :attribute precisa ser preenchido.'
        ];

        $dados = $request->validate($regras, $feedbacks);

        SiteContato::create($dados);
        return redirect()->route('site.index');
        
    }
}
