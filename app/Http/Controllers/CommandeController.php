<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\DetailCommande;
use App\Models\User;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\Console\Command\Command;

use function Laravel\Prompts\error;

class CommandeController extends Controller
{

    public function getcommandes()
    {

        $items = Commande::all();



        return DataTables()->of($items)
            ->addColumn('action', function ($commande) {
                return view('commandes.partials.actions', compact('commande'))->render();
            })
            ->addColumn('mode_reglement', function ($commande) {
            
                return $commande->mode_reglement->mode_reglement;
            })
            ->addColumn('statut', function ($commande) {
                return'<button class="btn">
                 <span class="badge badge-primary">'.$commande->etat->etat.'</span>
                </button>';
            })
      
            ->addColumn('regle', function ($commande) {
            
                return $commande->regle ? 'Oui' : 'Non';
            })
            ->addColumn('client', function ($commande) {
                return $commande->client;
            })
            ->addColumn('total', function ($commande) {
                return $commande->total;
            })
            ->rawColumns(['action','statut'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
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
    public function store(StoreCommandeRequest $request)
    {
        try {
            DB::beginTransaction();
            $client=$request->client;
            if(!$client){
                $client=User::create([
                    'password'=>$request->passwordclient,
                    'name'=>$request->nameclient,
                    'email'=>$request->emailclient,
                ]);
            }
            $commande = Commande::create([
                'user_id' => $client->id ?? $request->client,
                'regle' => false,
                'mode_reglement_id' => $request->paymentMode,
                'date' => $request->date,
                'heure' => now()->format('H:i:s'),
                'etat_id' => 1,
            ]);
            foreach ($request->product as $produit) {
                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit['product_id'],
                    'quantite' => $produit['quantity'],
                    'prix_ht' => $produit['price'],
                    'tva' => 20,
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Commande crée avec succès']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        try {
            DB::beginTransaction();
            $client=$request->client;
            if(!$client){
                $client=User::create([
                    'password'=>$request->passwordclient,
                    'name'=>$request->nameclient,
                    'email'=>$request->emailclient,
                ]);
            }
            $commande = Commande::create([
                'user_id' => $client->id ?? $request->client,
                'regle' => false,
                'mode_reglement_id' => $request->paymentMode,
                'date' => $request->date,
                'heure' => now()->format('H:i:s'),
                'etat_id' => 1,
            ]);
            foreach ($request->product as $produit) {
                DetailCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit['product_id'],
                    'quantite' => $produit['quantity'],
                    'prix_ht' => $produit['price'],
                    'tva' => 20,
                ]);
            }
            DB::commit();
            return response()->json(['success' => 'Commande crée avec succès']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
