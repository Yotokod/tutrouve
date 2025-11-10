<!-- Hero Section - Keep existing design -->
@php
    $heroBg = get_static_option('frontend_home_hero_image');
@endphp

<div class="hero-section" style="background-image: url('{{ asset('storage/' . $heroBg) }}'); background-size: cover; background-position: center; padding: 100px 0;">
    <div style="background: rgba(0, 0, 0, 0.5); padding: 80px 0; min-height: 400px; display: flex; align-items: center;">
        <div class="container-1440">
            <div class="row">
                <div class="col-lg-8">
                    <div style="color: #ffffff;">
                        <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                            {{ get_static_option('frontend_home_hero_title') ?? __('Trouvez ce que vous cherchez') }}
                        </h1>
                        <p style="font-size: 1.2rem; margin-bottom: 40px; color: #e0e0e0; line-height: 1.6;">
                            {{ get_static_option('frontend_home_hero_subtitle') ?? __('Parcourez nos annonces et trouvez les meilleures offres') }}
                        </p>
                        
                        <!-- Search Form -->
                        <form action="{{ route('frontend.home.search') }}" method="get" style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <input type="text" name="search" placeholder="{{ __('Rechercher...') }}" 
                                   style="flex: 1; min-width: 250px; padding: 14px 20px; border-radius: 50px; border: none; font-size: 16px; background: rgba(255, 255, 255, 0.9);">
                            <button type="submit" 
                                    style="padding: 14px 40px; background: #93bd93; color: white; border: none; border-radius: 50px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 16px;"
                                    onmouseover="this.style.background='#7da97d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(147, 189, 147, 0.4)'"
                                    onmouseout="this.style.background='#93bd93'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                <i class="las la-search"></i> {{ __('Rechercher') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
