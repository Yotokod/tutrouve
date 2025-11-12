<!-- Diversity Section - Origami Symmetric Layout -->
<div class="diversity-section" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); position: relative; overflow: hidden;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <!-- Background Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.05), rgba(45, 88, 80, 0.03)); border-radius: 50%; filter: blur(60px); z-index: 0;"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 400px; height: 400px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.03), rgba(45, 88, 80, 0.05)); border-radius: 50%; filter: blur(80px); z-index: 0;"></div>
        
        <!-- Origami Grid Container -->
        <div style="position: relative; max-width: 1000px; margin: 0 auto; min-height: 700px;">
            
            @php
                // Récupérer 12 annonces aléatoires avec images
                $diverseListings = \App\Models\Backend\Listing::where('status', 1)
                    ->where('is_published', 1)
                    ->whereNotNull('image')
                    ->inRandomOrder()
                    ->take(12)
                    ->get();
                
                // Disposition symétrique en forme d'origami/diamant
                // Structure: rangées de 2-3-3-2-2 images
                $origamiPositions = [
                    // Rangée 1 (haut - 2 images)
                    ['left' => '25%', 'top' => '0%', 'size' => 140],
                    ['left' => '62%', 'top' => '0%', 'size' => 140],
                    
                    // Rangée 2 (3 images)
                    ['left' => '12%', 'top' => '18%', 'size' => 130],
                    ['left' => '42%', 'top' => '18%', 'size' => 130],
                    ['left' => '72%', 'top' => '18%', 'size' => 130],
                    
                    // Rangée 3 (3 images - plus large)
                    ['left' => '5%', 'top' => '40%', 'size' => 125],
                    ['left' => '38%', 'top' => '40%', 'size' => 125],
                    ['left' => '71%', 'top' => '40%', 'size' => 125],
                    
                    // Rangée 4 (2 images)
                    ['left' => '20%', 'top' => '62%', 'size' => 135],
                    ['left' => '57%', 'top' => '62%', 'size' => 135],
                    
                    // Rangée 5 (bas - 2 images)
                    ['left' => '28%', 'top' => '80%', 'size' => 130],
                    ['left' => '60%', 'top' => '80%', 'size' => 130],
                ];
            @endphp

            <!-- Images disposées en origami -->
            @foreach($diverseListings as $index => $listing)
                @php
                    $pos = $origamiPositions[$index] ?? ['left' => '50%', 'top' => '50%', 'size' => 130];
                @endphp
                <div class="origami-image-item" 
                     style="position: absolute; 
                            left: {{ $pos['left'] }}; 
                            top: {{ $pos['top'] }}; 
                            width: {{ $pos['size'] }}px; 
                            height: {{ $pos['size'] }}px; 
                            z-index: 1;
                            transform: translateX(-50%);
                            animation: floatOrigami {{ 3 + ($index % 3) }}s ease-in-out infinite;
                            animation-delay: {{ $index * 0.1 }}s;">
                    <a href="{{ route('frontend.listing.details', $listing->slug ?? 'x') }}" 
                       style="display: block; text-decoration: none; width: 100%; height: 100%;">
                        <div class="origami-image-wrapper" 
                             style="position: relative; 
                                    border-radius: 16px; 
                                    overflow: hidden; 
                                    width: 100%; 
                                    height: 100%; 
                                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); 
                                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
                                    background: white;">
                            {!! render_image_markup_by_attachment_id($listing->image, '', 'grid') !!}
                            <div class="origami-overlay" 
                                 style="position: absolute; 
                                        top: 0; 
                                        left: 0; 
                                        right: 0; 
                                        bottom: 0; 
                                        background: linear-gradient(135deg, rgba(31, 62, 57, 0.9), rgba(45, 88, 80, 0.8)); 
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

            <!-- Central Content (overlap au milieu) -->
            <div style="position: absolute; 
                        left: 50%; 
                        top: 50%; 
                        transform: translate(-50%, -50%); 
                        z-index: 10; 
                        text-align: center; 
                        max-width: 550px;
                        padding: 40px;
                        background: rgba(255, 255, 255, 0.95);
                        backdrop-filter: blur(10px);
                        border-radius: 24px;
                        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);">
                
                <!-- Section Header Badge -->
                <div style="display: inline-block; padding: 8px 20px; background: linear-gradient(135deg, rgba(31, 62, 57, 0.1), rgba(45, 88, 80, 0.1)); border-radius: 50px; margin-bottom: 16px;">
                    <span style="font-size: 12px; font-weight: 600; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: 1.5px;">
                        {{ __('DIVERSITÉ') }}
                    </span>
                </div>
                
                <!-- Main Title -->
                <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 700; color: #1e293b; margin: 0 0 14px; line-height: 1.2;">
                    {{ __('Découvrez toutes sortes d\'annonces') }}
                </h2>
                
                <!-- Subtitle -->
                <p style="font-size: 16px; color: #64748B; margin: 0 auto 30px; line-height: 1.6;">
                    {{ __('De l\'électronique aux services, explorez la richesse et la variété des offres disponibles sur Tutrouve.') }}
                </p>

                <!-- Call to Action Button -->
                <a href="{{ route('frontend.home.search') }}" 
                   class="btn-explore-diversity" 
                   style="display: inline-flex; 
                          align-items: center; 
                          gap: 10px; 
                          padding: 14px 32px; 
                          background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); 
                          color: white; 
                          border-radius: 50px; 
                          font-size: 15px; 
                          font-weight: 600; 
                          text-decoration: none; 
                          box-shadow: 0 8px 24px rgba(31, 62, 57, 0.3); 
                          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                    {{ __('Explorer toutes les annonces') }}
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="transition: transform 0.3s ease;">
                        <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    /* Origami Float Animation - subtle */
    @keyframes floatOrigami {
        0%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        50% {
            transform: translateX(-50%) translateY(-10px);
        }
    }

    /* Hover Effects */
    .origami-image-wrapper:hover {
        transform: scale(1.06) translateY(-6px);
        box-shadow: 0 16px 40px rgba(31, 62, 57, 0.2) !important;
    }

    .origami-image-wrapper:hover .origami-overlay {
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
    .origami-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .origami-image-wrapper:hover img {
        transform: scale(1.1);
    }

    /* Loading skeleton */
    .origami-image-wrapper::before {
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
        .origami-image-item {
            width: 110px !important;
            height: 110px !important;
        }
    }

    @media (max-width: 768px) {
        .diversity-section {
            padding: 60px 0 !important;
        }
        .origami-image-item {
            width: 85px !important;
            height: 85px !important;
        }
    }

    @media (max-width: 576px) {
        .origami-image-item {
            width: 65px !important;
            height: 65px !important;
        }
        .origami-image-item:nth-child(n+9) {
            display: none;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .origami-image-item {
            animation: none !important;
        }
        * {
            transition-duration: 0.01ms !important;
            animation-duration: 0.01ms !important;
        }
    }
</style>