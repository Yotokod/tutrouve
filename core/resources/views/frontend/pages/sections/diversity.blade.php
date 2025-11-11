<!-- Diversity Section - Testimonial Style -->
<div class="diversity-section" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); position: relative; overflow: hidden;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Background Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.05), rgba(45, 88, 80, 0.03)); border-radius: 50%; filter: blur(60px); z-index: 0;"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 400px; height: 400px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.03), rgba(45, 88, 80, 0.05)); border-radius: 50%; filter: blur(80px); z-index: 0;"></div>
        
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 60px; position: relative; z-index: 1;">
            <div style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.1), rgba(45, 88, 80, 0.1)); border-radius: 50px; margin-bottom: 16px;">
                <span style="font-size: 14px; font-weight: 600; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: 1px;">
                    {{ __('DIVERSITÉ') }}
                </span>
            </div>
            <h2 style="font-size: clamp(32px, 5vw, 48px); font-weight: 700; color: #1e293b; margin: 0 0 16px; line-height: 1.2;">
                {{ __('Découvrez toutes sortes d\'annonces') }}
            </h2>
            <p style="font-size: 18px; color: #64748B; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                {{ __('De l\'électronique aux services, explorez la richesse et la variété des offres disponibles sur Tutrouve.') }}
            </p>
        </div>

        @php
            // Récupérer 12 annonces aléatoires avec images
            $diverseListings = \App\Models\Backend\Listing::where('status', 1)
                ->where('is_published', 1)
                ->whereNotNull('image')
                ->inRandomOrder()
                ->take(12)
                ->get();
        @endphp

        <!-- Diverse Listings Grid with Floating Images -->
        <div class="diverse-listings-grid" style="position: relative; display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 24px; max-width: 900px; margin: 0 auto; padding: 40px 0;">
            @foreach($diverseListings as $index => $listing)
                <div class="diverse-item" 
                     style="position: relative; 
                            animation: floatImage {{ 3 + ($index % 3) }}s ease-in-out infinite; 
                            animation-delay: {{ $index * 0.2 }}s;">
                    <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                       style="display: block; text-decoration: none;">
                        <div class="diverse-image-wrapper" 
                             style="position: relative; 
                                    border-radius: 20px; 
                                    overflow: hidden; 
                                    aspect-ratio: 1;
                                    box-shadow: 0 10px 30px rgba(31, 62, 57, 0.15);
                                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                                    background: white;">
                            
                            <!-- Image -->
                            {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                            
                            <!-- Overlay on Hover -->
                            <div class="diverse-overlay" 
                                 style="position: absolute; 
                                        top: 0; 
                                        left: 0; 
                                        right: 0; 
                                        bottom: 0; 
                                        background: linear-gradient(135deg, rgba(31, 62, 57, 0.85), rgba(45, 88, 80, 0.75)); 
                                        opacity: 0; 
                                        transition: opacity 0.3s ease; 
                                        display: flex; 
                                        flex-direction: column;
                                        align-items: center; 
                                        justify-content: center; 
                                        padding: 16px;
                                        text-align: center;">
                                <div style="color: white; font-weight: 600; font-size: 14px; margin-bottom: 8px; line-height: 1.3;">
                                    {{ Str::limit($listing->title, 40) }}
                                </div>
                                <div style="color: rgba(255, 255, 255, 0.9); font-size: 16px; font-weight: 700;">
                                    {{ amount_with_currency_symbol($listing->price) }}
                                </div>
                                <div style="margin-top: 12px; padding: 6px 12px; background: rgba(255, 255, 255, 0.2); border-radius: 20px; font-size: 11px; color: white; border: 1px solid rgba(255, 255, 255, 0.3);">
                                    {{ optional($listing->category)->name ?? __('Divers') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Call to Action Button -->
        <div style="text-align: center; margin-top: 60px; position: relative; z-index: 1;">
            <a href="{{ route('frontend.home.search') }}" 
               class="btn-explore-diversity" 
               style="display: inline-flex; 
                      align-items: center; 
                      gap: 12px; 
                      padding: 16px 36px; 
                      background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); 
                      color: white; 
                      border-radius: 50px; 
                      font-size: 16px; 
                      font-weight: 600; 
                      text-decoration: none; 
                      box-shadow: 0 8px 24px rgba(31, 62, 57, 0.3); 
                      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                {{ __('Explorer toutes les annonces') }}
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="transition: transform 0.3s ease;">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

    </div>
</div>

<style>
    /* Animations */
    @keyframes floatImage {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        25% {
            transform: translateY(-10px) rotate(1deg);
        }
        50% {
            transform: translateY(-5px) rotate(-1deg);
        }
        75% {
            transform: translateY(-12px) rotate(0.5deg);
        }
    }

    /* Hover Effects */
    .diverse-image-wrapper:hover {
        transform: scale(1.05) translateY(-8px);
        box-shadow: 0 20px 40px rgba(31, 62, 57, 0.25) !important;
    }

    .diverse-image-wrapper:hover .diverse-overlay {
        opacity: 1;
    }

    .btn-explore-diversity:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 36px rgba(31, 62, 57, 0.4);
    }

    .btn-explore-diversity:hover svg {
        transform: translateX(4px);
    }

    /* Image Styling */
    .diverse-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .diverse-image-wrapper:hover img {
        transform: scale(1.1);
    }

    /* Responsive Grid */
    @media (max-width: 1024px) {
        .diverse-listings-grid {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)) !important;
            gap: 20px !important;
        }
    }

    @media (max-width: 768px) {
        .diversity-section {
            padding: 60px 0 !important;
        }

        .diverse-listings-grid {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 16px !important;
            padding: 30px 0 !important;
        }

        .diverse-image-wrapper {
            border-radius: 16px !important;
        }

        .diverse-overlay {
            padding: 12px !important;
        }

        .diverse-overlay div:first-child {
            font-size: 12px !important;
            margin-bottom: 6px !important;
        }

        .diverse-overlay div:nth-child(2) {
            font-size: 14px !important;
        }

        .diverse-overlay div:nth-child(3) {
            margin-top: 8px !important;
            padding: 4px 10px !important;
            font-size: 10px !important;
        }

        .btn-explore-diversity {
            padding: 14px 28px !important;
            font-size: 15px !important;
        }
    }

    @media (max-width: 576px) {
        .diverse-listings-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
        }

        .diversity-section h2 {
            font-size: 28px !important;
        }

        .diversity-section p {
            font-size: 16px !important;
        }
    }

    /* Prevent animation performance issues on mobile */
    @media (prefers-reduced-motion: reduce) {
        .diverse-item {
            animation: none !important;
        }

        * {
            transition-duration: 0.01ms !important;
            animation-duration: 0.01ms !important;
        }
    }

    /* Loading skeleton for images */
    .diverse-image-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        z-index: -1;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }
</style>
