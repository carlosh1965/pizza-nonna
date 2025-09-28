<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gasto::all();
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        return view('gastos.create');
    }

    public function store(Request $request)
    {
        Gasto::create($request->all());
        return redirect()->route('gastos.index');
    }

    public function destroy($id)
    {
        Gasto::destroy($id);
        return redirect()->route('gastos.index');
    }
}
