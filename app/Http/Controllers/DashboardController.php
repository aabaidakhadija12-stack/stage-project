<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Maintenance;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ── Compteurs généraux ──
        $stats = [
            'produits'             => Produit::count(),
            'commandes'            => Commande::count(),
            'clients'              => Client::count(),
            'fournisseurs'         => Fournisseur::count(),
            'factures'             => Facture::count(),
            'maintenances'         => Maintenance::count(),
            'stock_faible'         => Produit::where('quantiteStock', '<', 5)->count(),
            'stock_rupture'        => Produit::where('quantiteStock', 0)->count(),
            'commandes_en_attente' => Commande::where('statut', 'en_attente')->count(),
            'commandes_livrees'    => Commande::where('statut', 'livree')->count(),
            'commandes_annulees'   => Commande::where('statut', 'annulee')->count(),
        ];

        // ── Chiffre d'affaires ──
        $chiffreAffaires = Facture::sum('montant');
        $caThisMonth     = Facture::whereMonth('dateEmission', now()->month)
                                  ->whereYear('dateEmission', now()->year)
                                  ->sum('montant');
        $caLastMonth     = Facture::whereMonth('dateEmission', now()->subMonth()->month)
                                  ->whereYear('dateEmission', now()->subMonth()->year)
                                  ->sum('montant');
        $caEvolution     = $caLastMonth > 0
                           ? round((($caThisMonth - $caLastMonth) / $caLastMonth) * 100, 1)
                           : 0;

        // ── Valeur totale du stock ──
        $valeurStock = Produit::selectRaw('SUM(prix * quantiteStock) as total')->value('total') ?? 0;

        // ── Commandes par mois (12 derniers mois) pour le chart ──
        $commandesParMois = Commande::selectRaw('MONTH(date) as mois, YEAR(date) as annee, COUNT(*) as total')
            ->where('date', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('annee', 'mois')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();

        $chartLabels   = [];
        $chartCommandes = [];
        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $label = $date->translatedFormat('M Y');
            $chartLabels[] = $label;
            $found = $commandesParMois->first(function ($item) use ($date) {
                return $item->mois == $date->month && $item->annee == $date->year;
            });
            $chartCommandes[] = $found ? $found->total : 0;
        }

        // ── CA par mois (12 derniers mois) ──
        $caParMois = Facture::selectRaw('MONTH(dateEmission) as mois, YEAR(dateEmission) as annee, SUM(montant) as total')
            ->where('dateEmission', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('annee', 'mois')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();

        $chartCA = [];
        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $found = $caParMois->first(function ($item) use ($date) {
                return $item->mois == $date->month && $item->annee == $date->year;
            });
            $chartCA[] = $found ? round($found->total, 2) : 0;
        }

        // ── Répartition stock par type ──
        $stockParType = Produit::selectRaw('type, SUM(quantiteStock) as total')
            ->groupBy('type')
            ->orderByDesc('total')
            ->get();

        // ── Dernières données ──
        $dernieres_commandes = Commande::with(['client', 'fournisseur'])
            ->latest()
            ->take(5)
            ->get();

        $produits_stock_faible = Produit::where('quantiteStock', '<', 5)
            ->orderBy('quantiteStock')
            ->take(5)
            ->get();

        $dernieres_maintenances = Maintenance::with('produit')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'chiffreAffaires',
            'caThisMonth',
            'caLastMonth',
            'caEvolution',
            'valeurStock',
            'chartLabels',
            'chartCommandes',
            'chartCA',
            'stockParType',
            'dernieres_commandes',
            'produits_stock_faible',
            'dernieres_maintenances'
        ));
    }
}
