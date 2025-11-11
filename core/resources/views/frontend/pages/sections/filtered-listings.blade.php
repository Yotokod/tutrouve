<!-- Filtered Listings Section with Sidebar -->
<div class="filtered-listings-section">
    <div class="container-1440">
        <!-- Section Header -->
        <div class="section-header-filtered">
            <div class="section-title-wrapper">
                <h2 class="section-title">
                    {{ __('Annonces récentes') }}
                </h2>
                <p class="section-subtitle">
                    {{ __('Parcourez les dernières annonces avec nos filtres') }}
                </p>
            </div>
        </div>

        <div class="filtered-content-wrapper">
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar">
                <div class="filter-card">
                    <h3 class="filter-title">
                        <i class="las la-filter"></i>
                        {{ __('Filtres') }}
                    </h3>

                    <!-- Category Filter -->
                    <div class="filter-group">
                        <h4 class="filter-label">{{ __('Catégories') }}</h4>
                        <div class="filter-options">
                            @foreach(\App\Models\Backend\Category::where('status', 1)->take(8)->get() as $cat)
                            <label class="filter-checkbox">
                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="filter-input">
                                <span class="filter-checkmark"></span>
                                <span class="filter-text">{{ $cat->name }}</span>
                                <span class="filter-count">({{ $cat->listings_count ?? 0 }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="filter-group">
                        <h4 class="filter-label">{{ __('Fourchette de prix') }}</h4>
                        <div class="price-range-inputs">
                            <input type="number" placeholder="{{ __('Min') }}" class="price-input" name="price_min">
                            <span class="price-separator">-</span>
                            <input type="number" placeholder="{{ __('Max') }}" class="price-input" name="price_max">
                        </div>
                    </div>

                    <!-- Condition Filter -->
                    <div class="filter-group">
                        <h4 class="filter-label">{{ __('État') }}</h4>
                        <div class="filter-options">
                            <label class="filter-checkbox">
                                <input type="radio" name="condition" value="new" class="filter-input">
                                <span class="filter-checkmark"></span>
                                <span class="filter-text">{{ __('Neuf') }}</span>
                            </label>
                            <label class="filter-checkbox">
                                <input type="radio" name="condition" value="used" class="filter-input">
                                <span class="filter-checkmark"></span>
                                <span class="filter-text">{{ __('Occasion') }}</span>
                            </label>
                            <label class="filter-checkbox">
                                <input type="radio" name="condition" value="refurbished" class="filter-input">
                                <span class="filter-checkmark"></span>
                                <span class="filter-text">{{ __('Reconditionné') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Apply Filters Button -->
                    <button type="button" class="btn-apply-filters" id="applyFilters">
                        <i class="las la-check"></i>
                        {{ __('Appliquer les filtres') }}
                    </button>

                    <!-- Reset Filters -->
                    <button type="button" class="btn-reset-filters" id="resetFilters">
                        <i class="las la-redo"></i>
                        {{ __('Réinitialiser') }}
                    </button>
                </div>
            </aside>

            <!-- Listings Grid -->
            <div class="listings-main-content">
                <!-- Sort Options -->
                <div class="sort-bar">
                    <div class="results-count">
                        <strong id="resultsCount">{{ count($recentListings ?? []) }}</strong> {{ __('annonces trouvées') }}
                    </div>
                    <div class="sort-options">
                        <select class="sort-select" id="sortSelect">
                            <option value="recent">{{ __('Plus récent') }}</option>
                            <option value="price_asc">{{ __('Prix croissant') }}</option>
                            <option value="price_desc">{{ __('Prix décroissant') }}</option>
                            <option value="popular">{{ __('Plus populaire') }}</option>
                        </select>
                    </div>
                </div>

                <!-- Listings Grid -->
                <div class="listings-grid-filtered" id="listingsGrid">
                    @forelse($recentListings ?? [] as $listing)
                        <div class="listing-card-filtered" data-category="{{ $listing->category_id }}" data-price="{{ $listing->price }}">
                            <!-- Image -->
                            <div class="listing-image-wrapper">
                                <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="listing-image-link">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', '', 'thumb') !!}
                                    <div class="listing-image-overlay"></div>
                                </a>

                                @if($listing->is_featured == 1)
                                    <div class="listing-badge featured-badge">
                                        <svg width="10" height="10" viewBox="0 0 7 10" fill="none">
                                            <path d="M4 0V3.88889H7L3 10V6.11111H0L4 0Z" fill="currentColor"/>
                                        </svg>
                                        <span>{{ __('Vedette') }}</span>
                                    </div>
                                @endif

                                <div class="listing-favorite">
                                    <x-listings.favorite-item-add-remove :favorite="$listing->id ?? 0" />
                                </div>

                                <div class="listing-price-badge">
                                    {{ amount_with_currency_symbol($listing->price) }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="listing-content">
                                <h3 class="listing-title">
                                    <a href="{{ route('frontend.listing.details', $listing->slug) }}">
                                        {{ $listing->title }}
                                    </a>
                                </h3>

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

                                <a href="{{ route('frontend.listing.details', $listing->slug) }}" class="listing-btn">
                                    <span>{{ __('Voir détails') }}</span>
                                    <i class="las la-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="no-listings-filtered">
                            <i class="las la-inbox"></i>
                            <p>{{ __('Aucune annonce disponible') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Filtered Listings Section */
.filtered-listings-section {
    padding: 100px 0;
    background: #ffffff;
}

/* Section Header */
.section-header-filtered {
    text-align: center;
    margin-bottom: 50px;
}

.section-header-filtered .section-title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    color: #1F3E39;
    margin: 0 0 8px 0;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.section-header-filtered .section-subtitle {
    font-size: clamp(0.875rem, 1.5vw, 1rem);
    color: #666666;
    margin: 0;
}

/* Content Wrapper */
.filtered-content-wrapper {
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

/* Sidebar Filters */
.filters-sidebar {
    width: 280px;
    flex-shrink: 0;
    position: sticky;
    top: 100px;
}

.filter-card {
    background: #ffffff;
    border: 1px solid #f0f0f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.filter-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1F3E39;
    margin: 0 0 24px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-title i {
    font-size: 1.5rem;
    color: #1F3E39;
}

.filter-group {
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 1px solid #f0f0f0;
}

.filter-group:last-of-type {
    border-bottom: none;
    margin-bottom: 20px;
}

.filter-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1F3E39;
    margin: 0 0 16px 0;
}

/* Filter Options */
.filter-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.filter-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
    transition: background 0.3s ease;
}

.filter-checkbox:hover {
    background: rgba(31, 62, 57, 0.05);
}

.filter-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #1F3E39;
}

.filter-text {
    flex: 1;
    font-size: 0.9rem;
    color: #333333;
}

.filter-count {
    font-size: 0.85rem;
    color: #999999;
}

/* Price Range */
.price-range-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
}

.price-input {
    flex: 1;
    padding: 10px 12px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 0.9rem;
    outline: none;
    transition: border-color 0.3s ease;
}

.price-input:focus {
    border-color: #1F3E39;
}

.price-separator {
    color: #999999;
    font-weight: 600;
}

/* Filter Buttons */
.btn-apply-filters,
.btn-reset-filters {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-apply-filters {
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    margin-bottom: 12px;
    box-shadow: 0 4px 12px rgba(31, 62, 57, 0.25);
}

.btn-apply-filters:hover {
    background: linear-gradient(135deg, #2d5850 0%, #1F3E39 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(31, 62, 57, 0.35);
}

.btn-reset-filters {
    background: transparent;
    color: #666666;
    border: 1px solid #e0e0e0;
}

.btn-reset-filters:hover {
    background: #f8f8f8;
    border-color: #1F3E39;
    color: #1F3E39;
}

/* Main Content */
.listings-main-content {
    flex: 1;
    min-width: 0;
}

/* Sort Bar */
.sort-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    background: #f8faf9;
    border-radius: 12px;
    margin-bottom: 30px;
}

.results-count {
    font-size: 0.95rem;
    color: #666666;
}

.results-count strong {
    color: #1F3E39;
    font-weight: 700;
}

.sort-select {
    padding: 8px 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #ffffff;
    color: #333333;
    font-size: 0.9rem;
    cursor: pointer;
    outline: none;
}

.sort-select:focus {
    border-color: #1F3E39;
}

/* Listings Grid */
.listings-grid-filtered {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}

.listing-card-filtered {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f0f0f0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

.listing-card-filtered:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(31, 62, 57, 0.15);
    border-color: #1F3E39;
}

/* Use same styles as top-listings for consistency */
.listing-card-filtered .listing-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 180px;
    background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
}

.listing-card-filtered .listing-image-link {
    display: block;
    height: 100%;
    position: relative;
}

.listing-card-filtered .listing-image-link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.listing-card-filtered:hover .listing-image-link img {
    transform: scale(1.08);
}

.listing-card-filtered .listing-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.6) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.listing-card-filtered:hover .listing-image-overlay {
    opacity: 1;
}

.listing-card-filtered .listing-badge {
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
}

.listing-card-filtered .listing-favorite {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 3;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.listing-card-filtered:hover .listing-favorite {
    opacity: 1;
    transform: scale(1);
}

.listing-card-filtered .listing-price-badge {
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
}

.listing-card-filtered .listing-content {
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.listing-card-filtered .listing-title {
    margin: 0;
    font-size: 0.95rem;
    font-weight: 700;
    line-height: 1.4;
    min-height: 42px;
}

.listing-card-filtered .listing-title a {
    color: #1F3E39;
    text-decoration: none;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
}

.listing-card-filtered .listing-title a:hover {
    color: #2d5850;
}

.listing-card-filtered .listing-meta {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 0.8rem;
    color: #666666;
}

.listing-card-filtered .listing-location,
.listing-card-filtered .listing-date {
    display: flex;
    align-items: center;
    gap: 4px;
}

.listing-card-filtered .listing-location i,
.listing-card-filtered .listing-date i {
    font-size: 14px;
    color: #1F3E39;
}

.listing-card-filtered .listing-btn {
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
    transition: all 0.3s ease;
    margin-top: auto;
}

.listing-card-filtered .listing-btn:hover {
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border-color: #1F3E39;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(31, 62, 57, 0.25);
}

/* No Listings */
.no-listings-filtered {
    grid-column: 1 / -1;
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(135deg, #f8faf9 0%, #f0f4f3 100%);
    border-radius: 20px;
    border: 2px dashed #d0d0d0;
}

.no-listings-filtered i {
    font-size: 72px;
    color: #1F3E39;
    opacity: 0.3;
    margin-bottom: 20px;
    display: block;
}

.no-listings-filtered p {
    font-size: 1.125rem;
    color: #666666;
    margin: 0;
}

/* Responsive */
@media (max-width: 992px) {
    .filtered-content-wrapper {
        flex-direction: column;
    }

    .filters-sidebar {
        width: 100%;
        position: static;
    }

    .listings-grid-filtered {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }
}

@media (max-width: 768px) {
    .filtered-listings-section {
        padding: 60px 0;
    }

    .sort-bar {
        flex-direction: column;
        gap: 12px;
        align-items: stretch;
    }

    .listings-grid-filtered {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 576px) {
    .listings-grid-filtered {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const applyBtn = document.getElementById('applyFilters');
    const resetBtn = document.getElementById('resetFilters');
    const sortSelect = document.getElementById('sortSelect');
    const listingsGrid = document.getElementById('listingsGrid');
    const resultsCount = document.getElementById('resultsCount');
    
    if (!applyBtn || !listingsGrid) return;
    
    // Apply Filters
    applyBtn.addEventListener('click', function() {
        const selectedCategories = Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
            .map(cb => cb.value);
        const priceMin = document.querySelector('input[name="price_min"]').value;
        const priceMax = document.querySelector('input[name="price_max"]').value;
        const condition = document.querySelector('input[name="condition"]:checked')?.value;
        
        filterListings(selectedCategories, priceMin, priceMax, condition);
    });
    
    // Reset Filters
    resetBtn.addEventListener('click', function() {
        document.querySelectorAll('.filter-input').forEach(input => {
            input.checked = false;
        });
        document.querySelectorAll('.price-input').forEach(input => {
            input.value = '';
        });
        
        // Show all listings
        const allCards = listingsGrid.querySelectorAll('.listing-card-filtered');
        allCards.forEach(card => card.style.display = 'flex');
        updateResultsCount();
    });
    
    // Sort
    sortSelect.addEventListener('change', function() {
        sortListings(this.value);
    });
    
    function filterListings(categories, minPrice, maxPrice, condition) {
        const cards = listingsGrid.querySelectorAll('.listing-card-filtered');
        let visibleCount = 0;
        
        cards.forEach(card => {
            let show = true;
            
            // Filter by category
            if (categories.length > 0) {
                const cardCategory = card.dataset.category;
                if (!categories.includes(cardCategory)) {
                    show = false;
                }
            }
            
            // Filter by price
            const cardPrice = parseFloat(card.dataset.price);
            if (minPrice && cardPrice < parseFloat(minPrice)) {
                show = false;
            }
            if (maxPrice && cardPrice > parseFloat(maxPrice)) {
                show = false;
            }
            
            card.style.display = show ? 'flex' : 'none';
            if (show) visibleCount++;
        });
        
        resultsCount.textContent = visibleCount;
    }
    
    function sortListings(sortBy) {
        const cards = Array.from(listingsGrid.querySelectorAll('.listing-card-filtered'));
        
        cards.sort((a, b) => {
            switch(sortBy) {
                case 'price_asc':
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                case 'price_desc':
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                default:
                    return 0;
            }
        });
        
        cards.forEach(card => listingsGrid.appendChild(card));
    }
    
    function updateResultsCount() {
        const visibleCards = listingsGrid.querySelectorAll('.listing-card-filtered[style*="display: flex"], .listing-card-filtered:not([style*="display"])').length;
        resultsCount.textContent = visibleCards;
    }
});
</script>
