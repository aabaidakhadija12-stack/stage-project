

<?php $__env->startSection('title', 'Commande #' . $commande->id); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('commandes.index')); ?>" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item active">#<?php echo e($commande->id); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Commande #<?php echo e($commande->id); ?></h4>
        <p class="text-muted small mb-0"><?php echo e($commande->date->format('d/m/Y')); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('commandes.edit', $commande)); ?>" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="<?php echo e(route('commandes.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <!-- Details -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Détails</h6>
            </div>
            <div class="card-body p-3">
                <dl class="row small mb-0">
                    <dt class="col-5 text-muted">Statut</dt>
                    <dd class="col-7">
                        <span class="badge badge-pill bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>">
                            <?php echo e($commande->statut_label); ?>

                        </span>
                    </dd>

                    <dt class="col-5 text-muted">Date</dt>
                    <dd class="col-7"><?php echo e($commande->date->format('d/m/Y')); ?></dd>

                    <dt class="col-5 text-muted">Client</dt>
                    <dd class="col-7">
                        <?php if($commande->client): ?>
                            <a href="<?php echo e(route('clients.show', $commande->client)); ?>" class="text-decoration-none">
                                <?php echo e($commande->client->nom); ?>

                            </a>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-5 text-muted">Fournisseur</dt>
                    <dd class="col-7"><?php echo e($commande->fournisseur?->nom ?? '—'); ?></dd>

                    <dt class="col-5 text-muted">Total</dt>
                    <dd class="col-7 fw-bold text-primary fs-6"><?php echo e(number_format($total, 2, ',', ' ')); ?> €</dd>
                </dl>
            </div>
        </div>

        <!-- Facture -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-receipt me-2 text-success"></i>Facture</h6>
            </div>
            <div class="card-body p-3">
                <?php if($commande->facture): ?>
                    <p class="small mb-2">
                        Facture <strong>#<?php echo e($commande->facture->id); ?></strong> —
                        <?php echo e(number_format($commande->facture->montant, 2, ',', ' ')); ?> €
                    </p>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('factures.show', $commande->facture)); ?>" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-eye me-1"></i>Voir
                        </a>
                        <a href="<?php echo e(route('factures.pdf', $commande->facture)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-file-pdf me-1"></i>PDF
                        </a>
                    </div>
                <?php else: ?>
                    <p class="small text-muted mb-3">Aucune facture générée.</p>
                    <?php if(auth()->user()->isAdmin()): ?>
                    <form method="POST" action="<?php echo e(route('factures.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="commande_id" value="<?php echo e($commande->id); ?>">
                        <input type="hidden" name="dateEmission" value="<?php echo e(date('Y-m-d')); ?>">
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="bi bi-plus me-1"></i>Générer la facture
                        </button>
                    </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Produits -->
    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-cyan shadow-sm">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-box-seam me-2 text-primary"></i>Produits commandés</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Type</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-end">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $commande->produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('produits.show', $produit)); ?>" class="fw-medium text-decoration-none">
                                    <?php echo e($produit->nom); ?>

                                </a>
                            </td>
                            <td class="text-muted small"><?php echo e($produit->type ?? '—'); ?></td>
                            <td class="text-end"><?php echo e(number_format($produit->pivot->prix_unitaire, 2, ',', ' ')); ?> €</td>
                            <td class="text-center"><?php echo e($produit->pivot->quantite); ?></td>
                            <td class="text-end fw-semibold">
                                <?php echo e(number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2, ',', ' ')); ?> €
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Aucun produit</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td class="text-end fw-bold text-primary fs-6"><?php echo e(number_format($total, 2, ',', ' ')); ?> €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\commandes\show.blade.php ENDPATH**/ ?>