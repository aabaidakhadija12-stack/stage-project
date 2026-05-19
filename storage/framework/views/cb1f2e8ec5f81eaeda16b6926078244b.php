<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'show' => null,
    'edit' => null,
    'pdf' => null,
    'destroy' => null,
    'destroyMessage' => 'Supprimer cet élément ?',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'show' => null,
    'edit' => null,
    'pdf' => null,
    'destroy' => null,
    'destroyMessage' => 'Supprimer cet élément ?',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="action-group">
    <?php if($show): ?>
    <a href="<?php echo e($show); ?>" class="action-btn view" title="Voir les détails">
        <i class="bi bi-eye"></i>
    </a>
    <?php endif; ?>
    <?php if($edit): ?>
    <a href="<?php echo e($edit); ?>" class="action-btn edit" title="Modifier">
        <i class="bi bi-pencil-square"></i>
    </a>
    <?php endif; ?>
    <?php if($pdf): ?>
    <a href="<?php echo e($pdf); ?>" class="action-btn edit" title="Télécharger PDF" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i>
    </a>
    <?php endif; ?>
    <?php if($destroy): ?>
    <form method="POST" action="<?php echo e($destroy); ?>" onsubmit="return confirm(<?php echo json_encode($destroyMessage, 15, 512) ?>)">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button type="submit" class="action-btn delete" title="Supprimer">
            <i class="bi bi-trash3"></i>
        </button>
    </form>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views/partials/action-buttons.blade.php ENDPATH**/ ?>