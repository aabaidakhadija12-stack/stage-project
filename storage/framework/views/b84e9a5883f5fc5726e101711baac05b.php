

<?php $__env->startSection('title', 'Nouvelle commande'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('commandes.index')); ?>" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item active">Nouvelle</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Nouvelle commande</h4>
        <p class="text-muted small mb-0">Créer une nouvelle commande</p>
    </div>
    <a href="<?php echo e(route('commandes.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<form method="POST" action="<?php echo e(route('commandes.store')); ?>" id="commandeForm">
    <?php echo csrf_field(); ?>
    <div class="row g-3">
        <!-- Left column -->
        <div class="col-lg-8">
            <!-- Produits -->
            <div class="card shadow-sm border-0 rounded-3 mb-3">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="fw-semibold mb-0"><i class="bi bi-box-seam me-2 text-primary"></i>Produits commandés</h6>
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
                    <div class="text-end mt-3 pt-3 border-top">
                        <span class="fw-semibold">Total estimé : </span>
                        <span id="total-display" class="fs-5 fw-bold text-primary">0,00 €</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header py-3">
                    <h6 class="fw-semibold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Informations</h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label for="date" class="form-label fw-medium small">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date"
                               class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('date', date('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label fw-medium small">Statut <span class="text-danger">*</span></label>
                        <select id="statut" name="statut"
                                class="form-select <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="en_attente" <?php echo e(old('statut', 'en_attente') === 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                            <option value="confirmee"  <?php echo e(old('statut') === 'confirmee'  ? 'selected' : ''); ?>>Confirmée</option>
                            <option value="livree"     <?php echo e(old('statut') === 'livree'     ? 'selected' : ''); ?>>Livrée</option>
                            <option value="annulee"    <?php echo e(old('statut') === 'annulee'    ? 'selected' : ''); ?>>Annulée</option>
                        </select>
                        <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-medium small">Client</label>
                        <select id="client_id" name="client_id"
                                class="form-select <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">— Aucun client —</option>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->id); ?>" <?php echo e(old('client_id') == $client->id ? 'selected' : ''); ?>>
                                    <?php echo e($client->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="fournisseur_id" class="form-label fw-medium small">Fournisseur</label>
                        <select id="fournisseur_id" name="fournisseur_id"
                                class="form-select <?php $__errorArgs = ['fournisseur_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">— Aucun fournisseur —</option>
                            <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($f->id); ?>" <?php echo e(old('fournisseur_id') == $f->id ? 'selected' : ''); ?>>
                                    <?php echo e($f->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['fournisseur_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-lg me-1"></i>Créer la commande
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const produits = <?php echo json_encode($produits, 15, 512) ?>;
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
    row.className = 'produit-row row g-2 align-items-end mb-2 p-2 bg-light rounded-2';
    row.innerHTML = `
        <div class="col-md-5">
            <label class="form-label small fw-medium mb-1">Produit</label>
            <select name="produits[${rowIndex}][id]" class="form-select form-select-sm produit-select" required>
                <option value="">-- Choisir --</option>
                ${options}
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-medium mb-1">Quantité</label>
            <input type="number" name="produits[${rowIndex}][quantite]" min="1" value="1"
                   class="form-control form-control-sm qty-input" required>
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-medium mb-1">Prix unitaire (€)</label>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\commandes\create.blade.php ENDPATH**/ ?>