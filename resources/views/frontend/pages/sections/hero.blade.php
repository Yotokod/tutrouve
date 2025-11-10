<!-- Hero Section - Keep existing design with enhanced interactivity -->
@php
    $heroBg = get_static_option('frontend_home_hero_image');
@endphp

<div class="hero-section" style="background-image: url('{{ asset('storage/' . $heroBg) }}'); background-size: cover; background-position: center; padding: 100px 0; position: relative; overflow: hidden;">
    <!-- Animated background overlay -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(31, 62, 57, 0.85) 0%, rgba(15, 23, 42, 0.9) 100%); z-index: 1;"></div>
    
    <!-- Floating particles effect -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 2; pointer-events: none;">
        <div class="particle" style="position: absolute; width: 4px; height: 4px; background: rgba(147, 189, 147, 0.4); border-radius: 50%; top: 20%; left: 10%; animation: float-particle 8s ease-in-out infinite;"></div>
        <div class="particle" style="position: absolute; width: 6px; height: 6px; background: rgba(147, 189, 147, 0.3); border-radius: 50%; top: 60%; left: 80%; animation: float-particle 10s ease-in-out infinite 1s;"></div>
        <div class="particle" style="position: absolute; width: 5px; height: 5px; background: rgba(147, 189, 147, 0.5); border-radius: 50%; top: 40%; left: 50%; animation: float-particle 12s ease-in-out infinite 2s;"></div>
    </div>

    <div style="padding: 80px 0; min-height: 500px; display: flex; align-items: center; position: relative; z-index: 3;">
        <div class="container-1440">
            <div class="row">
                <div class="col-lg-9 col-xl-8">
                    <div style="color: #ffffff; animation: fadeInUp 0.8s ease-out;">
                        <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 24px; line-height: 1.2; letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            {{ get_static_option('frontend_home_hero_title') ?? __('Trouvez ce que vous cherchez') }}
                        </h1>
                        <p style="font-size: 1.25rem; margin-bottom: 40px; color: #e0e0e0; line-height: 1.7; max-width: 600px;">
                            {{ get_static_option('frontend_home_hero_subtitle') ?? __('Parcourez nos annonces et trouvez les meilleures offres près de chez vous') }}
                        </p>
                        
                        <!-- Enhanced Search Form with Neo-Glassmorphism -->
                        <form action="{{ route('frontend.home.search') }}" method="get" style="display: flex; gap: 12px; flex-wrap: wrap; animation: fadeInUp 0.8s ease-out 0.2s both;">
                            <div style="flex: 1; min-width: 300px; position: relative;">
                                <input type="text" name="search" placeholder="{{ __('Que recherchez-vous ?') }}" 
                                       style="width: 100%; padding: 16px 24px 16px 50px; border-radius: 50px; border: 2px solid rgba(255, 255, 255, 0.2); font-size: 16px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; outline: none;"
                                       onfocus="this.style.background='rgba(255, 255, 255, 1)'; this.style.borderColor='#93bd93'; this.style.boxShadow='0 12px 32px rgba(147, 189, 147, 0.2)'"
                                       onblur="this.style.background='rgba(255, 255, 255, 0.95)'; this.style.borderColor='rgba(255, 255, 255, 0.2)'; this.style.boxShadow='0 8px 24px rgba(0, 0, 0, 0.1)'">
                                <i class="las la-search" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); font-size: 20px; color: #93bd93; pointer-events: none;"></i>
                            </div>
                            <button type="submit" 
                                    style="padding: 16px 48px; background: linear-gradient(135deg, #93bd93, #7da97d); color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 16px; box-shadow: 0 8px 24px rgba(147, 189, 147, 0.3); white-space: nowrap;"
                                    onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 32px rgba(147, 189, 147, 0.4)'"
                                    onmouseout="this.style.background='linear-gradient(135deg, #93bd93, #7da97d)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(147, 189, 147, 0.3)'">
                                <i class="las la-search"></i> {{ __('Rechercher') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float-particle {
        0%, 100% {
            transform: translateY(0) translateX(0);
            opacity: 0.4;
        }
        50% {
            transform: translateY(-30px) translateX(15px);
            opacity: 0.8;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .hero-section h1 {
            font-size: 2.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 0 !important;
        }
        .hero-section h1 {
            font-size: 2rem !important;
        }
        .hero-section p {
            font-size: 1.1rem !important;
        }
    }

    @media (max-width: 576px) {
        .hero-section form {
            flex-direction: column;
        }
        .hero-section form > div {
            width: 100%;
        }
        .hero-section form button {
            width: 100%;
        }
    }
</style>
