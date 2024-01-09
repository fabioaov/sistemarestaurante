<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();

        return view('produtos/index')->with('produtos', $produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'produto' => ['required', 'string', 'max:50'],
            'valor' => ['required', 'numeric', 'max:9999999'],
            'estoque' => ['required', 'integer', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        Produto::create([
            'produto' => $request->produto,
            'valor' => $request->valor,
            'estoque' => $request->estoque,
        ]);

        return redirect()->route('produtos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        
        return view('produtos.edit')->with('produto', $produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'produto' => ['required', 'string', 'max:50'],
            'valor' => ['required', 'numeric', 'max:9999999'],
            'estoque' => ['required', 'integer', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $produto = Produto::find($id);

        $produto->produto = $request->produto;
        $produto->valor = $request->valor;
        $produto->estoque = $request->estoque;

        $produto->save();

        return redirect()->route('produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        $produto->delete();
        
        return redirect()->route('produtos');
    }
}
