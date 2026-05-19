<?php $__env->startSection('title', $fournisseur->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('fournisseurs.index')); ?>" class="text-decoration-none">Fournisseurs</a></li>
    <li class="breadcrumb-item active"><?php echo e($fournisseur->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(245,158,11,.9),rgba(245,158,11,.5));display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;box-shadow:0 4px 18px rgba(245,158,11,.35);">
            <i class="bi bi-truck"></i>
        </div>
        <div>
            <h4 style="font-weight:800;color:#f1f5f9;margin:0;letter-spacing:-.02em;"><?php echo e($fournisseur->nom); ?></h4>
            <p style="color:#64748b;font-size:.75rem;margin:2px 0 0;">Fiche fournisseur</p>
        </div>
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
        <div class="card h-100" style="border:1px solid rgba(245,158,11,.2);background:linear-gradient(135deg,rgba(245,158,11,.08),rgba(245,158,11,.02));">
            <div class="card-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width:80px;height:80px;border-radius:20px;background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.25);font-size:2.2rem;color:#f59e0b;">
                    <i class="bi bi-truck"></i>
                </div>
                <h5 style="font-weight:700;color:#f1f5f9;margin-bottom:4px;"><?php echo e($fournisseur->nom); ?></h5>
                <p style="color:#64748b;font-size:.78rem;margin:0;"><?php echo e($fournisseur->contact ?? 'Aucun contact renseigné'); ?></p>
            </div>
            <div style="height:1px;background:rgba(245,158,11,.15);"></div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Contact</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;"><?php echo e($fournisseur->contact ?? '—'); ?></span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Commandes</span>
                        <span style="font-size:.82rem;color:#f59e0b;font-weight:700;"><?php echo e($fournisseur->commandes->count()); ?></span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Depuis</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;"><?php echo e($fournisseur->created_at->format('d/m/Y')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-amber">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <div style="width:30px;height:30px;border-radius:8px;background:rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:.9rem;"><i class="bi bi-cart3"></i></div>
                <h6 style="font-weight:700;color:#f1f5f9;margin:0;font-size:.85rem;">Commandes associées</h6>
                <span style="margin-left:auto;font-size:.68rem;color:#f59e0b;background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.2);padding:.2rem .6rem;border-radius:20px;font-weight:600;"><?php echo e($fournisseur->commandes->count()); ?> commande(s)</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Client</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $fournisseur->commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $commande)); ?>" class="text-decoration-none fw-semibold" style="color:#f59e0b;">CMD-<?php echo e(str_pad($commande->id,4,'0',STR_PAD_LEFT)); ?></a></td>
                            <td style="color:#94a3b8;font-size:.78rem;"><?php echo e($commande->date->format('d/m/Y')); ?></td>
                            <td style="color:#e2e8f0;"><?php echo e($commande->client?->nom ?? '—'); ?></td>
                            <td><span class="badge bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>"><?php echo e($commande->statut_label); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center py-4" style="color:#64748b;"><i class="bi bi-inbox d-block mb-1" style="font-size:1.5rem;"></i>Aucune commande</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/fournisseurs/show.blade.php ENDPATH**/ ?>