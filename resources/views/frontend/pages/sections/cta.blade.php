<!-- Call To Action Section with Enhanced Neo-Glassmorphism and Stats -->
<div class="cta-section" style="padding: 100px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%); position: relative; overflow: hidden;">
    <!-- Background animated elements -->
    <div style="position: absolute; top: -50%; right: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(147, 189, 147, 0.2) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -50%; left: -20%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(93, 189, 213, 0.15) 0%, transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite 2s;"></div>
    <div style="position: absolute; top: 20%; right: 10%; width: 200px; height: 200px; background: radial-gradient(circle, rgba(255, 184, 0, 0.1) 0%, transparent 70%); border-radius: 50%; animation: float 6s ease-in-out infinite 1s;"></div>

    <div class="container-1440">
        <!-- Stats Row -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="row g-4 text-center" style="position: relative; z-index: 2;">
                    <div class="col-md-4">
                        <div style="padding: 30px 20px; background: rgba(255, 255, 255, 0.06); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: #93bd93; margin-bottom: 8px;">{{ $topListings->count() ?? 0 }}+</div>
                            <div style="color: #b0b0b0; font-size: 14px;">{{ __('Annonces actives') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding: 30px 20px; background: rgba(255, 255, 255, 0.06); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: #93bd93; margin-bottom: 8px;">{{ $categories->count() ?? 0 }}+</div>
                            <div style="color: #b0b0b0; font-size: 14px;">{{ __('Catégories') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding: 30px 20px; background: rgba(255, 255, 255, 0.06); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: #93bd93; margin-bottom: 8px;">1000+</div>
                            <div style="color: #b0b0b0; font-size: 14px;">{{ __('Utilisateurs actifs') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main CTA Card -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div style="
                    background: linear-gradient(135deg, rgba(147, 189, 147, 0.15) 0%, rgba(255, 255, 255, 0.08) 100%);
                    backdrop-filter: blur(20px);
                    border-radius: 24px;
                    padding: 60px 40px;
                    border: 1px solid rgba(147, 189, 147, 0.3);
                    text-align: center;
                    position: relative;
                    z-index: 1;
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                    animation: fadeInScale 0.8s ease-out;
                " onmouseover="this.style.transform='translateY(-8px) scale(1.01)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.boxShadow='0 20px 60px rgba(147, 189, 147, 0.3)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.2)'">
                    
                    <!-- Icon with Glow Effect -->
                    <div style="font-size: 72px; margin-bottom: 24px; color: #93bd93; filter: drop-shadow(0 4px 12px rgba(147, 189, 147, 0.5)); animation: pulse-glow 2s ease-in-out infinite;">
                        <i class="las la-rocket"></i>
                    </div>

                    <!-- Title -->
                    <h2 style="
                        color: #ffffff;
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
                        color: #d0d0d0;
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
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 16px 48px;
                               background: linear-gradient(135deg, #93bd93, #7da97d);
                               color: white;
                               text-decoration: none;
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 17px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               box-shadow: 0 6px 20px rgba(147, 189, 147, 0.4);
                               position: relative;
                               overflow: hidden;
                           "
                           onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 32px rgba(147, 189, 147, 0.6)'"
                           onmouseout="this.style.background='linear-gradient(135deg, #93bd93, #7da97d)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 20px rgba(147, 189, 147, 0.4)'">
                            <i class="las la-user-plus" style="font-size: 20px;"></i>
                            <span>{{ __('Créer un compte gratuit') }}</span>
                        </a>

                        <!-- Browse Listings Button -->
                        <a href="{{ route('frontend.home.search') }}" 
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 16px 48px;
                               background: rgba(255, 255, 255, 0.12);
                               color: white;
                               text-decoration: none;
                               border: 2px solid rgba(147, 189, 147, 0.5);
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 17px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               backdrop-filter: blur(10px);
                           "
                           onmouseover="this.style.background='rgba(147, 189, 147, 0.2)'; this.style.borderColor='rgba(147, 189, 147, 0.8)'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 6px 20px rgba(147, 189, 147, 0.3)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.12)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="las la-search" style="font-size: 20px;"></i>
                            <span>{{ __('Explorer les annonces') }}</span>
                        </a>
                    </div>

                    <!-- Features Row -->
                    <div style="display: flex; gap: 32px; justify-content: center; margin-top: 40px; padding-top: 40px; border-top: 1px solid rgba(255, 255, 255, 0.1); flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 8px; color: #d0d0d0; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #93bd93; font-size: 20px;"></i>
                            <span>{{ __('100% Gratuit') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #d0d0d0; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #93bd93; font-size: 20px;"></i>
                            <span>{{ __('Inscription rapide') }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #d0d0d0; font-size: 14px;">
                            <i class="las la-check-circle" style="color: #93bd93; font-size: 20px;"></i>
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
            filter: drop-shadow(0 4px 12px rgba(147, 189, 147, 0.5));
            transform: scale(1);
        }
        50% {
            filter: drop-shadow(0 4px 20px rgba(147, 189, 147, 0.8));
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
