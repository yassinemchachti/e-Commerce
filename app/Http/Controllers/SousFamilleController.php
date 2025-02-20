<?php

namespace App\Http\Controllers;


use App\Models\SousFamille;
use App\Http\Requests\StoreSousFamilleRequest;

use App\Http\Requests\UpdateSousFamilleRequest;

class SousFamilleController extends Controller
{
    public function getsousfamilles()
    {

        $items = SousFamille::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($sousfamille) {
                return view('sousfamilles.partials.actions', compact('sousfamille'))->render();
            })
            ->editColumn('created_at', function ($sousfamille) {
                return $sousfamille->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousfamilles = SousFamille::all();
        return view('sousfamilles.index', compact('sousfamilles'));
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
    public function store(StoreSousFamilleRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
            $path = 'images/' . $filename;
            $store = $request->file('image')->storeAs(
                'images',      // Directory
                $filename,     // Custom filename
                'public'       // Disk name
            );
        }
        $sousfamille = SousFamille::create([
            'libelle' => $request->libelle,
            'image' => $path,
            'famille_id' => $request->famille_id
        ]);
        return response()->json(['success' => 'Sous Famille crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(SousFamille $sousfamille)
    {
        return response()->json($sousfamille);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSousFamilleRequest $request, SousFamille $sousfamille)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalName();
            $path = 'images/' . $filename;
            $store = $request->file('image')->storeAs(
                'images',      // Directory
                $filename,     // Custom filename
                'public'       // Disk name
            );
            $sousfamille->update([
                'libelle' => $request->libelle,
                'image' => $path,
                'famille_id' => $request->famille_id
            ]);
        } else {
            $sousfamille->update([
                'libelle' => $request->libelle,
                'famille_id' => $request->famille_id
            ]);
        }

        return response()->json(['success' => 'Sous Famille modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SousFamille $sousfamille)
    {

        $sousfamille->delete();
        return response()->json(['success' => 'Sous Famille supprimée avec succès']);
    }
}
