<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with(['client', 'fournisseur']);

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('search')) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%');
            });
        }

        $commandes = $query->latest('date')->paginate(5)->withQueryString();

        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $clients      = Client::orderBy('nom')->get();
        $fournisseurs = Fournisseur::orderBy('nom')->get();
        $produits     = Produit::where('quantiteStock', '>', 0)->orderBy('nom')->get();

        return view('commandes.create', compact('clients', 'fournisseurs', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'           => ['required', 'date'],
            'statut'         => ['required', 'in:en_attente,confirmee,livree,annulee'],
            'client_id'      => ['nullable', 'exists:clients,id'],
            'fournisseur_id' => ['nullable', 'exists:fournisseurs,id'],
            'produits'       => ['required', 'array', 'min:1'],
            'produits.*.id'  => ['required', 'exists:produits,id'],
            'produits.*.quantite'     => ['required', 'integer', 'min:1'],
            'produits.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ]);

        $commande = Commande::create([
            'date'           => $validated['date'],
            'statut'         => $validated['statut'],
            'client_id'      => $validated['client_id'],
            'fournisseur_id' => $validated['fournisseur_id'],
        ]);

        foreach ($validated['produits'] as $item) {
            $commande->produits()->attach($item['id'], [
                'quantite'      => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'],
            ]);
        }

        return redirect()->route('commandes.show', $commande)
                         ->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $commande->load(['client', 'fournisseur', 'produits', 'facture']);
        $total = $commande->calculerTotal();

        return view('commandes.show', compact('commande', 'total'));
    }

    public function edit(Commande $commande)
    {
        $clients      = Client::orderBy('nom')->get();
        $fournisseurs = Fournisseur::orderBy('nom')->get();
        $commande->load('produits');

        return view('commandes.edit', compact('commande', 'clients', 'fournisseurs'));
    }

    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'date'           => ['required', 'date'],
            'statut'         => ['required', 'in:en_attente,confirmee,livree,annulee'],
            'client_id'      => ['nullable', 'exists:clients,id'],
            'fournisseur_id' => ['nullable', 'exists:fournisseurs,id'],
        ]);

        $commande->update($validated);

        return redirect()->route('commandes.show', $commande)
                         ->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index')
                         ->with('success', 'Commande supprimée avec succès.');
    }

    public function calculerTotal(Commande $commande)
    {
        $commande->load('produits');
        $total = $commande->calculerTotal();

        return response()->json(['total' => $total]);
    }
}
