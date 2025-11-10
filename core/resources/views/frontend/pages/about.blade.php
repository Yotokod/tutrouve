@extends('frontend.layout.master')

@section('content')
    <!-- About Hero Section -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%);">
        <div class="container-1440">
            <div class="row align-items-center g-5">
                <!-- Content -->
                <div class="col-lg-6">
                    <div>
                        <h1 style="color: #ffffff; font-size: 3rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                            {{ __('À propos de nous') }}
                        </h1>
                        <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin-bottom: 30px;"></div>
                        <p style="color: #b0b0b0; font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
                            {{ get_static_option('about_page_description') ?? __('Bienvenue sur notre plateforme de petites annonces. Nous nous engageons à fournir un service de qualité pour connecter les vendeurs et les acheteurs.') }}
                        </p>
                        <p style="color: #b0b0b0; font-size: 1rem; line-height: 1.8;">
                            {{ __('Notre mission est de simplifier le processus de vente et d\'achat en ligne, en offrant une plateforme sûre, fiable et conviviale.') }}
                        </p>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-lg-6">
                    <div style="
                        background: rgba(147, 189, 147, 0.1);
                        backdrop-filter: blur(10px);
                        border-radius: 16px;
                        padding: 30px;
                        border: 1px solid rgba(147, 189, 147, 0.3);
                    ">
                        <img src="{{ get_static_option('about_page_image') ?? asset('images/about.jpg') }}" 
                             alt="About Us" 
                             style="width: 100%; border-radius: 12px; display: block;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%);">
        <div class="container-1440">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 style="color: #ffffff; font-size: 2.5rem; font-weight: 700; margin-bottom: 12px; text-align: center;">
                        {{ __('Nos avantages') }}
                    </h2>
                    <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin: 0 auto 30px;"></div>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $features = [
                        ['icon' => 'la-shield-alt', 'title' => __('Sécurisé'), 'description' => __('Transactions sécurisées et données protégées')],
                        ['icon' => 'la-users', 'title' => __('Communauté'), 'description' => __('Des milliers d\'utilisateurs actifs')],
                        ['icon' => 'la-check-circle', 'title' => __('Vérification'), 'description' => __('Annonces vérifiées et approuvées')],
                        ['icon' => 'la-headset', 'title' => __('Support'), 'description' => __('Support client 24/7 en ligne')],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="col-lg-3 col-md-6">
                        <div style="
                            background: rgba(147, 189, 147, 0.1);
                            backdrop-filter: blur(10px);
                            border-radius: 16px;
                            padding: 30px;
                            border: 1px solid rgba(147, 189, 147, 0.3);
                            text-align: center;
                            transition: all 0.3s;
                            cursor: pointer;
                        "
                        onmouseover="this.style.transform='translateY(-8px)'; this.style.background='rgba(147, 189, 147, 0.2)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(147, 189, 147, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'">
                            <div style="font-size: 48px; color: #93bd93; margin-bottom: 16px;">
                                <i class="las {{ $feature['icon'] }}"></i>
                            </div>
                            <h3 style="color: #ffffff; font-size: 1.3rem; margin-bottom: 12px;">
                                {{ $feature['title'] }}
                            </h3>
                            <p style="color: #b0b0b0; font-size: 0.95rem; margin: 0;">
                                {{ $feature['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
