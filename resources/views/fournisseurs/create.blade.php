@extends('layouts.app')

@section('title', 'Nouveau fournisseur')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('fournisseurs.index') }}" class="text-decoration-none">Fournisseurs</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouveau fournisseur</h4>
        <p class="text-muted small mb-0">Ajouter un fournisseur au répertoire</p>
    </div>
    <a href="{{ route('fournisseurs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:28px;height:28px;border-radius:7px;background:rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:.85rem;"><i class="bi bi-truck"></i></div>
                    <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Informations du fournisseur</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('fournisseurs.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label fw-medium">Nom <span class="text-danger">*</span></label>
                        <input type="text" id="nom" name="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}" required autofocus>
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="form-label fw-medium">Contact</label>
                        <input type="text" id="contact" name="contact"
                               class="form-control @error('contact') is-invalid @enderror"
                               value="{{ old('contact') }}"
                               placeholder="Email, téléphone ou nom du contact...">
                        @error('contact')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
