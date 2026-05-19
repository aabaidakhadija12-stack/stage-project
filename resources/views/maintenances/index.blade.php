@extends('layouts.app')

@section('title', 'Maintenances')
@section('page_title', 'Maintenances')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="rose"
    icon="tools"
    title="Maintenances"
    description="Interventions et suivi technique"
    :stat="$maintenances->total() . ' intervention' . ($maintenances->total() > 1 ? 's' : '')"
    stat-icon="wrench-adjustable"
    :add-url="route('maintenances.create')"
    add-label="Nouvelle maintenance"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Produit ou type..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select">
                    <option value="">Tous les types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filtrer</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </x-slot:filters>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenances as $maintenance)
                <tr>
                    <td>
                        @if($maintenance->produit)
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-tools"></i></div>
                            <div>
                                <a href="{{ route('produits.show', $maintenance->produit) }}" class="cell-entity-name">
                                    {{ $maintenance->produit->nom }}
                                </a>
                            </div>
                        </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td><span class="badge-type"><i class="bi bi-wrench"></i> {{ $maintenance->type }}</span></td>
                    <td class="text-muted small">{{ $maintenance->date->format('d/m/Y') }}</td>
                    <td class="cell-entity-desc text-truncate" style="max-width:200px;">{{ $maintenance->description ?? '—' }}</td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'edit' => route('maintenances.edit', $maintenance),
                            'destroy' => route('maintenances.destroy', $maintenance),
                            'destroyMessage' => 'Supprimer cette maintenance ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'tools',
                        'message' => 'Aucune maintenance enregistrée',
                        'addUrl' => route('maintenances.create'),
                        'addLabel' => 'Créer la première maintenance',
                        'colspan' => 5,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($maintenances->hasPages())
        <x-slot:footer>{{ $maintenances->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
