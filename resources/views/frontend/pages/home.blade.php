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
</script>
@endpush
