<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_config['site_name']) ?> | Domain Portfolio</title>
    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="nav-header">
        <div class="nav-inner">
            <a href="https://xpsystems.eu" class="nav-logo">xpsystems</a>
            <div class="nav-links">
                <a href="https://xpsystems.eu" class="nav-link">Main Site</a>
                <a href="https://status.xpsystems.eu" class="nav-link">Status</a>
            </div>
            <div class="nav-right">
                <?php include 'components/theme-toggle.php'; ?>
                <button class="nav-hamburger" aria-label="Toggle menu">
                    <svg class="icon-hamburger" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    <svg class="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>
    </nav>
    <div class="nav-overlay"></div>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-inner container">
            <div class="hero-eyebrow reveal">Domain Portfolio</div>
            <h1 class="hero-title reveal" style="--delay: 50ms">Our Digital Footprint</h1>
            <p class="hero-description reveal" style="--delay: 100ms">
                A comprehensive registry of all domains owned and managed by xpsystems.
            </p>
        </div>
    </header>

    <!-- Divider: Hero -> Services (Multi-layer Wave) -->
    <div class="section-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <!-- Background Layer (matches previous section slightly transparent or offset) -->
            <path d="M0,0 C300,100 900,0 1200,100 L1200,120 L0,120 Z" class="divider-fill-bg" style="opacity: 0.3"></path>
            <!-- Foreground Layer (matches next section) -->
            <path d="M0,40 C200,120 1000,0 1200,80 L1200,120 L0,120 Z" class="divider-fill-alt"></path>
        </svg>
    </div>

    <!-- Active Domains Grid -->
    <main class="services-section">
        <div class="container">
            <!-- Grid content... (Same as before) -->
             <div class="services-grid">
                <?php foreach ($active_domains as $index => $category): ?>
                <div class="card <?= isset($category['highlight']) ? 'card-partner' : '' ?> reveal" style="--delay: <?= 100 + ($index * 50) ?>ms">
                    <div class="card-top">
                        <div class="card-badge <?= isset($category['highlight']) ? 'card-badge-service' : '' ?>"><?= htmlspecialchars($category['category']) ?></div>
                        <h3 class="card-name"><?= count($category['links']) ?> Domains</h3>
                    </div>
                    <ul class="link-list">
                        <?php foreach ($category['links'] as $link): ?>
                        <li>
                            <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener noreferrer" class="card-sublink">
                                <?= htmlspecialchars($link['label']) ?>
                                <?php if (isset($link['badge'])): ?>
                                    <span class="badge badge-<?= strtolower($link['badge']) ?>"><?= htmlspecialchars($link['badge']) ?></span>
                                <?php endif; ?>
                                <svg class="icon-ext" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="7 7 17 17"/><polyline points="17 7 17 17 7 17"/></svg>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Divider: Services -> Legacy (Multi-layer Curve) -->
    <div class="section-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <!-- Background Layer -->
            <path d="M0,0 C400,120 800,0 1200,60 L1200,120 L0,120 Z" class="divider-fill-alt" style="opacity: 0.2"></path>
            <!-- Foreground Layer -->
            <path d="M0,60 C300,0 900,120 1200,40 L1200,120 L0,120 Z" class="divider-fill-bg"></path>
        </svg>
    </div>

    <!-- Legacy Section -->
    <section class="legacy-section">
        <div class="container">
             <!-- Legacy content... (Same as before) -->
             <div class="section-header reveal">
                <h2 class="section-title">Legacy & Expired</h2>
                <p class="section-subtitle">Historical domains previously part of the network.</p>
            </div>
            <div class="legacy-grid reveal" style="--delay: 100ms">
                <?php foreach ($legacy_domains['links'] as $link): ?>
                <div class="legacy-item">
                    <span class="expired-link">
                        <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        <?= htmlspecialchars($link['label']) ?>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Divider: Legacy -> Footer (Multi-layer Tilt) -->
    <div class="section-divider">
         <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <!-- Background Layer -->
            <path d="M0,0 L1200,80 L1200,120 L0,120 Z" class="divider-fill-bg" style="opacity: 0.3"></path>
            <!-- Foreground Layer -->
            <path d="M0,80 L1200,0 L1200,120 L0,120 Z" class="divider-fill-footer"></path>
        </svg>
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-brand">
                    <span class="footer-logo">xpsystems</span>
                    <span class="footer-copy">&copy; <?= htmlspecialchars($site_config['current_year']) ?> All rights reserved.</span>
                    <span class="footer-version"><?= htmlspecialchars($site_config['version']) ?></span>
                </div>
                <div class="footer-right">
                    <?php include 'components/theme-toggle.php'; ?>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>