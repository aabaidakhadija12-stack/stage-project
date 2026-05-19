

<?php $__env->startSection('title', $produit->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('produits.index')); ?>" class="text-decoration-none">Produits</a></li>
    <li class="breadcrumb-item active"><?php echo e($produit->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1"><?php echo e($produit->nom); ?></h4>
        <p class="text-muted small mb-0">Détails du produit</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('produits.edit', $produit)); ?>" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="<?php echo e(route('produits.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <!-- Info card -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3 mb-3">
            <div class="card-body p-4">
                <div class="text-center mb-3">
                    <div class="mx-auto mb-3 rounded-3 bg-primary-subtle d-flex align-items-center justify-content-center"
                         style="width:80px;height:80px;font-size:2.5rem;">
                        <i class="bi bi-box-seam text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-1"><?php echo e($produit->nom); ?></h5>
                    <?php if($produit->type): ?>
                        <span class="badge bg-secondary-subtle text-secondary"><?php echo e($produit->type); ?></span>
                    <?php endif; ?>
                </div>

                <hr>

                <dl class="row mb-0 small">
                    <dt class="col-6 text-muted">Prix</dt>
                    <dd class="col-6 fw-semibold"><?php echo e(number_format($produit->prix, 2, ',', ' ')); ?> €</dd>

                    <dt class="col-6 text-muted">Stock</dt>
                    <dd class="col-6">
                        <?php if($produit->quantiteStock === 0): ?>
                            <span class="badge bg-danger-subtle text-danger">Rupture</span>
                        <?php elseif($produit->quantiteStock < 5): ?>
                            <span class="badge bg-warning-subtle text-warning"><?php echo e($produit->quantiteStock); ?> (faible)</span>
                        <?php else: ?>
                            <span class="badge bg-success-subtle text-success"><?php echo e($produit->quantiteStock); ?></span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-6 text-muted">Créé le</dt>
                    <dd class="col-6"><?php echo e($produit->created_at->format('d/m/Y')); ?></dd>
                </dl>

                <?php if($produit->description): ?>
                <hr>
                <p class="small text-muted mb-0"><?php echo e($produit->description); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stock management -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-arrow-left-right me-2 text-primary"></i>Gestion du stock</h6>
            </div>
            <div class="card-body p-3">
                <form method="POST" action="<?php echo e(route('produits.updateStock', $produit)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-2">
                        <label class="form-label small fw-medium">Action</label>
                        <select name="action" class="form-select form-select-sm">
                            <option value="ajouter">Ajouter au stock</option>
                            <option value="retirer">Retirer du stock</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Quantité</label>
                        <input type="number" name="quantite" min="1" value="1" class="form-control form-control-sm">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        <i class="bi bi-check me-1"></i>Appliquer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Maintenances -->
    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-orange shadow-sm mb-3">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-tools me-2 text-secondary"></i>Maintenances</h6>
                <a href="<?php echo e(route('maintenances.create')); ?>?produit_id=<?php echo e($produit->id); ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-plus me-1"></i>Ajouter
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>Date</th><th>Type</th><th>Description</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produit->maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="small"><?php echo e($m->date->format('d/m/Y')); ?></td>
                            <td><span class="badge bg-secondary-subtle text-secondary"><?php echo e($m->type); ?></span></td>
                            <td class="text-muted small"><?php echo e($m->description ?? '—'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center text-muted py-3">Aucune maintenance</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Commandes liées -->
        <div class="card table-card table-pro-card accent-orange shadow-sm">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Commandes associées</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Client</th><th>Qté</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produit->commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $c)); ?>" class="text-decoration-none">#<?php echo e($c->id); ?></a></td>
                            <td class="small"><?php echo e($c->date->format('d/m/Y')); ?></td>
                            <td><?php echo e($c->client?->nom ?? '—'); ?></td>
                            <td><?php echo e($c->pivot->quantite); ?></td>
                            <td><span class="badge bg-<?php echo e($c->statut_badge); ?>-subtle text-<?php echo e($c->statut_badge); ?>"><?php echo e($c->statut_label); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted py-3">Aucune commande</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\produits\show.blade.php ENDPATH**/ ?>