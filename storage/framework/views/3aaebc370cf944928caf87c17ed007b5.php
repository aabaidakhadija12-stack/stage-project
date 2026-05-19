<?php $__env->startSection('title', $produit->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('produits.index')); ?>" class="text-decoration-none">Produits</a></li>
    <li class="breadcrumb-item active"><?php echo e($produit->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(249,115,22,.9),rgba(249,115,22,.5));display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;box-shadow:0 4px 18px rgba(249,115,22,.35);">
            <i class="bi bi-box-seam"></i>
        </div>
        <div>
            <h4 style="font-weight:800;color:#f1f5f9;margin:0;letter-spacing:-.02em;"><?php echo e($produit->nom); ?></h4>
            <p style="color:#64748b;font-size:.75rem;margin:2px 0 0;">Détails du produit</p>
        </div>
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
    
    <div class="col-lg-4">
        
        <div class="card mb-3" style="border:1px solid rgba(249,115,22,.2);background:linear-gradient(135deg,rgba(249,115,22,.08),rgba(249,115,22,.02));">
            <div class="card-body p-4 text-center">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width:80px;height:80px;border-radius:20px;background:rgba(249,115,22,.15);border:1px solid rgba(249,115,22,.25);font-size:2.2rem;color:#f97316;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h5 style="font-weight:700;color:#f1f5f9;margin-bottom:6px;"><?php echo e($produit->nom); ?></h5>
                <?php if($produit->type): ?>
                    <span style="display:inline-flex;align-items:center;gap:.3rem;padding:.3em .8em;border-radius:6px;font-size:.72rem;font-weight:600;background:rgba(249,115,22,.12);border:1px solid rgba(249,115,22,.2);color:#fb923c;">
                        <?php echo e($produit->type); ?>

                    </span>
                <?php endif; ?>
            </div>
            <div style="height:1px;background:rgba(249,115,22,.15);"></div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Prix</span>
                        <span style="font-size:.95rem;font-weight:800;color:#f97316;"><?php echo e(number_format($produit->prix, 2, ',', ' ')); ?> DH</span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Stock</span>
                        <span>
                            <?php if($produit->quantiteStock === 0): ?>
                                <span class="badge bg-danger-subtle text-danger">Rupture</span>
                            <?php elseif($produit->quantiteStock < 5): ?>
                                <span class="badge bg-warning-subtle text-warning"><?php echo e($produit->quantiteStock); ?> u. (faible)</span>
                            <?php else: ?>
                                <span class="badge bg-success-subtle text-success"><?php echo e($produit->quantiteStock); ?> u.</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Créé le</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;"><?php echo e($produit->created_at->format('d/m/Y')); ?></span>
                    </div>
                    <?php if($produit->description): ?>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <p style="font-size:.78rem;color:#94a3b8;margin:0;line-height:1.6;"><?php echo e($produit->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="card" style="border:1px solid rgba(16,185,129,.2);background:linear-gradient(135deg,rgba(16,185,129,.07),rgba(16,185,129,.02));">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(16,185,129,.15);">
                <div style="width:28px;height:28px;border-radius:7px;background:rgba(16,185,129,.2);display:flex;align-items:center;justify-content:center;color:#10b981;font-size:.85rem;"><i class="bi bi-arrow-left-right"></i></div>
                <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Gestion du stock</span>
            </div>
            <div class="card-body p-3">
                <form method="POST" action="<?php echo e(route('produits.updateStock', $produit)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-2">
                        <label class="form-label">Action</label>
                        <select name="action" class="form-select form-select-sm">
                            <option value="ajouter">Ajouter au stock</option>
                            <option value="retirer">Retirer du stock</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantité</label>
                        <input type="number" name="quantite" min="1" value="1" class="form-control form-control-sm">
                    </div>
                    <button type="submit" class="btn btn-sm w-100" style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;font-weight:600;">
                        <i class="bi bi-check me-1"></i>Appliquer
                    </button>
                </form>
            </div>
        </div>
    </div>

    
    <div class="col-lg-8">
        
        <div class="card table-card table-pro-card accent-orange mb-3">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:30px;height:30px;border-radius:8px;background:rgba(249,115,22,.2);display:flex;align-items:center;justify-content:center;color:#f97316;font-size:.9rem;"><i class="bi bi-tools"></i></div>
                    <h6 style="font-weight:700;color:#f1f5f9;margin:0;font-size:.85rem;">Maintenances</h6>
                </div>
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
                            <td style="color:#94a3b8;font-size:.78rem;"><?php echo e($m->date->format('d/m/Y')); ?></td>
                            <td><span class="badge bg-secondary-subtle text-secondary"><?php echo e($m->type); ?></span></td>
                            <td style="color:#94a3b8;font-size:.78rem;"><?php echo e($m->description ?? '—'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center py-4" style="color:#64748b;"><i class="bi bi-tools d-block mb-1" style="font-size:1.5rem;"></i>Aucune maintenance</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="card table-card table-pro-card accent-cyan">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <div style="width:30px;height:30px;border-radius:8px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.9rem;"><i class="bi bi-cart3"></i></div>
                <h6 style="font-weight:700;color:#f1f5f9;margin:0;font-size:.85rem;">Commandes associées</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>#</th><th>Date</th><th>Client</th><th class="text-center">Qté</th><th>Statut</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produit->commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $c)); ?>" class="text-decoration-none fw-semibold" style="color:#06b6d4;">CMD-<?php echo e(str_pad($c->id,4,'0',STR_PAD_LEFT)); ?></a></td>
                            <td style="color:#94a3b8;font-size:.78rem;"><?php echo e($c->date->format('d/m/Y')); ?></td>
                            <td style="color:#e2e8f0;"><?php echo e($c->client?->nom ?? '—'); ?></td>
                            <td class="text-center" style="font-weight:700;color:#f1f5f9;"><?php echo e($c->pivot->quantite); ?></td>
                            <td><span class="badge bg-<?php echo e($c->statut_badge); ?>-subtle text-<?php echo e($c->statut_badge); ?>"><?php echo e($c->statut_label); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-4" style="color:#64748b;"><i class="bi bi-inbox d-block mb-1" style="font-size:1.5rem;"></i>Aucune commande</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/produits/show.blade.php ENDPATH**/ ?>