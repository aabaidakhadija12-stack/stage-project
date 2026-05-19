

<?php $__env->startSection('title', 'Maintenances'); ?>
<?php $__env->startSection('page_title', 'Maintenances'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-panel','data' => ['accent' => 'rose','icon' => 'tools','title' => 'Maintenances','description' => 'Interventions et suivi technique','stat' => $maintenances->total() . ' intervention' . ($maintenances->total() > 1 ? 's' : ''),'statIcon' => 'wrench-adjustable','addUrl' => route('maintenances.create'),'addLabel' => 'Nouvelle maintenance']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['accent' => 'rose','icon' => 'tools','title' => 'Maintenances','description' => 'Interventions et suivi technique','stat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maintenances->total() . ' intervention' . ($maintenances->total() > 1 ? 's' : '')),'stat-icon' => 'wrench-adjustable','add-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('maintenances.create')),'add-label' => 'Nouvelle maintenance']); ?>
     <?php $__env->slot('filters', null, []); ?> 
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Produit ou type..." value="<?php echo e(request('search')); ?>">
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
                <a href="<?php echo e(route('maintenances.index')); ?>" class="btn btn-outline-secondary w-100">
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
                    <th>Date</th>
                    <th>Description</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <?php if($maintenance->produit): ?>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-tools"></i></div>
                            <div>
                                <a href="<?php echo e(route('produits.show', $maintenance->produit)); ?>" class="cell-entity-name">
                                    <?php echo e($maintenance->produit->nom); ?>

                                </a>
                            </div>
                        </div>
                        <?php else: ?>
                            <span class="text-muted">—</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge-type"><i class="bi bi-wrench"></i> <?php echo e($maintenance->type); ?></span></td>
                    <td class="text-muted small"><?php echo e($maintenance->date->format('d/m/Y')); ?></td>
                    <td class="cell-entity-desc text-truncate" style="max-width:200px;"><?php echo e($maintenance->description ?? '—'); ?></td>
                    <td class="text-end pe-3">
                        <?php echo $__env->make('partials.action-buttons', [
                            'edit' => route('maintenances.edit', $maintenance),
                            'destroy' => route('maintenances.destroy', $maintenance),
                            'destroyMessage' => 'Supprimer cette maintenance ?',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('partials.empty-state', [
                        'icon' => 'tools',
                        'message' => 'Aucune maintenance enregistrée',
                        'addUrl' => route('maintenances.create'),
                        'addLabel' => 'Créer la première maintenance',
                        'colspan' => 5,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($maintenances->hasPages()): ?>
         <?php $__env->slot('footer', null, []); ?> <?php echo e($maintenances->links()); ?> <?php $__env->endSlot(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\maintenances\index.blade.php ENDPATH**/ ?>