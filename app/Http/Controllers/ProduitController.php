<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;

class ProduitController extends Controller
{
    public function getproduits()
    {

        $items = Produit::all();

        return DataTables()->of($items)
            ->addColumn('action', function ($produit) {
                return view('produits.partials.actions', compact('produit'))->render();
            })
            ->editColumn('created_at', function ($produit) {
                return $produit->created_at->format('m/d/Y H:i');
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
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
        $produit = Produit::create([
            'code_barre' => $request->codebar,
            'designation' => $request->designation,
            'prix_ht' => $request->prix_ht,
            'tva' => $request->tva,
            'description' => $request->description,
            'unite_id' => $request->unite,
            'marque_id' => $request->marque,
            'sous_famille_id' => $request->sous_famille,
            'image' => $path,
        ]);
        return response()->json(['success' => 'Produit crée avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
  
        return response()->json([
            'produit' => $produit,
            'unite' => $produit->unite,
            'marque' => $produit->marque,
            'sous_famille' => $produit->sous_famille
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
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

            $produit->update([
                'code_barre' => $request->codebar,
                'designation' => $request->designation,
                'prix_ht' => $request->prix_ht,
                'tva' => $request->tva,
                'description' => $request->description,
                'unite_id' => $request->unite,
                'marque_id' => $request->marque,
                'sous_famille_id' => $request->sous_famille,
                'image' => $path,
            ]);
        } else {
            $produit->update([
                'code_barre' => $request->codebar,
                'designation' => $request->designation,
                'prix_ht' => $request->prix_ht,
                'tva' => $request->tva,
                'description' => $request->description,
                'unite_id' => $request->unite,
                'marque_id' => $request->marque,
                'sous_famille_id' => $request->sous_famille,
            ]);
        }
        return response()->json(['success' => 'Produit modifiée avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return response()->json(['success' => 'Produit supprimée avec succès']);
    }
}
