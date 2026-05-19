<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'accent' => 'orange',
    'icon' => 'grid',
    'title' => '',
    'description' => '',
    'stat' => '',
    'statIcon' => 'layers',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
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
    'accent' => 'orange',
    'icon' => 'grid',
    'title' => '',
    'description' => '',
    'stat' => '',
    'statIcon' => 'layers',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div <?php echo e($attributes->merge(['class' => 'data-panel accent-' . $accent . ' mb-4'])); ?>>
    <div class="data-panel-header">
        <div class="data-panel-meta">
            <div class="data-panel-icon"><i class="bi bi-<?php echo e($icon); ?>"></i></div>
            <div>
                <h2 class="data-panel-title"><?php echo e($title); ?></h2>
                <?php if($description): ?>
                    <p class="data-panel-desc"><?php echo e($description); ?></p>
                <?php endif; ?>
            </div>
            <?php if($stat): ?>
                <span class="data-panel-stat">
                    <i class="bi bi-<?php echo e($statIcon); ?>"></i>
                    <?php echo e($stat); ?>

                </span>
            <?php endif; ?>
        </div>
        <?php if($addUrl): ?>
            <a href="<?php echo e($addUrl); ?>" class="btn-add">
                <i class="bi bi-plus-lg"></i> <?php echo e($addLabel); ?>

            </a>
        <?php endif; ?>
    </div>

    <?php if(isset($filters)): ?>
        <div class="filter-bar"><?php echo e($filters); ?></div>
    <?php endif; ?>

    <?php echo e($slot); ?>


    <?php if(isset($footer)): ?>
        <div class="card-footer py-3 px-3"><?php echo e($footer); ?></div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\components\data-panel.blade.php ENDPATH**/ ?>