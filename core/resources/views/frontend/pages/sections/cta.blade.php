<!-- Call To Action Section with Enhanced Neo-Glassmorphism and Stats -->
<div class="cta-section" style="padding: 100px 0; background: linear-gradient(135deg, #f0f7f0 0%, #e8f4e9 100%); position: relative; overflow: hidden;">
    <!-- Background animated elements -->
    <div style="position: absolute; top: -50%; right: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(147, 189, 147, 0.15) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -50%; left: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(147, 189, 147, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite 2s;"></div>
    <div style="position: absolute; top: 20%; right: 10%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(147, 189, 147, 0.08) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite 1s;"></div>

    <div class="container-1440">
        <!-- Stats Row -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="row g-4 text-center" style="position: relative; z-index: 2;">
                    <div class="col-md-4">
                        <div class="stat-card-hover" style="padding: 30px 20px; background: #ffffff; backdrop-filter: blur(10px); border-radius: 16px; border: 2px solid rgba(31, 62, 57, 0.1); transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(31, 62, 57, 0.3)'; this.style.boxShadow='0 12px 32px rgba(31, 62, 57, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(31, 62, 57, 0.1)'; this.style.boxShadow='0 4px 16px rgba(0, 0, 0, 0.08)'">
                            <div style="font-size: 2.5rem; font-weight: 700; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">{{ $topListings->count() ?? 7 }}+</div>
                            <div style="color: #666666; font-size: 14px; font-weight: 500;">{{ __('Annonces actives') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card-hover" style="padding: 30px 20px; background: #ffffff; backdrop-filter: blur(10px); border-radius: 16px; border: 2px solid rgba(31, 62, 57, 0.1); transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(31, 62, 57, 0.3)'; this.style.boxShadow='0 12px 32px rgba(31, 62, 57, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(31, 62, 57, 0.1)'; this.style.boxShadow='0 4px 16px rgba(0, 0, 0, 0.08)'">
                            <div style="font-size: 2.5rem; font-weight: 700; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">{{ $categories->count() ?? 6 }}+</div>
                            <div style="color: #666666; font-size: 14px; font-weight: 500;">{{ __('Catégories') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card-hover" style="padding: 30px 20px; background: #ffffff; backdrop-filter: blur(10px); border-radius: 16px; border: 2px solid rgba(31, 62, 57, 0.1); transition: all 0.3s ease; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(31, 62, 57, 0.3)'; this.style.boxShadow='0 12px 32px rgba(31, 62, 57, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(31, 62, 57, 0.1)'; this.style.boxShadow='0 4px 16px rgba(0, 0, 0, 0.08)'">
                            <div style="font-size: 2.5rem; font-weight: 700; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 8px;">1000+</div>
                            <div style="color: #666666; font-size: 14px; font-weight: 500;">{{ __('Utilisateurs actifs') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main CTA Card -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div style="
                    background: #ffffff;
                    border-radius: 24px;
                    padding: 60px 40px;
                    border: 2px solid rgba(147, 189, 147, 0.2);
                    text-align: center;
                    position: relative;
                    z-index: 1;
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    animation: fadeInScale 0.8s ease-out;
                " onmouseover="this.style.transform='translateY(-8px) scale(1.01)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.boxShadow='0 20px 60px rgba(147, 189, 147, 0.2)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(147, 189, 147, 0.2)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'">
                    
                    <!-- Icon with Glow Effect -->
                    <div style="font-size: 72px; margin-bottom: 24px; background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; filter: drop-shadow(0 4px 12px rgba(31, 62, 57, 0.3)); animation: pulse-glow 2s ease-in-out infinite;">
                        <i class="las la-rocket"></i>
                    </div>

                    <!-- Title -->
                    <h2 style="
                        color: #1F3E39;
                        font-size: 2.8rem;
                        font-weight: 700;
                        margin-bottom: 20px;
                        letter-spacing: -1px;
                        line-height: 1.2;
                    ">
                        {{ __('Prêt à commencer votre aventure ?') }}
                    </h2>

                    <!-- Subtitle -->
                    <p style="
                        color: #555555;
                        font-size: 1.15rem;
                        margin-bottom: 40px;
                        line-height: 1.7;
                        max-width: 600px;
                        margin-left: auto;
                        margin-right: auto;
                    ">
                        {{ __('Rejoignez notre communauté et commencez à publier vos annonces gratuitement. C\'est simple, rapide et efficace !') }}
                    </p>

                    <!-- CTA Buttons -->
                    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-bottom: 24px;">
                        <!-- Create Account Button -->
                        <a href="{{ route('user.register') }}" 
                           class="cta-btn-primary"
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 16px 48px;
                               background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
                               color: white;
                               text-decoration: none;
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 17px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               box-shadow: 0 8px 24px rgba(31, 62, 57, 0.35);
                               position: relative;
                               overflow: hidden;
                           "
                           onmouseover="this.style.background='linear-gradient(135deg, #2d5850 0%, #1F3E39 100%)'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 36px rgba(31, 62, 57, 0.5)'"
                           onmouseout="this.style.background='linear-gradient(135deg, #1F3E39 0%, #2d5850 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(31, 62, 57, 0.35)'">
                            <i class="las la-user-plus" style="font-size: 20px;"></i>
                            <span>{{ __('Créer un compte gratuit') }}</span>
                        </a>

                        <!-- Browse Listings Button -->
                        <a href="{{ route('frontend.home.search') }}" 
                           class="cta-btn-secondary"
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 16px 48px;
                               background: transparent;
                               color: #1F3E39;
                               text-decoration: none;
                               border: 2px solid #1F3E39;
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 17px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                           "
                           onmouseover="this.style.background='#1F3E39'; this.style.color='white'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(31, 62, 57, 0.3)'"
                           onmouseout="this.style.background='transparent'; this.style.color='#1F3E39'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="las la-search" style="font-size: 20px;"></i>
                            <span>{{ __('Explorer les annonces') }}</span>
                        </a>
                    </div>

                    <!-- Features Row -->
                    <div style="display: flex; gap: 32px; justify-content: center; margin-top: 40px; padding-top: 40px; border-top: 1px solid rgba(31, 62, 57, 0.1); flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #666666; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #1F3E39; font-size: 20px;"></i>
                            <span>{{ __('100% Gratuit') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #666666; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #1F3E39; font-size: 20px;"></i>
                            <span>{{ __('Inscription rapide') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #666666; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #1F3E39; font-size: 20px;"></i>
                            <span>{{ __('Support 24/7') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse-glow {
        0%, 100% {
            filter: drop-shadow(0 4px 12px rgba(31, 62, 57, 0.4));
            transform: scale(1);
        }
        50% {
            filter: drop-shadow(0 6px 24px rgba(31, 62, 57, 0.6));
            transform: scale(1.05);
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        .cta-section {
            padding: 60px 0 !important;
        }
        .cta-section h2 {
            font-size: 2rem !important;
        }
        .cta-section p {
            font-size: 1rem !important;
        }
    }
</style>

<style>
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-30px) rotate(5deg);
        }
    }

    @media (max-width: 768px) {
        .cta-section {
            padding: 50px 0 !important;
        }

        .cta-section > div > div > div {
            padding: 40px 20px !important;
        }

        .cta-section h2 {
            font-size: 2rem !important;
        }

        .cta-section p {
            font-size: 1rem !important;
        }

        .cta-section a {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .cta-section h2 {
            font-size: 1.75rem !important;
        }
    }
</style>
