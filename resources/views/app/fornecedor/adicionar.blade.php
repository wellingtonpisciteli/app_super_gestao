@extends('app.layouts.basico')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - {{ isset($fornecedor) ? 'Editar' : 'Adicionar' }}</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{ $msg ?? ''}}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.adicionar') }}" method="post">
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? ''}}">
                    @csrf
                    <input name="nome" type="text" value="{{ $fornecedor->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    <input name="site" type="text" value="{{ $fornecedor->site ?? old('site') }}" placeholder="Site" class="borda-preta">
                        {{ $errors->has('site') ? $errors->first('site') : '' }}
                    <input name="uf" type="text" value="{{ $fornecedor->uf ?? old('uf') }}" placeholder="UF" class="borda-preta">
                        {{ $errors->has('uf') ? $errors->first('uf') : '' }}
                    <input name="email" type="text" value="{{ $fornecedor->email ?? old('email') }}" placeholder="E-mail" class="borda-preta">
                        {{ $errors->has('email') ? $errors->first('email') : '' }}
                    <button type="submit" class="borda-preta">{{ isset($fornecedor) ? 'Editar' : 'Cadastrar' }}</button>
                </form>
            </div>
        </div>
    </div>        
@endsection