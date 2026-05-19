

<?php $__env->startSection('title', 'Modifier commande #' . $commande->id); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('commandes.index')); ?>" class="text-decoration-none">Commandes</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('commandes.show', $commande)); ?>" class="text-decoration-none">#<?php echo e($commande->id); ?></a></li>
    <li class="breadcrumb-item active">Modifier</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Modifier la commande #<?php echo e($commande->id); ?></h4>
        <p class="text-muted small mb-0">Mise à jour des informations de la commande</p>
    </div>
    <a href="<?php echo e(route('commandes.show', $commande)); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('commandes.update', $commande)); ?>">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label for="date" class="form-label fw-medium">Date <span class="text-danger">*</span></label>
                        <input type="date" id="date" name="date"
                               class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('date', $commande->date->format('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="statut" class="form-label fw-medium">Statut <span class="text-danger">*</span></label>
                        <select id="statut" name="statut"
                                class="form-select <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="en_attente" <?php echo e(old('statut', $commande->statut) === 'en_attente' ? 'selected' : ''); ?>>En attente</option>
                            <option value="confirmee"  <?php echo e(old('statut', $commande->statut) === 'confirmee'  ? 'selected' : ''); ?>>Confirmée</option>
                            <option value="livree"     <?php echo e(old('statut', $commande->statut) === 'livree'     ? 'selected' : ''); ?>>Livrée</option>
                            <option value="annulee"    <?php echo e(old('statut', $commande->statut) === 'annulee'    ? 'selected' : ''); ?>>Annulée</option>
                        </select>
                        <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-medium">Client</label>
                        <select id="client_id" name="client_id" class="form-select">
                            <option value="">— Aucun client —</option>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->id); ?>"
                                    <?php echo e(old('client_id', $commande->client_id) == $client->id ? 'selected' : ''); ?>>
                                    <?php echo e($client->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fournisseur_id" class="form-label fw-medium">Fournisseur</label>
                        <select id="fournisseur_id" name="fournisseur_id" class="form-select">
                            <option value="">— Aucun fournisseur —</option>
                            <?php $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($f->id); ?>"
                                    <?php echo e(old('fournisseur_id', $commande->fournisseur_id) == $f->id ? 'selected' : ''); ?>>
                                    <?php echo e($f->nom); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Mettre à jour
                        </button>
                        <a href="<?php echo e(route('commandes.show', $commande)); ?>" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\commandes\edit.blade.php ENDPATH**/ ?>