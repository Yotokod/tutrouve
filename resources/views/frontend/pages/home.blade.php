@extends('frontend.layout.master')

@push('styles')
<style>
    /* Global Animations and Transitions */
    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Page fade-in animation */
    .page-content {
        animation: pageLoad 0.6s ease-out;
    }

    @keyframes pageLoad {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Improved hover states */
    .listing-card-glass:hover .image-overlay {
        opacity: 1;
    }

    .listing-card-glass:hover .favorite-btn-wrapper {
        opacity: 1 !important;
        transform: scale(1) !important;
    }

    /* Smooth animations for all interactive elements */
    a, button, input, .listing-card-glass, .category-card-glass {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced glassmorphism effect */
    @supports (backdrop-filter: blur(10px)) or (-webkit-backdrop-filter: blur(10px)) {
        .listing-card-glass,
        .category-card-glass {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    }

    /* Responsive container adjustments */
    @media (max-width: 1440px) {
        .container-1440 {
            max-width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    /* Animation for lazy-loaded images */
    img {
        transition: opacity 0.3s ease-in-out;
    }

    img[loading="lazy"] {
        opacity: 0;
    }

    img.loaded {
        opacity: 1;
    }

    /* Focus states for accessibility */
    a:focus, button:focus, input:focus {
        outline: 2px solid #93bd93;
        outline-offset: 2px;
    }

    /* Stagger animation for cards */
    .listing-card-glass {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .listing-card-glass:nth-child(1) { animation-delay: 0.1s; }
    .listing-card-glass:nth-child(2) { animation-delay: 0.2s; }
    .listing-card-glass:nth-child(3) { animation-delay: 0.3s; }
    .listing-card-glass:nth-child(4) { animation-delay: 0.4s; }
    .listing-card-glass:nth-child(5) { animation-delay: 0.5s; }
    .listing-card-glass:nth-child(6) { animation-delay: 0.6s; }
    .listing-card-glass:nth-child(7) { animation-delay: 0.7s; }
    .listing-card-glass:nth-child(8) { animation-delay: 0.8s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===============================================
       TUTROUVE SLIDER STYLES - Original Design
       =============================================== */
    .tutslider-wrapper {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .tutslider {
        height: 500px;
        position: relative;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .tutslider-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 500px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        z-index: 1;
    }

    .tutslider-slide:first-child {
        opacity: 1;
        z-index: 3;
    }

    .tutslider-slide[onclick] {
        cursor: pointer;
    }

    /* Navigation Arrows with Glassmorphism */
    .tutslider > i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        border-radius: 50%;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
    }

    .tutslider > i.tutslider-left {
        left: 20px;
    }

    .tutslider > i.tutslider-right {
        right: 20px;
    }

    .tutslider:hover > i {
        opacity: 1;
    }

    .tutslider:hover > i.tutslider-left {
        left: 20px;
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .tutslider:hover > i.tutslider-right {
        right: 20px;
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .tutslider > i svg {
        width: 20px;
        height: 20px;
        fill: #ffffff;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .tutslider > i:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: translateY(-50%) scale(1.1);
    }

    /* Dots Indicators */
    .tutslider > ul {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 12px;
        list-style: none;
        padding: 12px 20px;
        margin: 0;
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .tutslider > ul > li {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .tutslider > ul > li:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.2);
    }

    .tutslider > ul > li.tutslider-active {
        width: 32px;
        border-radius: 16px;
        background: #93bd93;
        box-shadow: 0 4px 16px rgba(147, 189, 147, 0.5);
    }

    /* Textbox with Frozen Glass Effect */
    .tutslider-slide .tutslider-textbox {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        border-radius: 24px;
        padding: 40px 50px;
        max-width: 600px;
        text-align: center;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        z-index: 5;
    }

    .tutslider-slide .tutslider-textbox h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        padding-bottom: 16px;
        position: relative;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .tutslider-slide .tutslider-textbox h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: #93bd93;
        border-radius: 3px;
        box-shadow: 0 2px 8px rgba(147, 189, 147, 0.5);
    }

    .tutslider-slide .tutslider-textbox p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.95);
        margin: 16px 0 0;
        line-height: 1.6;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    }

    /* Clickable slides indicator */
    .tutslider-slide[onclick]::after {
        content: '➜';
        position: absolute;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: rgba(147, 189, 147, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 24px;
        z-index: 6;
        box-shadow: 0 8px 24px rgba(147, 189, 147, 0.4);
        transition: all 0.3s ease;
    }

    /* Responsive Slider */
    @media (max-width: 992px) {
        .tutslider,
        .tutslider-slide {
            height: 400px;
        }

        .tutslider-slide .tutslider-textbox {
            padding: 30px 35px;
            max-width: 500px;
        }

        .tutslider-slide .tutslider-textbox h3 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 768px) {
        .tutslider,
        .tutslider-slide {
            height: 350px;
        }

        .tutslider-slide .tutslider-textbox {
            padding: 25px 30px;
            max-width: 85%;
        }

        .tutslider > i {
            width: 45px;
            height: 45px;
        }

        .tutslider > ul {
            bottom: 20px;
            padding: 10px 16px;
        }
    }

    @media (max-width: 576px) {
        .tutslider,
        .tutslider-slide {
            height: 300px;
        }

        .tutslider-slide .tutslider-textbox {
            padding: 20px 25px;
            max-width: 90%;
        }

        .tutslider-slide .tutslider-textbox h3 {
            font-size: 1.25rem;
        }

        .tutslider-slide .tutslider-textbox p {
            font-size: 0.85rem;
        }

        .tutslider > i {
            width: 40px;
            height: 40px;
        }
    }
</style>
@endpush

@section('content')
<div class="page-content">
    <!-- Hero Section - Design amélioré avec particules animées -->
    @include('frontend.pages.sections.hero')

    <!-- Top Annonces / Featured Listings Section -->
    @include('frontend.pages.sections.top-listings')

    <!-- Categories Browse Section -->
    @include('frontend.pages.sections.browse-categories')

    <!-- Recent Listings Section -->
    @include('frontend.pages.sections.recent-listings')

    <!-- Call To Action Section avec statistiques -->
    @include('frontend.pages.sections.cta')
</div>
@endsection

@push('scripts')
<script>
    // Lazy load images with fade-in effect
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img[loading="lazy"]');
        
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
            
            // Si l'image est déjà chargée (depuis le cache)
            if (img.complete) {
                img.classList.add('loaded');
            }
        });
    });

    // Smooth scroll to sections
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('.top-listings-section, .browse-categories-section, .recent-listings-section, .cta-section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(section);
    });

    // ===============================================
    // TUTROUVE SLIDER SCRIPT - Original Design
    // ===============================================
    (function() {
        'use strict';
        
        const TutrouveSlider = {
            slider: null,
            slides: [],
            currentIndex: 0,
            interval: null,
            autoPlayDelay: 5000,

            init: function() {
                this.slider = document.getElementById('tutslider3');
                if (!this.slider) return;

                this.slides = Array.from(this.slider.querySelectorAll('.tutslider-slide'));
                if (this.slides.length === 0) return;

                this.setupDots();
                this.setupArrows();
                this.setupAutoPlay();
                this.setupKeyboard();
                this.showSlide(0);
            },

            setupDots: function() {
                if (this.slides.length <= 1) return;

                const ul = document.createElement('ul');
                this.slides.forEach((_, index) => {
                    const li = document.createElement('li');
                    if (index === 0) li.classList.add('tutslider-active');
                    li.addEventListener('click', () => this.goToSlide(index));
                    li.setAttribute('tabindex', '0');
                    li.setAttribute('role', 'button');
                    li.setAttribute('aria-label', `Aller au slide ${index + 1}`);
                    ul.appendChild(li);
                });
                this.slider.appendChild(ul);
            },

            setupArrows: function() {
                const leftArrow = this.slider.querySelector('.tutslider-left');
                const rightArrow = this.slider.querySelector('.tutslider-right');

                if (leftArrow) {
                    leftArrow.addEventListener('click', () => this.prevSlide());
                    leftArrow.setAttribute('tabindex', '0');
                    leftArrow.setAttribute('role', 'button');
                    leftArrow.setAttribute('aria-label', 'Slide précédent');
                }

                if (rightArrow) {
                    rightArrow.addEventListener('click', () => this.nextSlide());
                    rightArrow.setAttribute('tabindex', '0');
                    rightArrow.setAttribute('role', 'button');
                    rightArrow.setAttribute('aria-label', 'Slide suivant');
                }
            },

            setupAutoPlay: function() {
                this.startAutoPlay();
                
                this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
                this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
            },

            setupKeyboard: function() {
                const controls = this.slider.querySelectorAll('.tutslider-arrows, ul > li');
                controls.forEach(control => {
                    control.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            control.click();
                        }
                    });
                });
            },

            showSlide: function(index) {
                this.slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? '1' : '0';
                    slide.style.zIndex = i === index ? '3' : '1';
                });

                const dots = this.slider.querySelectorAll('ul > li');
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('tutslider-active');
                    } else {
                        dot.classList.remove('tutslider-active');
                    }
                });

                this.currentIndex = index;
            },

            goToSlide: function(index) {
                this.showSlide(index);
                this.resetAutoPlay();
            },

            nextSlide: function() {
                const nextIndex = (this.currentIndex + 1) % this.slides.length;
                this.goToSlide(nextIndex);
            },

            prevSlide: function() {
                const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                this.goToSlide(prevIndex);
            },

            startAutoPlay: function() {
                if (this.slides.length <= 1) return;
                this.interval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
            },

            stopAutoPlay: function() {
                clearInterval(this.interval);
            },

            resetAutoPlay: function() {
                this.stopAutoPlay();
                this.startAutoPlay();
            }
        };

        // Init slider when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                TutrouveSlider.init();
            });
        } else {
            TutrouveSlider.init();
        }
    })();
</script>
@endpush
