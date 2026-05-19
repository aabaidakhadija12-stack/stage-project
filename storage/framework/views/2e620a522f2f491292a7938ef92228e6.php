<?php $__env->startSection('title', 'Commande #' . $commande->id); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('commandes.index')); ?>" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item active">CMD-<?php echo e(str_pad($commande->id,4,'0',STR_PAD_LEFT)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(6,182,212,.9),rgba(6,182,212,.5));display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;box-shadow:0 4px 18px rgba(6,182,212,.35);">
            <i class="bi bi-cart3"></i>
        </div>
        <div>
            <h4 style="font-weight:800;color:#f1f5f9;margin:0;letter-spacing:-.02em;">CMD-<?php echo e(str_pad($commande->id,4,'0',STR_PAD_LEFT)); ?></h4>
            <p style="color:#64748b;font-size:.75rem;margin:2px 0 0;"><?php echo e($commande->date->format('d/m/Y')); ?></p>
        </div>
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
    
    <div class="col-lg-4">
        
        <div class="card mb-3" style="border:1px solid rgba(6,182,212,.2);background:linear-gradient(135deg,rgba(6,182,212,.08),rgba(6,182,212,.02));">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(6,182,212,.15);">
                <div style="width:28px;height:28px;border-radius:7px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.85rem;"><i class="bi bi-info-circle"></i></div>
                <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Détails</span>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Statut</span>
                        <span class="badge bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>"><?php echo e($commande->statut_label); ?></span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Date</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;"><?php echo e($commande->date->format('d/m/Y')); ?></span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Client</span>
                        <?php if($commande->client): ?>
                            <a href="<?php echo e(route('clients.show', $commande->client)); ?>" style="font-size:.82rem;color:#3b82f6;font-weight:600;text-decoration:none;"><?php echo e($commande->client->nom); ?></a>
                        <?php else: ?>
                            <span style="color:#475569;font-size:.82rem;">—</span>
                        <?php endif; ?>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Fournisseur</span>
                        <span style="font-size:.82rem;color:#e2e8f0;font-weight:500;"><?php echo e($commande->fournisseur?->nom ?? '—'); ?></span>
                    </div>
                    <div style="height:1px;background:rgba(255,255,255,.05);"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="font-size:.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;">Total</span>
                        <span style="font-size:1.1rem;font-weight:800;color:#10b981;"><?php echo e(number_format($total, 2, ',', ' ')); ?> DH</span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card" style="border:1px solid rgba(16,185,129,.2);background:linear-gradient(135deg,rgba(16,185,129,.07),rgba(16,185,129,.02));">
            <div class="card-header d-flex align-items-center gap-2" style="border-bottom:1px solid rgba(16,185,129,.15);">
                <div style="width:28px;height:28px;border-radius:7px;background:rgba(16,185,129,.2);display:flex;align-items:center;justify-content:center;color:#10b981;font-size:.85rem;"><i class="bi bi-receipt"></i></div>
                <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Facture</span>
            </div>
            <div class="card-body p-4">
                <?php if($commande->facture): ?>
                    <div style="font-size:.82rem;color:#94a3b8;margin-bottom:.75rem;">
                        Facture <strong style="color:#10b981;">FAC-<?php echo e(str_pad($commande->facture->id,4,'0',STR_PAD_LEFT)); ?></strong>
                        — <span style="color:#e2e8f0;font-weight:700;"><?php echo e(number_format($commande->facture->montant, 2, ',', ' ')); ?> DH</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('factures.show', $commande->facture)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye me-1"></i>Voir
                        </a>
                        <a href="<?php echo e(route('factures.pdf', $commande->facture)); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-file-pdf me-1"></i>PDF
                        </a>
                    </div>
                <?php else: ?>
                    <p style="font-size:.8rem;color:#64748b;margin-bottom:.75rem;">Aucune facture générée.</p>
                    <?php if(auth()->user()->isAdmin()): ?>
                    <form method="POST" action="<?php echo e(route('factures.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="commande_id" value="<?php echo e($commande->id); ?>">
                        <input type="hidden" name="dateEmission" value="<?php echo e(date('Y-m-d')); ?>">
                        <button type="submit" class="btn btn-sm w-100" style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;border:none;font-weight:600;">
                            <i class="bi bi-plus me-1"></i>Générer la facture
                        </button>
                    </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-8">
        <div class="card table-card table-pro-card accent-cyan">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <div style="width:30px;height:30px;border-radius:8px;background:rgba(6,182,212,.2);display:flex;align-items:center;justify-content:center;color:#06b6d4;font-size:.9rem;"><i class="bi bi-box-seam"></i></div>
                <h6 style="font-weight:700;color:#f1f5f9;margin:0;font-size:.85rem;">Produits commandés</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Type</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-center">Qté</th>
                            <th class="text-end">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $commande->produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(route('produits.show', $produit)); ?>" style="font-weight:600;color:#e2e8f0;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#e2e8f0'">
                                    <?php echo e($produit->nom); ?>

                                </a>
                            </td>
                            <td style="color:#64748b;font-size:.78rem;"><?php echo e($produit->type ?? '—'); ?></td>
                            <td class="text-end" style="color:#e2e8f0;font-weight:500;"><?php echo e(number_format($produit->pivot->prix_unitaire, 2, ',', ' ')); ?> DH</td>
                            <td class="text-center" style="font-weight:700;color:#f1f5f9;"><?php echo e($produit->pivot->quantite); ?></td>
                            <td class="text-end" style="font-weight:700;color:#10b981;">
                                <?php echo e(number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2, ',', ' ')); ?> DH
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center py-4" style="color:#64748b;">Aucun produit</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background:rgba(16,185,129,.08);border-top:1px solid rgba(16,185,129,.2);">
                            <td colspan="4" class="text-end" style="font-weight:700;color:#94a3b8;padding:.9rem 1.2rem;">Total</td>
                            <td class="text-end" style="font-weight:800;color:#10b981;font-size:1rem;padding:.9rem 1.2rem;"><?php echo e(number_format($total, 2, ',', ' ')); ?> DH</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/commandes/show.blade.php ENDPATH**/ ?>