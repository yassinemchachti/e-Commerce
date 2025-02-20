<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;

class MarqueController extends Controller
{

    public function getMarques()
    {

        $items = Marque::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($marque) {
                return view('marques.partials.actions', compact('marque'))->render();
            })
            ->editColumn('created_at', function ($marque) {
                return $marque->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::all();
        return view('marques.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarqueRequest $request)
    {
        $marque = Marque::create($request->all());
        return response()->json(['success' => 'Marque crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marque $marque)
    {
        return response()->json($marque);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarqueRequest $request, Marque $marque)
    {
        $marque->update($request->all());
        return response()->json(['success' => 'Marque modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {

        $marque->delete();
        return response()->json(['success' => 'Marque supprimée avec succès']);
    }
}
