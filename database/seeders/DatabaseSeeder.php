<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Fournisseur;
use App\Models\Maintenance;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Maintenance::truncate();
        Facture::truncate();
        DB::table('commande_produit')->truncate();
        Commande::truncate();
        Produit::truncate();
        Client::truncate();
        Fournisseur::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // ── Utilisateurs ──
        $admin = User::create([
            'name'     => 'Administrateur',
            'email'    => 'admin@aquamab.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Technicien AQUA',
            'email'    => 'technicien@aquamab.com',
            'password' => Hash::make('password'),
            'role'     => 'technicien',
        ]);

        $clientUser = User::create([
            'name'     => 'Karim Benali',
            'email'    => 'client@aquamab.com',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        User::create([
            'name'     => 'Fournisseur Pro',
            'email'    => 'fournisseur@aquamab.com',
            'password' => Hash::make('password'),
            'role'     => 'fournisseur',
        ]);

        // ── Clients ──
        $clients = collect([
            ['nom' => 'Karim Benali', 'adresse' => '12 Bd Zerktouni, Casablanca', 'telephone' => '0612345678', 'user_id' => $clientUser->id],
            ['nom' => 'Entreprise Atlas Sécurité', 'adresse' => '45 Av. Hassan II, Rabat', 'telephone' => '0537123456'],
            ['nom' => 'Hôtel Marrakech Palace', 'adresse' => '8 Rue de la Koutoubia, Marrakech', 'telephone' => '0524432110'],
            ['nom' => 'Industries Tanger Méd', 'adresse' => 'Zone Franche, Tanger', 'telephone' => '0539123456'],
            ['nom' => 'Résidence Al Amal', 'adresse' => 'Quartier Maarif, Casablanca', 'telephone' => '0661122334'],
            ['nom' => 'École Internationale Fès', 'adresse' => 'Route d\'Imouzzer, Fès', 'telephone' => '0535622188'],
            ['nom' => 'Clinique Agdal', 'adresse' => 'Av. des FAR, Rabat', 'telephone' => '0537689900'],
            ['nom' => 'Supermarché Marjane Agadir', 'adresse' => 'Bd Mohammed V, Agadir', 'telephone' => '0528876543'],
            ['nom' => 'Société BTP Oujda', 'adresse' => 'Rue Alger, Oujda', 'telephone' => '0536543210'],
            ['nom' => 'Centre Commercial Anfa', 'adresse' => 'Anfa Place, Casablanca', 'telephone' => '0522987654'],
            ['nom' => 'Usine Textile Meknès', 'adresse' => 'Zone Industrielle, Meknès', 'telephone' => '0535512345'],
            ['nom' => 'Restaurant Le Patio', 'adresse' => 'Médina, Essaouira', 'telephone' => '0644556677'],
        ])->map(fn ($c) => Client::create($c));

        // ── Fournisseurs ──
        $fournisseurs = collect([
            ['nom' => 'FireTech Maroc', 'contact' => 'contact@firetech.ma'],
            ['nom' => 'SafeGuard Équipements', 'contact' => 'info@safeguard.ma'],
            ['nom' => 'ProSécurité Incendie', 'contact' => 'ventes@prosecurite.ma'],
            ['nom' => 'Euro Feu Distribution', 'contact' => 'commande@eurofeu.ma'],
            ['nom' => 'Atlas Protection', 'contact' => 'commercial@atlasprotection.ma'],
            ['nom' => 'Med Fire Systems', 'contact' => 'support@medfire.ma'],
            ['nom' => 'Sécurité Express', 'contact' => '06 61 00 22 33'],
            ['nom' => 'Global Safety Supply', 'contact' => 'achats@globalsafety.ma'],
        ])->map(fn ($f) => Fournisseur::create($f));

        // ── Produits (20 articles — pagination + stock varié) ──
        $produitsData = [
            ['nom' => 'Extincteur CO2 5kg', 'type' => 'Extincteur', 'prix' => 89.99, 'quantiteStock' => 50, 'description' => 'Extincteur CO2, feux électriques et liquides.'],
            ['nom' => 'Extincteur Poudre 6kg', 'type' => 'Extincteur', 'prix' => 65.00, 'quantiteStock' => 30, 'description' => 'Poudre polyvalente ABC.'],
            ['nom' => 'Extincteur Eau 9L', 'type' => 'Extincteur', 'prix' => 55.00, 'quantiteStock' => 0, 'description' => 'Eau pulvérisée avec additif.'],
            ['nom' => 'Extincteur Mousse 6L', 'type' => 'Extincteur', 'prix' => 78.50, 'quantiteStock' => 18, 'description' => 'Mousse AFFF pour hydrocarbures.'],
            ['nom' => 'Détecteur de fumée', 'type' => 'Détection', 'prix' => 25.50, 'quantiteStock' => 100, 'description' => 'Détecteur optique certifié.'],
            ['nom' => 'Détecteur de chaleur', 'type' => 'Détection', 'prix' => 32.00, 'quantiteStock' => 45, 'description' => 'Détecteur thermique fixe 58°C.'],
            ['nom' => 'Centrale incendie 4 zones', 'type' => 'Détection', 'prix' => 320.00, 'quantiteStock' => 8, 'description' => 'Centrale adressable 4 zones.'],
            ['nom' => 'Centrale incendie 8 zones', 'type' => 'Détection', 'prix' => 485.00, 'quantiteStock' => 5, 'description' => 'Centrale adressable 8 zones.'],
            ['nom' => 'Déclencheur manuel', 'type' => 'Détection', 'prix' => 18.50, 'quantiteStock' => 2, 'description' => 'DM d\'alarme incendie.'],
            ['nom' => 'Sirène incendie 24V', 'type' => 'Détection', 'prix' => 42.00, 'quantiteStock' => 35, 'description' => 'Sirène électronique 100 dB.'],
            ['nom' => 'Robinet d\'incendie armé', 'type' => 'Robinetterie', 'prix' => 145.00, 'quantiteStock' => 3, 'description' => 'RIA 19mm, tuyau 20m.'],
            ['nom' => 'Colonne sèche 70mm', 'type' => 'Robinetterie', 'prix' => 890.00, 'quantiteStock' => 4, 'description' => 'Colonne sèche pour immeuble R+4.'],
            ['nom' => 'Panneau sortie de secours', 'type' => 'Signalisation', 'prix' => 12.00, 'quantiteStock' => 200, 'description' => 'Photoluminescent 30x12 cm.'],
            ['nom' => 'Panneau extincteur', 'type' => 'Signalisation', 'prix' => 8.50, 'quantiteStock' => 150, 'description' => 'Panneau ISO 7010.'],
            ['nom' => 'Bloc éclairage secours', 'type' => 'Éclairage', 'prix' => 95.00, 'quantiteStock' => 22, 'description' => 'BAES LED 45 lux.'],
            ['nom' => 'Sprinkler pendant', 'type' => 'Sprinkler', 'prix' => 28.00, 'quantiteStock' => 60, 'description' => 'Tête sprinkleur K80 68°C.'],
            ['nom' => 'Armoire RIA complète', 'type' => 'Robinetterie', 'prix' => 1250.00, 'quantiteStock' => 6, 'description' => 'Armoire avec lance et tuyau.'],
            ['nom' => 'Couverture anti-feu', 'type' => 'Protection', 'prix' => 35.00, 'quantiteStock' => 40, 'description' => 'Couverture fibre de verre 1.2x1.8m.'],
            ['nom' => 'Kit première intervention', 'type' => 'Protection', 'prix' => 120.00, 'quantiteStock' => 15, 'description' => 'Extincteur + couverture + signalisation.'],
            ['nom' => 'Détecteur CO', 'type' => 'Détection', 'prix' => 38.00, 'quantiteStock' => 1, 'description' => 'Détecteur monoxyde de carbone.'],
        ];

        $produits = collect($produitsData)->map(fn ($p) => Produit::create($p));

        // ── Commandes (28 commandes sur 8 mois) ──
        $statuts = ['en_attente', 'confirmee', 'livree', 'livree', 'livree', 'annulee'];
        $commandes = collect();

        for ($i = 0; $i < 28; $i++) {
            $client = $clients->random();
            $fournisseur = $fournisseurs->random();
            $statut = $statuts[array_rand($statuts)];
            $date = now()->subMonths(rand(0, 7))->subDays(rand(0, 28));

            $commande = Commande::create([
                'date'           => $date,
                'statut'         => $statut,
                'client_id'      => $client->id,
                'fournisseur_id' => rand(0, 1) ? $fournisseur->id : null,
            ]);

            $nbLignes = rand(1, 4);
            $produitsCommande = $produits->random(min($nbLignes, $produits->count()));
            $total = 0;

            foreach ($produitsCommande as $produit) {
                $qte = rand(1, 12);
                $commande->produits()->attach($produit->id, [
                    'quantite'      => $qte,
                    'prix_unitaire' => $produit->prix,
                ]);
                $total += $qte * $produit->prix;
            }

            if ($statut === 'livree') {
                Facture::create([
                    'montant'      => round($total, 2),
                    'dateEmission' => $date->copy()->addDays(rand(1, 5)),
                    'commande_id'  => $commande->id,
                ]);
            }

            $commandes->push($commande);
        }

        // ── Maintenances (18 interventions) ──
        $typesMaintenance = ['Vérification', 'Recharge', 'Réparation', 'Remplacement', 'Contrôle annuel', 'Mise en service'];
        $descriptions = [
            'Contrôle périodique réglementaire.',
            'Recharge après utilisation sur incident.',
            'Remplacement joint et test pression.',
            'Nettoyage et test déclenchement.',
            'Mise à jour centrale et test sirènes.',
            'Remplacement batterie et capteur.',
        ];

        for ($i = 0; $i < 18; $i++) {
            Maintenance::create([
                'date'        => now()->subMonths(rand(0, 6))->subDays(rand(0, 25)),
                'type'        => $typesMaintenance[array_rand($typesMaintenance)],
                'description' => $descriptions[array_rand($descriptions)],
                'produit_id'  => $produits->random()->id,
            ]);
        }

        $this->command->info('Base remplie : ' . $produits->count() . ' produits, ' . $clients->count() . ' clients, ' . $commandes->count() . ' commandes, ' . Facture::count() . ' factures, ' . Maintenance::count() . ' maintenances.');
    }
}
