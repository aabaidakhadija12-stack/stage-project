@extends('layouts.app')

@section('title', 'Produits')
@section('page_title', 'Produits')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="orange"
    icon="box-seam"
    title="Catalogue produits"
    description="Gérez votre stock et vos équipements"
    :stat="$produits->total() . ' produit' . ($produits->total() > 1 ? 's' : '')"
    stat-icon="layers"
    :add-url="route('produits.create')"
    add-label="Nouveau produit"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom ou type..." value="{{ request('search') }}">
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
                <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary w-100">
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
                    <th>Prix</th>
                    <th>Stock</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produits as $produit)
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon">
                                <i class="bi bi-{{ match(true) {
                                    str_contains(strtolower($produit->type ?? ''), 'extincteur') => 'fire',
                                    str_contains(strtolower($produit->type ?? ''), 'détection') || str_contains(strtolower($produit->type ?? ''), 'detect') => 'broadcast',
                                    str_contains(strtolower($produit->type ?? ''), 'robinet') => 'droplet',
                                    default => 'box-seam',
                                } }}"></i>
                            </div>
                            <div>
                                <a href="{{ route('produits.show', $produit) }}" class="cell-entity-name">{{ $produit->nom }}</a>
                                @if($produit->description)
                                    <div class="cell-entity-desc text-truncate d-block" style="max-width:220px;">{{ $produit->description }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($produit->type)
                            <span class="badge-type"><i class="bi bi-tag"></i> {{ $produit->type }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td><span class="cell-price">{{ number_format($produit->prix, 2, ',', ' ') }} <small>DH</small></span></td>
                    <td>
                        @if($produit->quantiteStock === 0)
                            <span class="badge-stock bg-danger-subtle text-danger">Rupture</span>
                        @elseif($produit->quantiteStock < 5)
                            <span class="badge-stock bg-warning-subtle text-warning">{{ $produit->quantiteStock }} faible</span>
                        @else
                            <span class="badge-stock bg-success-subtle text-success">{{ $produit->quantiteStock }} en stock</span>
                        @endif
                    </td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'show' => route('produits.show', $produit),
                            'edit' => route('produits.edit', $produit),
                            'destroy' => route('produits.destroy', $produit),
                            'destroyMessage' => 'Supprimer ce produit ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'box-seam',
                        'message' => 'Aucun produit trouvé',
                        'addUrl' => route('produits.create'),
                        'addLabel' => 'Créer le premier produit',
                        'colspan' => 5,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($produits->hasPages())
        <x-slot:footer>{{ $produits->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
