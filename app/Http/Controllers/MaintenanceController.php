<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Produit;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Maintenance::with('produit');

        if ($request->filled('search')) {
            $query->whereHas('produit', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%');
            })->orWhere('type', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $maintenances = $query->latest('date')->paginate(5)->withQueryString();
        $types        = Maintenance::distinct()->pluck('type')->filter()->sort()->values();

        return view('maintenances.index', compact('maintenances', 'types'));
    }

    public function create()
    {
        $produits = Produit::orderBy('nom')->get();
        return view('maintenances.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'        => ['required', 'date'],
            'type'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'produit_id'  => ['required', 'exists:produits,id'],
        ]);

        Maintenance::create($validated);

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance enregistrée avec succès.');
    }

    public function show(Maintenance $maintenance)
    {
        $maintenance->load('produit');
        return view('maintenances.show', compact('maintenance'));
    }

    public function edit(Maintenance $maintenance)
    {
        $produits = Produit::orderBy('nom')->get();
        return view('maintenances.edit', compact('maintenance', 'produits'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'date'        => ['required', 'date'],
            'type'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'produit_id'  => ['required', 'exists:produits,id'],
        ]);

        $maintenance->update($validated);

        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance mise à jour avec succès.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')
                         ->with('success', 'Maintenance supprimée avec succès.');
    }
}
