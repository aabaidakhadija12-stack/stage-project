<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — AQUA MAB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #0f172a;
        }

        /* ── Left panel ── */
        .left-panel {
            width: 45%;
            background: linear-gradient(160deg, #0f172a 0%, #1e293b 60%, #1a1a2e 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(230,57,70,.18) 0%, transparent 70%);
            border-radius: 50%;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -80px;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(249,115,22,.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .lp-logo {
            display: flex; align-items: center; gap: .85rem;
            position: relative; z-index: 1;
        }
        .lp-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, #e63946, #f97316);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #fff;
            box-shadow: 0 6px 20px rgba(230,57,70,.4);
        }
        .lp-brand { color: #fff; font-size: 1.2rem; font-weight: 800; letter-spacing: -.02em; }
        .lp-sub   { color: rgba(255,255,255,.4); font-size: .72rem; text-transform: uppercase; letter-spacing: .1em; margin-top: 2px; }

        .lp-content { position: relative; z-index: 1; }
        .lp-title {
            font-size: 2.4rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -.03em;
            margin-bottom: 1.2rem;
        }
        .lp-title span { color: #e63946; }
        .lp-desc { color: rgba(255,255,255,.5); font-size: .9rem; line-height: 1.7; max-width: 340px; }

        .lp-stats {
            display: flex; gap: 2rem;
            position: relative; z-index: 1;
        }
        .lp-stat-val { color: #fff; font-size: 1.6rem; font-weight: 800; }
        .lp-stat-lbl { color: rgba(255,255,255,.4); font-size: .72rem; text-transform: uppercase; letter-spacing: .08em; margin-top: 2px; }

        /* ── Right panel ── */
        .right-panel {
            flex: 1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-box h2 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -.03em;
            margin-bottom: .4rem;
        }
        .login-box .subtitle {
            color: #64748b;
            font-size: .88rem;
            margin-bottom: 2rem;
        }

        .form-label {
            font-size: .78rem;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: .4rem;
        }

        .input-wrap {
            position: relative;
        }
        .input-wrap i {
            position: absolute;
            left: .9rem; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: .95rem;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: .7rem .9rem .7rem 2.5rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .88rem;
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #0f172a;
            transition: border-color .18s, box-shadow .18s;
            outline: none;
        }
        .input-wrap input:focus {
            border-color: #e63946;
            box-shadow: 0 0 0 3px rgba(230,57,70,.1);
        }
        .input-wrap input.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: .78rem; color: #ef4444; margin-top: .3rem; }

        .btn-login {
            width: 100%;
            padding: .8rem;
            background: linear-gradient(135deg, #e63946, #f97316);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: .9rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(230,57,70,.35);
            letter-spacing: .01em;
        }
        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(230,57,70,.45);
        }
        .btn-login:active { transform: translateY(0); }

        .remember-row {
            display: flex; align-items: center; gap: .5rem;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type=checkbox] {
            width: 16px; height: 16px;
            accent-color: #e63946;
            cursor: pointer;
        }
        .remember-row label {
            font-size: .82rem;
            color: #64748b;
            cursor: pointer;
        }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0;
            color: #cbd5e1; font-size: .78rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: #e2e8f0;
        }

        .register-link {
            text-align: center;
            font-size: .84rem;
            color: #64748b;
        }
        .register-link a {
            color: #e63946;
            font-weight: 700;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: .75rem 1rem;
            color: #991b1b;
            font-size: .83rem;
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: .5rem;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            body { background: #f8fafc; }
        }
    </style>
</head>
<body>

    
    <div class="left-panel">
        <div class="lp-logo">
            <div class="lp-icon"><i class="bi bi-fire"></i></div>
            <div>
                <div class="lp-brand">AQUA MAB</div>
                <div class="lp-sub">Équipements incendie</div>
            </div>
        </div>

        <div class="lp-content">
            <div class="lp-title">
                Gestion de<br>stock <span>intelligente</span>
            </div>
            <p class="lp-desc">
                Pilotez votre inventaire d'équipements incendie, suivez vos commandes et générez vos factures en toute simplicité.
            </p>
        </div>

        <div class="lp-stats">
            <div>
                <div class="lp-stat-val">100%</div>
                <div class="lp-stat-lbl">Sécurisé</div>
            </div>
            <div>
                <div class="lp-stat-val">4</div>
                <div class="lp-stat-lbl">Rôles</div>
            </div>
            <div>
                <div class="lp-stat-val">∞</div>
                <div class="lp-stat-lbl">Produits</div>
            </div>
        </div>
    </div>

    
    <div class="right-panel">
        <div class="login-box">
            <h2>Bon retour 👋</h2>
            <p class="subtitle">Connectez-vous à votre espace de gestion</p>

            <?php if(session('success')): ?>
            <div class="alert-error" style="background:#f0fdf4;border-color:#bbf7d0;color:#166534;">
                <i class="bi bi-check-circle-fill"></i> <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="alert-error">
                <i class="bi bi-exclamation-circle-fill"></i> <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="email" name="email"
                               value="<?php echo e(old('email')); ?>"
                               placeholder="admin@aquamab.com"
                               class="<?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                               required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="password" name="password"
                               placeholder="••••••••"
                               class="<?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                               required>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>

            <div class="divider">ou</div>

            <div class="register-link">
                Pas encore de compte ?
                <a href="<?php echo e(route('register')); ?>">Créer un compte</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\projet-stage\resources\views\auth\login.blade.php ENDPATH**/ ?>