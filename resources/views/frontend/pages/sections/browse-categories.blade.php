<!-- Browse Categories Section with Modern Neo-Glassmorphism Design -->
<div class="browse-categories-section" style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%);">
    <div class="container-1440">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="section-title-wrapper">
                        <h2 class="section-title-modern" style="color: #ffffff; margin-bottom: 12px; font-size: 2.5rem; font-weight: 700; letter-spacing: -0.5px;">
                            {{ __('Parcourir les catégories') }}
                        </h2>
                        <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            @forelse($categories ?? [] as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="{{ route('frontend.show.listing.by.category', $category->slug) }}" 
                       class="category-card-glass"
                       style="
                           display: flex;
                           flex-direction: column;
                           align-items: center;
                           justify-content: center;
                           padding: 40px 20px;
                           background: rgba(147, 189, 147, 0.1);
                           backdrop-filter: blur(10px);
                           border-radius: 16px;
                           border: 1px solid rgba(147, 189, 147, 0.3);
                           text-decoration: none;
                           transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                           min-height: 200px;
                           cursor: pointer;
                           position: relative;
                           overflow: hidden;
                       "
                       onmouseover="this.style.background='rgba(147, 189, 147, 0.2)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 16px 48px rgba(147, 189, 147, 0.2)'"
                       onmouseout="this.style.background='rgba(147, 189, 147, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'">
                        
                        <!-- Background Animation Element -->
                        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(147, 189, 147, 0.3) 0%, transparent 70%); animation: float 6s ease-in-out infinite;"></div>

                        <!-- Category Icon -->
                        @if(!empty($category->icon))
                            <div style="font-size: 48px; margin-bottom: 16px; color: #93bd93; z-index: 1; position: relative;">
                                {!! $category->icon !!}
                            </div>
                        @else
                            <i class="las la-folder" style="font-size: 48px; margin-bottom: 16px; color: #93bd93; z-index: 1;"></i>
                        @endif

                        <!-- Category Name -->
                        <h3 style="
                            color: #ffffff;
                            font-size: 1.1rem;
                            font-weight: 600;
                            margin: 0;
                            text-align: center;
                            z-index: 1;
                            position: relative;
                        ">
                            {{ $category->name }}
                        </h3>

                        <!-- Item Count -->
                        <p style="
                            color: #b0b0b0;
                            font-size: 14px;
                            margin: 8px 0 0 0;
                            z-index: 1;
                            position: relative;
                        ">
                            {{ $category->listings_count ?? 0 }} {{ __('annonces') }}
                        </p>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div style="
                        background: rgba(255, 255, 255, 0.05);
                        backdrop-filter: blur(10px);
                        border: 1px solid rgba(255, 255, 255, 0.15);
                        border-radius: 16px;
                        padding: 60px 20px;
                        text-align: center;
                        color: #b0b0b0;
                    ">
                        <p style="font-size: 18px; margin: 0;">{{ __('Aucune catégorie disponible') }}</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
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
