@extends('layouts.app')

@section('title', 'Nouvelle commande')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('commandes.index') }}" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item active">Nouvelle</li>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouvelle commande</h4>
        <p class="text-muted small mb-0">Créer une nouvelle commande</p>
    </div>
    <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<form method="POST" action="{{ route('commandes.store') }}" id="commandeForm">
    @csrf
    <div class="row g-3">
        <!-- Left column -->
        <div class="col-lg-8">
            <!-- Produits -->
            <div class="card shadow-sm border-0 rounded-3 mb-3">
                <div class="card-header py-3 d-flex align-items-center justify-content-between" style="border-bottom:1px solid rgba(255,255,255,.07);">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:28px;height:28px;border-radius:7px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.85rem;"><i class="bi bi-box-seam"></i></div>
                        <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Produits commandés</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addProduit">
                        <i class="bi bi-plus me-1"></i>Ajouter un produit
                    </button>
                </div>
                <div class="card-body p-3">
                    <div id="produits-container">
                        <!-- Rows added by JS -->
                    </div>
                    <div id="no-produit-msg" class="text-center text-muted py-3 small">
                        Cliquez sur "Ajouter un produit" pour commencer.
                    </div>
                    <div class="text-end mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,.07);">
                        <span style="font-size:.82rem;color:#94a3b8;font-weight:600;">Total estimé : </span>
                        <span id="total-display" style="font-size:1.1rem;font-weight:800;color:#10b981;">0,00 DH</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:28px;height:28px;border-radius:7px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.85rem;"><i class="bi bi-info-circle"></i></div>
                        <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Informations</span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label for="date" class="form-label fw-medium small">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label fw-medium small">Statut <span class="text-danger">*</span></label>
                        <select id="statut" name="statut"
                                class="form-select @error('statut') is-invalid @enderror" required>
                            <option value="en_attente" {{ old('statut', 'en_attente') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmee"  {{ old('statut') === 'confirmee'  ? 'selected' : '' }}>Confirmée</option>
                            <option value="livree"     {{ old('statut') === 'livree'     ? 'selected' : '' }}>Livrée</option>
                            <option value="annulee"    {{ old('statut') === 'annulee'    ? 'selected' : '' }}>Annulée</option>
                        </select>
                        @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-medium small">Client</label>
                        <select id="client_id" name="client_id"
                                class="form-select @error('client_id') is-invalid @enderror">
                            <option value="">— Aucun client —</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="fournisseur_id" class="form-label fw-medium small">Fournisseur</label>
                        <select id="fournisseur_id" name="fournisseur_id"
                                class="form-select @error('fournisseur_id') is-invalid @enderror">
                            <option value="">— Aucun fournisseur —</option>
                            @foreach($fournisseurs as $f)
                                <option value="{{ $f->id }}" {{ old('fournisseur_id') == $f->id ? 'selected' : '' }}>
                                    {{ $f->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('fournisseur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-lg me-1"></i>Créer la commande
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
const produits = @json($produits);
let rowIndex = 0;

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.produit-row').forEach(row => {
        const qty   = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        total += qty * price;
    });
    document.getElementById('total-display').textContent =
        total.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €';
}

function addRow() {
    const container = document.getElementById('produits-container');
    document.getElementById('no-produit-msg').style.display = 'none';

    const options = produits.map(p =>
        `<option value="${p.id}" data-prix="${p.prix}">${p.nom} (stock: ${p.quantiteStock})</option>`
    ).join('');

    const row = document.createElement('div');
    row.className = 'produit-row row g-2 align-items-end mb-2 p-2 rounded-2';
    row.innerHTML = `
        <div class="col-md-5">
            <label style="font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;">Produit</label>
            <select name="produits[${rowIndex}][id]" class="form-select form-select-sm produit-select" required>
                <option value="">-- Choisir --</option>
                ${options}
            </select>
        </div>
        <div class="col-md-3">
            <label style="font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;">Quantité</label>
            <input type="number" name="produits[${rowIndex}][quantite]" min="1" value="1"
                   class="form-control form-control-sm qty-input" required>
        </div>
        <div class="col-md-3">
            <label style="font-size:.7rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;">Prix unitaire (DH)</label>
            <input type="number" name="produits[${rowIndex}][prix_unitaire]" min="0" step="0.01" value="0"
                   class="form-control form-control-sm price-input" required>
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-outline-danger remove-row w-100">
                <i class="bi bi-x"></i>
            </button>
        </div>
    `;

    row.querySelector('.produit-select').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const prix = selected.dataset.prix || 0;
        row.querySelector('.price-input').value = parseFloat(prix).toFixed(2);
        updateTotal();
    });

    row.querySelector('.qty-input').addEventListener('input', updateTotal);
    row.querySelector('.price-input').addEventListener('input', updateTotal);

    row.querySelector('.remove-row').addEventListener('click', function () {
        row.remove();
        updateTotal();
        if (!document.querySelectorAll('.produit-row').length) {
            document.getElementById('no-produit-msg').style.display = '';
        }
    });

    container.appendChild(row);
    rowIndex++;
}

document.getElementById('addProduit').addEventListener('click', addRow);
addRow(); // Start with one row
</script>
@endpush
