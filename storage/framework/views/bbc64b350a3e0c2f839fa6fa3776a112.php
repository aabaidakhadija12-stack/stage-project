

<?php $__env->startSection('title', $fournisseur->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('fournisseurs.index')); ?>" class="text-decoration-none">Fournisseurs</a></li>
    <li class="breadcrumb-item active"><?php echo e($fournisseur->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1"><?php echo e($fournisseur->nom); ?></h4>
        <p class="text-muted small mb-0">Fiche fournisseur</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('fournisseurs.edit', $fournisseur)); ?>" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="<?php echo e(route('fournisseurs.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4 text-center">
                <div class="mx-auto mb-3 rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center"
                     style="width:72px;height:72px;font-size:2rem;">
                    <i class="bi bi-truck text-warning"></i>
                </div>
                <h5 class="fw-bold mb-1"><?php echo e($fournisseur->nom); ?></h5>
                <p class="text-muted small"><?php echo e($fournisseur->contact ?? 'Aucun contact renseigné'); ?></p>
            </div>
            <hr class="my-0">
            <div class="card-body p-3">
                <dl class="row small mb-0">
                    <dt class="col-6 text-muted">Contact</dt>
                    <dd class="col-6"><?php echo e($fournisseur->contact ?? '—'); ?></dd>
                    <dt class="col-6 text-muted">Commandes</dt>
                    <dd class="col-6"><?php echo e($fournisseur->commandes->count()); ?></dd>
                    <dt class="col-6 text-muted">Depuis</dt>
                    <dd class="col-6"><?php echo e($fournisseur->created_at->format('d/m/Y')); ?></dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-amber shadow-sm">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Commandes associées</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Client</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $fournisseur->commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $commande)); ?>" class="text-decoration-none fw-medium">#<?php echo e($commande->id); ?></a></td>
                            <td class="small text-muted"><?php echo e($commande->date->format('d/m/Y')); ?></td>
                            <td><?php echo e($commande->client?->nom ?? '—'); ?></td>
                            <td><span class="badge bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>"><?php echo e($commande->statut_label); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Aucune commande</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\fournisseurs\show.blade.php ENDPATH**/ ?>