<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\LogAcessoMiddleware;

Route::get('/', [PrincipalController::class, 'principal'])
    ->middleware('log.acesso')
    ->name('site.index');

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');    
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/login/{erro?}' , [LoginController::class, 'index'])->name('site.login');
Route::post('/login' , [LoginController::class, 'autenticar'])->name('site.login');

Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/home' , [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair' , [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente' , [ClienteController::class, 'index'])->name('app.cliente');

    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    Route::get('/produto' , [ProdutoController::class, 'index'])->name('app.produto');
});

Route::get('/rota1', function(){
    echo 'Rota 1';
})->name('site.rota1');

Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para ir a pagina inicial.';
});



