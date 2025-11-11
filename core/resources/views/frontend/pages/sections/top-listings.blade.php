<!-- Top Listings / Top Annonces Section -->
<div class="top-listings-section">
    <div class="container-1440">
        <!-- Section Header -->
        <div class="section-header-top">
            <div class="section-title-wrapper">
                <h2 class="section-title">
                    {{ __('Top Annonces') }}
                </h2>
                <p class="section-subtitle">
                    {{ __('Découvrez les meilleures offres du moment') }}
                </p>
            </div>
            <a href="{{ route('frontend.home.search') }}" class="btn-explore">
                <span>{{ __('Explorer tous') }}</span>
                <i class="las la-arrow-right"></i>
            </a>
        </div>

        <!-- Listings Carousel with Modern Card Design -->
        <div class="listings-carousel-wrapper">
            <button class="carousel-nav carousel-prev" aria-label="Previous">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <div class="listings-carousel" id="topListingsCarousel">
                @forelse($topListings ?? [] as $listing)
                <div class="listing-card">
                    <!-- Image Container -->
                    <div class="listing-image-wrapper">
                        <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="listing-image-link">
                            {!! render_image_markup_by_attachment_id($listing->image, '', '', 'thumb') !!}
                            <div class="listing-image-overlay"></div>
                        </a>

                        <!-- Featured Badge -->
                        @if($listing->is_featured == 1)
                            <div class="listing-badge featured-badge">
                                <svg width="12" height="14" viewBox="0 0 7 10" fill="none">
                                    <path d="M4 0V3.88889H7L3 10V6.11111H0L4 0Z" fill="currentColor"/>
                                </svg>
                                <span>{{ __('En vedette') }}</span>
                            </div>
                        @endif

                        <!-- Favorite Button -->
                        <div class="listing-favorite">
                            <x-listings.favorite-item-add-remove :favorite="$listing->id ?? 0" />
                        </div>

                        <!-- Price Badge -->
                        <div class="listing-price-badge">
                            {{ amount_with_currency_symbol($listing->price) }}
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="listing-content">
                        <!-- Title -->
                        <h3 class="listing-title">
                            <a href="{{ route('frontend.listing.details', $listing->slug) }}">
                                {{ $listing->title }}
                            </a>
                        </h3>

                        <!-- Location & Date -->
                        <div class="listing-meta">
                            <div class="listing-location">
                                <i class="las la-map-marker"></i>
                                <x-listings.listing-location :listing="$listing"/>
                            </div>
                            @if(!empty($listing->published_at))
                                <div class="listing-date">
                                    <i class="las la-clock"></i>
                                    <span>{{ \Carbon\Carbon::parse($listing->published_at)->diffForHumans() }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- View Details Button -->
                        <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="listing-btn">
                            <span>{{ __('Voir les détails') }}</span>
                            <i class="las la-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="no-listings">
                    <i class="las la-inbox"></i>
                    <p>{{ __('Aucune annonce disponible pour le moment') }}</p>
                </div>
            @endforelse
            </div>
            
            <button class="carousel-nav carousel-next" aria-label="Next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
/* Top Listings Section */
.top-listings-section {
    padding: 100px 0;
    background: #ffffff;
    position: relative;
}

/* Section Header */
.section-header-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 50px;
    gap: 24px;
    flex-wrap: wrap;
}

.section-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    color: #1F3E39;
    margin: 0 0 8px 0;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.section-subtitle {
    font-size: clamp(0.875rem, 1.5vw, 1rem);
    color: #666666;
    margin: 0;
    line-height: 1.6;
}

.btn-explore {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 15px;
    text-decoration: none;
    box-shadow: 0 4px 16px rgba(31, 62, 57, 0.25);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
}

.btn-explore:hover {
    background: linear-gradient(135deg, #2d5850 0%, #1F3E39 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(31, 62, 57, 0.35);
}

.btn-explore i {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.btn-explore:hover i {
    transform: translateX(4px);
}

/* Listings Carousel Wrapper */
.listings-carousel-wrapper {
    position: relative;
    padding: 0 60px;
}

/* Carousel Navigation Buttons */
.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(31, 62, 57, 0.9);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.carousel-prev {
    left: 0;
}

.carousel-next {
    right: 0;
}

.carousel-nav:hover {
    background: rgba(31, 62, 57, 1);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 20px rgba(31, 62, 57, 0.4);
}

.carousel-nav:active {
    transform: translateY(-50%) scale(0.95);
}

.carousel-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* Listings Carousel */
.listings-carousel {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.listings-carousel::-webkit-scrollbar {
    display: none;
}

/* Listing Card */
.listing-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    min-width: 260px;
    max-width: 260px;
    flex-shrink: 0;
}

.listing-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(31, 62, 57, 0.15);
    border-color: #1F3E39;
}

/* Image Wrapper */
.listing-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 180px;
    background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
}

.listing-image-link {
    display: block;
    height: 100%;
    position: relative;
}

.listing-image-link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.listing-card:hover .listing-image-link img {
    transform: scale(1.08);
}

.listing-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.6) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.listing-card:hover .listing-image-overlay {
    opacity: 1;
}

/* Featured Badge */
.listing-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 10px;
    background: linear-gradient(135deg, #FFB800 0%, #FF8C00 100%);
    color: #ffffff;
    border-radius: 50px;
    font-size: 10px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(255, 184, 0, 0.4);
    z-index: 3;
    animation: pulse-badge 2s ease-in-out infinite;
}

.listing-badge svg {
    width: 10px;
    height: 10px;
}

@keyframes pulse-badge {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 4px 12px rgba(255, 184, 0, 0.4);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(255, 184, 0, 0.6);
    }
}

/* Favorite Button */
.listing-favorite {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 3;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.listing-favorite > * {
    transform: scale(0.85);
}

.listing-card:hover .listing-favorite {
    opacity: 1;
    transform: scale(1);
}

/* Price Badge */
.listing-price-badge {
    position: absolute;
    bottom: 12px;
    left: 12px;
    padding: 8px 14px;
    background: rgba(31, 62, 57, 0.95);
    backdrop-filter: blur(10px);
    color: #ffffff;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 800;
    box-shadow: 0 4px 16px rgba(31, 62, 57, 0.3);
    z-index: 3;
    letter-spacing: -0.5px;
}

/* Card Content */
.listing-content {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 12px;
}

/* Title */
.listing-title {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 700;
    line-height: 1.4;
    min-height: 42px;
}

.listing-title a {
    color: #1F3E39;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
}

.listing-title a:hover {
    color: #2d5850;
}

/* Meta Info */
.listing-meta {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 0.8rem;
    color: #666666;
}

.listing-location,
.listing-date {
    display: flex;
    align-items: center;
    gap: 4px;
}

.listing-location i,
.listing-date i {
    font-size: 14px;
    color: #1F3E39;
}

/* View Details Button */
.listing-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 16px;
    background: linear-gradient(135deg, rgba(31, 62, 57, 0.05) 0%, rgba(31, 62, 57, 0.1) 100%);
    color: #1F3E39;
    border: 2px solid rgba(31, 62, 57, 0.2);
    border-radius: 10px;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: auto;
}

.listing-btn:hover {
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border-color: #1F3E39;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(31, 62, 57, 0.25);
}

.listing-btn i {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.listing-btn:hover i {
    transform: translateX(4px);
}

/* No Listings */
.no-listings {
    grid-column: 1 / -1;
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(135deg, #f8faf9 0%, #f0f4f3 100%);
    border-radius: 20px;
    border: 2px dashed #d0d0d0;
}

.no-listings i {
    font-size: 72px;
    color: #1F3E39;
    opacity: 0.3;
    margin-bottom: 20px;
    display: block;
}

.no-listings p {
    font-size: 1.125rem;
    color: #666666;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 992px) {
    .top-listings-section {
        padding: 80px 0;
    }
    
    .section-header-top {
        margin-bottom: 40px;
    }
    
    .listings-carousel-wrapper {
        padding: 0 50px;
    }
    
    .carousel-nav {
        width: 45px;
        height: 45px;
    }
    
    .listing-card {
        min-width: 240px;
        max-width: 240px;
    }
    
    .listing-image-wrapper {
        height: 170px;
    }
}

@media (max-width: 768px) {
    .top-listings-section {
        padding: 60px 0;
    }
    
    .section-header-top {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 32px;
    }
    
    .btn-explore {
        width: 100%;
        justify-content: center;
    }
    
    .listings-carousel-wrapper {
        padding: 0 40px;
    }
    
    .carousel-nav {
        width: 40px;
        height: 40px;
    }
    
    .carousel-nav svg {
        width: 20px;
        height: 20px;
    }
    
    .listing-card {
        min-width: 220px;
        max-width: 220px;
    }
    
    .listing-content {
        padding: 14px;
        gap: 10px;
    }
    
    .listing-image-wrapper {
        height: 160px;
    }
}

@media (max-width: 576px) {
    .top-listings-section {
        padding: 50px 0;
    }
    
    .listings-carousel-wrapper {
        padding: 0 35px;
    }
    
    .carousel-nav {
        width: 36px;
        height: 36px;
    }
    
    .carousel-nav svg {
        width: 18px;
        height: 18px;
    }
    
    .listing-card {
        min-width: 200px;
        max-width: 200px;
        border-radius: 14px;
    }
    
    .listing-image-wrapper {
        height: 150px;
    }
    
    .listing-content {
        padding: 12px;
    }
    
    .listing-title {
        font-size: 0.875rem;
        min-height: auto;
    }
    
    .listing-price-badge {
        font-size: 0.9rem;
        padding: 6px 10px;
    }
    
    .no-listings {
        padding: 60px 20px;
        min-width: 100%;
    }
    
    .no-listings i {
        font-size: 56px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('topListingsCarousel');
    if (!carousel) return;
    
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');
    const carouselWrapper = document.querySelector('.listings-carousel-wrapper');
    
    if (!prevBtn || !nextBtn) return;
    
    const scrollAmount = 284; // Card width (260px) + gap (24px)
    let autoplayInterval;
    let isUserInteracting = false;
    
    function updateButtons() {
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        prevBtn.disabled = carousel.scrollLeft <= 0;
        nextBtn.disabled = carousel.scrollLeft >= maxScroll - 1;
    }
    
    function scrollNext() {
        const maxScroll = carousel.scrollWidth - carousel.clientWidth;
        
        // Si on est à la fin, revenir au début
        if (carousel.scrollLeft >= maxScroll - 1) {
            carousel.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        } else {
            carousel.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
        
        setTimeout(updateButtons, 400);
    }
    
    function startAutoplay() {
        // Ne démarrer l'autoplay que s'il y a assez de contenu pour scroller
        const hasScrollableContent = carousel.scrollWidth > carousel.clientWidth;
        
        if (hasScrollableContent && !isUserInteracting) {
            autoplayInterval = setInterval(scrollNext, 3000);
        }
    }
    
    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }
    
    // Navigation manuelle
    prevBtn.addEventListener('click', () => {
        stopAutoplay();
        isUserInteracting = true;
        
        carousel.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
        
        setTimeout(() => {
            updateButtons();
            isUserInteracting = false;
            startAutoplay();
        }, 400);
    });
    
    nextBtn.addEventListener('click', () => {
        stopAutoplay();
        isUserInteracting = true;
        
        scrollNext();
        
        setTimeout(() => {
            isUserInteracting = false;
            startAutoplay();
        }, 400);
    });
    
    // Pause au survol du carrousel
    if (carouselWrapper) {
        carouselWrapper.addEventListener('mouseenter', () => {
            stopAutoplay();
        });
        
        carouselWrapper.addEventListener('mouseleave', () => {
            if (!isUserInteracting) {
                startAutoplay();
            }
        });
    }
    
    // Pause au focus/interaction avec une card
    const listingCards = carousel.querySelectorAll('.listing-card');
    listingCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            stopAutoplay();
        });
        
        card.addEventListener('mouseleave', () => {
            if (!isUserInteracting && !carouselWrapper.matches(':hover')) {
                startAutoplay();
            }
        });
    });
    
    carousel.addEventListener('scroll', updateButtons);
    
    // Initial button state
    updateButtons();
    
    // Update on window resize
    window.addEventListener('resize', () => {
        updateButtons();
        stopAutoplay();
        startAutoplay();
    });
    
    // Démarrer l'autoplay
    startAutoplay();
    
    // Cleanup
    window.addEventListener('beforeunload', stopAutoplay);
});
</script>
