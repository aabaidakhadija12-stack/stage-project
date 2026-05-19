<?php $__env->startSection('title', 'Commandes'); ?>
<?php $__env->startSection('page_title', 'Commandes'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-panel','data' => ['accent' => 'cyan','icon' => 'cart3','title' => 'Gestion des commandes','description' => 'Suivi des ventes et livraisons','stat' => $commandes->total() . ' commande' . ($commandes->total() > 1 ? 's' : ''),'statIcon' => 'receipt','addUrl' => route('commandes.create'),'addLabel' => 'Nouvelle commande']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['accent' => 'cyan','icon' => 'cart3','title' => 'Gestion des commandes','description' => 'Suivi des ventes et livraisons','stat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($commandes->total() . ' commande' . ($commandes->total() > 1 ? 's' : '')),'stat-icon' => 'receipt','add-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('commandes.create')),'add-label' => 'Nouvelle commande']); ?>
     <?php $__env->slot('filters', null, []); ?> 
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Recherche client</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom du client..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente" <?php echo e(request('statut') === 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                    <option value="confirmee" <?php echo e(request('statut') === 'confirmee' ? 'selected' : ''); ?>>Confirmée</option>
                    <option value="livree" <?php echo e(request('statut') === 'livree' ? 'selected' : ''); ?>>Livrée</option>
                    <option value="annulee" <?php echo e(request('statut') === 'annulee' ? 'selected' : ''); ?>>Annulée</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filtrer</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('commandes.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
     <?php $__env->endSlot(); ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Commande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Fournisseur</th>
                    <th>Statut</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-bag-check"></i></div>
                            <div>
                                <a href="<?php echo e(route('commandes.show', $commande)); ?>" class="cell-entity-name">
                                    CMD-<?php echo e(str_pad($commande->id, 4, '0', STR_PAD_LEFT)); ?>

                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted small"><?php echo e($commande->date->format('d/m/Y')); ?></td>
                    <td><?php echo e($commande->client?->nom ?? '—'); ?></td>
                    <td class="text-muted small"><?php echo e($commande->fournisseur?->nom ?? '—'); ?></td>
                    <td>
                        <span class="badge badge-stock bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?>">
                            <?php echo e($commande->statut_label); ?>

                        </span>
                    </td>
                    <td class="text-end pe-3">
                        <?php echo $__env->make('partials.action-buttons', [
                            'show' => route('commandes.show', $commande),
                            'edit' => route('commandes.edit', $commande),
                            'destroy' => route('commandes.destroy', $commande),
                            'destroyMessage' => 'Supprimer cette commande ?',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('partials.empty-state', [
                        'icon' => 'cart3',
                        'message' => 'Aucune commande trouvée',
                        'addUrl' => route('commandes.create'),
                        'addLabel' => 'Créer la première commande',
                        'colspan' => 6,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($commandes->hasPages()): ?>
         <?php $__env->slot('footer', null, []); ?> <?php echo e($commandes->links()); ?> <?php $__env->endSlot(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/commandes/index.blade.php ENDPATH**/ ?>