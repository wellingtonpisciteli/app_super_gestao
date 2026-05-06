<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index', ['titulo' => 'Fornecedor']);
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->get();

        return view('app.fornecedor.listar', ['titulo' => 'Listar', 'fornecedores' => $fornecedores]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        //Inclusão
        if($request->input('_token') != '' && $request->input('id') == ''){
            //Validação
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email|unique:fornecedores,email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve conter no máximo 40 caracteres',
                'uf.min' => 'O campo UF deve conter no mínimo 2 caracteres',
                'uf.max' => 'O campo UF deve conter no máximo 2 caracteres',
                'email' => 'O campo e-mail não foi preenchido corretamente',
                'email.unique' => 'Esse e-mail já está sendo utilizado'
            ];

            $dados = $request->validate($regras, $feedback);
            
            Fornecedor::create($dados);
            
            //Dados
            $msg = 'Cadastro realizado com sucesso!';
        }

        //Edição
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = "Atualização realizada com sucesso!";
            }else {
                $msg = "Erro ao tentar atualizar o registro!";
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['titulo' => 'Adicionar', 'msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['titulo' => 'Editar', 'fornecedor' => $fornecedor, 'msg' => $msg]);
    }
}
