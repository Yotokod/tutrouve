<!-- Browse Categories Section - Modern Design -->
<div class="browse-categories-section">
    <div class="container-1440">
        <!-- Section Header -->
        <div class="section-header-categories">
            <div class="section-title-wrapper">
                <h2 class="section-title">
                    {{ __('Parcourir les catégories') }}
                </h2>
                <p class="section-subtitle">
                    {{ __('Explorez nos catégories et trouvez ce que vous cherchez') }}
                </p>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="categories-grid">
            @forelse($categories ?? [] as $category)
                <a href="{{ route('frontend.show.listing.by.category', $category->slug) }}" 
                   class="category-card-modern">
                    <div class="category-card-bg"></div>
                    
                    <div class="category-card-content">
                        <!-- Category Icon -->
                        <div class="category-icon-wrapper">
                            @if(!empty($category->icon))
                                <i class="{{ $category->icon }} category-icon"></i>
                            @else
                                <i class="las la-folder category-icon"></i>
                            @endif
                        </div>

                        <!-- Category Info -->
                        <div class="category-info">
                            <h3 class="category-name">
                                {{ $category->name }}
                            </h3>
                            <p class="category-count">
                                {{ $category->listings_count ?? 0 }} {{ __('annonces') }}
                            </p>
                        </div>
                    </div>

                    <!-- Arrow Icon -->
                    <div class="category-arrow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </a>
            @empty
                <div class="no-categories">
                    <i class="las la-folder-open"></i>
                    <p>{{ __('Aucune catégorie disponible') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* Browse Categories Section */
.browse-categories-section {
    padding: 100px 0;
    background: linear-gradient(180deg, #ffffff 0%, #f8faf9 100%);
    position: relative;
    overflow: hidden;
}

.browse-categories-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, rgba(31, 62, 57, 0.1) 50%, transparent 100%);
}

/* Section Header */
.section-header-categories {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
}

.section-header-categories .section-title {
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 800;
    color: #1F3E39;
    margin: 0 0 16px 0;
    line-height: 1.2;
    letter-spacing: -1px;
}

.section-header-categories .section-subtitle {
    font-size: clamp(1rem, 2vw, 1.125rem);
    color: #666666;
    margin: 0;
    line-height: 1.6;
}

/* Categories Grid */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    position: relative;
}

/* Category Card Modern */
.category-card-modern {
    position: relative;
    display: flex;
    align-items: center;
    padding: 28px 24px;
    background: #ffffff;
    border-radius: 16px;
    border: 2px solid #f0f0f0;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
}

.category-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #1F3E39 0%, #2d5850 100%);
    transform: scaleY(0);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.category-card-modern:hover::before {
    transform: scaleY(1);
}

.category-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(31, 62, 57, 0.03) 0%, rgba(31, 62, 57, 0.08) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.category-card-modern:hover .category-card-bg {
    opacity: 1;
}

.category-card-modern:hover {
    transform: translateX(8px);
    border-color: #1F3E39;
    box-shadow: 0 12px 32px rgba(31, 62, 57, 0.15);
}

/* Category Content */
.category-card-content {
    display: flex;
    align-items: center;
    gap: 20px;
    flex: 1;
    position: relative;
    z-index: 1;
}

/* Icon Wrapper */
.category-icon-wrapper {
    width: 64px;
    height: 64px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    border-radius: 12px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(31, 62, 57, 0.2);
}

.category-card-modern:hover .category-icon-wrapper {
    transform: rotate(-5deg) scale(1.1);
    box-shadow: 0 8px 24px rgba(31, 62, 57, 0.3);
}

.category-icon {
    font-size: 32px;
    color: #ffffff;
    line-height: 1;
}

/* Category Info */
.category-info {
    flex: 1;
    min-width: 0;
}

.category-name {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1F3E39;
    margin: 0 0 6px 0;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.category-card-modern:hover .category-name {
    color: #2d5850;
}

.category-count {
    font-size: 0.875rem;
    color: #666666;
    margin: 0;
    font-weight: 500;
    transition: color 0.3s ease;
}

.category-card-modern:hover .category-count {
    color: #1F3E39;
}

/* Arrow */
.category-arrow {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(31, 62, 57, 0.08);
    border-radius: 8px;
    color: #1F3E39;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.category-card-modern:hover .category-arrow {
    background: #1F3E39;
    color: #ffffff;
    transform: translateX(4px);
}

/* No Categories */
.no-categories {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    background: #f8faf9;
    border-radius: 16px;
    border: 2px dashed #e0e0e0;
}

.no-categories i {
    font-size: 64px;
    color: #cccccc;
    margin-bottom: 16px;
    display: block;
}

.no-categories p {
    font-size: 1.125rem;
    color: #666666;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 992px) {
    .browse-categories-section {
        padding: 80px 0;
    }
    
    .categories-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }
    
    .category-card-modern {
        padding: 24px 20px;
    }
    
    .category-icon-wrapper {
        width: 56px;
        height: 56px;
    }
    
    .category-icon {
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .browse-categories-section {
        padding: 60px 0;
    }
    
    .section-header-categories {
        margin-bottom: 40px;
    }
    
    .categories-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .category-card-modern {
        padding: 20px 16px;
    }
    
    .category-card-content {
        gap: 16px;
    }
    
    .category-icon-wrapper {
        width: 52px;
        height: 52px;
    }
    
    .category-icon {
        font-size: 26px;
    }
    
    .category-name {
        font-size: 1rem;
    }
    
    .category-count {
        font-size: 0.8125rem;
    }
}

@media (max-width: 480px) {
    .browse-categories-section {
        padding: 50px 0;
    }
    
    .category-card-modern {
        padding: 18px 14px;
    }
    
    .category-icon-wrapper {
        width: 48px;
        height: 48px;
    }
    
    .category-icon {
        font-size: 24px;
    }
    
    .category-arrow {
        width: 32px;
        height: 32px;
    }
    
    .category-arrow svg {
        width: 16px;
        height: 16px;
    }
}
</style>
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(2deg);
        }
    }

    .category-card-glass {
        animation: slideInUp 0.6s ease-out;
    }

    @media (max-width: 768px) {
        .browse-categories-section {
            padding: 50px 0 !important;
        }
    }
</style>
