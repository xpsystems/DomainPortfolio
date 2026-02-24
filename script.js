// script.js - Theme switching and interactions

(function() {
    'use strict';

    // ── Theme Management ───────────────────────────────────────────
    
    const THEME_KEY = 'xps-theme';
    
    function getSystemTheme() {
        return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    }
    
    function applyTheme(mode) {
        const resolved = mode === 'system' ? getSystemTheme() : mode;
        document.documentElement.setAttribute('data-theme', resolved);
        
        // Update button states
        document.querySelectorAll('.theme-btn').forEach(function(btn) {
            btn.classList.toggle('active', btn.dataset.theme === mode);
        });
    }
    
    function loadTheme() {
        const saved = localStorage.getItem(THEME_KEY) || 'system';
        applyTheme(saved);
        return saved;
    }
    
    let currentTheme = loadTheme();
    
    // Listen for OS theme changes
    window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', function() {
        if (currentTheme === 'system') {
            applyTheme('system');
        }
    });
    
    // Theme button clicks
    document.querySelectorAll('.theme-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            currentTheme = btn.dataset.theme;
            localStorage.setItem(THEME_KEY, currentTheme);
            
            // Add transition class
            document.documentElement.classList.add('is-switching-theme');
            applyTheme(currentTheme);
            
            // Remove transition class after animation
            setTimeout(function() {
                document.documentElement.classList.remove('is-switching-theme');
            }, 350);
        });
    });

    // ── Scroll Reveal ───────────────────────────────────────────────
    
    function initReveal() {
        const reveals = document.querySelectorAll('.reveal');
        
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            reveals.forEach(function(el) {
                observer.observe(el);
            });
        } else {
            // Fallback for older browsers
            reveals.forEach(function(el) {
                el.classList.add('visible');
            });
        }
    }

    // ── Animated Counters ───────────────────────────────────────────
    
    function animateCounter(element, target, duration) {
        if (!element) return;
        
        const start = 0;
        const startTime = performance.now();
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Ease out cubic
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(start + (target - start) * easeOut);
            
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }
        
        requestAnimationFrame(update);
    }

    function initCounters() {
        const stats = window.DOMAIN_STATS || { active: 0, legacy: 0 };
        const activeEl = document.getElementById('active-count');
        const legacyEl = document.getElementById('legacy-count');
        
        // Delay animation until reveal is visible
        setTimeout(function() {
            animateCounter(activeEl, stats.active, 1200);
            animateCounter(legacyEl, stats.legacy, 800);
        }, 400);
    }

    // ── Initialize ──────────────────────────────────────────────────
    
    document.addEventListener('DOMContentLoaded', function() {
        initReveal();
        initCounters();
    });

})();