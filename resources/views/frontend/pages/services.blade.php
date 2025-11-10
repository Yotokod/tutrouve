@extends('frontend.layout.master')

@section('content')
    <!-- Services Hero Section -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%); text-align: center;">
        <div class="container-1440">
            <h1 style="color: #ffffff; font-size: 3rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                {{ __('Nos services') }}
            </h1>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin: 0 auto 20px;"></div>
            <p style="color: #b0b0b0; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.8;">
                {{ __('Découvrez tous les services que nous offrons pour rendre votre expérience meilleure.') }}
            </p>
        </div>
    </div>

    <!-- Services Grid -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%);">
        <div class="container-1440">
            <div class="row g-4">
                @php
                    $services = [
                        [
                            'icon' => 'la-list-ul',
                            'title' => __('Lister vos annonces'),
                            'description' => __('Publiez vos annonces facilement et rapidement sur notre plateforme.'),
                        ],
                        [
                            'icon' => 'la-search',
                            'title' => __('Rechercher les annonces'),
                            'description' => __('Trouvez exactement ce que vous cherchez grâce à nos outils de recherche avancés.'),
                        ],
                        [
                            'icon' => 'la-comments',
                            'title' => __('Messagerie instantanée'),
                            'description' => __('Communiquez directement avec les vendeurs et acheteurs en temps réel.'),
                        ],
                        [
                            'icon' => 'la-heart',
                            'title' => __('Favoris'),
                            'description' => __('Enregistrez vos annonces préférées et retrouvez-les facilement.'),
                        ],
                        [
                            'icon' => 'la-star',
                            'title' => __('Avis et notes'),
                            'description' => __('Consultez les avis d\'autres utilisateurs pour vous aider à décider.'),
                        ],
                        [
                            'icon' => 'la-lock',
                            'title' => __('Transactions sécurisées'),
                            'description' => __('Vos données personnelles et financières sont protégées.'),
                        ],
                    ];
                @endphp

                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div style="
                            background: rgba(147, 189, 147, 0.1);
                            backdrop-filter: blur(10px);
                            border-radius: 16px;
                            padding: 40px 30px;
                            border: 1px solid rgba(147, 189, 147, 0.3);
                            transition: all 0.3s;
                            cursor: pointer;
                            min-height: 280px;
                            display: flex;
                            flex-direction: column;
                        "
                        onmouseover="this.style.transform='translateY(-10px) scale(1.02)'; this.style.background='rgba(147, 189, 147, 0.2)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.boxShadow='0 16px 48px rgba(147, 189, 147, 0.2)'"
                        onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.background='rgba(147, 189, 147, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'">
                            <!-- Icon -->
                            <div style="font-size: 48px; color: #93bd93; margin-bottom: 20px; transition: all 0.3s;">
                                <i class="las {{ $service['icon'] }}"></i>
                            </div>

                            <!-- Title -->
                            <h3 style="color: #ffffff; font-size: 1.3rem; font-weight: 600; margin-bottom: 12px;">
                                {{ $service['title'] }}
                            </h3>

                            <!-- Description -->
                            <p style="color: #b0b0b0; font-size: 0.95rem; line-height: 1.6; flex-grow: 1; margin: 0;">
                                {{ $service['description'] }}
                            </p>

                            <!-- Arrow -->
                            <div style="margin-top: 20px; color: #93bd93; font-size: 24px; transition: all 0.3s;">
                                <i class="las la-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%);">
        <div class="container-1440">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 style="color: #ffffff; font-size: 2.5rem; font-weight: 700; margin-bottom: 12px; text-align: center;">
                        {{ __('Plans tarifaires') }}
                    </h2>
                    <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin: 0 auto 30px;"></div>
                    <p style="color: #b0b0b0; font-size: 1rem; text-align: center; margin: 0;">
                        {{ __('Choisissez le plan qui convient le mieux à vos besoins.') }}
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $plans = [
                        [
                            'name' => __('Gratuit'),
                            'price' => __('Gratuit'),
                            'features' => [
                                __('Jusqu\'à 3 annonces'),
                                __('Images illimitées'),
                                __('Support email'),
                                __('Accès à la communauté'),
                            ],
                        ],
                        [
                            'name' => __('Premium'),
                            'price' => __('9,99 €/mois'),
                            'features' => [
                                __('Annonces illimitées'),
                                __('Images illimitées'),
                                __('Mise en avant des annonces'),
                                __('Support prioritaire'),
                                __('Statistiques détaillées'),
                            ],
                            'featured' => true,
                        ],
                        [
                            'name' => __('Pro'),
                            'price' => __('19,99 €/mois'),
                            'features' => [
                                __('Tout de Premium'),
                                __('API d\'intégration'),
                                __('Gestion d\'équipe'),
                                __('Support téléphonique'),
                                __('Rapports avancés'),
                            ],
                        ],
                    ];
                @endphp

                @foreach($plans as $plan)
                    <div class="col-lg-4">
                        <div style="
                            background: {{ isset($plan['featured']) && $plan['featured'] ? 'linear-gradient(135deg, rgba(147, 189, 147, 0.3), rgba(147, 189, 147, 0.1))' : 'rgba(147, 189, 147, 0.1)' }};
                            backdrop-filter: blur(10px);
                            border-radius: 16px;
                            padding: 40px 30px;
                            border: {{ isset($plan['featured']) && $plan['featured'] ? '2px solid rgba(147, 189, 147, 0.8)' : '1px solid rgba(147, 189, 147, 0.3)' }};
                            transition: all 0.3s;
                            transform: {{ isset($plan['featured']) && $plan['featured'] ? 'scale(1.05)' : 'scale(1)' }};
                            position: relative;
                        "
                        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 16px 48px rgba(147, 189, 147, 0.2)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'">
                            
                            @if(isset($plan['featured']) && $plan['featured'])
                                <div style="
                                    position: absolute;
                                    top: -12px;
                                    left: 50%;
                                    transform: translateX(-50%);
                                    background: linear-gradient(135deg, #93bd93, #7da97d);
                                    color: white;
                                    padding: 4px 16px;
                                    border-radius: 20px;
                                    font-size: 12px;
                                    font-weight: 600;
                                ">
                                    {{ __('Recommandé') }}
                                </div>
                            @endif

                            <!-- Plan Name -->
                            <h3 style="color: #ffffff; font-size: 1.5rem; font-weight: 700; margin-bottom: 16px;">
                                {{ $plan['name'] }}
                            </h3>

                            <!-- Price -->
                            <div style="font-size: 2.5rem; font-weight: 700; color: #93bd93; margin-bottom: 30px;">
                                {{ $plan['price'] }}
                            </div>

                            <!-- Features -->
                            <ul style="list-style: none; padding: 0; margin-bottom: 30px;">
                                @foreach($plan['features'] as $feature)
                                    <li style="color: #b0b0b0; font-size: 0.95rem; margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                        <i class="las la-check" style="color: #93bd93; font-size: 18px;"></i>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <!-- CTA Button -->
                            <a href="{{ route('user.register') }}" 
                               style="
                                   display: block;
                                   text-align: center;
                                   padding: 12px 20px;
                                   background: {{ isset($plan['featured']) && $plan['featured'] ? 'linear-gradient(135deg, #93bd93, #7da97d)' : 'rgba(147, 189, 147, 0.2)' }};
                                   color: white;
                                   border: 1px solid rgba(147, 189, 147, 0.5);
                                   border-radius: 8px;
                                   text-decoration: none;
                                   font-weight: 600;
                                   transition: all 0.3s;
                               "
                               onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='{{ isset($plan['featured']) && $plan['featured'] ? 'linear-gradient(135deg, #93bd93, #7da97d)' : 'rgba(147, 189, 147, 0.2)' }}'; this.style.transform='translateY(0)'">
                                {{ __('Commencer') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
