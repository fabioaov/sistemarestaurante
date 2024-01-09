<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas = Mesa::all();

        return view('mesas/index')->with('mesas', $mesas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mesas/create');
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
            'mesa' => ['required', 'string', 'max:50'],
            'vagas' => ['required', 'integer', 'max:20'],
        ]);

        Mesa::create([
            'mesa' => $request->mesa,
            'vagas' => $request->vagas,
        ]);

        return redirect()->route('mesas');
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
        $mesa = Mesa::find($id);

        return view('mesas.edit')->with('mesa', $mesa);
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
            'mesa' => ['required', 'string', 'max:50'],
            'vagas' => ['required', 'integer', 'max:20'],
        ]);

        $mesa = Mesa::find($id);

        $mesa->mesa = $request->mesa;
        $mesa->vagas = $request->vagas;

        $mesa->save();

        return redirect()->route('mesas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mesa = Mesa::find($id);

        $mesa->delete();

        return redirect()->route('mesas');
    }
}
