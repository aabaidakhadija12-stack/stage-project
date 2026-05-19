@extends('layouts.app')

@section('title', 'Factures')
@section('page_title', 'Factures')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="emerald"
    icon="receipt"
    title="Facturation"
    description="Historique des factures émises"
    :stat="$factures->total() . ' facture' . ($factures->total() > 1 ? 's' : '')"
    stat-icon="file-earmark-text"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Recherche client</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom du client..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Rechercher</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('factures.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </x-slot:filters>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Facture</th>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factures as $facture)
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-receipt"></i></div>
                            <div>
                                <a href="{{ route('factures.show', $facture) }}" class="cell-entity-name">
                                    FAC-{{ str_pad($facture->id, 4, '0', STR_PAD_LEFT) }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('commandes.show', $facture->commande) }}" class="badge-type text-decoration-none">
                            <i class="bi bi-link-45deg"></i> CMD #{{ $facture->commande_id }}
                        </a>
                    </td>
                    <td>{{ $facture->commande->client?->nom ?? '—' }}</td>
                    <td class="text-muted small">{{ $facture->dateEmission->format('d/m/Y') }}</td>
                    <td><span class="cell-price">{{ number_format($facture->montant, 2, ',', ' ') }} <small>DH</small></span></td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'show' => route('factures.show', $facture),
                            'pdf' => route('factures.pdf', $facture),
                            'destroy' => route('factures.destroy', $facture),
                            'destroyMessage' => 'Supprimer cette facture ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'receipt',
                        'message' => 'Aucune facture trouvée',
                        'colspan' => 6,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($factures->hasPages())
        <x-slot:footer>{{ $factures->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
