

<?php $__env->startSection('title', 'Clients'); ?>
<?php $__env->startSection('page_title', 'Clients'); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal874453d1eb4e1c4c0f72ce9b0dc545e5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-panel','data' => ['accent' => 'blue','icon' => 'people','title' => 'Répertoire clients','description' => 'Gérez vos clients et comptes','stat' => $clients->total() . ' client' . ($clients->total() > 1 ? 's' : ''),'statIcon' => 'person-lines-fill','addUrl' => route('clients.create'),'addLabel' => 'Nouveau client']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-panel'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['accent' => 'blue','icon' => 'people','title' => 'Répertoire clients','description' => 'Gérez vos clients et comptes','stat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($clients->total() . ' client' . ($clients->total() > 1 ? 's' : '')),'stat-icon' => 'person-lines-fill','add-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('clients.create')),'add-label' => 'Nouveau client']); ?>
     <?php $__env->slot('filters', null, []); ?> 
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nom ou téléphone..." value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> Rechercher</button>
            </div>
            <div class="col-md-2">
                <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
     <?php $__env->endSlot(); ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Compte</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="cell-entity">
                            <div class="cell-entity-icon"><i class="bi bi-person"></i></div>
                            <div>
                                <a href="<?php echo e(route('clients.show', $client)); ?>" class="cell-entity-name"><?php echo e($client->nom); ?></a>
                            </div>
                        </div>
                    </td>
                    <td class="text-muted small"><?php echo e($client->telephone ?? '—'); ?></td>
                    <td class="text-muted small text-truncate" style="max-width:180px;"><?php echo e($client->adresse ?? '—'); ?></td>
                    <td>
                        <?php if($client->user): ?>
                            <span class="badge-type"><i class="bi bi-person-check"></i> <?php echo e($client->user->email); ?></span>
                        <?php else: ?>
                            <span class="text-muted small">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-3">
                        <?php echo $__env->make('partials.action-buttons', [
                            'show' => route('clients.show', $client),
                            'edit' => route('clients.edit', $client),
                            'destroy' => route('clients.destroy', $client),
                            'destroyMessage' => 'Supprimer ce client ?',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php echo $__env->make('partials.empty-state', [
                        'icon' => 'people',
                        'message' => 'Aucun client trouvé',
                        'addUrl' => route('clients.create'),
                        'addLabel' => 'Ajouter le premier client',
                        'colspan' => 5,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($clients->hasPages()): ?>
         <?php $__env->slot('footer', null, []); ?> <?php echo e($clients->links()); ?> <?php $__env->endSlot(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\clients\index.blade.php ENDPATH**/ ?>