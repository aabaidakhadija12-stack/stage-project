@extends('layouts.app')

@section('title', 'Fournisseurs')
@section('page_title', 'Fournisseurs')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="amber"
    icon="truck"
    title="Répertoire fournisseurs"
    description="Vos partenaires et contacts"
    :stat="$fournisseurs->total() . ' fournisseur' . ($fournisseurs->total() > 1 ? 's' : '')"
    stat-icon="building"
    :add-url="route('fournisseurs.create')"
    add-label="Nouveau fournisseur"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom ou contact..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Rechercher</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('fournisseurs.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </x-slot:filters>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Fournisseur</th>
                    <th>Contact</th>
                    <th>Commandes</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fournisseurs as $fournisseur)
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-truck"></i></div>
                            <div>
                                <a href="{{ route('fournisseurs.show', $fournisseur) }}" class="cell-entity-name">{{ $fournisseur->nom }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $fournisseur->contact ?? '—' }}</td>
                    <td>
                        <span class="badge-type"><i class="bi bi-cart3"></i> {{ $fournisseur->commandes_count ?? 0 }} commande(s)</span>
                    </td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'show' => route('fournisseurs.show', $fournisseur),
                            'edit' => route('fournisseurs.edit', $fournisseur),
                            'destroy' => route('fournisseurs.destroy', $fournisseur),
                            'destroyMessage' => 'Supprimer ce fournisseur ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'truck',
                        'message' => 'Aucun fournisseur trouvé',
                        'addUrl' => route('fournisseurs.create'),
                        'addLabel' => 'Ajouter le premier fournisseur',
                        'colspan' => 4,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($fournisseurs->hasPages())
        <x-slot:footer>{{ $fournisseurs->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
