

<?php $__env->startSection('title', 'Tableau de bord'); ?>

<?php $__env->startSection('page_title', 'Tableau de bord'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .kpi-card { border-radius:14px !important; transition:transform .22s,box-shadow .22s; overflow:hidden; position:relative; cursor:default; border:1px solid rgba(255,255,255,.1) !important; }
    .kpi-card:hover { transform:translateY(-4px); box-shadow:0 12px 35px rgba(0,0,0,.4) !important; }
    .kpi-card .card-body { padding:1.3rem 1.4rem; }
    .kpi-purple  { background:linear-gradient(135deg,#4f46e5,#7c3aed); }
    .kpi-cyan    { background:linear-gradient(135deg,#0891b2,#06b6d4); }
    .kpi-rose    { background:linear-gradient(135deg,#be185d,#f43f5e); }
    .kpi-emerald { background:linear-gradient(135deg,#065f46,#10b981); }
    .kpi-violet  { background:linear-gradient(135deg,#6d28d9,#a855f7); }
    .kpi-slate   { background:linear-gradient(135deg,#1e293b,#475569); }
    .kpi-icon-wrap { width:46px;height:46px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fff;flex-shrink:0; }
    .kpi-val  { font-size:1.75rem;font-weight:800;color:#fff;line-height:1.1;letter-spacing:-.03em; }
    .kpi-lbl  { font-size:.63rem;color:rgba(255,255,255,.65);font-weight:600;text-transform:uppercase;letter-spacing:.1em;margin-top:3px; }
    .kpi-sub  { font-size:.72rem;color:rgba(255,255,255,.75);margin-top:6px; }
    .kpi-trend { font-size:.72rem;font-weight:600;margin-top:6px; }
    .kpi-trend.up   { color:#6ee7b7; }
    .kpi-trend.down { color:#fca5a5; }
    .kpi-trend.flat { color:rgba(255,255,255,.45); }
    .kpi-bg-icon { position:absolute;right:-6px;bottom:-6px;font-size:5rem;color:rgba(255,255,255,.06);line-height:1;pointer-events:none; }
    /* Analytics panels */
    .chart-panel {
        --chart-accent: 249, 115, 22;
        background: linear-gradient(160deg, rgba(var(--chart-accent), .06) 0%, rgba(255,255,255,.02) 45%);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0,0,0,.35);
        position: relative;
        height: 100%;
    }
    .chart-panel::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, rgb(var(--chart-accent)), transparent);
    }
    .chart-panel.accent-cyan    { --chart-accent: 6, 182, 212; }
    .chart-panel.accent-emerald { --chart-accent: 16, 185, 129; }
    .chart-panel.accent-violet  { --chart-accent: 139, 92, 246; }
    .chart-panel.accent-amber   { --chart-accent: 245, 158, 11; }
    .chart-panel.accent-rose    { --chart-accent: 244, 63, 94; }

    .chart-panel-head {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: .75rem;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }
    .chart-panel-title {
        display: flex; align-items: center; gap: .65rem;
        font-size: .88rem; font-weight: 700; color: #f1f5f9; margin: 0;
    }
    .chart-panel-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #fff;
        background: linear-gradient(135deg, rgba(var(--chart-accent), .9), rgba(var(--chart-accent), .45));
        box-shadow: 0 4px 14px rgba(var(--chart-accent), .35);
    }
    .chart-legend { display: flex; gap: .5rem; flex-wrap: wrap; }
    .chart-legend-pill {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .28rem .65rem; border-radius: 20px;
        font-size: .68rem; font-weight: 600;
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.08);
        color: #94a3b8;
    }
    .chart-legend-pill .dot {
        width: 8px; height: 8px; border-radius: 50%;
        box-shadow: 0 0 8px currentColor;
    }
    .chart-panel-body { padding: 1rem 1.25rem 1.25rem; }
    .chart-canvas-wrap { position: relative; height: 280px; }
    .chart-canvas-wrap.sm { height: 220px; }

    .stock-breakdown { margin-top: 1rem; display: flex; flex-direction: column; gap: .55rem; }
    .stock-row { display: grid; grid-template-columns: 1fr auto; gap: .5rem; align-items: center; }
    .stock-row-label {
        display: flex; align-items: center; gap: .45rem;
        font-size: .72rem; color: #94a3b8; font-weight: 500;
    }
    .stock-row-label .dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .stock-row-val { font-size: .72rem; font-weight: 700; color: #e2e8f0; }
    .stock-row-bar {
        grid-column: 1 / -1; height: 5px; border-radius: 10px;
        background: rgba(255,255,255,.06); overflow: hidden;
    }
    .stock-row-bar span {
        display: block; height: 100%; border-radius: 10px;
        background: linear-gradient(90deg, rgba(var(--bar-rgb), .9), rgba(var(--bar-rgb), .4));
        transition: width .6s cubic-bezier(.34, 1.2, .64, 1);
    }

    .stat-mini {
        text-align: center; padding: 1.25rem 1rem;
        background: rgba(0,0,0,.15);
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,.05);
    }
    .stat-mini-val {
        font-size: 1.85rem; font-weight: 800; letter-spacing: -.03em;
        background: linear-gradient(135deg, #fff 30%, rgb(var(--chart-accent)));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .stat-mini-lbl { font-size: .68rem; color: #64748b; margin-top: .25rem; text-transform: uppercase; letter-spacing: .08em; }
    .stat-mini-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .65rem; margin-top: 1rem; }
    .stat-mini-cell {
        padding: .65rem; border-radius: 10px;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.06);
        text-align: center;
    }
    .stat-mini-cell .v { font-size: .95rem; font-weight: 700; color: #f1f5f9; }
    .stat-mini-cell .l { font-size: .62rem; color: #64748b; margin-top: 2px; }

    .cmd-status-list { display: flex; flex-direction: column; gap: 1rem; }
    .cmd-status-item .top { display: flex; justify-content: space-between; font-size: .75rem; margin-bottom: .4rem; }
    .cmd-status-item .top span:first-child { color: #94a3b8; }
    .cmd-status-item .top span:last-child { font-weight: 700; color: #f1f5f9; }
    .cmd-status-track {
        height: 8px; border-radius: 20px;
        background: rgba(255,255,255,.06); overflow: hidden;
    }
    .cmd-status-fill {
        height: 100%; border-radius: 20px;
        transition: width .8s cubic-bezier(.34, 1.2, .64, 1);
        box-shadow: 0 0 12px rgba(var(--fill-rgb), .5);
    }

    .table-card { border-radius:14px !important; overflow:hidden; }
    .section-label { font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.14em;color:#64748b;margin-bottom:.85rem; }
    .status-dot { width:7px;height:7px;border-radius:50%;display:inline-block;margin-right:5px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php if($stats['stock_rupture'] > 0 || $stats['stock_faible'] > 0 || $stats['commandes_en_attente'] > 0): ?>
<div class="row g-2 mb-4">
    <?php if($stats['stock_rupture'] > 0): ?>
    <div class="col-auto">
        <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-0 rounded-3 small">
            <i class="bi bi-x-circle-fill"></i>
            <span><strong><?php echo e($stats['stock_rupture']); ?></strong> produit(s) en rupture</span>
        </div>
    </div>
    <?php endif; ?>
    <?php if($stats['stock_faible'] > 0): ?>
    <div class="col-auto">
        <div class="alert alert-warning d-flex align-items-center gap-2 py-2 px-3 mb-0 rounded-3 small">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span><strong><?php echo e($stats['stock_faible']); ?></strong> produit(s) stock faible</span>
        </div>
    </div>
    <?php endif; ?>
    <?php if($stats['commandes_en_attente'] > 0): ?>
    <div class="col-auto">
        <div class="alert alert-info d-flex align-items-center gap-2 py-2 px-3 mb-0 rounded-3 small">
            <i class="bi bi-clock-fill"></i>
            <span><strong><?php echo e($stats['commandes_en_attente']); ?></strong> commande(s) en attente</span>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>


<div class="section-label">Indicateurs clés</div>
<div class="row g-3 mb-4">

    <?php if(auth()->user()->isAdmin()): ?>
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-emerald h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-cash-stack"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e(number_format($chiffreAffaires, 0, ',', ' ')); ?> DH</div>
                    <div class="kpi-lbl">Chiffre d'affaires</div>
                    <?php if($caEvolution > 0): ?>
                        <div class="kpi-trend up"><i class="bi bi-arrow-up-short"></i>+<?php echo e($caEvolution); ?>% ce mois</div>
                    <?php elseif($caEvolution < 0): ?>
                        <div class="kpi-trend down"><i class="bi bi-arrow-down-short"></i><?php echo e($caEvolution); ?>% ce mois</div>
                    <?php else: ?>
                        <div class="kpi-trend flat"><i class="bi bi-dash"></i> Stable</div>
                    <?php endif; ?>
                </div>
                <i class="bi bi-cash-stack kpi-bg-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-purple h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-boxes"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e(number_format($valeurStock, 0, ',', ' ')); ?> DH</div>
                    <div class="kpi-lbl">Valeur du stock</div>
                    <div class="kpi-sub"><?php echo e($stats['produits']); ?> références · <?php echo e($stats['stock_rupture']); ?> ruptures</div>
                </div>
                <i class="bi bi-boxes kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isClient()): ?>
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-rose h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-cart3"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e($stats['commandes']); ?></div>
                    <div class="kpi-lbl">Commandes totales</div>
                    <div class="kpi-sub"><?php echo e($stats['commandes_livrees']); ?> livrées · <?php echo e($stats['commandes_en_attente']); ?> en attente</div>
                </div>
                <i class="bi bi-cart3 kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isAdmin()): ?>
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-cyan h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-people"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e($stats['clients']); ?></div>
                    <div class="kpi-lbl">Clients actifs</div>
                    <div class="kpi-sub"><?php echo e($stats['fournisseurs']); ?> fournisseurs partenaires</div>
                </div>
                <i class="bi bi-people kpi-bg-icon"></i>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-violet h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-receipt"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e($stats['factures']); ?></div>
                    <div class="kpi-lbl">Factures émises</div>
                    <div class="kpi-sub">Total : <?php echo e(number_format($chiffreAffaires, 0, ',', ' ')); ?> DH</div>
                </div>
                <i class="bi bi-receipt kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isTechnicien()): ?>
    <div class="col-6 col-xl-4">
        <div class="card kpi-card kpi-slate h-100">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="kpi-icon-wrap"><i class="bi bi-tools"></i></div>
                <div class="flex-grow-1">
                    <div class="kpi-val"><?php echo e($stats['maintenances']); ?></div>
                    <div class="kpi-lbl">Maintenances</div>
                    <div class="kpi-sub">Total interventions techniques</div>
                </div>
                <i class="bi bi-tools kpi-bg-icon"></i>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>


<?php if(auth()->user()->isAdmin()): ?>
    <?php echo $__env->make('dashboard.analytics', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>


<div class="section-label">Activité récente</div>
<div class="row g-3">

    <?php if(auth()->user()->isAdmin() || auth()->user()->isClient()): ?>
    <div class="col-lg-7">
        <div class="card table-card table-pro-card accent-cyan shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-cart3 me-2" style="color:rgb(6,182,212)"></i>Dernières commandes</h6>
                <a href="<?php echo e(route('commandes.index')); ?>" class="btn btn-sm btn-outline-primary rounded-3">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Réf.</th><th>Client</th><th>Date</th><th>Statut</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dernieres_commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('commandes.show', $commande)); ?>" class="text-decoration-none fw-semibold text-primary">CMD-<?php echo e(str_pad($commande->id,4,'0',STR_PAD_LEFT)); ?></a></td>
                            <td><?php echo e($commande->client?->nom ?? '—'); ?></td>
                            <td class="text-muted small"><?php echo e($commande->date->format('d/m/Y')); ?></td>
                            <td><span class="badge rounded-pill bg-<?php echo e($commande->statut_badge); ?>-subtle text-<?php echo e($commande->statut_badge); ?> px-3"><?php echo e($commande->statut_label); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-1"></i>Aucune commande</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isTechnicien()): ?>
    <div class="col-lg-5">
        <div class="card table-card table-pro-card accent-orange shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-exclamation-triangle me-2" style="color:rgb(249,115,22)"></i>Stock critique</h6>
                <a href="<?php echo e(route('produits.index')); ?>" class="btn btn-sm btn-outline-warning rounded-3">Gérer</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Produit</th><th>Type</th><th class="text-center">Stock</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $produits_stock_faible; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><a href="<?php echo e(route('produits.show', $produit)); ?>" class="text-decoration-none fw-medium"><?php echo e($produit->nom); ?></a></td>
                            <td class="text-muted small"><?php echo e($produit->type ?? '—'); ?></td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-<?php echo e($produit->quantiteStock === 0 ? 'danger' : 'warning'); ?>-subtle text-<?php echo e($produit->quantiteStock === 0 ? 'danger' : 'warning'); ?> px-3">
                                    <?php echo e($produit->quantiteStock === 0 ? 'Rupture' : $produit->quantiteStock.' u.'); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="text-center text-muted py-4"><i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>Stocks suffisants</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php if(auth()->user()->isAdmin() || auth()->user()->isTechnicien()): ?>
<div class="row g-3 mt-0">
    <div class="col-12">
        <div class="card table-card table-pro-card accent-rose shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="fw-semibold mb-0"><i class="bi bi-tools me-2" style="color:rgb(244,63,94)"></i>Maintenances récentes</h6>
                <a href="<?php echo e(route('maintenances.index')); ?>" class="btn btn-sm btn-outline-secondary rounded-3">Voir tout</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Produit</th><th>Type</th><th>Date</th><th>Description</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $dernieres_maintenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maintenance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-medium"><?php echo e($maintenance->produit?->nom ?? '—'); ?></td>
                            <td><span class="badge bg-secondary-subtle text-secondary rounded-pill px-3"><?php echo e($maintenance->type); ?></span></td>
                            <td class="text-muted small"><?php echo e($maintenance->date->format('d/m/Y')); ?></td>
                            <td class="text-muted small text-truncate" style="max-width:200px;"><?php echo e($maintenance->description ?? '—'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4"><i class="bi bi-wrench fs-4 d-block mb-1"></i>Aucune maintenance</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php if(auth()->user()->isAdmin()): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
    Chart.defaults.color = '#64748b';
    Chart.defaults.borderColor = 'rgba(255,255,255,.06)';

    var gridColor = 'rgba(255,255,255,.06)';
    var tooltip = {
        backgroundColor: 'rgba(15,15,26,.95)',
        titleColor: '#f1f5f9',
        bodyColor: '#94a3b8',
        borderColor: 'rgba(255,255,255,.1)',
        borderWidth: 1,
        padding: 14,
        cornerRadius: 10,
        displayColors: true,
        boxPadding: 6
    };

    function gradient(ctx, c1, c2) {
        var g = ctx.createLinearGradient(0, 0, 0, 280);
        g.addColorStop(0, c1);
        g.addColorStop(1, c2);
        return g;
    }

    var ctxEvo = document.getElementById('chartEvolution');
    if (ctxEvo) {
        var c = ctxEvo.getContext('2d');
        new Chart(ctxEvo, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
                datasets: [
                    {
                        label: 'Commandes',
                        data: <?php echo json_encode($chartCommandes, 15, 512) ?>,
                        borderColor: '#38bdf8',
                        backgroundColor: gradient(c, 'rgba(56,189,248,.25)', 'rgba(56,189,248,0)'),
                        borderWidth: 2.5,
                        pointBackgroundColor: '#0f0f1a',
                        pointBorderColor: '#38bdf8',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.42,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'CA (DH)',
                        data: <?php echo json_encode($chartCA, 15, 512) ?>,
                        borderColor: '#34d399',
                        backgroundColor: gradient(c, 'rgba(52,211,153,.2)', 'rgba(52,211,153,0)'),
                        borderWidth: 2.5,
                        pointBackgroundColor: '#0f0f1a',
                        pointBorderColor: '#34d399',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.42,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false }, tooltip: tooltip },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b', font: { size: 10 }, maxRotation: 45 }
                    },
                    y: {
                        position: 'left',
                        grid: { color: gridColor },
                        ticks: { color: '#64748b', stepSize: 1, font: { size: 10 } },
                        title: { display: true, text: 'Commandes', color: '#94a3b8', font: { size: 10, weight: '600' } }
                    },
                    y1: {
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { color: '#64748b', font: { size: 10 } },
                        title: { display: true, text: 'CA (DH)', color: '#94a3b8', font: { size: 10, weight: '600' } }
                    }
                }
            }
        });
    }

    var stockColors = ['#38bdf8','#34d399','#fb923c','#fb7185','#60a5fa','#a78bfa','#fbbf24'];
    var ctxStock = document.getElementById('chartStock');
    if (ctxStock) {
        new Chart(ctxStock, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($stockParType->pluck('type'), 15, 512) ?>,
                datasets: [{
                    data: <?php echo json_encode($stockParType->pluck('total'), 15, 512) ?>,
                    backgroundColor: stockColors,
                    borderWidth: 0,
                    hoverOffset: 10,
                    spacing: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: tooltip
                }
            }
        });
    }
})();
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\dashboard\index.blade.php ENDPATH**/ ?>