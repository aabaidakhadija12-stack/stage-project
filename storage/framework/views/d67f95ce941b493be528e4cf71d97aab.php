

<?php $__env->startSection('title', $client->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('clients.index')); ?>" class="text-decoration-none">Clients</a></li>
    <li class="breadcrumb-item active"><?php echo e($client->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1"><?php echo e($client->nom); ?></h4>
        <p class="text-muted small mb-0">Fiche client</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('clients.edit', $client)); ?>" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4 text-center">
                <div class="mx-auto mb-3 rounded-circle bg-info-subtle d-flex align-items-center justify-content-center"
                     style="width:72px;height:72px;font-size:2rem;">
                    <i class="bi bi-person text-info"></i>
                </div>
                <h5 class="fw-bold mb-1"><?php echo e($client->nom); ?></h5>
                <?php if($client->user): ?>
                    <span class="badge bg-success-subtle text-success small">Compte actif</span>
                <?php endif; ?>
            </div>
            <hr class="my-0">
            <div class="card-body p-3">
                <dl class="row small mb-0">
                    <dt class="col-5 text-muted">Téléphone</dt>
                    <dd class="col-7"><?php echo e($client->telephone ?? '—'); ?></dd>

                    <dt class="col-5 text-muted">Adresse</dt>
                    <dd class="col-7"><?php echo e($client->adresse ?? '—'); ?></dd>

                    <?php if($client->user): ?>
                    <dt class="col-5 text-muted">Email</dt>
                    <dd class="col-7 text-truncate"><?php echo e($client->user->email); ?></dd>
                    <?php endif; ?>

                    <dt class="col-5 text-muted">Client depuis</dt>
                    <dd class="col-7"><?php echo e($client->created_at->format('d/m/Y')); ?></dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-blue shadow-sm">
            <div class="card-header py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-cart3 me-2 text-primary"></i>Historique des commandes</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Statut</th><th>Facture</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $client->commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $commande)); ?>" class="text-decoration-none fw-medium">#<?php echo e($commande->id); ?></a></td>
                            <td class="small text-muted"><?php echo e($commande->date->format('d/m/Y')); ?></td>
                            <td><span class="badge bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>"><?php echo e($commande->statut_label); ?></span></td>
                            <td>
                                <?php if($commande->facture): ?>
                                    <a href="<?php echo e(route('factures.show', $commande->facture)); ?>" class="btn btn-xs btn-outline-success btn-sm">
                                        <i class="bi bi-receipt me-1"></i>#<?php echo e($commande->facture->id); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\clients\show.blade.php ENDPATH**/ ?>