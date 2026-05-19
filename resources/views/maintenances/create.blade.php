@extends('layouts.app')

@section('title', 'Nouvelle maintenance')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('maintenances.index') }}" class="text-decoration-none">Maintenances</a></li>
    <li class="breadcrumb-item active">Nouvelle</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouvelle maintenance</h4>
        <p class="text-muted small mb-0">Enregistrer une intervention technique</p>
    </div>
    <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('maintenances.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="produit_id" class="form-label fw-medium">Produit <span class="text-danger">*</span></label>
                        <select id="produit_id" name="produit_id"
                                class="form-select @error('produit_id') is-invalid @enderror" required>
                            <option value="">— Sélectionner un produit —</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}"
                                    {{ (old('produit_id', request('produit_id')) == $produit->id) ? 'selected' : '' }}>
                                    {{ $produit->nom }} ({{ $produit->type ?? 'Sans type' }})
                                </option>
                            @endforeach
                        </select>
                        @error('produit_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label fw-medium">Type d'intervention <span class="text-danger">*</span></label>
                        <input type="text" id="type" name="type"
                               class="form-control @error('type') is-invalid @enderror"
                               value="{{ old('type') }}"
                               placeholder="Ex: Vérification annuelle, Remplacement, Réparation..."
                               list="types-list" required>
                        <datalist id="types-list">
                            <option value="Vérification annuelle">
                            <option value="Remplacement">
                            <option value="Réparation">
                            <option value="Contrôle périodique">
                            <option value="Mise en conformité">
                        </datalist>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label fw-medium">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <textarea id="description" name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Détails de l'intervention...">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
