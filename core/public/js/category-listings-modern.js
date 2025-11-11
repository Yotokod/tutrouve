/**
 * CATEGORY LISTINGS - INTERACTIONS MODERNES
 * Sidebar toggle, animations, filtres
 */

(function () {
    'use strict';

    // ==================== INITIALISATION ====================
    document.addEventListener('DOMContentLoaded', function () {
        initSidebar();
        initAnimations();
        initCounterAnimation();
        initScrollEffects();
    });

    // ==================== SIDEBAR MOBILE ====================
    function initSidebar() {
        const filterToggle = document.getElementById('filterToggle');
        const sidebarContent = document.getElementById('sidebarContent');
        const sidebarClose = document.getElementById('sidebarClose');

        if (!filterToggle || !sidebarContent) return;

        // Créer overlay pour mobile
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);

        // Ouvrir sidebar
        filterToggle.addEventListener('click', function () {
            sidebarContent.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // Fermer sidebar
        function closeSidebar() {
            sidebarContent.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (sidebarClose) {
            sidebarClose.addEventListener('click', closeSidebar);
        }

        overlay.addEventListener('click', closeSidebar);

        // Fermer avec Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebarContent.classList.contains('active')) {
                closeSidebar();
            }
        });
    }

    // ==================== ANIMATIONS ====================
    function initAnimations() {
        // Animer les éléments au chargement
        const filterItems = document.querySelectorAll('.filter-item');

        filterItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-10px)';

            setTimeout(() => {
                item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 30);
        });

        // Animation des cards listings
        const listingCards = document.querySelectorAll('.single-listing, .listing-card');

        listingCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }

    // ==================== COUNTER ANIMATION ====================
    function initCounterAnimation() {
        const countNumber = document.querySelector('.count-number');

        if (!countNumber) return;

        const target = parseInt(countNumber.textContent);
        const duration = 1000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                countNumber.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                countNumber.textContent = target;
            }
        };

        // Observer pour démarrer l'animation quand visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !countNumber.classList.contains('animated')) {
                    countNumber.classList.add('animated');
                    updateCounter();
                }
            });
        });

        observer.observe(countNumber);
    }

    // ==================== SCROLL EFFECTS ====================
    function initScrollEffects() {
        const sidebar = document.querySelector('.listings-sidebar');

        if (!sidebar || window.innerWidth < 992) return;

        let lastScroll = 0;
        const header = document.querySelector('.page-header-category');
        const headerHeight = header ? header.offsetHeight : 0;

        window.addEventListener('scroll', function () {
            const currentScroll = window.pageYOffset;

            // Ajuster position sticky du sidebar
            if (currentScroll > headerHeight) {
                sidebar.style.top = '20px';
            } else {
                sidebar.style.top = '100px';
            }

            lastScroll = currentScroll;
        });

        // Animation au scroll pour les éléments
        const observeElements = document.querySelectorAll('.filter-group, .listings-header');

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        observeElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            scrollObserver.observe(el);
        });
    }

    // ==================== RIPPLE EFFECT ====================
    document.addEventListener('click', function (e) {
        const filterItem = e.target.closest('.filter-item');

        if (!filterItem) return;

        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(31, 62, 57, 0.3);
            width: 20px;
            height: 20px;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;

        const rect = filterItem.getBoundingClientRect();
        ripple.style.left = `${e.clientX - rect.left - 10}px`;
        ripple.style.top = `${e.clientY - rect.top - 10}px`;

        filterItem.style.position = 'relative';
        filterItem.style.overflow = 'hidden';
        filterItem.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });

    // Ajouter l'animation ripple
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .filter-item {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);

    // ==================== SMOOTH SCROLL ====================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);

            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ==================== PERFORMANCE MONITORING ====================
    if (window.performance && window.performance.timing) {
        window.addEventListener('load', function () {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log(`⚡ Page de catégorie chargée en ${loadTime}ms`);
        });
    }

    // ==================== EXPORT ====================
    window.CategoryListings = {
        initAnimations: initAnimations,
        initCounterAnimation: initCounterAnimation
    };

    console.log('✅ Category Listings Modern initialisé!');

})();
