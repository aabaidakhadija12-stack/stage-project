@extends('layouts.app')

@section('title', $client->nom)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}" class="text-decoration-none">Clients</a></li>
    <li class="breadcrumb-item active">{{ $client->nom }}</li>
@endsection

@section('content')

{{-- Page header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(59,130,246,.9),rgba(59,130,246,.5));display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;box-shadow:0 4px 18px rgba(59,130,246,.35);">
            <i class="bi bi-person"></i>
        </div>
        <div>
            <h4 style="font-weight:800;color:#f1f5f9;margin:0;letter-spacing:-.02em;">{{ $client->nom }}</h4>
            <p style="color:#64748b;font-size:.75rem;margin:2px 0 0;">Fiche client</p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    {{-- Info card --}}
    <div class="col-lg-4">
        <div class="card h-100" style="border:1px solid rgba(59,130,246,.2);background:linear-gradient(135deg,rgba(59,130,246,.08),rgba(59,130,246,.02));">
            <div class="card-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width:80px;height:80px;border-radius:20px;background:rgba(59,130,246,.15);border:1px solid rgba(59,130,246,.25);font-size:2.2rem;color:#3b82f6;">
                    <i class="bi bi-person"></i>
                </div>
                <h5 style="font-weight:700;color:#f1f5f9;margin-bottom:6px;">{{ $client->nom }}</h5>
                @if($client->user)
                    <span class="badge bg-success-subtle text-success">
                        <i class="bi bi-check-circle me-1"></i>Compte actif
                    </span>
                @endif
            </div>
            <div style="height:1px;background:rgba(59,130,246,.15);"></div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap;">Téléphone</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;text-align:right;">{{ $client->telephone ?? '—' }}</span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap;">Adresse</span>
                        <span style="font-size:.78rem;color:#94a3b8;text-align:right;">{{ $client->adresse ?? '—' }}</span>
                    </div>
                    @if($client->user)
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-start gap-2">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap;">Email</span>
                        <span style="font-size:.78rem;color:#3b82f6;text-align:right;word-break:break-all;">{{ $client->user->email }}</span>
                    </div>
                    @endif
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Client depuis</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;">{{ $client->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Commandes table --}}
    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-blue">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <div style="width:30px;height:30px;border-radius:8px;background:rgba(59,130,246,.2);display:flex;align-items:center;justify-content:center;color:#3b82f6;font-size:.9rem;"><i class="bi bi-cart3"></i></div>
                <h6 style="font-weight:700;color:#f1f5f9;margin:0;font-size:.85rem;">Historique des commandes</h6>
                <span style="margin-left:auto;font-size:.68rem;color:#3b82f6;background:rgba(59,130,246,.12);border:1px solid rgba(59,130,246,.2);padding:.2rem .6rem;border-radius:20px;font-weight:600;">{{ $client->commandes->count() }} commande(s)</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Statut</th><th>Facture</th></tr>
                    </thead>
                    <tbody>
                        @forelse($client->commandes as $commande)
                        <tr>
                            <td><a href="{{ route('commandes.show', $commande) }}" class="text-decoration-none fw-semibold" style="color:#3b82f6;">CMD-{{ str_pad($commande->id,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td style="color:#94a3b8;font-size:.78rem;">{{ $commande->date->format('d/m/Y') }}</td>
                            <td><span class="badge bg-{{ $commande->statut_badge }}-subtle text-{{ $commande->statut_badge }}">{{ $commande->statut_label }}</span></td>
                            <td>
                                @if($commande->facture)
                                    <a href="{{ route('factures.show', $commande->facture) }}" class="btn btn-sm btn-outline-secondary" style="font-size:.7rem;">
                                        <i class="bi bi-receipt me-1"></i>FAC-{{ str_pad($commande->facture->id,4,'0',STR_PAD_LEFT) }}
                                    </a>
                                @else
                                    <span style="color:#475569;font-size:.78rem;">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4" style="color:#64748b;"><i class="bi bi-inbox d-block mb-1" style="font-size:1.5rem;"></i>Aucune commande</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
