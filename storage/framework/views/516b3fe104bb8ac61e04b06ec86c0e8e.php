

<?php $__env->startSection('title', 'Produits'); ?>
<?php $__env->startSection('page_title', 'Produits'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-panel','data' => ['accent' => 'orange','icon' => 'box-seam','title' => 'Catalogue produits','description' => 'Gérez votre stock et vos équipements','stat' => $produits->total() . ' produit' . ($produits->total() > 1 ? 's' : ''),'statIcon' => 'layers','addUrl' => route('produits.create'),'addLabel' => 'Nouveau produit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['accent' => 'orange','icon' => 'box-seam','title' => 'Catalogue produits','description' => 'Gérez votre stock et vos équipements','stat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($produits->total() . ' produit' . ($produits->total() > 1 ? 's' : '')),'stat-icon' => 'layers','add-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('produits.create')),'add-label' => 'Nouveau produit']); ?>
     <?php $__env->slot('filters', null, []); ?> 
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom ou type..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select">
                    <option value="">Tous les types</option>
                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php echo e(request('type') === $type ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Filtrer</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('produits.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
     <?php $__env->endSlot(); ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon">
                                <i class="bi bi-<?php echo e(match(true) {
                                    str_contains(strtolower($produit->type ?? ''), 'extincteur') => 'fire',
                                    str_contains(strtolower($produit->type ?? ''), 'détection') || str_contains(strtolower($produit->type ?? ''), 'detect') => 'broadcast',
                                    str_contains(strtolower($produit->type ?? ''), 'robinet') => 'droplet',
                                    default => 'box-seam',
                                }); ?>"></i>
                            </div>
                            <div>
                                <a href="<?php echo e(route('produits.show', $produit)); ?>" class="cell-entity-name"><?php echo e($produit->nom); ?></a>
                                <?php if($produit->description): ?>
                                    <div class="cell-entity-desc text-truncate d-block" style="max-width:220px;"><?php echo e($produit->description); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if($produit->type): ?>
                            <span class="badge-type"><i class="bi bi-tag"></i> <?php echo e($produit->type); ?></span>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="cell-price"><?php echo e(number_format($produit->prix, 2, ',', ' ')); ?> <small>DH</small></span></td>
                    <td>
                        <?php if($produit->quantiteStock === 0): ?>
                            <span class="badge-stock bg-danger-subtle text-danger">Rupture</span>
                        <?php elseif($produit->quantiteStock < 5): ?>
                            <span class="badge-stock bg-warning-subtle text-warning"><?php echo e($produit->quantiteStock); ?> faible</span>
                        <?php else: ?>
                            <span class="badge-stock bg-success-subtle text-success"><?php echo e($produit->quantiteStock); ?> en stock</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-3">
                        <?php echo $__env->make('partials.action-buttons', [
                            'show' => route('produits.show', $produit),
                            'edit' => route('produits.edit', $produit),
                            'destroy' => route('produits.destroy', $produit),
                            'destroyMessage' => 'Supprimer ce produit ?',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('partials.empty-state', [
                        'icon' => 'box-seam',
                        'message' => 'Aucun produit trouvé',
                        'addUrl' => route('produits.create'),
                        'addLabel' => 'Créer le premier produit',
                        'colspan' => 5,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($produits->hasPages()): ?>
         <?php $__env->slot('footer', null, []); ?> <?php echo e($produits->links()); ?> <?php $__env->endSlot(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\produits\index.blade.php ENDPATH**/ ?>