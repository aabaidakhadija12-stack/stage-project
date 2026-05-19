

<?php $__env->startSection('title', 'Facture FAC-' . str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('factures.index')); ?>" class="text-decoration-none">Factures</a></li>
    <li class="breadcrumb-item active">FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Facture FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></h4>
        <p class="text-muted small mb-0">Émise le <?php echo e($facture->dateEmission->format('d/m/Y')); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('factures.pdf', $facture)); ?>" class="btn btn-danger">
            <i class="bi bi-file-pdf me-1"></i>Télécharger PDF
        </a>
        <a href="<?php echo e(route('factures.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<!-- Invoice card -->
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0 rounded-3" id="invoice-content">
            <div class="card-body p-5">
                <!-- Header -->
                <div class="row mb-5">
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-danger d-flex align-items-center justify-content-center text-white"
                                 style="width:48px;height:48px;font-size:1.5rem;">
                                <i class="bi bi-fire"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">AQUA MAB</div>
                                <div class="text-muted small">Équipements incendie</div>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">
                            123 Rue de la Sécurité<br>
                            75001 Paris, France<br>
                            contact@aquamab.com
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <h2 class="fw-bold text-primary mb-1">FACTURE</h2>
                        <p class="text-muted small mb-1">N° FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?></p>
                        <p class="text-muted small mb-1">Date : <?php echo e($facture->dateEmission->format('d/m/Y')); ?></p>
                        <p class="text-muted small mb-0">Commande : #<?php echo e($facture->commande_id); ?></p>
                    </div>
                </div>

                <!-- Client info -->
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <div class="small fw-semibold text-muted text-uppercase mb-2">Facturé à</div>
                            <?php if($facture->commande->client): ?>
                                <div class="fw-semibold"><?php echo e($facture->commande->client->nom); ?></div>
                                <div class="text-muted small"><?php echo e($facture->commande->client->adresse ?? ''); ?></div>
                                <div class="text-muted small"><?php echo e($facture->commande->client->telephone ?? ''); ?></div>
                            <?php else: ?>
                                <span class="text-muted small">Client non renseigné</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($facture->commande->fournisseur): ?>
                    <div class="col-6">
                        <div class="bg-light rounded-3 p-3">
                            <div class="small fw-semibold text-muted text-uppercase mb-2">Fournisseur</div>
                            <div class="fw-semibold"><?php echo e($facture->commande->fournisseur->nom); ?></div>
                            <div class="text-muted small"><?php echo e($facture->commande->fournisseur->contact ?? ''); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Products table -->
                <table class="table mb-4">
                    <thead class="table-dark">
                        <tr>
                            <th>Désignation</th>
                            <th>Type</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-center">Qté</th>
                            <th class="text-end">Total HT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $facture->commande->produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="fw-medium"><?php echo e($produit->nom); ?></td>
                            <td class="text-muted small"><?php echo e($produit->type ?? '—'); ?></td>
                            <td class="text-end"><?php echo e(number_format($produit->pivot->prix_unitaire, 2, ',', ' ')); ?> €</td>
                            <td class="text-center"><?php echo e($produit->pivot->quantite); ?></td>
                            <td class="text-end"><?php echo e(number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2, ',', ' ')); ?> €</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <!-- Totals -->
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <table class="table table-sm">
                            <tr>
                                <td class="text-muted">Sous-total HT</td>
                                <td class="text-end fw-medium"><?php echo e(number_format($facture->montant, 2, ',', ' ')); ?> €</td>
                            </tr>
                            <tr>
                                <td class="text-muted">TVA (20%)</td>
                                <td class="text-end fw-medium"><?php echo e(number_format($facture->montant * 0.20, 2, ',', ' ')); ?> €</td>
                            </tr>
                            <tr class="table-primary">
                                <td class="fw-bold">Total TTC</td>
                                <td class="text-end fw-bold fs-5"><?php echo e(number_format($facture->montant * 1.20, 2, ',', ' ')); ?> €</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Footer note -->
                <hr>
                <p class="text-muted small text-center mb-0">
                    Merci pour votre confiance. AQUA MAB — Spécialiste en équipements de protection incendie.
                </p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\factures\show.blade.php ENDPATH**/ ?>