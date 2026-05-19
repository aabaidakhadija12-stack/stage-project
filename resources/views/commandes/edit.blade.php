@extends('layouts.app')

@section('title', 'Modifier commande #' . $commande->id)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('commandes.index') }}" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('commandes.show', $commande) }}" class="text-decoration-none">#{{ $commande->id }}</a></li>
    <li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Modifier la commande #{{ $commande->id }}</h4>
        <p class="text-muted small mb-0">Mise à jour des informations de la commande</p>
    </div>
    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:28px;height:28px;border-radius:7px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.85rem;"><i class="bi bi-pencil"></i></div>
                    <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Modifier la commande</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('commandes.update', $commande) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="date" class="form-label fw-medium">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', $commande->date->format('Y-m-d')) }}" required>
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label fw-medium">Statut <span class="text-danger">*</span></label>
                        <select id="statut" name="statut"
                                class="form-select @error('statut') is-invalid @enderror" required>
                            <option value="en_attente" {{ old('statut', $commande->statut) === 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmee"  {{ old('statut', $commande->statut) === 'confirmee'  ? 'selected' : '' }}>Confirmée</option>
                            <option value="livree"     {{ old('statut', $commande->statut) === 'livree'     ? 'selected' : '' }}>Livrée</option>
                            <option value="annulee"    {{ old('statut', $commande->statut) === 'annulee'    ? 'selected' : '' }}>Annulée</option>
                        </select>
                        @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-medium">Client</label>
                        <select id="client_id" name="client_id" class="form-select">
                            <option value="">— Aucun client —</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('client_id', $commande->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fournisseur_id" class="form-label fw-medium">Fournisseur</label>
                        <select id="fournisseur_id" name="fournisseur_id" class="form-select">
                            <option value="">— Aucun fournisseur —</option>
                            @foreach($fournisseurs as $f)
                                <option value="{{ $f->id }}"
                                    {{ old('fournisseur_id', $commande->fournisseur_id) == $f->id ? 'selected' : '' }}>
                                    {{ $f->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Mettre à jour
                        </button>
                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
