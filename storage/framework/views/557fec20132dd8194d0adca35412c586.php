

<?php $__env->startSection('title', 'Facture FAC-' . str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('factures.index')); ?>" class="text-decoration-none">Factures</a></li>
    <li class="breadcrumb-item active">FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(16,185,129,.9),rgba(16,185,129,.5));display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;box-shadow:0 4px 18px rgba(16,185,129,.35);">
            <i class="bi bi-receipt-cutoff"></i>
        </div>
        <div>
            <h4 style="font-weight:800;color:#f1f5f9;margin:0;letter-spacing:-.02em;">FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></h4>
            <p style="color:#64748b;font-size:.75rem;margin:2px 0 0;">Émise le <?php echo e($facture->dateEmission->format('d/m/Y')); ?></p>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('factures.pdf', $facture)); ?>" class="btn btn-outline-danger">
            <i class="bi bi-file-pdf me-1"></i>Télécharger PDF
        </a>
        <a href="<?php echo e(route('factures.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card" id="invoice-content" style="border:1px solid rgba(255,255,255,.1);background:rgba(255,255,255,.04);">
            <div class="card-body p-5">
                
                <div class="row mb-5">
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#e63946,#f97316);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;">
                                <i class="bi bi-fire"></i>
                            </div>
                            <div>
                                <div style="font-weight:800;font-size:1.1rem;color:#f1f5f9;">AQUA MAB</div>
                                <div style="color:#64748b;font-size:.72rem;">Équipements incendie</div>
                            </div>
                        </div>
                        <p style="color:#64748b;font-size:.78rem;line-height:1.7;margin:0;">
                            123 Rue de la Sécurité<br>
                            Casablanca, Maroc<br>
                            contact@aquamab.com
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <div style="font-size:2rem;font-weight:800;color:#10b981;letter-spacing:-.03em;margin-bottom:8px;">FACTURE</div>
                        <p style="color:#94a3b8;font-size:.78rem;margin:2px 0;">N° FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></p>
                        <p style="color:#94a3b8;font-size:.78rem;margin:2px 0;">Date : <?php echo e($facture->dateEmission->format('d/m/Y')); ?></p>
                        <p style="color:#94a3b8;font-size:.78rem;margin:2px 0;">Commande : CMD-<?php echo e(str_pad($facture->commande_id,4,'0',STR_PAD_LEFT)); ?></p>
                    </div>
                </div>

                
                <div class="row mb-4">
                    <div class="col-6">
                        <div style="background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.15);border-radius:12px;padding:1rem 1.2rem;">
                            <div style="font-size:.65rem;font-weight:700;color:#3b82f6;text-transform:uppercase;letter-spacing:.1em;margin-bottom:.6rem;">Facturé à</div>
                            <?php if($facture->commande->client): ?>
                                <div style="font-weight:700;color:#f1f5f9;font-size:.9rem;"><?php echo e($facture->commande->client->nom); ?></div>
                                <div style="color:#94a3b8;font-size:.78rem;margin-top:3px;"><?php echo e($facture->commande->client->adresse ?? ''); ?></div>
                                <div style="color:#94a3b8;font-size:.78rem;"><?php echo e($facture->commande->client->telephone ?? ''); ?></div>
                            <?php else: ?>
                                <span style="color:#64748b;font-size:.82rem;">Client non renseigné</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($facture->commande->fournisseur): ?>
                    <div class="col-6">
                        <div style="background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.15);border-radius:12px;padding:1rem 1.2rem;">
                            <div style="font-size:.65rem;font-weight:700;color:#f59e0b;text-transform:uppercase;letter-spacing:.1em;margin-bottom:.6rem;">Fournisseur</div>
                            <div style="font-weight:700;color:#f1f5f9;font-size:.9rem;"><?php echo e($facture->commande->fournisseur->nom); ?></div>
                            <div style="color:#94a3b8;font-size:.78rem;margin-top:3px;"><?php echo e($facture->commande->fournisseur->contact ?? ''); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                
                <div class="table-responsive mb-4">
                    <table class="table align-middle mb-0" style="border:1px solid rgba(255,255,255,.07);border-radius:10px;overflow:hidden;">
                        <thead>
                            <tr style="background:rgba(0,0,0,.3);">
                                <th style="color:#94a3b8;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">Désignation</th>
                                <th style="color:#94a3b8;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">Type</th>
                                <th class="text-end" style="color:#94a3b8;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">Prix unitaire</th>
                                <th class="text-center" style="color:#94a3b8;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">Qté</th>
                                <th class="text-end" style="color:#94a3b8;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:.85rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">Total HT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $facture->commande->produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
                                <td style="font-weight:600;color:#e2e8f0;padding:.85rem 1rem;"><?php echo e($produit->nom); ?></td>
                                <td style="color:#64748b;font-size:.78rem;padding:.85rem 1rem;"><?php echo e($produit->type ?? '—'); ?></td>
                                <td class="text-end" style="color:#e2e8f0;padding:.85rem 1rem;"><?php echo e(number_format($produit->pivot->prix_unitaire, 2, ',', ' ')); ?> DH</td>
                                <td class="text-center" style="font-weight:700;color:#f1f5f9;padding:.85rem 1rem;"><?php echo e($produit->pivot->quantite); ?></td>
                                <td class="text-end" style="font-weight:600;color:#e2e8f0;padding:.85rem 1rem;"><?php echo e(number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2, ',', ' ')); ?> DH</td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:12px;overflow:hidden;">
                            <div class="d-flex justify-content-between align-items-center" style="padding:.7rem 1rem;border-bottom:1px solid rgba(255,255,255,.06);">
                                <span style="color:#94a3b8;font-size:.8rem;">Sous-total HT</span>
                                <span style="color:#e2e8f0;font-weight:600;font-size:.8rem;"><?php echo e(number_format($facture->montant, 2, ',', ' ')); ?> DH</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="padding:.7rem 1rem;border-bottom:1px solid rgba(255,255,255,.06);">
                                <span style="color:#94a3b8;font-size:.8rem;">TVA (20%)</span>
                                <span style="color:#e2e8f0;font-weight:600;font-size:.8rem;"><?php echo e(number_format($facture->montant * 0.20, 2, ',', ' ')); ?> DH</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center" style="padding:.85rem 1rem;background:rgba(16,185,129,.12);">
                                <span style="color:#10b981;font-weight:700;font-size:.85rem;">Total TTC</span>
                                <span style="color:#10b981;font-weight:800;font-size:1.1rem;"><?php echo e(number_format($facture->montant * 1.20, 2, ',', ' ')); ?> DH</span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div style="height:1px;background:rgba(255,255,255,.06);margin:2rem 0 1rem;"></div>
                <p style="color:#475569;font-size:.75rem;text-align:center;margin:0;">
                    Merci pour votre confiance. <strong style="color:#64748b;">AQUA MAB</strong> — Spécialiste en équipements de protection incendie.
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/factures/show.blade.php ENDPATH**/ ?>