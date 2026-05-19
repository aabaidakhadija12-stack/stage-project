@extends('layouts.app')

@section('title', 'Clients')
@section('page_title', 'Clients')
@section('breadcrumb')
@endsection

@section('content')
<x-data-panel
    accent="blue"
    icon="people"
    title="Répertoire clients"
    description="Gérez vos clients et comptes"
    :stat="$clients->total() . ' client' . ($clients->total() > 1 ? 's' : '')"
    stat-icon="person-lines-fill"
    :add-url="route('clients.create')"
    add-label="Nouveau client"
>
    <x-slot:filters>
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom ou téléphone..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Rechercher</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </x-slot:filters>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Compte</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-person"></i></div>
                            <div>
                                <a href="{{ route('clients.show', $client) }}" class="cell-entity-name">{{ $client->nom }}</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $client->telephone ?? '—' }}</td>
                    <td class="text-muted small text-truncate" style="max-width:180px;">{{ $client->adresse ?? '—' }}</td>
                    <td>
                        @if($client->user)
                            <span class="badge-type"><i class="bi bi-person-check"></i> {{ $client->user->email }}</span>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="text-end pe-3">
                        @include('partials.action-buttons', [
                            'show' => route('clients.show', $client),
                            'edit' => route('clients.edit', $client),
                            'destroy' => route('clients.destroy', $client),
                            'destroyMessage' => 'Supprimer ce client ?',
                        ])
                    </td>
                </tr>
                @empty
                    @include('partials.empty-state', [
                        'icon' => 'people',
                        'message' => 'Aucun client trouvé',
                        'addUrl' => route('clients.create'),
                        'addLabel' => 'Ajouter le premier client',
                        'colspan' => 5,
                    ])
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clients->hasPages())
        <x-slot:footer>{{ $clients->links() }}</x-slot:footer>
    @endif
</x-data-panel>
@endsection
