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

        <!-- Listings Grid with Modern Card Design -->
        <div class="listings-grid">
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
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 800;
    color: #1F3E39;
    margin: 0 0 12px 0;
    line-height: 1.2;
    letter-spacing: -1px;
}

.section-subtitle {
    font-size: clamp(1rem, 2vw, 1.125rem);
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

/* Listings Grid */
.listings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 28px;
}

/* Listing Card */
.listing-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
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
    height: 240px;
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
    top: 16px;
    left: 16px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    background: linear-gradient(135deg, #FFB800 0%, #FF8C00 100%);
    color: #ffffff;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(255, 184, 0, 0.4);
    z-index: 3;
    animation: pulse-badge 2s ease-in-out infinite;
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
    top: 16px;
    right: 16px;
    z-index: 3;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.listing-card:hover .listing-favorite {
    opacity: 1;
    transform: scale(1);
}

/* Price Badge */
.listing-price-badge {
    position: absolute;
    bottom: 16px;
    left: 16px;
    padding: 10px 18px;
    background: rgba(31, 62, 57, 0.95);
    backdrop-filter: blur(10px);
    color: #ffffff;
    border-radius: 12px;
    font-size: 1.25rem;
    font-weight: 800;
    box-shadow: 0 4px 16px rgba(31, 62, 57, 0.3);
    z-index: 3;
    letter-spacing: -0.5px;
}

/* Card Content */
.listing-content {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 16px;
}

/* Title */
.listing-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 700;
    line-height: 1.4;
    min-height: 48px;
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
    gap: 8px;
    font-size: 0.875rem;
    color: #666666;
}

.listing-location,
.listing-date {
    display: flex;
    align-items: center;
    gap: 6px;
}

.listing-location i,
.listing-date i {
    font-size: 16px;
    color: #1F3E39;
}

/* View Details Button */
.listing-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    background: linear-gradient(135deg, rgba(31, 62, 57, 0.05) 0%, rgba(31, 62, 57, 0.1) 100%);
    color: #1F3E39;
    border: 2px solid rgba(31, 62, 57, 0.2);
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
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
    
    .listings-grid {
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 24px;
    }
    
    .listing-image-wrapper {
        height: 220px;
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
    
    .listings-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }
    
    .listing-content {
        padding: 20px;
        gap: 14px;
    }
    
    .listing-image-wrapper {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .top-listings-section {
        padding: 50px 0;
    }
    
    .listings-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .listing-card {
        border-radius: 16px;
    }
    
    .listing-image-wrapper {
        height: 180px;
    }
    
    .listing-content {
        padding: 18px;
    }
    
    .listing-title {
        font-size: 1rem;
        min-height: auto;
    }
    
    .listing-price-badge {
        font-size: 1.125rem;
        padding: 8px 14px;
    }
    
    .no-listings {
        padding: 60px 20px;
    }
    
    .no-listings i {
        font-size: 56px;
    }
}
</style>
