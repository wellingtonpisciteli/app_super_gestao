<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
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
    Route::get('/clientes' , function(){return 'Clientes'; })->name('app.clientes');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos' , function(){return 'Produtos'; })->name('app.produtos');
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



