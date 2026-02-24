<?php
// index.php - Main domain listing page
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete domain portfolio for XP-Systems and affiliated projects.">
    <title><?= htmlspecialchars($site_config['site_name']) ?> | Domain Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-header">
        <div class="nav-inner">
            <a href="https://xpsystems.eu" class="nav-logo">
                <svg class="nav-logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/>
                    <line x1="12" y1="22" x2="12" y2="15.5"/>
                    <polyline points="22 8.5 12 15.5 2 8.5"/>
                </svg>
                <span>XP-Systems</span>
            </a>
            <div class="nav-right">
                <a href="https://xpsystems.eu" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Main Site
                </a>
                <a href="https://status.xpsystems.eu" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    Status
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-bg">
            <div class="hero-grid"></div>
            <div class="hero-glow"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-eyebrow reveal">Domain Portfolio</div>
                <h1 class="hero-title reveal" style="--delay: 50ms">
                    <span class="title-line">Our Digital</span>
                    <span class="title-line accent">Footprint</span>
                </h1>
                <p class="hero-description reveal" style="--delay: 100ms">
                    A comprehensive registry of all domains owned and managed by XP-Systems, 
                    including active projects, infrastructure, and historical archives.
                </p>
                <div class="hero-stats reveal" style="--delay: 150ms">
                    <div class="stat-block">
                        <span class="stat-number" id="active-count">0</span>
                        <span class="stat-label">Active Domains</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-block">
                        <span class="stat-number" id="legacy-count">0</span>
                        <span class="stat-label">Archived</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Domain Grid -->
    <main class="main-content">
        <div class="container">
            <div class="domain-grid">
                <?php 
                $active_count = 0;
                $legacy_count = 0;
                
                foreach ($domains as $index => $category): 
                    if (!isset($category['is_legacy'])) {
                        $active_count += count($category['links']);
                    } else {
                        $legacy_count = count($category['links']);
                    }
                ?>
                <section class="card <?= isset($category['is_legacy']) ? 'card-legacy' : '' ?> <?= isset($category['highlight']) ? 'card-highlight' : '' ?> reveal" style="--delay: <?= 200 + ($index * 50) ?>ms">
                    <div class="card-header">
                        <div class="card-icon-wrap">
                            <?php if ($category['icon'] === 'user'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'server'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
                                <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
                                <line x1="6" y1="6" x2="6.01" y2="6"/>
                                <line x1="6" y1="18" x2="6.01" y2="18"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'globe'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'code'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="16 18 22 12 16 6"/>
                                <polyline points="8 6 2 12 8 18"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'shield'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'folder'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                            </svg>
                            <?php elseif ($category['icon'] === 'archive'): ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="21 8 21 21 3 21 3 8"/>
                                <rect x="1" y="3" width="22" height="5"/>
                                <line x1="10" y1="12" x2="14" y2="12"/>
                            </svg>
                            <?php endif; ?>
                        </div>
                        <h3 class="card-title"><?= htmlspecialchars($category['category']) ?></h3>
                        <span class="card-count"><?= count($category['links']) ?> domains</span>
                    </div>
                    <ul class="link-list">
                        <?php foreach ($category['links'] as $link): ?>
                        <li>
                            <?php if (isset($category['is_legacy'])): ?>
                                <span class="expired-link">
                                    <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    <?= htmlspecialchars($link['label']) ?>
                                </span>
                            <?php else: ?>
                                <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener noreferrer" class="domain-link">
                                    <svg class="link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                        <polyline points="15 3 21 3 21 9"/>
                                        <line x1="10" y1="14" x2="21" y2="3"/>
                                    </svg>
                                    <span class="domain-text"><?= htmlspecialchars($link['label']) ?></span>
                                    <?php if (isset($link['badge'])): ?>
                                        <span class="badge badge-<?= strtolower($link['badge']) ?>"><?= htmlspecialchars($link['badge']) ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-left">
                    <span class="footer-logo">XP-Systems</span>
                    <span class="footer-copy">&copy; <?= htmlspecialchars($site_config['current_year']) ?> All rights reserved.</span>
                    <span class="footer-version"><?= htmlspecialchars($site_config['version']) ?></span>
                </div>
                <div class="footer-right">
                    <div class="theme-toggle" role="group" aria-label="Color theme">
                        <button class="theme-btn" data-theme="system" title="System theme" type="button">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </button>
                        <button class="theme-btn" data-theme="dark" title="Dark theme" type="button">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                            </svg>
                        </button>
                        <button class="theme-btn" data-theme="light" title="Light theme" type="button">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="5"/>
                                <line x1="12" y1="1" x2="12" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="23"/>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                <line x1="1" y1="12" x2="3" y2="12"/>
                                <line x1="21" y1="12" x2="23" y2="12"/>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Pass PHP counts to JS
        window.DOMAIN_STATS = {
            active: <?= $active_count ?>,
            legacy: <?= $legacy_count ?>
        };
    </script>
    <script src="script.js"></script>
</body>
</html>