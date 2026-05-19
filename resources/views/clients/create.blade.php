@extends('layouts.app')

@section('title', 'Nouveau client')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}" class="text-decoration-none">Clients</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouveau client</h4>
        <p class="text-muted small mb-0">Ajouter un client au répertoire</p>
    </div>
    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:28px;height:28px;border-radius:7px;background:rgba(59,130,246,.2);display:flex;align-items:center;justify-content:center;color:#3b82f6;font-size:.85rem;"><i class="bi bi-person-plus"></i></div>
                    <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Informations du client</span>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label fw-medium">Nom <span class="text-danger">*</span></label>
                        <input type="text" id="nom" name="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom') }}" required autofocus>
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="form-label fw-medium">Téléphone</label>
                        <input type="text" id="telephone" name="telephone"
                               class="form-control @error('telephone') is-invalid @enderror"
                               value="{{ old('telephone') }}" placeholder="06 XX XX XX XX">
                        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label fw-medium">Adresse</label>
                        <textarea id="adresse" name="adresse" rows="2"
                                  class="form-control @error('adresse') is-invalid @enderror"
                                  placeholder="Adresse complète...">{{ old('adresse') }}</textarea>
                        @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-medium">Compte utilisateur associé</label>
                        <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">— Aucun compte —</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
