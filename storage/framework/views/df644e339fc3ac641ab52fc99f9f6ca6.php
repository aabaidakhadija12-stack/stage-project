<?php $__env->startSection('title', 'Factures'); ?>
<?php $__env->startSection('page_title', 'Factures'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-panel','data' => ['accent' => 'emerald','icon' => 'receipt','title' => 'Facturation','description' => 'Historique des factures émises','stat' => $factures->total() . ' facture' . ($factures->total() > 1 ? 's' : ''),'statIcon' => 'file-earmark-text']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['accent' => 'emerald','icon' => 'receipt','title' => 'Facturation','description' => 'Historique des factures émises','stat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($factures->total() . ' facture' . ($factures->total() > 1 ? 's' : '')),'stat-icon' => 'file-earmark-text']); ?>
     <?php $__env->slot('filters', null, []); ?> 
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Recherche client</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom du client..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Rechercher</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('factures.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
     <?php $__env->endSlot(); ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Facture</th>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $factures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-receipt"></i></div>
                            <div>
                                <a href="<?php echo e(route('factures.show', $facture)); ?>" class="cell-entity-name">
                                    FAC-<?php echo e(str_pad($facture->id, 4, '0', STR_PAD_LEFT)); ?>

                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo e(route('commandes.show', $facture->commande)); ?>" class="badge-type text-decoration-none">
                            <i class="bi bi-link-45deg"></i> CMD #<?php echo e($facture->commande_id); ?>

                        </a>
                    </td>
                    <td><?php echo e($facture->commande->client?->nom ?? '—'); ?></td>
                    <td class="text-muted small"><?php echo e($facture->dateEmission->format('d/m/Y')); ?></td>
                    <td><span class="cell-price"><?php echo e(number_format($facture->montant, 2, ',', ' ')); ?> <small>DH</small></span></td>
                    <td class="text-end pe-3">
                        <?php echo $__env->make('partials.action-buttons', [
                            'show' => route('factures.show', $facture),
                            'pdf' => route('factures.pdf', $facture),
                            'destroy' => route('factures.destroy', $facture),
                            'destroyMessage' => 'Supprimer cette facture ?',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('partials.empty-state', [
                        'icon' => 'receipt',
                        'message' => 'Aucune facture trouvée',
                        'colspan' => 6,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($factures->hasPages()): ?>
         <?php $__env->slot('footer', null, []); ?> <?php echo e($factures->links()); ?> <?php $__env->endSlot(); ?>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5)): ?>
<?php $attributes = $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5; ?>
<?php unset($__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5)): ?>
<?php $component = $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5; ?>
<?php unset($__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/factures/index.blade.php ENDPATH**/ ?>