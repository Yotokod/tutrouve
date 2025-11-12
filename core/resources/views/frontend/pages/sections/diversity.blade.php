<!-- Diversity Section - Two Column Layout with Carousel -->
<div class="diversity-section" style="background: #f0f7f0; position: relative; overflow: hidden;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding-left: 60px;">
        
        <!-- Two Column Layout -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; position: relative; z-index: 1;">
            
            <!-- Left Column - Content -->
            <div style="padding-right: 40px;">
                
                <!-- Section Header Badge -->
                <div style="display: inline-block; padding: 8px 20px; background: rgba(255, 255, 255, 0.3); border-radius: 50px; margin-bottom: 24px;">
                    <span style="font-size: 13px; font-weight: 600; color: #1F3E39; letter-spacing: 1.5px;">
                        {{ __('DIVERSITÉ') }}
                    </span>
                </div>
                
                <!-- Main Title -->
                <h2 style="font-size: clamp(36px, 5vw, 52px); font-weight: 700; color: #1e293b; margin: 0 0 20px; line-height: 1.2;">
                    {{ __('Découvrez toutes sortes d\'annonces') }}
                </h2>
                
                <!-- Subtitle -->
                <p style="font-size: 18px; color: #334155; margin: 0 0 40px; line-height: 1.7;">
                    {{ __('De l\'électronique aux services, explorez la richesse et la variété des offres disponibles sur Tutrouve.') }}
                </p>

                <!-- Call to Action Button -->
                <a href="{{ route('frontend.home.search') }}" 
                   class="btn-explore-diversity" 
                   style="display: inline-flex; 
                          align-items: center; 
                          gap: 12px; 
                          padding: 16px 36px; 
                          background: #1F3E39; 
                          color: white; 
                          border-radius: 50px; 
                          font-size: 16px; 
                          font-weight: 600; 
                          text-decoration: none; 
                          box-shadow: 0 4px 12px rgba(31, 62, 57, 0.25); 
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

            <!-- Right Column - Scrolling Columns -->
            <div style="display: flex; gap: 12px; height: 700px; overflow: hidden; position: relative; margin: -100px 0;">
                
                <!-- Column 1 - Scroll Down -->
                <div class="scroll-column scroll-down" style="flex: 1; display: flex; flex-direction: column; gap: 12px;">
                    @foreach($diverseListings->slice(0, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                    <div class="carousel-overlay" 
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
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- Duplicate for seamless loop -->
                    @foreach($diverseListings->slice(0, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Column 2 - Scroll Up -->
                <div class="scroll-column scroll-up" style="flex: 1; display: flex; flex-direction: column; gap: 12px; margin-top: -100px;">
                    @foreach($diverseListings->slice(4, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                    <div class="carousel-overlay" 
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
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- Duplicate for seamless loop -->
                    @foreach($diverseListings->slice(4, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Column 3 - Scroll Down (offset) -->
                <div class="scroll-column scroll-down-slow" style="flex: 1; display: flex; flex-direction: column; gap: 12px; margin-top: -50px;">
                    @foreach($diverseListings->slice(8, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                    <div class="carousel-overlay" 
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
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- Duplicate for seamless loop -->
                    @foreach($diverseListings->slice(8, 4) as $listing)
                        <div class="carousel-image-item">
                            <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                               style="display: block; text-decoration: none; width: 100%; height: 100%;">
                                <div class="carousel-image-wrapper" 
                                     style="position: relative; 
                                            overflow: hidden; 
                                            width: 100%; 
                                            height: 200px;
                                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                            background: #f0f0f0;">
                                    {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    /* Scrolling animations */
    @keyframes scrollDown {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-50%);
        }
    }

    @keyframes scrollUp {
        0% {
            transform: translateY(-50%);
        }
        100% {
            transform: translateY(0);
        }
    }

    .scroll-down {
        animation: scrollDown 30s linear infinite;
    }

    .scroll-up {
        animation: scrollUp 25s linear infinite;
    }

    .scroll-down-slow {
        animation: scrollDown 35s linear infinite;
    }

    /* Pause on hover */
    .scroll-column:hover {
        animation-play-state: paused;
    }

    /* Hover Effects */
    .carousel-image-wrapper:hover {
        transform: scale(1.05);
    }

    .carousel-image-wrapper:hover .carousel-overlay {
        opacity: 1;
    }

    .btn-explore-diversity:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(31, 62, 57, 0.35);
    }

    .btn-explore-diversity:hover svg {
        transform: translateX(4px);
    }

    /* Image Styling */
    .carousel-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .carousel-image-wrapper:hover img {
        transform: scale(1.08);
    }

    /* Loading skeleton */
    .carousel-image-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, #e0e0e0 25%, #d0d0d0 50%, #e0e0e0 75%);
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
    }

    @media (max-width: 768px) {
        .diversity-section {
            padding: 40px 20px !important;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .scroll-column {
            animation: none !important;
        }
        * {
            transition-duration: 0.01ms !important;
        }
    }
</style>