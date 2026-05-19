<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'AQUA MAB'); ?> — Gestion de Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-w:  240px;
            --bg:         #0d0d1a;
            --bg2:        #12122a;
            --bg3:        #1a1a35;
            --card-bg:    rgba(255,255,255,.04);
            --card-border:rgba(255,255,255,.08);
            --sidebar-bg: #0a0a1f;
            --primary:    #e63946;
            --primary-l:  #f97316;
            --accent:     #f97316;
            --accent2:    #10b981;
            --danger:     #f43f5e;
            --warning:    #f59e0b;
            --text:       #e2e8f0;
            --text-muted: #64748b;
            --border:     rgba(255,255,255,.07);
            --radius:     14px;
            --radius-sm:  9px;
            --glow-purple: 0 0 20px rgba(230,57,70,.25);
            --glow-cyan:   0 0 20px rgba(249,115,22,.2);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 13.5px;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* ══════════════════════════════
           SIDEBAR
        ══════════════════════════════ */
        #sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            background:
                radial-gradient(ellipse 120% 80% at 0% 0%, rgba(230,57,70,.12) 0%, transparent 55%),
                radial-gradient(ellipse 80% 60% at 100% 100%, rgba(249,115,22,.08) 0%, transparent 50%),
                var(--sidebar-bg);
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
            overflow: hidden;
        }
        .sb-brand {
            padding: 1.4rem 1.2rem 1.2rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: .8rem;
            flex-shrink: 0;
        }
        .sb-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #fff; flex-shrink: 0;
            box-shadow: var(--glow-purple);
            animation: sb-brand-pulse 3s ease-in-out infinite;
        }
        @keyframes sb-brand-pulse {
            0%, 100% { box-shadow: 0 0 12px rgba(230,57,70,.35); }
            50%       { box-shadow: 0 0 22px rgba(249,115,22,.5); }
        }
        .sb-name { color: #fff; font-size: .95rem; font-weight: 700; letter-spacing: -.01em; }
        .sb-sub  { color: var(--text-muted); font-size: .6rem; text-transform: uppercase; letter-spacing: .1em; }

        .sb-nav { flex: 1; overflow-y: auto; padding: .5rem 0; min-height: 0; }
        .sb-nav::-webkit-scrollbar { width: 3px; }
        .sb-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }

        .sb-section {
            color: var(--text-muted);
            font-size: .58rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .14em;
            padding: .85rem 1.2rem .35rem;
            display: flex; align-items: center; gap: .5rem;
        }
        .sb-section::after {
            content: '';
            flex: 1; height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,.08), transparent);
        }

        .sb-link {
            --sb-accent: 230, 57, 70;
            display: flex; align-items: center; gap: .75rem;
            color: #94a3b8;
            text-decoration: none;
            padding: .5rem .75rem .5rem .85rem;
            margin: 2px .55rem;
            border-radius: var(--radius-sm);
            font-size: .8rem; font-weight: 500;
            position: relative;
            overflow: hidden;
            transition: color .25s ease, background .25s ease, transform .22s ease, box-shadow .25s ease;
            animation: sb-fade-in .4s ease backwards;
        }
        .sb-nav a.sb-link:nth-of-type(1) { animation-delay: .05s; }
        .sb-nav a.sb-link:nth-of-type(2) { animation-delay: .10s; }
        .sb-nav a.sb-link:nth-of-type(3) { animation-delay: .15s; }
        .sb-nav a.sb-link:nth-of-type(4) { animation-delay: .20s; }
        .sb-nav a.sb-link:nth-of-type(5) { animation-delay: .25s; }
        .sb-nav a.sb-link:nth-of-type(6) { animation-delay: .30s; }
        .sb-nav a.sb-link:nth-of-type(7) { animation-delay: .35s; }

        @keyframes sb-fade-in {
            from { opacity: 0; transform: translateX(-8px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .sb-link::before {
            content: '';
            position: absolute; left: 0; top: 50%;
            width: 3px; height: 0;
            border-radius: 0 4px 4px 0;
            background: rgb(var(--sb-accent));
            transform: translateY(-50%);
            transition: height .25s cubic-bezier(.34, 1.2, .64, 1);
            box-shadow: 0 0 10px rgba(var(--sb-accent), .6);
        }
        .sb-link::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg, rgba(var(--sb-accent), .14), transparent 70%);
            opacity: 0;
            transition: opacity .25s ease;
            pointer-events: none;
        }

        .sb-icon-wrap {
            width: 32px; height: 32px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: .95rem;
            background: rgba(var(--sb-accent), .12);
            color: rgb(var(--sb-accent));
            transition: transform .25s cubic-bezier(.34, 1.2, .64, 1),
                        background .25s ease,
                        box-shadow .25s ease,
                        color .25s ease;
        }
        .sb-label { flex: 1; line-height: 1.2; }

        .sb-link:hover {
            color: #f1f5f9;
            transform: translateX(4px);
            background: rgba(255,255,255,.05);
        }
        .sb-link:hover::before { height: 55%; }
        .sb-link:hover::after  { opacity: 1; }
        .sb-link:hover .sb-icon-wrap {
            transform: scale(1.1) rotate(-3deg);
            background: rgba(var(--sb-accent), .22);
            box-shadow: 0 4px 14px rgba(var(--sb-accent), .3);
        }

        .sb-link.active {
            color: #fff;
            font-weight: 600;
            background: rgba(var(--sb-accent), .12);
            box-shadow: inset 0 0 0 1px rgba(var(--sb-accent), .2);
        }
        .sb-link.active::before { height: 70%; }
        .sb-link.active::after  { opacity: 1; }
        .sb-link.active .sb-icon-wrap {
            background: linear-gradient(135deg, rgba(var(--sb-accent), .9), rgba(var(--sb-accent), .55));
            color: #fff;
            box-shadow: 0 4px 16px rgba(var(--sb-accent), .45);
            transform: scale(1.05);
        }

        /* Accent par page */
        .sb-link.accent-red     { --sb-accent: 230, 57, 70; }
        .sb-link.accent-orange  { --sb-accent: 249, 115, 22; }
        .sb-link.accent-amber   { --sb-accent: 245, 158, 11; }
        .sb-link.accent-emerald { --sb-accent: 16, 185, 129; }
        .sb-link.accent-cyan    { --sb-accent: 6, 182, 212; }
        .sb-link.accent-blue    { --sb-accent: 59, 130, 246; }
        .sb-link.accent-violet  { --sb-accent: 139, 92, 246; }
        .sb-link.accent-rose    { --sb-accent: 244, 63, 94; }

        .sb-footer {
            flex-shrink: 0;
            padding: .85rem .9rem;
            border-top: 1px solid var(--border);
            background: var(--sidebar-bg);
        }
        .sb-user {
            display: flex; align-items: center; gap: .65rem;
            padding: .5rem .65rem;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,.04);
            margin-bottom: .5rem;
        }
        .sb-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: .75rem; flex-shrink: 0;
        }
        .sb-uname { color: #e2e8f0; font-size: .75rem; font-weight: 600; }
        .sb-urole { color: var(--text-muted); font-size: .62rem; }
        .sb-logout {
            display: flex; align-items: center; gap: .5rem;
            width: 100%; padding: .45rem .7rem;
            background: rgba(244,63,94,.08);
            border: 1px solid rgba(244,63,94,.15);
            border-radius: var(--radius-sm);
            color: rgba(244,63,94,.7);
            font-size: .75rem; font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all .18s;
            text-align: left;
        }
        .sb-logout:hover { background: rgba(244,63,94,.18); color: #fda4af; border-color: rgba(244,63,94,.3); }

        /* ══════════════════════════════
           MAIN
        ══════════════════════════════ */
        #main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        #topbar {
            --tb-accent: 230, 57, 70;
            background:
                linear-gradient(90deg, rgba(var(--tb-accent), .08) 0%, transparent 45%),
                rgba(13,13,26,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            padding: 0 1.5rem;
            min-height: 62px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 999;
            gap: 1rem;
        }
        #topbar::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                rgba(var(--tb-accent), .7),
                rgba(var(--tb-accent), .2) 40%,
                transparent 80%);
            opacity: .85;
        }
        .topbar-left  { display: flex; align-items: center; gap: .85rem; min-width: 0; }
        .topbar-right { display: flex; align-items: center; gap: .65rem; flex-shrink: 0; }

        .topbar-page {
            display: flex; align-items: center; gap: .85rem;
            min-width: 0;
            animation: topbar-in .45s cubic-bezier(.34, 1.1, .64, 1) backwards;
        }
        @keyframes topbar-in {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .topbar-icon-wrap {
            width: 40px; height: 40px;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
            color: #fff;
            background: linear-gradient(135deg,
                rgba(var(--tb-accent), .95),
                rgba(var(--tb-accent), .55));
            box-shadow: 0 4px 18px rgba(var(--tb-accent), .35);
            transition: transform .3s cubic-bezier(.34, 1.2, .64, 1), box-shadow .3s ease;
        }
        .topbar-page:hover .topbar-icon-wrap {
            transform: scale(1.06) rotate(-4deg);
            box-shadow: 0 6px 22px rgba(var(--tb-accent), .5);
        }

        .topbar-text { min-width: 0; }
        .topbar-title {
            font-size: 1rem; font-weight: 700;
            color: #fff; letter-spacing: -.02em;
            margin: 0; line-height: 1.2;
            background: linear-gradient(90deg, #fff 60%, rgba(var(--tb-accent), 1));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .topbar-sub {
            font-size: .68rem; color: var(--text-muted);
            margin-top: 2px; font-weight: 500;
        }

        .topbar-crumb {
            --bs-breadcrumb-divider: '›';
            font-size: .72rem; margin: 0; padding: 0;
            background: transparent;
        }
        .topbar-crumb .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(var(--tb-accent), .6);
            font-weight: 700;
        }
        .topbar-crumb .breadcrumb-item a {
            color: rgba(var(--tb-accent), 1);
            text-decoration: none;
            transition: color .2s, opacity .2s;
        }
        .topbar-crumb .breadcrumb-item a:hover { color: #fff; opacity: .9; }
        .topbar-crumb .breadcrumb-item.active { color: #94a3b8; }

        .topbar-chip {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .35rem .75rem;
            border-radius: 20px;
            font-size: .7rem; font-weight: 600;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            color: var(--text-muted);
            transition: background .2s, border-color .2s, color .2s;
        }
        .topbar-chip i { font-size: .8rem; }
        .topbar-chip:hover {
            background: rgba(var(--tb-accent), .1);
            border-color: rgba(var(--tb-accent), .25);
            color: #e2e8f0;
        }
        .topbar-chip.accent {
            background: rgba(var(--tb-accent), .12);
            border-color: rgba(var(--tb-accent), .25);
            color: rgb(var(--tb-accent));
        }
        .topbar-chip.accent i { color: rgb(var(--tb-accent)); }

        #topbar.tb-violet  { --tb-accent: 139, 92, 246; }
        #topbar.tb-orange  { --tb-accent: 249, 115, 22; }
        #topbar.tb-cyan    { --tb-accent: 6, 182, 212; }
        #topbar.tb-emerald { --tb-accent: 16, 185, 129; }
        #topbar.tb-blue    { --tb-accent: 59, 130, 246; }
        #topbar.tb-amber   { --tb-accent: 245, 158, 11; }
        #topbar.tb-rose    { --tb-accent: 244, 63, 94; }
        #topbar.tb-red     { --tb-accent: 230, 57, 70; }

        .page-body { padding: 1.5rem; flex: 1; }

        /* ══════════════════════════════
           COMPONENTS
        ══════════════════════════════ */

        /* Buttons */
        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 600; font-size: .78rem;
            border-radius: var(--radius-sm);
            padding: .44rem 1rem;
            transition: all .18s; letter-spacing: .01em;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-l));
            border: none; color: #fff;
            box-shadow: 0 4px 14px rgba(230,57,70,.35);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(249,115,22,.45);
            background: linear-gradient(135deg, #dc2626, var(--primary-l));
            color: #fff;
        }
        .btn-outline-primary { border: 1px solid rgba(124,58,237,.5); color: var(--primary-l); background: transparent; }
        .btn-outline-primary:hover { background: rgba(124,58,237,.15); color: var(--primary-l); border-color: var(--primary-l); }
        .btn-outline-secondary { border: 1px solid var(--border); color: var(--text-muted); background: transparent; }
        .btn-outline-secondary:hover { background: rgba(255,255,255,.06); color: var(--text); border-color: rgba(255,255,255,.15); }
        .btn-outline-danger { border: 1px solid rgba(244,63,94,.3); color: #f43f5e; background: transparent; }
        .btn-outline-danger:hover { background: rgba(244,63,94,.15); color: #fda4af; }
        .btn-outline-warning { border: 1px solid rgba(245,158,11,.3); color: var(--warning); background: transparent; }
        .btn-outline-warning:hover { background: rgba(245,158,11,.12); color: #fcd34d; }
        .btn-sm { padding: .3rem .7rem; font-size: .72rem; border-radius: 7px; }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            backdrop-filter: blur(8px);
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: .9rem 1.2rem;
            font-weight: 600; font-size: .82rem;
            color: var(--text);
        }
        .card-footer {
            background: transparent;
            border-top: 1px solid var(--border);
        }

        /* KPI Cards */
        .kpi-card {
            border-radius: var(--radius) !important;
            transition: transform .22s ease, box-shadow .22s ease;
            overflow: hidden; position: relative; cursor: default;
            border: 1px solid rgba(255,255,255,.1) !important;
        }
        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0,0,0,.4) !important;
        }
        .kpi-card .card-body { padding: 1.3rem 1.4rem; }

        .kpi-purple { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); }
        .kpi-cyan   { background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%); }
        .kpi-rose   { background: linear-gradient(135deg, #be185d 0%, #f43f5e 100%); }
        .kpi-emerald{ background: linear-gradient(135deg, #065f46 0%, #10b981 100%); }
        .kpi-violet { background: linear-gradient(135deg, #6d28d9 0%, #a855f7 100%); }
        .kpi-slate  { background: linear-gradient(135deg, #1e293b 0%, #475569 100%); }

        .kpi-icon-wrap {
            width: 46px; height: 46px;
            border-radius: 12px;
            background: rgba(255,255,255,.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: #fff; flex-shrink: 0;
        }
        .kpi-val  { font-size: 1.75rem; font-weight: 800; color: #fff; line-height: 1.1; letter-spacing: -.03em; }
        .kpi-lbl  { font-size: .63rem; color: rgba(255,255,255,.65); font-weight: 600; text-transform: uppercase; letter-spacing: .1em; margin-top: 3px; }
        .kpi-sub  { font-size: .72rem; color: rgba(255,255,255,.75); margin-top: 6px; }
        .kpi-trend{ font-size: .72rem; font-weight: 600; margin-top: 6px; }
        .kpi-trend.up   { color: #6ee7b7; }
        .kpi-trend.down { color: #fca5a5; }
        .kpi-trend.flat { color: rgba(255,255,255,.45); }
        .kpi-bg-icon {
            position: absolute; right: -6px; bottom: -6px;
            font-size: 5rem; color: rgba(255,255,255,.06);
            line-height: 1; pointer-events: none;
        }

        /* Tables */
        .table-card { border-radius: var(--radius) !important; overflow: hidden; }
        .table { font-size: .8rem; color: var(--text); }
        .table thead th {
            background: rgba(255,255,255,.03);
            color: var(--text-muted);
            font-size: .65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .09em;
            border-bottom: 1px solid var(--border);
            padding: .75rem 1rem; white-space: nowrap;
        }
        .table tbody td { padding: .75rem 1rem; vertical-align: middle; border-color: var(--border); }
        .table tbody tr { transition: background .15s; }
        .table tbody tr:hover { background: rgba(255,255,255,.03); }
        .table > :not(caption) > * > * { background: transparent; color: var(--text); }

        /* Data panel (liste pro) */
        .data-panel {
            --panel-accent: 249, 115, 22;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,.25);
        }
        .data-panel.accent-orange  { --panel-accent: 249, 115, 22; }
        .data-panel.accent-cyan    { --panel-accent: 6, 182, 212; }
        .data-panel.accent-emerald { --panel-accent: 16, 185, 129; }
        .data-panel.accent-blue    { --panel-accent: 59, 130, 246; }
        .data-panel.accent-amber   { --panel-accent: 245, 158, 11; }
        .data-panel.accent-rose    { --panel-accent: 244, 63, 94; }

        .data-panel-header {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 1rem;
            padding: 1.1rem 1.35rem;
            background: linear-gradient(135deg, rgba(var(--panel-accent), .12) 0%, transparent 60%);
            border-bottom: 1px solid var(--border);
        }
        .data-panel-meta { display: flex; align-items: center; gap: 1rem; }
        .data-panel-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff;
            background: linear-gradient(135deg, rgba(var(--panel-accent), .95), rgba(var(--panel-accent), .5));
            box-shadow: 0 4px 16px rgba(var(--panel-accent), .35);
        }
        .data-panel-title { font-size: .95rem; font-weight: 700; color: #fff; margin: 0; line-height: 1.2; }
        .data-panel-desc  { font-size: .72rem; color: var(--text-muted); margin: 2px 0 0; }
        .data-panel-stat {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .25rem .65rem; border-radius: 20px;
            font-size: .68rem; font-weight: 600;
            background: rgba(var(--panel-accent), .12);
            border: 1px solid rgba(var(--panel-accent), .22);
            color: rgb(var(--panel-accent));
        }

        .btn-add {
            display: inline-flex; align-items: center; gap: .5rem;
            padding: .55rem 1.15rem;
            background: linear-gradient(135deg, rgb(var(--panel-accent)), rgba(var(--panel-accent), .7));
            color: #fff !important; text-decoration: none;
            border: none; border-radius: 10px;
            font-size: .78rem; font-weight: 600;
            box-shadow: 0 4px 18px rgba(var(--panel-accent), .4);
            transition: transform .2s, box-shadow .2s;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(var(--panel-accent), .5);
            color: #fff;
        }

        .filter-bar {
            padding: 1rem 1.35rem;
            background: rgba(0,0,0,.15);
            border-bottom: 1px solid var(--border);
        }
        .filter-bar .form-label { margin-bottom: .3rem; }

        .data-panel .table thead th,
        .table-pro-card .table thead th,
        .table-pro thead th {
            background: rgba(0,0,0,.2);
            padding: .85rem 1.2rem;
            font-size: .62rem; letter-spacing: .11em;
            border-bottom: 1px solid rgba(var(--panel-accent), .15);
        }
        .data-panel .table tbody td,
        .table-pro-card .table tbody td,
        .table-pro tbody td { padding: .9rem 1.2rem; }
        .data-panel .table tbody tr,
        .table-pro-card .table tbody tr,
        .table-pro tbody tr {
            transition: background .2s, box-shadow .2s;
            border-left: 3px solid transparent;
        }
        .data-panel .table tbody tr:hover,
        .table-pro-card .table tbody tr:hover,
        .table-pro tbody tr:hover {
            background: rgba(var(--panel-accent), .04);
            border-left-color: rgb(var(--panel-accent));
        }

        .table-pro-card {
            --panel-accent: 100, 116, 139;
            border-radius: var(--radius) !important;
            overflow: hidden;
        }
        .table-pro-card.accent-orange  { --panel-accent: 249, 115, 22; }
        .table-pro-card.accent-cyan    { --panel-accent: 6, 182, 212; }
        .table-pro-card.accent-emerald { --panel-accent: 16, 185, 129; }
        .table-pro-card.accent-blue    { --panel-accent: 59, 130, 246; }
        .table-pro-card.accent-amber   { --panel-accent: 245, 158, 11; }
        .table-pro-card.accent-rose    { --panel-accent: 244, 63, 94; }
        .table-pro-card.accent-violet  { --panel-accent: 139, 92, 246; }

        .cell-product, .cell-entity { display: flex; align-items: center; gap: .85rem; }
        .cell-product-icon, .cell-entity-icon {
            width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            background: rgba(var(--panel-accent), .12);
            color: rgb(var(--panel-accent));
            border: 1px solid rgba(var(--panel-accent), .2);
        }
        .cell-product-name, .cell-entity-name {
            font-weight: 600; color: #f1f5f9; text-decoration: none;
            transition: color .2s;
        }
        .cell-product-name:hover, .cell-entity-name:hover { color: rgb(var(--panel-accent)); }
        .cell-product-desc, .cell-entity-desc { font-size: .7rem; color: var(--text-muted); margin-top: 1px; }

        .cell-price { font-weight: 700; font-size: .85rem; color: #fff; }
        .cell-price small { font-size: .68rem; color: var(--text-muted); font-weight: 500; }

        .badge-type {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .3em .7em; border-radius: 6px;
            font-size: .68rem; font-weight: 600;
            background: rgba(255,255,255,.06);
            border: 1px solid var(--border);
            color: #cbd5e1;
        }
        .badge-stock {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .28em .65em; border-radius: 20px;
            font-size: .68rem; font-weight: 700;
        }
        .badge-stock::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; background: currentColor;
        }

        .action-group {
            display: inline-flex; align-items: center; gap: 2px;
            padding: 3px;
            background: rgba(0,0,0,.25);
            border: 1px solid var(--border);
            border-radius: 10px;
        }
        .action-btn {
            width: 34px; height: 34px;
            display: inline-flex; align-items: center; justify-content: center;
            border: none; border-radius: 8px;
            background: transparent;
            font-size: .9rem;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, color .2s, transform .15s, box-shadow .2s;
        }
        .action-btn:hover { transform: translateY(-2px); }
        .action-btn.view  { color: #64748b; }
        .action-btn.view:hover  { background: rgba(59,130,246,.2);  color: #60a5fa; box-shadow: 0 4px 12px rgba(59,130,246,.25); }
        .action-btn.edit  { color: #64748b; }
        .action-btn.edit:hover  { background: rgba(249,115,22,.2);  color: #fb923c; box-shadow: 0 4px 12px rgba(249,115,22,.25); }
        .action-btn.delete{ color: #64748b; }
        .action-btn.delete:hover{ background: rgba(244,63,94,.2);  color: #fb7185; box-shadow: 0 4px 12px rgba(244,63,94,.25); }
        .action-group form { display: contents; }

        .empty-state {
            padding: 3.5rem 1.5rem; text-align: center;
        }
        .empty-state-icon {
            width: 64px; height: 64px; margin: 0 auto 1rem;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
            background: rgba(var(--panel-accent), .1);
            color: rgb(var(--panel-accent));
            border: 1px dashed rgba(var(--panel-accent), .3);
        }

        /* Badges */
        .badge { font-size: .68rem; font-weight: 600; padding: .3em .65em; border-radius: 5px; }
        .bg-success-subtle { background: rgba(16,185,129,.15) !important; }
        .text-success { color: #34d399 !important; }
        .bg-warning-subtle { background: rgba(245,158,11,.15) !important; }
        .text-warning { color: #fbbf24 !important; }
        .bg-danger-subtle { background: rgba(244,63,94,.15) !important; }
        .text-danger { color: #fb7185 !important; }
        .bg-primary-subtle { background: rgba(124,58,237,.15) !important; }
        .text-primary { color: var(--primary-l) !important; }
        .bg-secondary-subtle { background: rgba(100,116,139,.15) !important; }
        .text-secondary { color: #94a3b8 !important; }
        .bg-info-subtle { background: rgba(6,182,212,.15) !important; }
        .text-info { color: #22d3ee !important; }

        /* Forms */
        .form-control, .form-select {
            font-size: .8rem; font-family: 'Inter', sans-serif;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text);
            padding: .5rem .85rem;
            transition: border-color .18s, box-shadow .18s;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,.07);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124,58,237,.15);
            color: var(--text);
        }
        .form-control::placeholder { color: var(--text-muted); }
        .form-select option { background: var(--bg2); color: var(--text); }
        .form-label { font-size: .72rem; font-weight: 700; color: #94a3b8; margin-bottom: .35rem; text-transform: uppercase; letter-spacing: .06em; }
        .input-group-text {
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-size: .8rem;
        }
        .input-group > .form-control.border-start-0 { border-left: 0; }
        .input-group > .input-group-text.border-end-0 { border-right: 0; }

        /* Bootstrap light utilities → dark theme */
        .bg-white {
            background-color: rgba(255,255,255,.04) !important;
            color: var(--text) !important;
        }
        .card-header.bg-white,
        .card-footer.bg-white {
            background-color: rgba(255,255,255,.04) !important;
            border-color: var(--border) !important;
        }
        .bg-light {
            background-color: rgba(255,255,255,.05) !important;
            color: var(--text-muted) !important;
        }
        .input-group-text.bg-light {
            background-color: rgba(255,255,255,.05) !important;
            border-color: var(--border) !important;
            color: var(--text-muted) !important;
        }

        /* Alerts */
        .alert { border-radius: var(--radius-sm); font-size: .8rem; }
        .alert-success { background: rgba(16,185,129,.1); border: 1px solid rgba(16,185,129,.2); color: #6ee7b7; }
        .alert-danger  { background: rgba(244,63,94,.1);  border: 1px solid rgba(244,63,94,.2);  color: #fca5a5; }
        .alert-warning { background: rgba(245,158,11,.1); border: 1px solid rgba(245,158,11,.2); color: #fcd34d; }
        .alert-info    { background: rgba(6,182,212,.1);  border: 1px solid rgba(6,182,212,.2);  color: #67e8f9; }
        .btn-close { filter: invert(1) opacity(.5); }

        /* Section label */
        .section-label {
            font-size: .62rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .14em;
            color: var(--text-muted); margin-bottom: .85rem;
        }

        /* Status dot */
        .status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; margin-right: 5px; }

        /* Pagination */
        .pagination { font-size: .78rem; }
        .page-link {
            background: rgba(255,255,255,.05);
            border-color: var(--border);
            color: var(--text-muted);
            border-radius: 7px !important;
            margin: 0 2px;
            font-family: 'Inter', sans-serif;
        }
        .page-link:hover { background: rgba(255,255,255,.1); color: #fff; border-color: var(--border); }
        .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: #fff; }

        /* Text helpers */
        .text-muted { color: var(--text-muted) !important; }
        .fw-medium { font-weight: 500; }
        .fw-semibold { font-weight: 600; }

        /* Scrollbar global */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 5px; }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main { margin-left: 0; }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<nav id="sidebar">
    <div class="sb-brand">
        <div class="sb-icon"><i class="bi bi-fire"></i></div>
        <div>
            <div class="sb-name">AQUA MAB</div>
            <div class="sb-sub">Équipements incendie</div>
        </div>
    </div>

    <div class="sb-nav">
        <div class="sb-section">Principal</div>
        <a href="<?php echo e(route('dashboard')); ?>" class="sb-link accent-violet <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-speedometer2"></i></span>
            <span class="sb-label">Tableau de bord</span>
        </a>

        <?php if(auth()->user()->isAdmin() || auth()->user()->isTechnicien()): ?>
        <div class="sb-section">Stock</div>
        <a href="<?php echo e(route('produits.index')); ?>" class="sb-link accent-orange <?php echo e(request()->routeIs('produits.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-box-seam"></i></span>
            <span class="sb-label">Produits</span>
        </a>
        <?php endif; ?>

        <?php if(auth()->user()->isAdmin() || auth()->user()->isClient()): ?>
        <div class="sb-section">Ventes</div>
        <a href="<?php echo e(route('commandes.index')); ?>" class="sb-link accent-cyan <?php echo e(request()->routeIs('commandes.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-cart3"></i></span>
            <span class="sb-label">Commandes</span>
        </a>
        <?php endif; ?>

        <?php if(auth()->user()->isAdmin()): ?>
        <a href="<?php echo e(route('factures.index')); ?>" class="sb-link accent-emerald <?php echo e(request()->routeIs('factures.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-receipt"></i></span>
            <span class="sb-label">Factures</span>
        </a>
        <div class="sb-section">Répertoire</div>
        <a href="<?php echo e(route('clients.index')); ?>" class="sb-link accent-blue <?php echo e(request()->routeIs('clients.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-people"></i></span>
            <span class="sb-label">Clients</span>
        </a>
        <a href="<?php echo e(route('fournisseurs.index')); ?>" class="sb-link accent-amber <?php echo e(request()->routeIs('fournisseurs.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-truck"></i></span>
            <span class="sb-label">Fournisseurs</span>
        </a>
        <?php endif; ?>

        <?php if(auth()->user()->isAdmin() || auth()->user()->isTechnicien()): ?>
        <div class="sb-section">Technique</div>
        <a href="<?php echo e(route('maintenances.index')); ?>" class="sb-link accent-rose <?php echo e(request()->routeIs('maintenances.*') ? 'active' : ''); ?>">
            <span class="sb-icon-wrap"><i class="bi bi-tools"></i></span>
            <span class="sb-label">Maintenances</span>
        </a>
        <?php endif; ?>
    </div>

    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
            <div style="min-width:0;">
                <div class="sb-uname text-truncate"><?php echo e(auth()->user()->name); ?></div>
                <div class="sb-urole"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sb-logout">
                <i class="bi bi-box-arrow-left"></i> Déconnexion
            </button>
        </form>
    </div>
</nav>


<div id="main">
    <?php
        $tbClass = match(true) {
            request()->routeIs('dashboard')       => 'tb-violet',
            request()->routeIs('produits.*')      => 'tb-orange',
            request()->routeIs('commandes.*')     => 'tb-cyan',
            request()->routeIs('factures.*')      => 'tb-emerald',
            request()->routeIs('clients.*')       => 'tb-blue',
            request()->routeIs('fournisseurs.*')  => 'tb-amber',
            request()->routeIs('maintenances.*')  => 'tb-rose',
            default                               => 'tb-red',
        };
        $tbIcon = match(true) {
            request()->routeIs('dashboard')       => 'speedometer2',
            request()->routeIs('produits.*')      => 'box-seam',
            request()->routeIs('commandes.*')     => 'cart3',
            request()->routeIs('factures.*')      => 'receipt',
            request()->routeIs('clients.*')       => 'people',
            request()->routeIs('fournisseurs.*')  => 'truck',
            request()->routeIs('maintenances.*')  => 'tools',
            default                               => 'grid',
        };
        $tbSub = match(true) {
            request()->routeIs('dashboard')       => 'Vue d\'ensemble',
            request()->routeIs('produits.*')      => 'Gestion du stock',
            request()->routeIs('commandes.*')     => 'Suivi des ventes',
            request()->routeIs('factures.*')      => 'Facturation',
            request()->routeIs('clients.*')       => 'Répertoire clients',
            request()->routeIs('fournisseurs.*')  => 'Répertoire fournisseurs',
            request()->routeIs('maintenances.*')  => 'Interventions techniques',
            default                               => 'AQUA MAB',
        };
        $tbTitle = trim($__env->yieldContent('page_title'));
        $tbHasCrumb = ! empty(trim($__env->yieldContent('breadcrumb')));
    ?>
    <div id="topbar" class="<?php echo e($tbClass); ?>">
        <div class="topbar-left">
            <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div class="topbar-page">
                <div class="topbar-icon-wrap"><i class="bi bi-<?php echo e($tbIcon); ?>"></i></div>
                <div class="topbar-text">
                    <?php if($tbTitle !== ''): ?>
                        <h1 class="topbar-title"><?php echo e($tbTitle); ?></h1>
                        <?php if($tbHasCrumb): ?>
                        <ol class="breadcrumb topbar-crumb"><?php echo trim($__env->yieldContent('breadcrumb')); ?></ol>
                        <?php else: ?>
                        <div class="topbar-sub"><?php echo e($tbSub); ?></div>
                        <?php endif; ?>
                    <?php elseif($tbHasCrumb): ?>
                        <ol class="breadcrumb topbar-crumb mb-0"><?php echo trim($__env->yieldContent('breadcrumb')); ?></ol>
                    <?php else: ?>
                        <h1 class="topbar-title">AQUA MAB</h1>
                        <div class="topbar-sub"><?php echo e($tbSub); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="topbar-right d-none d-sm-flex">
            <span class="topbar-chip">
                <i class="bi bi-calendar3"></i>
                <?php echo e(now()->format('d/m/Y')); ?>

            </span>
            <span class="topbar-chip accent">
                <i class="bi bi-person-badge"></i>
                <?php echo e(ucfirst(auth()->user()->role)); ?>

            </span>
        </div>
    </div>

    <div class="page-body">

        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if(session('info')): ?>
        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-info-circle-fill"></i> <?php echo e(session('info')); ?>

            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <strong>Veuillez corriger les erreurs :</strong>
            </div>
            <ul class="mb-0 ps-3 mt-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('show');
    });
    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (el) {
            bootstrap.Alert.getOrCreateInstance(el)?.close();
        });
    }, 5000);
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\layouts\app.blade.php ENDPATH**/ ?>