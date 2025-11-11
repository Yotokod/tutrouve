/**
 * LISTING DETAILS - INTERACTIONS MODERNES
 * Galerie, favoris, reviews, contact forms
 */

(function () {
    'use strict';

    // ==================== CONSTANTES ====================
    const ANIMATION_DURATION = 300;

    // ==================== INITIALISATION ====================
    document.addEventListener('DOMContentLoaded', function () {
        initGallery();
        initFavorites();
        initShareButtons();
        initPhoneReveal();
        initScrollAnimations();
        initReviewForm();
        initContactForm();
        initTabSwitcher();
    });

    // ==================== GALERIE PHOTOS ====================
    function initGallery() {
        const mainImage = document.querySelector('.gallery-main-image img');
        const thumbnails = document.querySelectorAll('.gallery-thumb');
        const prevBtn = document.querySelector('.gallery-arrow.prev');
        const nextBtn = document.querySelector('.gallery-arrow.next');

        if (!mainImage || thumbnails.length === 0) return;

        let currentIndex = 0;
        const images = Array.from(thumbnails).map(thumb => thumb.querySelector('img').src);

        // Clic sur thumbnail
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', function () {
                setActiveImage(index);
            });
        });

        // Navigation avec flèches
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                setActiveImage(currentIndex);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                currentIndex = (currentIndex + 1) % images.length;
                setActiveImage(currentIndex);
            });
        }

        // Navigation clavier
        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') prevBtn?.click();
            if (e.key === 'ArrowRight') nextBtn?.click();
        });

        function setActiveImage(index) {
            currentIndex = index;

            // Fade out
            mainImage.style.opacity = '0';

            setTimeout(() => {
                mainImage.src = images[index];
                mainImage.style.opacity = '1';
            }, 200);

            // Update active thumbnail
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }

        // Initialiser le premier thumbnail comme actif
        if (thumbnails[0]) {
            thumbnails[0].classList.add('active');
        }

        // Zoom sur image principale
        if (mainImage.parentElement) {
            mainImage.parentElement.addEventListener('click', function () {
                openLightbox(images, currentIndex);
            });
        }
    }

    // ==================== LIGHTBOX ==================== 
    function openLightbox(images, startIndex) {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox-overlay';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <button class="lightbox-close">&times;</button>
                <button class="lightbox-prev">
                    <i class="las la-angle-left"></i>
                </button>
                <img src="${images[startIndex]}" alt="Listing Image">
                <button class="lightbox-next">
                    <i class="las la-angle-right"></i>
                </button>
                <div class="lightbox-counter">${startIndex + 1} / ${images.length}</div>
            </div>
        `;

        // Styles inline
        lightbox.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        `;

        document.body.appendChild(lightbox);
        document.body.style.overflow = 'hidden';

        setTimeout(() => lightbox.style.opacity = '1', 10);

        let currentIdx = startIndex;
        const img = lightbox.querySelector('img');
        const counter = lightbox.querySelector('.lightbox-counter');

        function updateImage() {
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = images[currentIdx];
                counter.textContent = `${currentIdx + 1} / ${images.length}`;
                img.style.opacity = '1';
            }, 200);
        }

        lightbox.querySelector('.lightbox-close').addEventListener('click', closeLightbox);
        lightbox.querySelector('.lightbox-prev').addEventListener('click', () => {
            currentIdx = (currentIdx - 1 + images.length) % images.length;
            updateImage();
        });
        lightbox.querySelector('.lightbox-next').addEventListener('click', () => {
            currentIdx = (currentIdx + 1) % images.length;
            updateImage();
        });

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });

        document.addEventListener('keydown', handleLightboxKeys);

        function handleLightboxKeys(e) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') lightbox.querySelector('.lightbox-prev').click();
            if (e.key === 'ArrowRight') lightbox.querySelector('.lightbox-next').click();
        }

        function closeLightbox() {
            lightbox.style.opacity = '0';
            document.body.style.overflow = '';
            document.removeEventListener('keydown', handleLightboxKeys);
            setTimeout(() => lightbox.remove(), 300);
        }

        // Ajouter styles CSS pour les éléments du lightbox
        const style = document.createElement('style');
        style.textContent = `
            .lightbox-content {
                position: relative;
                max-width: 90vw;
                max-height: 90vh;
            }
            .lightbox-content img {
                max-width: 100%;
                max-height: 90vh;
                object-fit: contain;
                transition: opacity 0.2s;
            }
            .lightbox-close,
            .lightbox-prev,
            .lightbox-next {
                position: absolute;
                background: rgba(255, 255, 255, 0.9);
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                font-size: 24px;
                transition: all 0.3s;
                z-index: 10;
            }
            .lightbox-close {
                top: 20px;
                right: 20px;
            }
            .lightbox-close:hover {
                background: #ef4444;
                color: white;
            }
            .lightbox-prev {
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
            }
            .lightbox-next {
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
            }
            .lightbox-prev:hover,
            .lightbox-next:hover {
                background: #1F3E39;
                color: white;
            }
            .lightbox-counter {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 14px;
            }
        `;
        document.head.appendChild(style);
    }

    // ==================== FAVORIS ====================
    function initFavorites() {
        const favoriteBtn = document.querySelector('.btn-favorite');

        if (!favoriteBtn) return;

        favoriteBtn.addEventListener('click', function () {
            this.classList.toggle('active');

            if (this.classList.contains('active')) {
                showNotification('Ajouté aux favoris ❤️', 'success');
                this.style.animation = 'pulse 0.3s ease';
            } else {
                showNotification('Retiré des favoris', 'info');
            }

            setTimeout(() => {
                this.style.animation = '';
            }, 300);
        });
    }

    // ==================== PARTAGE ====================
    function initShareButtons() {
        const shareBtn = document.querySelector('.btn-share');

        if (!shareBtn) return;

        shareBtn.addEventListener('click', function () {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                }).catch(() => { });
            } else {
                copyToClipboard(window.location.href);
                showNotification('Lien copié dans le presse-papiers !', 'success');
            }
        });
    }

    function copyToClipboard(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    }

    // ==================== RÉVÉLER TÉLÉPHONE ====================
    function initPhoneReveal() {
        const phoneBtn = document.getElementById('userPhoneNumberBtn');
        const maskedNumber = document.getElementById('default_phone_number_show');
        const fullNumber = document.getElementById('phoneNumber');

        if (!phoneBtn || !fullNumber) return;

        phoneBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Masquer le numéro masqué
            if (maskedNumber) {
                maskedNumber.style.display = 'none';
            }

            // Afficher le vrai numéro
            fullNumber.style.display = 'block';

            // Masquer le bouton
            this.style.display = 'none';

            showNotification('Numéro révélé !', 'success');
        });
    }

    // ==================== ANIMATIONS AU SCROLL ====================
    function initScrollAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        const elements = document.querySelectorAll('.listing-features, .listing-description, .listing-reviews');
        elements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });
    }

    // ==================== FORMULAIRE D'AVIS ====================
    function initReviewForm() {
        const reviewForm = document.querySelector('#reviewForm');

        if (!reviewForm) return;

        const stars = reviewForm.querySelectorAll('.star-rating i');
        let rating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('click', function () {
                rating = index + 1;
                updateStars(rating);
            });

            star.addEventListener('mouseenter', function () {
                updateStars(index + 1);
            });
        });

        reviewForm.addEventListener('mouseleave', function () {
            updateStars(rating);
        });

        function updateStars(count) {
            stars.forEach((star, index) => {
                star.classList.toggle('active', index < count);
            });
        }
    }

    // ==================== FORMULAIRE CONTACT ====================
    function initContactForm() {
        const contactForm = document.querySelector('#contactForm');

        if (!contactForm) return;

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validation simple
            const name = this.querySelector('[name="name"]');
            const email = this.querySelector('[name="email"]');
            const message = this.querySelector('[name="message"]');

            if (!name.value || !email.value || !message.value) {
                showNotification('Veuillez remplir tous les champs', 'error');
                return;
            }

            // Simulation d'envoi
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Envoi en cours...';

            setTimeout(() => {
                showNotification('Message envoyé avec succès !', 'success');
                this.reset();
                submitBtn.disabled = false;
                submitBtn.textContent = 'Envoyer le message';
            }, 1500);
        });
    }

    // ==================== TAB SWITCHER ====================
    function initTabSwitcher() {
        const tabs = document.querySelectorAll('[data-tab]');
        const contents = document.querySelectorAll('[data-tab-content]');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                const targetId = this.dataset.tab;

                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                document.querySelector(`[data-tab-content="${targetId}"]`)?.classList.add('active');
            });
        });
    }

    // ==================== NOTIFICATIONS ====================
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;

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
            <div style="display: flex; align-items: center; gap: 12px;">
                <span style="color: ${colors[type]}; font-size: 24px;">${icons[type]}</span>
                <span style="flex: 1;">${message}</span>
            </div>
        `;

        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 10000;
            min-width: 300px;
            border-left: 4px solid ${colors[type]};
            opacity: 0;
            transform: translateX(400px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 10);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => notification.remove(), 400);
        }, 4000);
    }

    // ==================== ESCROW FORM VALIDATION ====================
    function initEscrowForm() {
        const escrowForm = document.getElementById('forme');
        const amountInput = document.getElementById('amount');

        if (!escrowForm || !amountInput) return;

        // Validation en temps réel
        amountInput.addEventListener('input', function () {
            const value = parseFloat(this.value);

            if (value < 0) {
                this.value = 0;
            }

            // Ajouter un feedback visuel
            if (value > 0) {
                this.style.borderColor = '#22C55E';
            } else {
                this.style.borderColor = '';
            }
        });

        // Validation avant soumission
        escrowForm.addEventListener('submit', function (e) {
            const amount = parseFloat(amountInput.value);

            if (!amount || amount <= 0) {
                e.preventDefault();
                showNotification('Veuillez entrer un montant valide', 'error');
                amountInput.focus();
                return false;
            }

            // Confirmation
            const confirmed = confirm(
                `Vous êtes sur le point d'initier une transaction Escrow de ${amount.toLocaleString()} FCFA.\n\n` +
                `Le montant sera bloqué en séquestre jusqu'à la confirmation de réception du produit.\n\n` +
                `Souhaitez-vous continuer?`
            );

            if (!confirmed) {
                e.preventDefault();
                return false;
            }

            // Afficher un message de chargement
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="las la-spinner la-spin"></i> Traitement en cours...';
                submitBtn.disabled = true;
            }
        });
    }

    // Ajouter l'initialisation du formulaire Escrow
    document.addEventListener('DOMContentLoaded', function () {
        initEscrowForm();
    });

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

    // ==================== PERFORMANCE ====================
    if (window.performance && window.performance.timing) {
        window.addEventListener('load', function () {
            const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
            console.log(`⚡ Page de détails chargée en ${loadTime}ms`);
        });
    }

    // ==================== EXPORT ====================
    window.ListingDetails = {
        showNotification: showNotification
    };

    console.log('✅ Listing Details Modern initialisé!');

})();
