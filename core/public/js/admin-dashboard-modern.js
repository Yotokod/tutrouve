/**
 * DASHBOARD ADMIN - INTERACTIONS MODERNES
 * Créé le: 11 Novembre 2025
 * Animations légères et interactions fluides
 */

(function () {
    'use strict';

    // ==================== CONSTANTES ====================
    const ANIMATION_DURATION = 300;
    const SCROLL_THRESHOLD = 100;
    const COUNT_ANIMATION_DURATION = 1500;

    // ==================== DOM READY ====================
    document.addEventListener('DOMContentLoaded', function () {
        initAdminDashboard();
        initStatsCounters();
        initTableAnimations();
        initProgressBars();
        initChartAnimations();
        initCardAnimations();
        initNotifications();
        initTooltips();
        initScrollEffects();
    });

    // ==================== INITIALISATION DASHBOARD ====================
    function initAdminDashboard() {
        console.log('✨ Dashboard Admin Moderne initialisé');

        // Animation d'entrée progressive
        animateElements();

        // Ajouter classe pour animations CSS
        document.body.classList.add('admin-dashboard-loaded');

        // Observer pour animations au scroll
        setupScrollObserver();
    }

    // ==================== ANIMATIONS D'ENTRÉE ====================
    function animateElements() {
        const elements = document.querySelectorAll('.dashboard_promo__single, .dashboard__card, .progress__item');

        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';

            setTimeout(() => {
                el.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }

    // ==================== SCROLL OBSERVER ====================
    function setupScrollObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');

                    // Animer les compteurs quand visibles
                    if (entry.target.classList.contains('dashboard_promo__single__price')) {
                        animateCounter(entry.target);
                    }
                }
            });
        }, {
            threshold: 0.1
        });

        const observeElements = document.querySelectorAll('.dashboard__card, .dashboard_promo__single, .chart__item__inner');
        observeElements.forEach(el => observer.observe(el));
    }

    // ==================== ANIMATION COMPTEURS ====================
    function initStatsCounters() {
        const counters = document.querySelectorAll('.dashboard_promo__single__price');

        counters.forEach(counter => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !counter.classList.contains('counted')) {
                        counter.classList.add('counted');
                        animateCounter(counter);
                    }
                });
            });

            observer.observe(counter);
        });
    }

    function animateCounter(counter) {
        const text = counter.textContent.trim();
        const number = parseInt(text.replace(/[^0-9]/g, ''));

        if (isNaN(number)) return;

        const duration = COUNT_ANIMATION_DURATION;
        const step = number / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < number) {
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = number.toLocaleString();
            }
        };

        updateCounter();
    }

    // ==================== ANIMATIONS TABLES ====================
    function initTableAnimations() {
        const rows = document.querySelectorAll('.table_row');

        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateX(-20px)';

            setTimeout(() => {
                row.style.transition = 'all 0.4s ease-out';
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });

        // Effet hover avancé
        rows.forEach(row => {
            row.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.01)';
            });

            row.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1)';
            });
        });
    }

    // ==================== PROGRESS BARS ====================
    function initProgressBars() {
        const progressBars = document.querySelectorAll('.progress__item__main');

        progressBars.forEach(bar => {
            const percent = bar.getAttribute('data-percent');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !bar.classList.contains('animated')) {
                        bar.classList.add('animated');
                        setTimeout(() => {
                            bar.style.width = percent + '%';
                        }, 100);
                    }
                });
            });

            observer.observe(bar);

            // État initial
            bar.style.width = '0%';
        });
    }

    // ==================== ANIMATIONS CHARTS ====================
    function initChartAnimations() {
        const chartContainers = document.querySelectorAll('.chart__item__inner');

        chartContainers.forEach(container => {
            container.style.opacity = '0';
            container.style.transform = 'scale(0.95)';

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            container.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                            container.style.opacity = '1';
                            container.style.transform = 'scale(1)';
                        }, 200);
                    }
                });
            });

            observer.observe(container);
        });
    }

    // ==================== ANIMATIONS CARDS ====================
    function initCardAnimations() {
        const cards = document.querySelectorAll('.dashboard__card, .dashboard_promo__single');

        cards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    }

    // ==================== NOTIFICATIONS ====================
    function initNotifications() {
        window.showAdminNotification = function (message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `admin-notification notification-${type}`;

            const icons = {
                success: '<i class="las la-check-circle"></i>',
                error: '<i class="las la-times-circle"></i>',
                warning: '<i class="las la-exclamation-triangle"></i>',
                info: '<i class="las la-info-circle"></i>'
            };

            const colors = {
                success: '#10b981',
                error: '#ef4444',
                warning: '#f59e0b',
                info: '#3b82f6'
            };

            notification.innerHTML = `
                <div class="notification-content">
                    <span class="notification-icon" style="color: ${colors[type]}; font-size: 24px;">
                        ${icons[type]}
                    </span>
                    <span class="notification-message">${message}</span>
                </div>
            `;

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 16px 24px;
                border-radius: 16px;
                box-shadow: 0 8px 32px rgba(31, 62, 57, 0.15);
                z-index: 10000;
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 320px;
                border-left: 4px solid ${colors[type]};
                opacity: 0;
                transform: translateX(400px);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            `;

            document.body.appendChild(notification);

            // Animer l'entrée
            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateX(0)';
            }, 10);

            // Retirer après 4 secondes
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => notification.remove(), 400);
            }, 4000);
        };
    }

    // ==================== TOOLTIPS ====================
    function initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');

        tooltipElements.forEach(element => {
            const tooltipText = element.getAttribute('data-tooltip');

            element.addEventListener('mouseenter', function (e) {
                const tooltip = createTooltip(tooltipText);
                document.body.appendChild(tooltip);
                positionTooltip(tooltip, e.target);
            });

            element.addEventListener('mouseleave', function () {
                const tooltip = document.querySelector('.admin-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                    setTimeout(() => tooltip.remove(), 200);
                }
            });
        });
    }

    function createTooltip(text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'admin-tooltip';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.2s ease;
            pointer-events: none;
            box-shadow: 0 4px 12px rgba(31, 62, 57, 0.3);
            white-space: nowrap;
        `;

        setTimeout(() => tooltip.style.opacity = '1', 10);
        return tooltip;
    }

    function positionTooltip(tooltip, target) {
        const rect = target.getBoundingClientRect();
        tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
        tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
    }

    // ==================== SCROLL EFFECTS ====================
    function initScrollEffects() {
        let lastScroll = 0;
        const header = document.querySelector('.dashboard__inner__header');

        if (!header) return;

        window.addEventListener('scroll', function () {
            const currentScroll = window.pageYOffset;

            if (currentScroll > SCROLL_THRESHOLD) {
                header.style.boxShadow = '0 12px 48px rgba(31, 62, 57, 0.2)';
                header.style.transform = 'translateY(-2px)';
            } else {
                header.style.boxShadow = '0 8px 32px rgba(31, 62, 57, 0.1)';
                header.style.transform = 'translateY(0)';
            }

            lastScroll = currentScroll;
        });
    }

    // ==================== RIPPLE EFFECT ====================
    document.querySelectorAll('.cmnBtn, .dashboard_promo__single').forEach(element => {
        element.addEventListener('click', function (e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                width: 20px;
                height: 20px;
                transform: scale(0);
                animation: admin-ripple 0.6s ease-out;
                pointer-events: none;
            `;

            const rect = this.getBoundingClientRect();
            ripple.style.left = `${e.clientX - rect.left - 10}px`;
            ripple.style.top = `${e.clientY - rect.top - 10}px`;

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Ajouter l'animation ripple dans le style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes admin-ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .admin-notification .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .admin-notification .notification-message {
            color: #1F3E39;
            font-weight: 500;
            font-size: 0.95rem;
            flex: 1;
        }
        
        .animate-in {
            animation: adminFadeInUp 0.6s ease-out;
        }
        
        /* Select2 modern styling */
        .select2-container--default .select2-selection--single {
            border: 2px solid rgba(31, 62, 57, 0.08) !important;
            border-radius: 12px !important;
            height: 42px !important;
            padding: 6px 12px !important;
        }
        
        .select2-container--default .select2-selection--single:focus {
            border-color: #1F3E39 !important;
            box-shadow: 0 0 0 4px rgba(31, 62, 57, 0.1) !important;
        }
        
        /* Smooth transitions */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    `;
    document.head.appendChild(style);

    // ==================== PERFORMANCE MONITORING ====================
    if (window.performance && window.performance.timing) {
        window.addEventListener('load', function () {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log(`⚡ Dashboard Admin chargé en ${loadTime}ms`);

            // Afficher une notification si le chargement est rapide
            if (loadTime < 2000) {
                console.log('🚀 Chargement ultra-rapide!');
            }
        });
    }

    // ==================== AUTO-REFRESH DATA (optionnel) ====================
    function initAutoRefresh() {
        const refreshInterval = 300000; // 5 minutes

        setInterval(() => {
            console.log('🔄 Actualisation des données...');
            // Ajouter ici la logique d'actualisation
        }, refreshInterval);
    }

    // ==================== KEYBOARD SHORTCUTS ====================
    document.addEventListener('keydown', function (e) {
        // Ctrl/Cmd + K pour recherche rapide
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            console.log('🔍 Recherche rapide activée');
            // Ajouter la logique de recherche
        }

        // Échap pour fermer les modales/notifications
        if (e.key === 'Escape') {
            const notifications = document.querySelectorAll('.admin-notification');
            notifications.forEach(n => n.remove());
        }
    });

    // ==================== THEME TOGGLE (optionnel) ====================
    window.toggleAdminTheme = function () {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('adminTheme', isDark ? 'dark' : 'light');

        showAdminNotification(
            isDark ? 'Mode sombre activé' : 'Mode clair activé',
            'info'
        );
    };

    // Charger le thème sauvegardé
    const savedTheme = localStorage.getItem('adminTheme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    }

    // ==================== EXPORT FUNCTIONS ====================
    window.AdminDashboard = {
        showNotification: window.showAdminNotification,
        animateCounter: animateCounter,
        toggleTheme: window.toggleAdminTheme
    };

    console.log('✅ Dashboard Admin Moderne prêt!');

})();
