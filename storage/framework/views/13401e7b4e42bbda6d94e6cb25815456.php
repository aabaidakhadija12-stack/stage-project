<?php
    $stockColors = ['6,182,212', '16,185,129', '249,115,22', '244,63,94', '59,130,246', '139,92,246', '245,158,11'];
    $stockMax = max($stockParType->max('total') ?? 1, 1);
?>
<div class="section-label">Analyse & Statistiques</div>
<div class="row g-3 mb-4">

    <div class="col-lg-8">
        <div class="chart-panel accent-cyan h-100">
            <div class="chart-panel-head">
                <h6 class="chart-panel-title">
                    <span class="chart-panel-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    Évolution sur 12 mois
                </h6>
                <div class="chart-legend">
                    <span class="chart-legend-pill"><span class="dot" style="color:#38bdf8;background:#38bdf8"></span> Commandes</span>
                    <span class="chart-legend-pill"><span class="dot" style="color:#34d399;background:#34d399"></span> CA (DH)</span>
                </div>
            </div>
            <div class="chart-panel-body">
                <div class="chart-canvas-wrap">
                    <canvas id="chartEvolution"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="chart-panel accent-amber h-100">
            <div class="chart-panel-head">
                <h6 class="chart-panel-title">
                    <span class="chart-panel-icon"><i class="bi bi-pie-chart-fill"></i></span>
                    Répartition du stock
                </h6>
            </div>
            <div class="chart-panel-body">
                <div class="chart-canvas-wrap sm">
                    <canvas id="chartStock"></canvas>
                </div>
                <div class="stock-breakdown">
                    <?php $__currentLoopData = $stockParType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $pct = round(($item->total / $stockMax) * 100); ?>
                    <div class="stock-row">
                        <div class="stock-row-label">
                            <span class="dot" style="background:rgb(<?php echo e($stockColors[$i % count($stockColors)]); ?>)"></span>
                            <?php echo e($item->type ?? 'Non défini'); ?>

                        </div>
                        <span class="stock-row-val"><?php echo e($item->total); ?> u.</span>
                        <div class="stock-row-bar">
                            <span style="width:<?php echo e($pct); ?>%;--bar-rgb:<?php echo e($stockColors[$i % count($stockColors)]); ?>"></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="chart-panel accent-emerald">
            <div class="chart-panel-head">
                <h6 class="chart-panel-title">
                    <span class="chart-panel-icon"><i class="bi bi-calendar-month"></i></span>
                    CA ce mois
                </h6>
            </div>
            <div class="chart-panel-body">
                <div class="stat-mini">
                    <div class="stat-mini-val"><?php echo e(number_format($caThisMonth, 0, ',', ' ')); ?> <small style="font-size:.55em;-webkit-text-fill-color:#94a3b8">DH</small></div>
                    <div class="stat-mini-lbl"><?php echo e(now()->translatedFormat('F Y')); ?></div>
                </div>
                <div class="stat-mini-grid">
                    <div class="stat-mini-cell">
                        <div class="v"><?php echo e(number_format($caLastMonth, 0, ',', ' ')); ?> DH</div>
                        <div class="l">Mois précédent</div>
                    </div>
                    <div class="stat-mini-cell">
                        <div class="v <?php echo e($caEvolution >= 0 ? 'text-success' : 'text-danger'); ?>">
                            <?php echo e($caEvolution >= 0 ? '+' : ''); ?><?php echo e($caEvolution); ?>%
                        </div>
                        <div class="l">Évolution</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="chart-panel accent-violet">
            <div class="chart-panel-head">
                <h6 class="chart-panel-title">
                    <span class="chart-panel-icon"><i class="bi bi-bar-chart-steps"></i></span>
                    Statuts commandes
                </h6>
            </div>
            <div class="chart-panel-body">
                <?php
                    $totalCmd = max($stats['commandes'], 1);
                    $statuts = [
                        ['label'=>'Livrées',    'count'=>$stats['commandes_livrees'],    'rgb'=>'16,185,129'],
                        ['label'=>'En attente', 'count'=>$stats['commandes_en_attente'], 'rgb'=>'245,158,11'],
                        ['label'=>'Annulées',   'count'=>$stats['commandes_annulees'],   'rgb'=>'244,63,94'],
                    ];
                ?>
                <div class="cmd-status-list">
                    <?php $__currentLoopData = $statuts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cmd-status-item">
                        <div class="top">
                            <span><?php echo e($s['label']); ?></span>
                            <span><?php echo e($s['count']); ?> <span class="text-muted fw-normal">(<?php echo e(round(($s['count']/$totalCmd)*100)); ?>%)</span></span>
                        </div>
                        <div class="cmd-status-track">
                            <div class="cmd-status-fill" style="width:<?php echo e(round(($s['count']/$totalCmd)*100)); ?>%;--fill-rgb:<?php echo e($s['rgb']); ?>;background:linear-gradient(90deg,rgba(<?php echo e($s['rgb']); ?>,.95),rgba(<?php echo e($s['rgb']); ?>,.35))"></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="chart-panel accent-rose">
            <div class="chart-panel-head">
                <h6 class="chart-panel-title">
                    <span class="chart-panel-icon"><i class="bi bi-receipt-cutoff"></i></span>
                    Factures
                </h6>
            </div>
            <div class="chart-panel-body">
                <div class="stat-mini">
                    <div class="stat-mini-val"><?php echo e($stats['factures']); ?></div>
                    <div class="stat-mini-lbl">Factures émises</div>
                </div>
                <div class="stat-mini-grid">
                    <div class="stat-mini-cell" style="grid-column:1/-1">
                        <div class="v text-success"><?php echo e(number_format($chiffreAffaires, 0, ',', ' ')); ?> DH</div>
                        <div class="l">Total facturé</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\dashboard\_analytics.blade.php ENDPATH**/ ?>