<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $produits = $query->orderBy('nom')->paginate(5)->withQueryString();
        $types    = Produit::distinct()->pluck('type')->filter()->sort()->values();

        return view('produits.index', compact('produits', 'types'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'           => ['required', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:100'],
            'prix'          => ['required', 'numeric', 'min:0'],
            'quantiteStock' => ['required', 'integer', 'min:0'],
            'description'   => ['nullable', 'string'],
        ]);

        Produit::create($validated);

        return redirect()->route('produits.index')
                         ->with('success', 'Produit créé avec succès.');
    }

    public function show(Produit $produit)
    {
        $produit->load('maintenances', 'commandes');
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom'           => ['required', 'string', 'max:255'],
            'type'          => ['nullable', 'string', 'max:100'],
            'prix'          => ['required', 'numeric', 'min:0'],
            'quantiteStock' => ['required', 'integer', 'min:0'],
            'description'   => ['nullable', 'string'],
        ]);

        $produit->update($validated);

        return redirect()->route('produits.index')
                         ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')
                         ->with('success', 'Produit supprimé avec succès.');
    }

    public function updateStock(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'action'   => ['required', 'in:ajouter,retirer'],
            'quantite' => ['required', 'integer', 'min:1'],
        ]);

        if ($validated['action'] === 'ajouter') {
            $produit->ajouterStock($validated['quantite']);
            $message = "Stock augmenté de {$validated['quantite']} unité(s).";
        } else {
            if ($produit->quantiteStock < $validated['quantite']) {
                return back()->withErrors(['quantite' => 'Stock insuffisant.']);
            }
            $produit->retirerStock($validated['quantite']);
            $message = "Stock réduit de {$validated['quantite']} unité(s).";
        }

        return back()->with('success', $message);
    }
}
