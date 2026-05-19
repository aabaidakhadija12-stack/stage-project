@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('page_title', 'Tableau de bord')

@section('breadcrumb')
@endsection

@push('styles')
<style>
    .kpi-card { border-radius:14px !important; transition:transform .22s,box-shadow .22s; overflow:hidden; position:relative; cursor:default; border:1px solid rgba(255,255,255,.1) !important; }
    .kpi-card:hover { transform:translateY(-4px); box-shadow:0 12px 35px rgba(0,0,0,.4) !important; }
    .kpi-card .card-body { padding:1.3rem 1.4rem; }
    .kpi-purple  { background:linear-gradient(135deg,#4f46e5,#7c3aed); }
    .kpi-cyan    { background:linear-gradient(135deg,#0891b2,#06b6d4); }
    .kpi-rose    { background:linear-gradient(135deg,#be185d,#f43f5e); }
    .kpi-emerald { background:linear-gradient(135deg,#065f46,#10b981); }
    .kpi-violet  { background:linear-gradient(135deg,#6d28d9,#a855f7); }
    .kpi-slate   { background:linear-gradient(135deg,#1e293b,#475569); }
    .kpi-icon-wrap { width:46px;height:46px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;flex-shrink:0; }
    .kpi-val  { font-size:1.75rem;font-weight:800;color:#fff;line-height:1.1;letter-spacing:-.03em; }
    .kpi-lbl  { font-size:.63rem;color:rgba(255,255,255,.65);font-weight:600;text-transform:uppercase;letter-spacing:.1em;margin-top:3px; }
    .kpi-sub  { font-size:.72rem;color:rgba(255,255,255,.75);margin-top:6px; }
    .kpi-trend { font-size:.72rem;font-weight:600;margin-top:6px; }
    .kpi-trend.up   { color:#6ee7b7; }
    .kpi-trend.down { color:#fca5a5; }
    .kpi-trend.flat { color:rgba(255,255,255,.45); }
    .kpi-bg-icon { position:absolute;right:-6px;bottom:-6px;font-size:5rem;color:rgba(255,255,255,.06);line-height:1;pointer-events:none; }
    .chart-card { border-radius:14px !important; }
    .chart-card .card-header { font-weight:600;font-size:.82rem; }
    .table-card { border-radius:14px !important; overflow:hidden; }
    .section-label {
        font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.14em;
        color:#64748b;margin-bottom:.85rem;
        display:flex;align-items:center;gap:.75rem;
    }
    .section-label::after {
        content:'';flex:1;height:1px;
        background:linear-gradient(90deg,rgba(255,255,255,.07),transparent);
    }
</style>
@endpush

@section('content')

{{-- Alertes --}}
@if($stats['stock_rupture'] > 0 || $stats['stock_faible'] > 0 || $stats['commandes_en_attente'] > 0)
<div class="d-flex flex-wrap gap-2 mb-4">
    @if($stats['stock_rupture'] > 0)
    <div style="display:flex;align-items:center;gap:.6rem;padding:.5rem 1rem;border-radius:10px;background:rgba(244,63,94,.1);border:1px solid rgba(244,63,94,.25);font-size:.78rem;color:#fda4af;">
        <i class="bi bi-x-circle-fill" style="color:#f43f5e;"></i>
        <span><strong style="color:#fb7185;">{{ $stats['stock_rupture'] }}</strong> produit(s) en rupture de stock</span>
    </div>
    @endif
    @if($stats['stock_faible'] > 0)
    <div style="display:flex;align-items:center;gap:.6rem;padding:.5rem 1rem;border-radius:10px;background:rgba(245,158,11,.1);border:1px solid rgba(245,158,11,.25);font-size:.78rem;color:#fcd34d;">
        <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;"></i>
        <span><strong style="color:#fbbf24;">{{ $stats['stock_faible'] }}</strong> produit(s) à stock faible</span>
    </div>
    @endif
    @if($stats['commandes_en_attente'] > 0)
    <div style="display:flex;align-items:center;gap:.6rem;padding:.5rem 1rem;border-radius:10px;background:rgba(6,182,212,.1);border:1px solid rgba(6,182,212,.25);font-size:.78rem;color:#67e8f9;">
        <i class="bi bi-clock-fill" style="color:#06b6d4;"></i>
        <span><strong style="color:#22d3ee;">{{ $stats['commandes_en_attente'] }}</strong> commande(s) en attente de traitement</span>
    </div>
    @endif
</div>
@endif

{{-- KPI Cards --}}
<div class="section-label">Indicateurs clés</div>
<div class="row g-3 mb-4">

    @if(auth()->user()->isAdmin())
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-emerald h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-cash-stack"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ number_format($chiffreAffaires, 0, ',', ' ') }} DH</div>
                    <div class="kpi-lbl">Chiffre d'affaires</div>
                    @if($caEvolution > 0)
                        <div class="kpi-trend up"><i class="bi bi-arrow-up-short"></i>+{{ $caEvolution }}% ce mois</div>
                    @elseif($caEvolution < 0)
                        <div class="kpi-trend down"><i class="bi bi-arrow-down-short"></i>{{ $caEvolution }}% ce mois</div>
                    @else
                        <div class="kpi-trend flat"><i class="bi bi-dash"></i> Stable</div>
                    @endif
                </div>
                <i class="bi bi-cash-stack kpi-bg-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-purple h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-boxes"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ number_format($valeurStock, 0, ',', ' ') }} DH</div>
                    <div class="kpi-lbl">Valeur du stock</div>
                    <div class="kpi-sub">{{ $stats['produits'] }} références · {{ $stats['stock_rupture'] }} ruptures</div>
                </div>
                <i class="bi bi-boxes kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin() || auth()->user()->isClient())
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-rose h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-cart3"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ $stats['commandes'] }}</div>
                    <div class="kpi-lbl">Commandes totales</div>
                    <div class="kpi-sub">{{ $stats['commandes_livrees'] }} livrées · {{ $stats['commandes_en_attente'] }} en attente</div>
                </div>
                <i class="bi bi-cart3 kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin())
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-cyan h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-people"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ $stats['clients'] }}</div>
                    <div class="kpi-lbl">Clients actifs</div>
                    <div class="kpi-sub">{{ $stats['fournisseurs'] }} fournisseurs partenaires</div>
                </div>
                <i class="bi bi-people kpi-bg-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-violet h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-receipt"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ $stats['factures'] }}</div>
                    <div class="kpi-lbl">Factures émises</div>
                    <div class="kpi-sub">Total : {{ number_format($chiffreAffaires, 0, ',', ' ') }} DH</div>
                </div>
                <i class="bi bi-receipt kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin() || auth()->user()->isTechnicien())
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-slate h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-tools"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val">{{ $stats['maintenances'] }}</div>
                    <div class="kpi-lbl">Maintenances</div>
                    <div class="kpi-sub">Total interventions techniques</div>
                </div>
                <i class="bi bi-tools kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    @endif

</div>

{{-- Charts (admin only) --}}
@if(auth()->user()->isAdmin())
<div class="section-label">Analyse & Statistiques</div>
<div class="row g-3 mb-4">

    <div class="col-lg-8">
        <div class="card chart-card h-100" style="border:1px solid rgba(59,130,246,.15);background:linear-gradient(135deg,rgba(59,130,246,.06),rgba(16,185,129,.04));">
            <div class="card-header d-flex align-items-center justify-content-between" style="border-bottom:1px solid rgba(255,255,255,.06);background:transparent;padding:1rem 1.35rem;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;border-radius:9px;background:rgba(59,130,246,.2);display:flex;align-items:center;justify-content:center;color:#3b82f6;font-size:.95rem;"><i class="bi bi-graph-up-arrow"></i></div>
                    <span style="font-size:.88rem;font-weight:700;color:#f1f5f9;">Évolution sur 12 mois</span>
                </div>
                <div class="d-flex gap-3" style="font-size:.72rem;">
                    <span style="display:flex;align-items:center;gap:.4rem;color:#94a3b8;"><span style="width:10px;height:3px;border-radius:2px;background:#3b82f6;display:inline-block;box-shadow:0 0 6px #3b82f6;"></span>Commandes</span>
                    <span style="display:flex;align-items:center;gap:.4rem;color:#94a3b8;"><span style="width:10px;height:3px;border-radius:2px;background:#10b981;display:inline-block;box-shadow:0 0 6px #10b981;"></span>CA (DH)</span>
                </div>
            </div>
            <div class="card-body p-3">
                <canvas id="chartEvolution" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card chart-card h-100" style="border:1px solid rgba(245,158,11,.15);background:linear-gradient(135deg,rgba(245,158,11,.07),rgba(245,158,11,.02));">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(255,255,255,.06);background:transparent;padding:1rem 1.35rem;">
                <div style="width:32px;height:32px;border-radius:9px;background:rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:.95rem;"><i class="bi bi-pie-chart-fill"></i></div>
                <span style="font-size:.88rem;font-weight:700;color:#f1f5f9;">Répartition du stock</span>
            </div>
            <div class="card-body d-flex flex-column align-items-center p-3">
                <canvas id="chartStock" style="max-height:200px;"></canvas>
                <div class="mt-3 w-100">
                    @foreach($stockParType as $item)
                    <div class="d-flex justify-content-between align-items-center mb-1" style="font-size:.75rem;">
                        <span style="color:#94a3b8;">{{ $item->type ?? 'Non défini' }}</span>
                        <span style="font-weight:700;color:#e2e8f0;">{{ $item->total }} u.</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- CA ce mois --}}
    <div class="col-lg-4">
        <div class="card chart-card h-100" style="background:linear-gradient(135deg,rgba(16,185,129,.12),rgba(16,185,129,.04));border:1px solid rgba(16,185,129,.2);">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(16,185,129,.15);background:transparent;">
                <div style="width:32px;height:32px;border-radius:9px;background:rgba(16,185,129,.2);display:flex;align-items:center;justify-content:center;color:#10b981;font-size:.95rem;"><i class="bi bi-calendar-check"></i></div>
                <span class="fw-semibold" style="font-size:.82rem;color:#e2e8f0;">CA ce mois</span>
                <span class="ms-auto" style="font-size:.65rem;color:#10b981;background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.2);padding:.2rem .6rem;border-radius:20px;font-weight:600;">{{ now()->translatedFormat('M Y') }}</span>
            </div>
            <div class="card-body py-3 px-4">
                <div style="font-size:2rem;font-weight:800;color:#10b981;letter-spacing:-.03em;line-height:1.1;">{{ number_format($caThisMonth, 0, ',', ' ') }} <span style="font-size:1rem;font-weight:600;opacity:.7;">DH</span></div>
                <div style="font-size:.7rem;color:#64748b;margin-top:4px;text-transform:uppercase;letter-spacing:.08em;font-weight:600;">Chiffre d'affaires mensuel</div>
                <div style="height:1px;background:rgba(255,255,255,.06);margin:1rem 0;"></div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div style="font-size:.78rem;font-weight:700;color:#e2e8f0;">{{ number_format($caLastMonth, 0, ',', ' ') }} DH</div>
                        <div style="font-size:.65rem;color:#64748b;">Mois précédent</div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:.9rem;font-weight:800;color:{{ $caEvolution >= 0 ? '#34d399' : '#fb7185' }};">
                            <i class="bi bi-arrow-{{ $caEvolution >= 0 ? 'up' : 'down' }}-short"></i>{{ $caEvolution >= 0 ? '+' : '' }}{{ $caEvolution }}%
                        </div>
                        <div style="font-size:.65rem;color:#64748b;">Évolution</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statuts commandes --}}
    <div class="col-lg-4">
        <div class="card chart-card h-100" style="background:linear-gradient(135deg,rgba(245,158,11,.1),rgba(245,158,11,.03));border:1px solid rgba(245,158,11,.18);">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(245,158,11,.15);background:transparent;">
                <div style="width:32px;height:32px;border-radius:9px;background:rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:.95rem;"><i class="bi bi-bar-chart-fill"></i></div>
                <span class="fw-semibold" style="font-size:.82rem;color:#e2e8f0;">Statuts commandes</span>
            </div>
            <div class="card-body py-3 px-4">
                @php
                    $totalCmd = max($stats['commandes'], 1);
                    $statutsData = [
                        ['label'=>'Livrées',    'count'=>$stats['commandes_livrees'],    'color'=>'#10b981','bg'=>'rgba(16,185,129,.15)'],
                        ['label'=>'En attente', 'count'=>$stats['commandes_en_attente'], 'color'=>'#f59e0b','bg'=>'rgba(245,158,11,.15)'],
                        ['label'=>'Annulées',   'count'=>$stats['commandes_annulees'],   'color'=>'#f43f5e','bg'=>'rgba(244,63,94,.15)'],
                    ];
                @endphp
                @foreach($statutsData as $s)
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center gap-2">
                            <span style="width:8px;height:8px;border-radius:50%;background:{{ $s['color'] }};display:inline-block;box-shadow:0 0 6px {{ $s['color'] }};"></span>
                            <span style="font-size:.75rem;color:#94a3b8;font-weight:500;">{{ $s['label'] }}</span>
                        </div>
                        <span style="font-size:.78rem;font-weight:700;color:#e2e8f0;">{{ $s['count'] }}</span>
                    </div>
                    <div style="height:6px;border-radius:10px;background:rgba(255,255,255,.06);overflow:hidden;">
                        <div style="height:100%;width:{{ round(($s['count']/$totalCmd)*100) }}%;border-radius:10px;background:{{ $s['color'] }};box-shadow:0 0 8px {{ $s['color'] }};transition:width .8s ease;"></div>
                    </div>
                </div>
                @endforeach
                <div style="height:1px;background:rgba(255,255,255,.06);margin:.75rem 0;"></div>
                <div style="font-size:.7rem;color:#64748b;text-align:center;">Total : <span style="color:#e2e8f0;font-weight:700;">{{ $stats['commandes'] }}</span> commandes</div>
            </div>
        </div>
    </div>

    {{-- Factures --}}
    <div class="col-lg-4">
        <div class="card chart-card h-100" style="background:linear-gradient(135deg,rgba(6,182,212,.1),rgba(6,182,212,.03));border:1px solid rgba(6,182,212,.18);">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(6,182,212,.15);background:transparent;">
                <div style="width:32px;height:32px;border-radius:9px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.95rem;"><i class="bi bi-receipt-cutoff"></i></div>
                <span class="fw-semibold" style="font-size:.82rem;color:#e2e8f0;">Factures</span>
            </div>
            <div class="card-body py-3 px-4 d-flex flex-column justify-content-between">
                <div class="text-center py-2">
                    <div style="font-size:3rem;font-weight:800;color:#06b6d4;letter-spacing:-.04em;line-height:1;text-shadow:0 0 30px rgba(6,182,212,.4);">{{ $stats['factures'] }}</div>
                    <div style="font-size:.7rem;color:#64748b;margin-top:6px;text-transform:uppercase;letter-spacing:.1em;font-weight:600;">Factures émises</div>
                </div>
                <div style="height:1px;background:rgba(255,255,255,.06);margin:.75rem 0;"></div>
                <div class="text-center">
                    <div style="font-size:1.15rem;font-weight:800;color:#10b981;letter-spacing:-.02em;">{{ number_format($chiffreAffaires, 0, ',', ' ') }} DH</div>
                    <div style="font-size:.65rem;color:#64748b;margin-top:3px;text-transform:uppercase;letter-spacing:.08em;font-weight:600;">Total facturé</div>
                </div>
            </div>
        </div>
    </div>

</div>
@endif

{{-- Tables --}}
<div class="section-label">Activité récente</div>
<div class="row g-3">

    @if(auth()->user()->isAdmin() || auth()->user()->isClient())
    <div class="col-lg-7">
        <div class="card table-card table-pro-card accent-cyan shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-cart3 me-2" style="color:rgb(6,182,212)"></i>Dernières commandes</h6>
                <a href="{{ route('commandes.index') }}" class="btn btn-sm btn-outline-primary rounded-3">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Réf.</th><th>Client</th><th>Date</th><th>Statut</th></tr></thead>
                    <tbody>
                        @forelse($dernieres_commandes as $commande)
                        <tr>
                            <td><a href="{{ route('commandes.show', $commande) }}" class="text-decoration-none fw-semibold text-primary">CMD-{{ str_pad($commande->id,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td>{{ $commande->client?->nom ?? '—' }}</td>
                            <td class="text-muted small">{{ $commande->date->format('d/m/Y') }}</td>
                            <td><span class="badge rounded-pill bg-{{ $commande->statut_badge }}-subtle text-{{ $commande->statut_badge }} px-3">{{ $commande->statut_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-1"></i>Aucune commande</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin() || auth()->user()->isTechnicien())
    <div class="col-lg-5">
        <div class="card table-card table-pro-card accent-orange shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-exclamation-triangle me-2" style="color:rgb(249,115,22)"></i>Stock critique</h6>
                <a href="{{ route('produits.index') }}" class="btn btn-sm btn-outline-warning rounded-3">Gérer</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Produit</th><th>Type</th><th class="text-center">Stock</th></tr></thead>
                    <tbody>
                        @forelse($produits_stock_faible as $produit)
                        <tr>
                            <td><a href="{{ route('produits.show', $produit) }}" class="text-decoration-none fw-medium">{{ $produit->nom }}</a></td>
                            <td class="text-muted small">{{ $produit->type ?? '—' }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-{{ $produit->quantiteStock === 0 ? 'danger' : 'warning' }}-subtle text-{{ $produit->quantiteStock === 0 ? 'danger' : 'warning' }} px-3">
                                    {{ $produit->quantiteStock === 0 ? 'Rupture' : $produit->quantiteStock.' u.' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-4"><i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>Stocks suffisants</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

</div>

@if(auth()->user()->isAdmin() || auth()->user()->isTechnicien())
<div class="row g-3 mt-0">
    <div class="col-12">
        <div class="card table-card table-pro-card accent-rose shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-tools me-2" style="color:rgb(244,63,94)"></i>Maintenances récentes</h6>
                <a href="{{ route('maintenances.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Produit</th><th>Type</th><th>Date</th><th>Description</th></tr></thead>
                    <tbody>
                        @forelse($dernieres_maintenances as $maintenance)
                        <tr>
                            <td class="fw-medium">{{ $maintenance->produit?->nom ?? '—' }}</td>
                            <td><span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">{{ $maintenance->type }}</span></td>
                            <td class="text-muted small">{{ $maintenance->date->format('d/m/Y') }}</td>
                            <td class="text-muted small text-truncate" style="max-width:200px;">{{ $maintenance->description ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4"><i class="bi bi-wrench fs-4 d-block mb-1"></i>Aucune maintenance</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
    Chart.defaults.color = '#64748b';

    /* ── Helpers ── */
    function gradientFill(ctx, colorTop, colorBot) {
        var g = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);
        g.addColorStop(0, colorTop);
        g.addColorStop(1, colorBot);
        return g;
    }

    var TOOLTIP = {
        backgroundColor: 'rgba(10,10,31,.92)',
        titleColor: '#f1f5f9',
        bodyColor: '#94a3b8',
        borderColor: 'rgba(255,255,255,.08)',
        borderWidth: 1,
        padding: 14,
        cornerRadius: 10,
        displayColors: true,
        boxPadding: 4,
    };

    var GRID_COLOR  = 'rgba(255,255,255,.05)';
    var TICK_COLOR  = '#475569';

    /* ── Chart Évolution ── */
    var ctxEvo = document.getElementById('chartEvolution');
    if (ctxEvo) {
        var evoCtx = ctxEvo.getContext('2d');
        new Chart(ctxEvo, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Commandes',
                        data: @json($chartCommandes),
                        borderColor: '#3b82f6',
                        backgroundColor: gradientFill(evoCtx, 'rgba(59,130,246,.25)', 'rgba(59,130,246,.01)'),
                        borderWidth: 2.5,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: 'rgba(10,10,31,.9)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        tension: 0.45,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'CA (DH)',
                        data: @json($chartCA),
                        borderColor: '#10b981',
                        backgroundColor: gradientFill(evoCtx, 'rgba(16,185,129,.22)', 'rgba(16,185,129,.01)'),
                        borderWidth: 2.5,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: 'rgba(10,10,31,.9)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        tension: 0.45,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: TOOLTIP
                },
                scales: {
                    x: {
                        grid: { color: GRID_COLOR, drawBorder: false },
                        ticks: { color: TICK_COLOR, font: { size: 11 }, maxRotation: 35 },
                        border: { display: false }
                    },
                    y: {
                        type: 'linear', position: 'left',
                        grid: { color: GRID_COLOR, drawBorder: false },
                        ticks: { color: TICK_COLOR, font: { size: 11 }, stepSize: 1 },
                        title: { display: true, text: 'Commandes', color: '#3b82f6', font: { size: 11, weight: '600' } },
                        border: { display: false }
                    },
                    y1: {
                        type: 'linear', position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { color: TICK_COLOR, font: { size: 11 } },
                        title: { display: true, text: 'CA (DH)', color: '#10b981', font: { size: 11, weight: '600' } },
                        border: { display: false }
                    }
                }
            }
        });
    }

    /* ── Chart Stock (Doughnut) ── */
    var ctxStock = document.getElementById('chartStock');
    if (ctxStock) {
        var PALETTE = ['#3b82f6','#10b981','#f59e0b','#ef4444','#06b6d4','#8b5cf6','#f97316','#ec4899'];
        new Chart(ctxStock, {
            type: 'doughnut',
            data: {
                labels: @json($stockParType->pluck('type')),
                datasets: [{
                    data: @json($stockParType->pluck('total')),
                    backgroundColor: PALETTE,
                    borderWidth: 3,
                    borderColor: 'rgba(10,10,31,.95)',
                    hoverBorderColor: 'rgba(255,255,255,.15)',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: '#94a3b8',
                            usePointStyle: true,
                            pointStyleWidth: 10
                        }
                    },
                    tooltip: TOOLTIP
                },
                animation: { animateRotate: true, duration: 900 }
            }
        });
    }
})();
</script>
@endpush
