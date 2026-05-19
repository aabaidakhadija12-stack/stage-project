<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>FAC-{{ str_pad($facture->id, 4, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #1e293b;
            background: #fff;
            padding: 40px;
            line-height: 1.5;
        }

        /* ── Header ── */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 36px;
            border-bottom: 3px solid #e63946;
            padding-bottom: 20px;
        }
        .header-left  { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }

        .brand-name {
            font-size: 22px;
            font-weight: 700;
            color: #e63946;
            letter-spacing: -0.5px;
        }
        .brand-sub {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .brand-address {
            font-size: 10px;
            color: #64748b;
            margin-top: 10px;
            line-height: 1.7;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -1px;
        }
        .invoice-meta {
            font-size: 10px;
            color: #64748b;
            margin-top: 6px;
            line-height: 1.8;
        }
        .invoice-meta strong { color: #1e293b; }

        /* ── Info boxes ── */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 28px;
        }
        .info-box {
            display: table-cell;
            width: 48%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            vertical-align: top;
        }
        .info-box + .info-box { margin-left: 4%; }
        .info-box-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 6px;
        }
        .info-box-name {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 3px;
        }
        .info-box-detail {
            font-size: 10px;
            color: #64748b;
            line-height: 1.6;
        }

        /* ── Table ── */
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .products-table thead tr {
            background: #1e293b;
            color: #fff;
        }
        .products-table thead th {
            padding: 10px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-align: left;
        }
        .products-table thead th.text-right { text-align: right; }
        .products-table thead th.text-center { text-align: center; }

        .products-table tbody tr { border-bottom: 1px solid #f1f5f9; }
        .products-table tbody tr:nth-child(even) { background: #f8fafc; }
        .products-table tbody td {
            padding: 10px 12px;
            font-size: 11px;
            color: #334155;
            vertical-align: middle;
        }
        .products-table tbody td.text-right  { text-align: right; }
        .products-table tbody td.text-center { text-align: center; }
        .products-table tbody td.fw-bold     { font-weight: 700; color: #1e293b; }

        /* ── Totals ── */
        .totals-wrap {
            width: 100%;
            display: table;
            margin-bottom: 32px;
        }
        .totals-spacer { display: table-cell; width: 55%; }
        .totals-box    { display: table-cell; width: 45%; vertical-align: top; }

        .totals-table { width: 100%; border-collapse: collapse; }
        .totals-table td {
            padding: 7px 12px;
            font-size: 11px;
            border-bottom: 1px solid #f1f5f9;
        }
        .totals-table td:last-child { text-align: right; font-weight: 600; }
        .totals-table .total-row {
            background: #e63946;
            color: #fff;
        }
        .totals-table .total-row td {
            font-size: 13px;
            font-weight: 700;
            border: none;
            padding: 10px 12px;
        }
        .totals-table .total-row td:last-child { text-align: right; }

        /* ── Footer ── */
        .footer {
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }
        .footer strong { color: #64748b; }

        /* ── Status badge ── */
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-livree    { background: #dcfce7; color: #166534; }
        .status-confirmee { background: #dbeafe; color: #1e40af; }
        .status-en_attente{ background: #fef9c3; color: #854d0e; }
        .status-annulee   { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

    {{-- ── Header ── --}}
    <div class="header">
        <div class="header-left">
            <div class="brand-name">🔥 AQUA MAB</div>
            <div class="brand-sub">Équipements de protection incendie</div>
            <div class="brand-address">
                123 Rue de la Sécurité, Casablanca<br>
                Maroc — contact@aquamab.com
            </div>
        </div>
        <div class="header-right">
            <div class="invoice-title">FACTURE</div>
            <div class="invoice-meta">
                <strong>N°</strong> FAC-{{ str_pad($facture->id, 4, '0', STR_PAD_LEFT) }}<br>
                <strong>Date :</strong> {{ $facture->dateEmission->format('d/m/Y') }}<br>
                <strong>Commande :</strong> CMD-{{ str_pad($facture->commande_id, 4, '0', STR_PAD_LEFT) }}<br>
                <strong>Statut :</strong>
                <span class="status-badge status-{{ $facture->commande->statut }}">
                    {{ $facture->commande->statut_label }}
                </span>
            </div>
        </div>
    </div>

    {{-- ── Client / Fournisseur ── --}}
    <div class="info-row">
        <div class="info-box">
            <div class="info-box-label">Facturé à</div>
            @if($facture->commande->client)
                <div class="info-box-name">{{ $facture->commande->client->nom }}</div>
                <div class="info-box-detail">
                    {{ $facture->commande->client->adresse ?? '' }}<br>
                    {{ $facture->commande->client->telephone ?? '' }}
                </div>
            @else
                <div class="info-box-detail">Client non renseigné</div>
            @endif
        </div>
        @if($facture->commande->fournisseur)
        <div class="info-box" style="margin-left:4%;">
            <div class="info-box-label">Fournisseur</div>
            <div class="info-box-name">{{ $facture->commande->fournisseur->nom }}</div>
            <div class="info-box-detail">{{ $facture->commande->fournisseur->contact ?? '' }}</div>
        </div>
        @endif
    </div>

    {{-- ── Products table ── --}}
    <table class="products-table">
        <thead>
            <tr>
                <th style="width:40%;">Désignation</th>
                <th style="width:15%;">Type</th>
                <th class="text-right" style="width:18%;">Prix unitaire</th>
                <th class="text-center" style="width:10%;">Qté</th>
                <th class="text-right" style="width:17%;">Total HT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facture->commande->produits as $produit)
            <tr>
                <td class="fw-bold">{{ $produit->nom }}</td>
                <td>{{ $produit->type ?? '—' }}</td>
                <td class="text-right">{{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} DH</td>
                <td class="text-center fw-bold">{{ $produit->pivot->quantite }}</td>
                <td class="text-right fw-bold">{{ number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2, ',', ' ') }} DH</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ── Totals ── --}}
    <div class="totals-wrap">
        <div class="totals-spacer"></div>
        <div class="totals-box">
            <table class="totals-table">
                <tr>
                    <td>Sous-total HT</td>
                    <td>{{ number_format($facture->montant, 2, ',', ' ') }} DH</td>
                </tr>
                <tr>
                    <td>TVA (20%)</td>
                    <td>{{ number_format($facture->montant * 0.20, 2, ',', ' ') }} DH</td>
                </tr>
                <tr class="total-row">
                    <td>Total TTC</td>
                    <td>{{ number_format($facture->montant * 1.20, 2, ',', ' ') }} DH</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <strong>AQUA MAB</strong> — Spécialiste en équipements de protection incendie<br>
        Merci pour votre confiance. Ce document est généré automatiquement.
    </div>

</body>
</html>
