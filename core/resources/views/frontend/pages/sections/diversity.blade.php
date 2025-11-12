<!-- Diversity Section - Two Column Layout -->
<div class="diversity-section" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); position: relative; overflow: hidden;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Background Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.05), rgba(45, 88, 80, 0.03)); border-radius: 50%; filter: blur(60px); z-index: 0;"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 400px; height: 400px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.03), rgba(45, 88, 80, 0.05)); border-radius: 50%; filter: blur(80px); z-index: 0;"></div>
        
        <!-- Two Column Layout -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; position: relative; z-index: 1;">
            
            <!-- Left Column - Content -->
            <div style="padding-right: 40px;">
                
                <!-- Section Header Badge -->
                <div style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.1), rgba(45, 88, 80, 0.1)); border-radius: 50px; margin-bottom: 24px;">
                    <span style="font-size: 13px; font-weight: 600; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: 1.5px;">
                        {{ __('DIVERSITÉ') }}
                    </span>
                </div>
                
                <!-- Main Title -->
                <h2 style="font-size: clamp(36px, 5vw, 52px); font-weight: 700; color: #1e293b; margin: 0 0 20px; line-height: 1.2;">
                    {{ __('Découvrez toutes sortes d\'annonces') }}
                </h2>
                
                <!-- Subtitle -->
                <p style="font-size: 18px; color: #64748B; margin: 0 0 40px; line-height: 1.7;">
                    {{ __('De l\'électronique aux services, explorez la richesse et la variété des offres disponibles sur Tutrouve.') }}
                </p>

                <!-- Call to Action Button -->
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

            @php
                // Récupérer 12 annonces aléatoires avec images
                $diverseListings = \App\Models\Backend\Listing::where('status', 1)
                    ->where('is_published', 1)
                    ->whereNotNull('image')
                    ->inRandomOrder()
                    ->take(12)
                    ->get();
            @endphp

            <!-- Right Column - Images Grid -->
            <div class="images-grid-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; position: relative;">
                
                @foreach($diverseListings as $index => $listing)
                    <div class="grid-image-item" 
                         style="animation: fadeInUp 0.6s ease-out forwards;
                                animation-delay: {{ $index * 0.08 }}s;
                                opacity: 0;">
                        <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                           style="display: block; text-decoration: none; width: 100%; height: 100%;">
                            <div class="grid-image-wrapper" 
                                 style="position: relative; 
                                        border-radius: 16px; 
                                        overflow: hidden; 
                                        width: 100%; 
                                        height: 160px;
                                        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); 
                                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                        background: white;">
                                {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                <div class="grid-overlay" 
                                     style="position: absolute; 
                                            top: 0; 
                                            left: 0; 
                                            right: 0; 
                                            bottom: 0; 
                                            background: linear-gradient(135deg, rgba(31, 62, 57, 0.9), rgba(45, 88, 80, 0.85)); 
                                            opacity: 0; 
                                            transition: opacity 0.3s ease; 
                                            display: flex; 
                                            flex-direction: column; 
                                            align-items: center; 
                                            justify-content: center; 
                                            padding: 12px; 
                                            text-align: center;">
                                    <div style="color: white; font-weight: 600; font-size: 12px; margin-bottom: 4px; line-height: 1.3;">
                                        {{ Str::limit($listing->title, 30) }}
                                    </div>
                                    <div style="color: rgba(255, 255, 255, 0.95); font-size: 14px; font-weight: 700;">
                                        {{ amount_with_currency_symbol($listing->price) }}
                                    </div>
                                    <div style="margin-top: 8px; padding: 4px 8px; background: rgba(255, 255, 255, 0.2); border-radius: 12px; font-size: 9px; color: white; border: 1px solid rgba(255, 255, 255, 0.3);">
                                        {{ optional($listing->category)->name ?? __('Divers') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</div>

<style>
    /* Fade in animation */
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

    /* Hover Effects */
    .grid-image-wrapper:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(31, 62, 57, 0.18) !important;
    }

    .grid-image-wrapper:hover .grid-overlay {
        opacity: 1;
    }

    .btn-explore-diversity:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(31, 62, 57, 0.4);
    }

    .btn-explore-diversity:hover svg {
        transform: translateX(4px);
    }

    /* Image Styling */
    .grid-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .grid-image-wrapper:hover img {
        transform: scale(1.08);
    }

    /* Loading skeleton */
    .grid-image-wrapper::before {
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
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .diversity-section > .container > div {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
        
        .images-grid-container {
            grid-template-columns: repeat(4, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .diversity-section {
            padding: 60px 0 !important;
        }
        
        .images-grid-container {
            grid-template-columns: repeat(3, 1fr) !important;
        }
        
        .grid-image-wrapper {
            height: 120px !important;
        }
    }

    @media (max-width: 576px) {
        .images-grid-container {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        
        .grid-image-wrapper {
            height: 100px !important;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .grid-image-item {
            animation: none !important;
            opacity: 1 !important;
        }
        * {
            transition-duration: 0.01ms !important;
            animation-duration: 0.01ms !important;
        }
    }
</style>