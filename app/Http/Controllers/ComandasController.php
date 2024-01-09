<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Mesa;
use App\Models\MetodoPagamento;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ComandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'ocupantes' => ['required', 'integer', 'between:1,4'],
            'idMesa' => ['required', 'integer', 'exists:mesas,id'],
        ]);

        $comanda = Comanda::create([
            'id_mesa' => $request->idMesa,
        ]);

        $mesa = Mesa::find($request->idMesa);

        $mesa->ocupantes = $request->ocupantes;

        $mesa->save();

        $request->session()->put('comanda_mesa' . $request->idMesa, $comanda->id);
        return redirect()->back()->with('success_code', $request->idMesa);
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
        $comanda = Comanda::find($id);
        $pedidos = Pedido::where('id_comanda', $comanda->id)->get();
        $metodos = MetodoPagamento::all();

        return view('comandas.edit')->with('comanda', $comanda)->with('pedidos', $pedidos)->with('metodos', $metodos);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
