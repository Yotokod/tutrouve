<!-- Services Highlight Section -->
@php
    // Récupérer la catégorie Services
    $servicesCategory = \App\Models\Backend\Category::where('name', 'LIKE', '%service%')
                                                     ->orWhere('name', 'LIKE', '%Service%')
                                                     ->where('status', 1)
                                                     ->first();
    
    // Si la catégorie existe, récupérer des annonces services aléatoires
    $serviceListings = [];
    if ($servicesCategory) {
        $serviceListings = \App\Models\Backend\Listing::where('category_id', $servicesCategory->id)
                                                       ->where('status', 1)
                                                       ->where('is_published', 1)
                                                       ->inRandomOrder()
                                                       ->take(3)
                                                       ->get();
    }
    
    // Si pas assez d'annonces services, compléter avec des annonces aléatoires
    if ($serviceListings->count() < 3) {
        $remainingCount = 3 - $serviceListings->count();
        $additionalListings = \App\Models\Backend\Listing::where('status', 1)
                                                          ->where('is_published', 1)
                                                          ->inRandomOrder()
                                                          ->take($remainingCount)
                                                          ->get();
        $serviceListings = $serviceListings->merge($additionalListings);
    }
@endphp

<section class="services-highlight-section" style="padding: 80px 0; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding-top: 80px; padding-bottom: 80px;">
    <div class="container-1440">
        <div class="services-highlight-wrapper" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            
            <!-- Left: Image Section -->
            <div class="services-image-section" style="position: relative;">
                <div class="main-service-image" style="position: relative; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 60px rgba(31, 62, 57, 0.15); height: 650px; min-height: 480px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #e8f5e9 0%, #f1f5f9 100%);">
                    <img src="https://tutrouve.com/core/public/2149095914.jpg" alt="Services" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                    <!-- Badge flottant (ancienne version) -->
                    <div style="position: absolute; bottom: 24px; left: 24px; background: white; padding: 16px 24px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 12px;">
                        <div style="display: flex; align-items: center; margin-right: 8px;">
                            @if($serviceListings->count() >= 3)
                                @foreach($serviceListings->take(3) as $index => $listing)
                                    <div style="width: 36px; height: 36px; border-radius: 50%; overflow: hidden; border: 3px solid white; margin-left: {{ $index > 0 ? '-12px' : '0' }}; position: relative; z-index: {{ 3 - $index }};">
                                        {!! render_image_markup_by_attachment_id($listing->image, '', 'thumb') !!}
                                    </div>
                                @endforeach
                            @endif
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px; border: 3px solid white; margin-left: -12px; position: relative; z-index: 0;">
                                {{ \App\Models\Backend\Listing::where('status', 1)->where('is_published', 1)->count() }}+
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 700; color: #1e293b; line-height: 1.2;">
                                {{ __('Rejoignez notre communauté') }}
                            </div>
                            <div style="font-size: 12px; color: #64748B; margin-top: 2px;">
                                {{ __('de professionnels actifs') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Content Section -->
            <div class="services-content-section">
                <div style="max-width: 540px;">
                    <!-- Title -->
                    <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; line-height: 1.2; margin-bottom: 24px;">
                        {{ __('Où les Sourires Deviennent des Opportunités') }}
                        
                    </h2>

                    <!-- Description -->
                    <p style="font-size: 16px; line-height: 1.8; color: #64748B; margin-bottom: 32px;">
                        {{ __('Tutrouve n\'est pas qu\'une plateforme d\'annonces, c\'est un espace où vos besoins trouvent des solutions. Ici, vous pouvez explorer librement, suivre vos recherches, et découvrir ces opportunités qui se transforment en succès concrets.') }}
                    </p>

                    <!-- CTA Button -->
                    <a href="{{ route('frontend.home.search') }}" style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 32px; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); color: white; border-radius: 16px; font-weight: 600; font-size: 16px; text-decoration: none; box-shadow: 0 8px 24px rgba(31, 62, 57, 0.3); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);" 
                       onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 36px rgba(31, 62, 57, 0.4)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(31, 62, 57, 0.3)';">
                        {{ __('Explorer Plus') }}
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    <!-- Features Grid -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 48px;">
                        <!-- Feature 1 -->
                        <div style="background: white; padding: 24px; border-radius: 16px; border: 2px solid rgba(31, 62, 57, 0.1); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                             onmouseover="this.style.borderColor='rgba(31, 62, 57, 0.3)'; this.style.transform='translateY(-4px)';"
                             onmouseout="this.style.borderColor='rgba(31, 62, 57, 0.1)'; this.style.transform='translateY(0)';">
                            <div style="width: 48px; height: 48px; background: rgba(31, 62, 57, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#1F3E39" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 17L12 22L22 17" stroke="#1F3E39" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 12L12 17L22 12" stroke="#1F3E39" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                                {{ __('Confidentialité') }}
                            </h4>
                            <p style="font-size: 14px; color: #64748B; line-height: 1.6;">
                                {{ __('Votre vie privée est notre priorité. Espace discret et sécurisé.') }}
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div style="background: white; padding: 24px; border-radius: 16px; border: 2px solid rgba(31, 62, 57, 0.1); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                             onmouseover="this.style.borderColor='rgba(31, 62, 57, 0.3)'; this.style.transform='translateY(-4px)';"
                             onmouseout="this.style.borderColor='rgba(31, 62, 57, 0.1)'; this.style.transform='translateY(0)';">
                            <div style="width: 48px; height: 48px; background: rgba(31, 62, 57, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="11" width="18" height="11" rx="2" stroke="#1F3E39" stroke-width="2"/>
                                    <path d="M7 11V7C7 4.79086 8.79086 3 11 3H13C15.2091 3 17 4.79086 17 7V11" stroke="#1F3E39" stroke-width="2"/>
                                    <circle cx="12" cy="16" r="1" fill="#1F3E39"/>
                                </svg>
                            </div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                                {{ __('Accessibilité') }}
                            </h4>
                            <p style="font-size: 14px; color: #64748B; line-height: 1.6;">
                                {{ __('Conçu pour tous, avec des fonctionnalités inclusives et faciles.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Responsive Styles -->
<style>
    @media (max-width: 992px) {
        .services-highlight-wrapper {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
        
        .services-highlight-section h2 {
            font-size: 36px !important;
        }
    }

    @media (max-width: 768px) {
        .services-highlight-section {
            padding: 60px 0 !important;
        }
        
        .services-highlight-section h2 {
            font-size: 32px !important;
        }
        
        .services-content-section > div {
            max-width: 100% !important;
        }
        
        .services-content-section > div > div:last-child {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
    }

    @media (max-width: 576px) {
        .services-highlight-section h2 {
            font-size: 28px !important;
        }
        
        .services-highlight-section p {
            font-size: 15px !important;
        }
        
        .main-service-image img {
            height: 400px !important;
            object-fit: cover;
        }
    }
</style>
