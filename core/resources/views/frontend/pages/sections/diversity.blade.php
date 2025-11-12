<!-- Diversity Section - Crown Layout Style -->
<div class="diversity-section" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); position: relative; overflow: hidden;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Background Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.05), rgba(45, 88, 80, 0.03)); border-radius: 50%; filter: blur(60px); z-index: 0;"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 400px; height: 400px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.03), rgba(45, 88, 80, 0.05)); border-radius: 50%; filter: blur(80px); z-index: 0;"></div>
        
        <!-- Crown Container -->
        <div style="position: relative; max-width: 1100px; margin: 0 auto; min-height: 600px;">
            
            @php
                // Récupérer 12 annonces aléatoires avec images
                $diverseListings = \App\Models\Backend\Listing::where('status', 1)
                    ->where('is_published', 1)
                    ->whereNotNull('image')
                    ->inRandomOrder()
                    ->take(12)
                    ->get();
                
                // Positions en couronne (cercle autour du centre)
                $crownPositions = [
                    // Rangée supérieure gauche
                    ['left' => '5%', 'top' => '8%', 'size' => 140, 'rotate' => -5],
                    ['left' => '18%', 'top' => '2%', 'size' => 150, 'rotate' => 3],
                    ['left' => '32%', 'top' => '0%', 'size' => 135, 'rotate' => -2],
                    
                    // Rangée supérieure droite
                    ['left' => '52%', 'top' => '0%', 'size' => 145, 'rotate' => 4],
                    ['left' => '68%', 'top' => '3%', 'size' => 140, 'rotate' => -3],
                    ['left' => '82%', 'top' => '10%', 'size' => 150, 'rotate' => 2],
                    
                    // Côtés milieu
                    ['left' => '2%', 'top' => '35%', 'size' => 135, 'rotate' => 5],
                    ['left' => '85%', 'top' => '38%', 'size' => 145, 'rotate' => -4],
                    
                    // Rangée inférieure
                    ['left' => '8%', 'top' => '65%', 'size' => 140, 'rotate' => -3],
                    ['left' => '22%', 'top' => '72%', 'size' => 135, 'rotate' => 4],
                    ['left' => '70%', 'top' => '70%', 'size' => 145, 'rotate' => -2],
                    ['left' => '83%', 'top' => '63%', 'size' => 140, 'rotate' => 3],
                ];
            @endphp

            <!-- Floating Images in Crown Pattern -->
            @foreach($diverseListings as $index => $listing)
                @php
                    $pos = $crownPositions[$index] ?? ['left' => '50%', 'top' => '50%', 'size' => 140, 'rotate' => 0];
                @endphp
                <div class="crown-image-item" 
                     style="position: absolute; 
                            left: {{ $pos['left'] }}; 
                            top: {{ $pos['top'] }}; 
                            width: {{ $pos['size'] }}px; 
                            height: {{ $pos['size'] }}px; 
                            z-index: 1;
                            animation: floatCrown {{ 3 + ($index % 3) }}s ease-in-out infinite;
                            animation-delay: {{ $index * 0.15 }}s;">
                    <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                       style="display: block; text-decoration: none; width: 100%; height: 100%;">
                        <div class="crown-image-wrapper" 
                             style="position: relative; 
                                    border-radius: 20px; 
                                    overflow: hidden; 
                                    width: 100%; 
                                    height: 100%; 
                                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12); 
                                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
                                    background: white;
                                    transform: rotate({{ $pos['rotate'] }}deg);">
                            {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                            <div class="crown-overlay" 
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
                                <div style="color: white; font-weight: 600; font-size: 13px; margin-bottom: 6px; line-height: 1.3;">
                                    {{ Str::limit($listing->title, 35) }}
                                </div>
                                <div style="color: rgba(255, 255, 255, 0.95); font-size: 15px; font-weight: 700;">
                                    {{ amount_with_currency_symbol($listing->price) }}
                                </div>
                                <div style="margin-top: 10px; padding: 5px 10px; background: rgba(255, 255, 255, 0.2); border-radius: 20px; font-size: 10px; color: white; border: 1px solid rgba(255, 255, 255, 0.3);">
                                    {{ optional($listing->category)->name ?? __('Divers') }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <!-- Central Content -->
            <div style="position: relative; z-index: 10; text-align: center; padding: 120px 20px 80px;">
                
                <!-- Section Header Badge -->
                <div style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.1), rgba(45, 88, 80, 0.1)); border-radius: 50px; margin-bottom: 16px;">
                    <span style="font-size: 13px; font-weight: 600; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: 1px;">
                        {{ __('DIVERSITÉ') }}
                    </span>
                </div>
                
                <!-- Main Title -->
                <h2 style="font-size: clamp(32px, 5vw, 48px); font-weight: 700; color: #1e293b; margin: 0 0 16px; line-height: 1.2;">
                    {{ __('Découvrez toutes sortes d\'annonces') }}
                </h2>
                
                <!-- Subtitle -->
                <p style="font-size: 18px; color: #64748B; max-width: 600px; margin: 0 auto 40px; line-height: 1.6;">
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

        </div>
    </div>
</div>

<style>
    /* Crown Float Animation */
    @keyframes floatCrown {
        0%, 100% {
            transform: translateY(0);
        }
        25% {
            transform: translateY(-12px);
        }
        50% {
            transform: translateY(-6px);
        }
        75% {
            transform: translateY(-15px);
        }
    }

    /* Hover Effects */
    .crown-image-wrapper:hover {
        transform: scale(1.08) translateY(-10px) rotate(0deg) !important;
        box-shadow: 0 20px 45px rgba(31, 62, 57, 0.25) !important;
    }

    .crown-image-wrapper:hover .crown-overlay {
        opacity: 1;
    }

    .btn-explore-diversity:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 36px rgba(31, 62, 57, 0.4);
    }

    .btn-explore-diversity:hover svg {
        transform: translateX(5px);
    }

    /* Image Styling */
    .crown-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .crown-image-wrapper:hover img {
        transform: scale(1.15);
    }

    /* Loading skeleton for images */
    .crown-image-wrapper::before {
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

    /* Responsive Design */
    @media (max-width: 1024px) {
        .crown-image-item {
            width: 110px !important;
            height: 110px !important;
        }
    }

    @media (max-width: 768px) {
        .diversity-section {
            padding: 60px 0 !important;
        }
        .crown-image-item {
            width: 85px !important;
            height: 85px !important;
        }
    }

    @media (max-width: 576px) {
        .crown-image-item {
            width: 65px !important;
            height: 65px !important;
        }
        .crown-image-item:nth-child(n+9) {
            display: none; /* Cache quelques images sur très petits écrans */
        }
    }

    /* Accessibility - Reduce motion */
    @media (prefers-reduced-motion: reduce) {
        .crown-image-item {
            animation: none !important;
        }
        * {
            transition-duration: 0.01ms !important;
            animation-duration: 0.01ms !important;
        }
    }
</style>