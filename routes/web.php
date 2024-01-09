<?php

use App\Http\Controllers\ComandasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MesasController;
use App\Http\Controllers\MetodosPagamentoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Comandas
    Route::post('/comandas/salvar', [ComandasController::class, 'store'])->name('comandas.salvar');
    Route::get('/comandas/{id}/editar', [ComandasController::class, 'edit'])->name('comandas.editar');
    Route::put('/comandas/{id}', [ComandasController::class, 'update'])->name('comandas.atualizar');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Formas de pagamento
    Route::get('/metodos_pagamento', [MetodosPagamentoController::class, 'index'])->name('metodos_pagamento');
    Route::get('/metodos_pagamento/novo', [MetodosPagamentoController::class, 'create'])->name('metodos_pagamento.novo');
    Route::post('/metodos_pagamento/salvar', [MetodosPagamentoController::class, 'store'])->name('metodos_pagamento.salvar');
    Route::get('/metodos_pagamento/{id}/editar', [MetodosPagamentoController::class, 'edit'])->name('metodos_pagamento.editar');
    Route::put('/metodos_pagamento/{id}', [MetodosPagamentoController::class, 'update'])->name('metodos_pagamento.atualizar');
    Route::delete('/metodos_pagamento/{id}', [MetodosPagamentoController::class, 'destroy'])->name('metodos_pagamento.deletar');

    // Mesas
    Route::get('/mesas', [MesasController::class, 'index'])->name('mesas');
    Route::get('/mesas/nova', [MesasController::class, 'create'])->name('mesas.nova');
    Route::post('/mesas/salvar', [MesasController::class, 'store'])->name('mesas.salvar');
    Route::get('/mesas/{id}/editar', [MesasController::class, 'edit'])->name('mesas.editar');
    Route::put('/mesas/{id}', [MesasController::class, 'update'])->name('mesas.atualizar');
    Route::delete('/mesas/{id}', [MesasController::class, 'destroy'])->name('mesas.deletar');

    // Pedidos
    Route::post('/pedidos/novo', [PedidosController::class, 'store'])->name('pedidos.salvar');

    // Produtos
    Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos');
    Route::get('/produtos/novo', [ProdutosController::class, 'create'])->name('produtos.novo');
    Route::post('/produtos/salvar', [ProdutosController::class, 'store'])->name('produtos.salvar');
    Route::get('/produtos/{id}/editar', [ProdutosController::class, 'edit'])->name('produtos.editar');
    Route::put('/produtos/{id}', [ProdutosController::class, 'update'])->name('produtos.atualizar');
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy'])->name('produtos.deletar');
});

require __DIR__ . '/auth.php';
