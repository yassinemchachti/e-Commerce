<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Http\Requests\StoreEtatRequest;
use App\Http\Requests\UpdateEtatRequest;

class EtatController extends Controller
{
    public function getEtats()
    {

        $items = Etat::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($etat) {
                return view('etats.partials.actions', compact('etat'))->render();
            })
            ->editColumn('created_at', function ($etat) {
                return $etat->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $etats = Etat::all();
        return view('etats.index', compact('etats'));
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
    public function store(StoreEtatRequest $request)
    {
        $etat = Etat::create($request->all());
        return response()->json(['success' => 'Etat crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etat $etat)
    {
        return response()->json($etat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etat $etat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtatRequest $request, Etat $etat)
    {
        $etat->update($request->all());
        return response()->json(['success' => 'Etat modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etat $etat)
    {
        $etat->delete();
        return response()->json(['success' => 'Etat supprimée avec succès']);
    }
}
