<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function index(Request $request)
    {
        $query = Facture::with(['commande.client']);

        if ($request->filled('search')) {
            $query->whereHas('commande.client', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%');
            });
        }

        $factures = $query->latest('dateEmission')->paginate(5)->withQueryString();

        return view('factures.index', compact('factures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'commande_id'  => ['required', 'exists:commandes,id'],
            'dateEmission' => ['required', 'date'],
        ]);

        $commande = Commande::with('produits')->findOrFail($validated['commande_id']);
        $montant  = $commande->calculerTotal();

        $facture = Facture::create([
            'commande_id'  => $commande->id,
            'montant'      => $montant,
            'dateEmission' => $validated['dateEmission'],
        ]);

        return redirect()->route('factures.show', $facture)
                         ->with('success', 'Facture générée avec succès.');
    }

    public function show(Facture $facture)
    {
        $facture->load(['commande.client', 'commande.fournisseur', 'commande.produits']);
        return view('factures.show', compact('facture'));
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();
        return redirect()->route('factures.index')
                         ->with('success', 'Facture supprimée avec succès.');
    }

    /**
     * Generate and download the invoice as PDF.
     */
    public function generatePdf(Facture $facture)
    {
        $facture->load(['commande.client', 'commande.fournisseur', 'commande.produits']);

        $pdf = Pdf::loadView('factures.pdf', compact('facture'))
                  ->setPaper('a4', 'portrait');

        $filename = 'FAC-' . str_pad($facture->id, 4, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($filename);
    }
}
