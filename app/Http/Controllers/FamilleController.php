<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use App\Http\Requests\StoreFamilleRequest;
use App\Http\Requests\UpdateFamilleRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class FamilleController extends Controller
{
    public function getfamilles()
    {

        $items = Famille::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($famille) {
                return view('familles.partials.actions', compact('famille'))->render();
            })
            ->editColumn('created_at', function ($famille) {
                return $famille->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familles = Famille::all();
        return view('familles.index', compact('familles'));
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
    public function store(StoreFamilleRequest $request)
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
        $famille = Famille::create([
            'libelle' => $request->libelle,
            'image' => $path,
        ]);
        return response()->json(['success' => 'Famille crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Famille $famille)
    {
        return response()->json($famille);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilleRequest $request, Famille $famille)
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
            $famille->update([
                'libelle' => $request->libelle,
                'image' => $path,
            ]);
        } else {
            $famille->update([
                'libelle' => $request->libelle,
            ]);
        }

        return response()->json(['success' => 'Famille modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Famille $famille)
    {

        $famille->delete();
        return response()->json(['success' => 'Famille supprimée avec succès']);
    }
}
