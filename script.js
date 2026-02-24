// script.js

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

    // ── Mobile Navigation ───────────────────────────────────────────
    
    function initNav() {
        const hamburger = document.querySelector('.nav-hamburger');
        const navLinks = document.querySelector('.nav-links'); // Target desktop nav-links class which becomes mobile menu
        const overlay = document.querySelector('.nav-overlay');

        if (hamburger && navLinks) {
            hamburger.addEventListener('click', function() {
                hamburger.classList.toggle('open');
                navLinks.classList.toggle('open');
                if(overlay) overlay.classList.toggle('active');
            });

            if (overlay) {
                overlay.addEventListener('click', function() {
                    hamburger.classList.remove('open');
                    navLinks.classList.remove('open');
                    overlay.classList.remove('active');
                });
            }
        }
    }

    // ── Initialize ──────────────────────────────────────────────────
    
    document.addEventListener('DOMContentLoaded', function() {
        initReveal();
        initNav();
    });

})();