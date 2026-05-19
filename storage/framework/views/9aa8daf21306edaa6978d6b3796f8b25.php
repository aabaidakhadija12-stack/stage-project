

<?php $__env->startSection('title', 'Modifier — ' . $fournisseur->nom); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('fournisseurs.index')); ?>" class="text-decoration-none">Fournisseurs</a></li>
    <li class="breadcrumb-item active"><?php echo e($fournisseur->nom); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Modifier le fournisseur</h4>
        <p class="text-muted small mb-0"><?php echo e($fournisseur->nom); ?></p>
    </div>
    <a href="<?php echo e(route('fournisseurs.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header py-3" style="border-bottom:1px solid rgba(255,255,255,.07);">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:28px;height:28px;border-radius:7px;background:rgba(245,158,11,.2);display:flex;align-items:center;justify-content:center;color:#f59e0b;font-size:.85rem;"><i class="bi bi-pencil"></i></div>
                    <span style="font-weight:700;color:#f1f5f9;font-size:.82rem;">Modifier — <?php echo e($fournisseur->nom); ?></span>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('fournisseurs.update', $fournisseur)); ?>">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label fw-medium">Nom <span class="text-danger">*</span></label>
                        <input type="text" id="nom" name="nom"
                               class="form-control <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('nom', $fournisseur->nom)); ?>" required autofocus>
                        <?php $__errorArgs = ['nom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="form-label fw-medium">Contact</label>
                        <input type="text" id="contact" name="contact"
                               class="form-control <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('contact', $fournisseur->contact)); ?>">
                        <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>Mettre à jour
                        </button>
                        <a href="<?php echo e(route('fournisseurs.index')); ?>" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/fournisseurs/edit.blade.php ENDPATH**/ ?>