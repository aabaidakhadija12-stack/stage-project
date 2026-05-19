<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => 'inbox',
    'message' => 'Aucun élément trouvé',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
    'colspan' => 1,
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
    'icon' => 'inbox',
    'message' => 'Aucun élément trouvé',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
    'colspan' => 1,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<tr>
    <td colspan="<?php echo e($colspan); ?>">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-<?php echo e($icon); ?>"></i></div>
            <p class="text-muted mb-2"><?php echo e($message); ?></p>
            <?php if($addUrl): ?>
                <a href="<?php echo e($addUrl); ?>" class="btn-add">
                    <i class="bi bi-plus-lg"></i> <?php echo e($addLabel); ?>

                </a>
            <?php endif; ?>
        </div>
    </td>
</tr>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\partials\empty-state.blade.php ENDPATH**/ ?>