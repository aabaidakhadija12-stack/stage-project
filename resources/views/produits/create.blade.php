@extends('layouts.app')

@section('title', 'Nouveau produit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('produits.index') }}" class="text-decoration-none">Produits</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouveau produit</h4>
        <p class="text-muted small mb-0">Ajouter un produit au catalogue</p>
    </div>
    <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:28px;height:28px;border-radius:7px;background:rgba(249,115,22,.2);display:flex;align-items:center;justify-content:center;color:#f97316;font-size:.85rem;"><i class="bi bi-box-seam"></i></div>
                    <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Informations du produit</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('produits.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label fw-medium">Nom du produit <span class="text-danger">*</span></label>
                        <input type="text" id="nom" name="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}" required autofocus>
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label fw-medium">Type</label>
                        <input type="text" id="type" name="type"
                               class="form-control @error('type') is-invalid @enderror"
                               value="{{ old('type') }}"
                               placeholder="Ex: Extincteur, Détection, Signalisation...">
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="prix" class="form-label fw-medium">Prix (€) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" id="prix" name="prix" step="0.01" min="0"
                                       class="form-control @error('prix') is-invalid @enderror"
                                       value="{{ old('prix', '0.00') }}" required>
                                <span class="input-group-text">€</span>
                                @error('prix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="quantiteStock" class="form-label fw-medium">Quantité en stock <span class="text-danger">*</span></label>
                            <input type="number" id="quantiteStock" name="quantiteStock" min="0"
                                   class="form-control @error('quantiteStock') is-invalid @enderror"
                                   value="{{ old('quantiteStock', '0') }}" required>
                            @error('quantiteStock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <textarea id="description" name="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Description du produit...">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
