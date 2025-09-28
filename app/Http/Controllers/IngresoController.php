<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::all();
        return view('ingresos.index', compact('ingresos'));
    }

    public function create()
    {
        return view('ingresos.create');
    }

    public function store(Request $request)
    {
        Ingreso::create($request->all());
        return redirect()->route('ingresos.index');
    }

    public function destroy($id)
    {
        Ingreso::destroy($id);
        return redirect()->route('ingresos.index');
    }
}
