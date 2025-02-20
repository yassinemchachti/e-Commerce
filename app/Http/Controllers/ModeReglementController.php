<?php

namespace App\Http\Controllers;

use App\Models\ModeReglement;
use App\Http\Requests\StoreModeReglementRequest;
use App\Http\Requests\UpdateModeReglementRequest;

class ModeReglementController extends Controller
{
    public function getmode_reglements()
    {

        $items = ModeReglement::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($mode_reglement) {
                return view('mode_regelement.partials.actions', compact('mode_reglement'))->render();
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
        $mode_reglements = ModeReglement::all();
        return view('mode_regelement.index', compact('mode_reglements'));
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
    public function store(StoreModeReglementRequest $request)
    {
        $mode_reglement = ModeReglement::create($request->all());
        return response()->json(['success' => 'Mode reglement crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModeReglement $modeReglement)
    {
        return response()->json($modeReglement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModeReglement $modeReglement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeReglementRequest $request, ModeReglement $modeReglement)
    {
        $modeReglement->update($request->all());
        return response()->json(['success' => 'Mode reglement modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModeReglement $modeReglement)
    {
        $modeReglement->delete();
        return response()->json(['success' => 'Mode reglement supprimée avec succès']);
    }
}
