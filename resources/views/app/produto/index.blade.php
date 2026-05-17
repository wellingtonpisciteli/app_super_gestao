@extends('app.layouts.basico')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Produto - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href=""></a>Novo</li>
                <li><a href=""></a>Consulta</li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table class="tabela-fornecedores">
                    <thead>
                        <tr>
                            <th >Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Excluir</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td></td>
                                <td></td>
                            </tr>                   
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $produtos->appends($request)->links() }}
                </div>  
                <!--
                <br>
                {{ $produtos->count() }} = Total de registro por pagina
                <br>
                {{ $produtos->total() }} = Total de registro da consulta
                <br>
                {{ $produtos->firstItem() }} = Numero do primeiro registro da pagina
                <br>
                {{ $produtos->lastItem() }} = Numero do ultimo registro da pagina
                -->
                <br>
                Exibindo {{ $produtos->count() }} de {{ $produtos->total() }} produtos (de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }}) 


            </div>
        </div>
    </div>        
@endsection