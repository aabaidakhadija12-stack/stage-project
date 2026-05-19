@extends('layouts.app')

@section('title', 'Commandes')
@section('page_title', 'Commandes')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="cyan"
    icon="cart3"
    title="Gestion des commandes"
    description="Suivi des ventes et livraisons"
    :stat="$commandes->total() . ' commande' . ($commandes->total() > 1 ? 's' : '')"
    stat-icon="receipt"
    :add-url="route('commandes.create')"
    add-label="Nouvelle commande"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Recherche client</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom du client..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmee" {{ request('statut') === 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                    <option value="livree" {{ request('statut') === 'livree' ? 'selected' : '' }}>Livrée</option>
                    <option value="annulee" {{ request('statut') === 'annulee' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filtrer</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </x-slot:filters>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Commande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Fournisseur</th>
                    <th>Statut</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $commande)
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-bag-check"></i></div>
                            <div>
                                <a href="{{ route('commandes.show', $commande) }}" class="cell-entity-name">
                                    CMD-{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $commande->date->format('d/m/Y') }}</td>
                    <td>{{ $commande->client?->nom ?? '—' }}</td>
                    <td class="text-muted small">{{ $commande->fournisseur?->nom ?? '—' }}</td>
                    <td>
                        <span class="badge badge-stock bg-{{ $commande->statut_badge }}-subtle text-{{ $commande->statut_badge }}">
                            {{ $commande->statut_label }}
                        </span>
                    </td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'show' => route('commandes.show', $commande),
                            'edit' => route('commandes.edit', $commande),
                            'destroy' => route('commandes.destroy', $commande),
                            'destroyMessage' => 'Supprimer cette commande ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'cart3',
                        'message' => 'Aucune commande trouvée',
                        'addUrl' => route('commandes.create'),
                        'addLabel' => 'Créer la première commande',
                        'colspan' => 6,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($commandes->hasPages())
        <x-slot:footer>{{ $commandes->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
