<?php

namespace App\Http\Controllers;

use App\Models\Unite;
use App\Http\Requests\StoreUniteRequest;
use App\Http\Requests\UpdateUniteRequest;

class UniteController extends Controller
{
    public function getUnites()
    {

        $items = Unite::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($unite) {
                return view('unites.partials.actions', compact('unite'))->render();
            })
            ->editColumn('created_at', function ($unite) {
                return $unite->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $unites = Unite::all();
        return view('unites.index', compact('unites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniteRequest $request)
    {
        $unite = Unite::create($request->all());
        return response()->json(['success' => 'Unite crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unite $unite)
    {
        return response()->json($unite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unite $unite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniteRequest $request, Unite $unite)
    {
        $unite->update($request->all());
        return response()->json(['success' => 'Unite modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unite $unite)
    {
        $unite->delete();
        return response()->json(['success' => 'Unite supprimée avec succès']);
    }
}
