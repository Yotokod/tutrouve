/**
 * DASHBOARD CLIENT - INTERACTIONS MODERNES
 * Créé le: 11 Novembre 2025
 * Animations légères et interactions fluides
 */

(function () {
    'use strict';

    // ==================== CONSTANTES ====================
    const ANIMATION_DURATION = 300;
    const SCROLL_THRESHOLD = 100;

    // ==================== DOM READY ====================
    document.addEventListener('DOMContentLoaded', function () {
        initDashboard();
        initSmoothScrolling();
        initCardAnimations();
        initReviewTabs();
        initTooltips();
        initCountUpAnimation();
        initLoadingStates();
        initNotifications();
    });

    // ==================== INITIALISATION DASHBOARD ====================
    function initDashboard() {
        console.log('✨ Dashboard Moderne initialisé');

        // Animation d'entrée progressive
        animateElements();

        // Ajouter classe pour animations CSS
        document.body.classList.add('dashboard-loaded');

        // Observer pour animations au scroll
        setupScrollObserver();
    }

    // ==================== ANIMATIONS D'ENTRÉE ====================
    function animateElements() {
        const elements = document.querySelectorAll('.stat-card, .card-modern, .menu-item');

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
                }
            });
        }, {
            threshold: 0.1
        });

        const observeElements = document.querySelectorAll('.seller-part, .all-reviews, .list-state');
        observeElements.forEach(el => observer.observe(el));
    }

    // ==================== SMOOTH SCROLLING ====================
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));

                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // ==================== ANIMATIONS DES CARDS ====================
    function initCardAnimations() {
        const cards = document.querySelectorAll('.stat-card, .card-modern, .seller-part-inner');

        cards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    }

    // ==================== ONGLETS REVIEWS ====================
    function initReviewTabs() {
        const tabButtons = document.querySelectorAll('.review-tab-btn button');
        const tabContents = document.querySelectorAll('.review-wraper');

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');

                // Retirer active de tous les boutons et contenus
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Ajouter active au bouton cliqué
                this.classList.add('active');

                // Afficher le contenu correspondant avec animation
                const targetContent = document.querySelector(targetId);
                if (targetContent) {
                    setTimeout(() => {
                        targetContent.classList.add('active');
                    }, 100);
                }
            });
        });
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
                const tooltip = document.querySelector('.modern-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                    setTimeout(() => tooltip.remove(), 200);
                }
            });
        });
    }

    function createTooltip(text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'modern-tooltip';
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
        `;

        setTimeout(() => tooltip.style.opacity = '1', 10);
        return tooltip;
    }

    function positionTooltip(tooltip, target) {
        const rect = target.getBoundingClientRect();
        tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
        tooltip.style.left = `${rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)}px`;
    }

    // ==================== ANIMATION COMPTEUR ====================
    function initCountUpAnimation() {
        const counters = document.querySelectorAll('.list-head');

        const animateCounter = (counter) => {
            const target = parseInt(counter.textContent);
            const duration = 1500;
            const step = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    entry.target.classList.add('counted');
                    animateCounter(entry.target);
                }
            });
        });

        counters.forEach(counter => observer.observe(counter));
    }

    // ==================== ÉTATS DE CHARGEMENT ====================
    function initLoadingStates() {
        // Simuler le chargement initial
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';

        // Supprimer après le chargement de la page
        window.addEventListener('load', function () {
            setTimeout(() => {
                loadingOverlay.classList.add('hidden');
                setTimeout(() => loadingOverlay.remove(), 300);
            }, 500);
        });
    }

    // ==================== NOTIFICATIONS ====================
    function initNotifications() {
        window.showDashboardNotification = function (message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `dashboard-notification notification-${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <span class="notification-icon">${getNotificationIcon(type)}</span>
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
                min-width: 300px;
                border-left: 4px solid ${getNotificationColor(type)};
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

    function getNotificationIcon(type) {
        const icons = {
            success: '✓',
            error: '✕',
            warning: '⚠',
            info: 'ℹ'
        };
        return icons[type] || icons.info;
    }

    function getNotificationColor(type) {
        const colors = {
            success: '#10b981',
            error: '#ef4444',
            warning: '#f59e0b',
            info: '#3b82f6'
        };
        return colors[type] || colors.info;
    }

    // ==================== MENU SIDEBAR ACTIF ====================
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar-menu-wraper .menu-item');

    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentPath.includes(href)) {
            item.classList.add('active');
        }
    });

    // ==================== HOVER EFFECT AVANCÉ ====================
    document.querySelectorAll('.menu-item, .btn-modern').forEach(element => {
        element.addEventListener('mouseenter', function (e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                width: 20px;
                height: 20px;
                transform: scale(0);
                animation: ripple-animation 0.6s ease-out;
                pointer-events: none;
            `;

            const rect = this.getBoundingClientRect();
            ripple.style.left = `${e.clientX - rect.left - 10}px`;
            ripple.style.top = `${e.clientY - rect.top - 10}px`;

            this.style.position = 'relative';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Ajouter l'animation ripple dans le style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .animate-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .dashboard-notification .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .dashboard-notification .notification-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
        }
        
        .dashboard-notification .notification-message {
            color: #1F3E39;
            font-weight: 500;
            font-size: 0.95rem;
        }
    `;
    document.head.appendChild(style);

    // ==================== PERFORMANCE MONITORING ====================
    if (window.performance && window.performance.timing) {
        window.addEventListener('load', function () {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log(`⚡ Dashboard chargé en ${loadTime}ms`);
        });
    }

})();
