@if($listings->count() > 0)
<!-- Section Listings Modernisée -->
<div class="exploreCategories modern-listings" data-padding-top="{{$padding_top}}" data-padding-bottom="{{$padding_bottom}}" style="background-color: {{$section_bg}}">
    <div class="container-1440">
        <!-- En-tête de section amélioré -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="section-title-wrapper">
                        <h2 class="section-title-modern">{{ $section_title ?? 'Top Listing' }}</h2>
                        <div class="title-underline"></div>
                    </div>
                    <form id="filter_with_listing_page_top" action="{{ url(get_static_option('listing_filter_page_url') ?? '/listings') }}" method="get">
                        <input type="hidden" name="listing_type_preferences" value="top_listing"/>
                        <button type="submit" class="btn-explore-modern" id="submit_form_listing_filter_top">
                            <span>{{ $explore_text }}</span>
                            <i class="las la-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Grille de listings -->
        <div class="row">
            <div class="col-lg-12">
                <div class="global-slick-init slider-inner-margin sliderArrow modern-slider" 
                     data-infinite="true" 
                     data-arrows="true" 
                     data-dots="false"  
                     data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"  
                     data-slidesToShow="4" 
                     data-swipeToSlide="true" 
                     data-autoplay="true" 
                     data-autoplaySpeed="3500" 
                     data-prevArrow='<div class="modern-arrow prev-arrow"><i class="las la-angle-left"></i></div>'
                     data-nextArrow='<div class="modern-arrow next-arrow"><i class="las la-angle-right"></i></div>' 
                     data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 4}},{"breakpoint": 1400,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 991,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"slidesToShow": 1}}]'>
                    
                    @foreach($listings as $listing)
                    <div class="listing-card-wrapper">
                        <div class="listing-card-modern">
                            <!-- Image avec overlay -->
                            <div class="listing-image-container">
                                <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="listing-image-link">
                                    {!! render_image_markup_by_attachment_id($listing->image, '','','thumb'); !!}
                                    <div class="image-overlay"></div>
                                </a>
                                
                                <!-- Badge En vedette -->
                                @if($listing->is_featured == 1)
                                <div class="featured-badge">
                                    <svg width="12" height="14" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0V3.88889H7L3 10V6.11111H0L4 0Z" fill="currentColor"/>
                                    </svg>
                                    <span>{{ __('En vedette') }}</span>
                                </div>
                                @endif
                                
                                <!-- Bouton favori -->
                                <div class="favorite-btn-wrapper">
                                    <x-listings.favorite-item-add-remove :favorite="$listing->id ?? 0" />
                                </div>
                            </div>

                            <!-- Contenu de la carte -->
                            <div class="listing-content">
                                <!-- Prix et date -->
                                <div class="listing-meta-top">
                                    <span class="listing-price">{{ amount_with_currency_symbol($listing->price) }}</span>
                                    @if(!empty($listing->published_at))
                                    <span class="listing-date">
                                        <i class="las la-clock"></i>
                                        {{ \Carbon\Carbon::parse($listing->published_at)->diffForHumans() }}
                                    </span>
                                    @endif
                                </div>

                                <!-- Titre -->
                                <h3 class="listing-title">
                                    <a href="{{ route('frontend.listing.details', $listing->slug) }}">
                                        {{ $listing->title }}
                                    </a>
                                </h3>

                                <!-- Localisation -->
                                <div class="listing-location">
                                    <x-listings.listing-location :listing="$listing"/>
                                </div>

                                <!-- Action button -->
                                <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="btn-view-details">
                                    <span>{{ __('Voir les détails') }}</span>
                                    <i class="las la-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS pour faciliter la personnalisation */
:root {
    --primary-color: #1F3E39;
    --primary-light: #2a534d;
    --secondary-color: #93bd93;
    --secondary-light: #a8cca8;
    --secondary-dark: #7da97d;
    --accent-color: #93bd93;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --bg-light: #f8f9fa;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 16px rgba(0,0,0,0.12);
    --shadow-lg: 0 8px 24px rgba(0,0,0,0.15);
    --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Section principale */
.modern-listings {
    padding: 60px 0;
}

/* En-tête de section */
.section-header {
    margin-bottom: 40px;
    animation: fadeInDown 0.6s ease-out;
}

.section-title-wrapper {
    position: relative;
}

.section-title-modern {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 12px;
    letter-spacing: -0.5px;
}

.title-underline {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
    animation: expandWidth 0.8s ease-out 0.3s both;
}

/* Bouton Explorer */
.btn-explore-modern {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: var(--transition-smooth);
    box-shadow: var(--shadow-sm);
    text-decoration: none;
}

.btn-explore-modern:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: white;
}

.btn-explore-modern i {
    transition: transform 0.3s ease;
    font-size: 18px;
}

.btn-explore-modern:hover i {
    transform: translateX(4px);
}

/* Carte de listing */
.listing-card-wrapper {
    padding: 10px;
}

.listing-card-modern {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: var(--transition-smooth);
    box-shadow: var(--shadow-sm);
    height: 100%;
    min-height: 450px;
    display: flex;
    flex-direction: column;
    animation: fadeInUp 0.6s ease-out;
}

.listing-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

/* Container d'image */
.listing-image-container {
    position: relative;
    overflow: hidden;
    height: 220px;
    background: var(--bg-light);
    flex-shrink: 0;
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
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.listing-card-modern:hover .listing-image-link img {
    transform: scale(1.08);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.listing-card-modern:hover .image-overlay {
    opacity: 1;
}

/* Badge En vedette */
.featured-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: linear-gradient(135deg, #FFB800, #FF8C00);
    color: white;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(255, 184, 0, 0.4);
    animation: pulse 2s ease-in-out infinite;
    z-index: 2;
}

.featured-badge svg {
    width: 12px;
    height: 14px;
    animation: flash 1.5s ease-in-out infinite;
}

/* Bouton favori */
.favorite-btn-wrapper {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 2;
    opacity: 0;
    transform: scale(0.8);
    transition: var(--transition-smooth);
}

.listing-card-modern:hover .favorite-btn-wrapper {
    opacity: 1;
    transform: scale(1);
}

/* Contenu de la carte */
.listing-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

/* Meta top */
.listing-meta-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    flex-wrap: wrap;
    gap: 8px;
    min-height: 36px;
}

.listing-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    letter-spacing: -0.5px;
}

.listing-date {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    color: var(--text-light);
}

.listing-date i {
    font-size: 14px;
}

/* Titre */
.listing-title {
    margin: 0 0 12px 0;
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.4;
    min-height: 62px;
}

.listing-title a {
    color: var(--text-dark);
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: color 0.3s ease;
}

.listing-title a:hover {
    color: var(--primary-color);
}

/* Localisation */
.listing-location {
    margin-bottom: 16px;
    color: var(--text-light);
    font-size: 14px;
    display: block;
    min-height: 22px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Bouton voir détails */
.btn-view-details {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 20px;
    background: var(--secondary-color);
    color: white;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: var(--transition-smooth);
    margin-top: auto;
}

.btn-view-details:hover {
    background: var(--secondary-dark);
    color: white;
    transform: translateX(4px);
    box-shadow: 0 4px 12px rgba(147, 189, 147, 0.4);
}

.btn-view-details i {
    transition: transform 0.3s ease;
}

.btn-view-details:hover i {
    transform: translateX(4px);
}

/* Flèches du slider */
.modern-arrow {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: var(--shadow-md);
    transition: var(--transition-smooth);
    z-index: 10;
}

.modern-arrow:hover {
    background: var(--secondary-color);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 16px rgba(147, 189, 147, 0.4);
}

.modern-arrow i {
    font-size: 24px;
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes expandWidth {
    from {
        width: 0;
    }
    to {
        width: 60px;
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

@keyframes flash {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.6;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .section-title-modern {
        font-size: 2rem;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .listing-image-container {
        height: 200px;
    }
    
    .listing-card-modern {
        min-height: 420px;
    }
    
    .modern-arrow {
        width: 40px;
        height: 40px;
    }
    
    .modern-arrow i {
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .modern-listings {
        padding: 40px 0;
    }
    
    .section-title-modern {
        font-size: 1.75rem;
    }
    
    .listing-price {
        font-size: 1.25rem;
    }
    
    .listing-card-modern {
        min-height: 400px;
    }
}
</style>

<!-- Script pour améliorer les animations au scroll -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.listing-card-modern').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
    
    // Empêcher la soumission du formulaire par défaut si nécessaire
    document.getElementById('submit_form_listing_filter_top')?.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('filter_with_listing_page_top').submit();
    });
});
</script>
<!-- Fin Section Listings Modernisée -->
@endif