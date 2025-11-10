<!-- Call To Action Section with Neo-Glassmorphism -->
<div class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%); position: relative; overflow: hidden;">
    <!-- Background animated elements -->
    <div style="position: absolute; top: -50%; right: -50%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(147, 189, 147, 0.15) 0%, transparent 70%); border-radius: 50%; animation: float 8s ease-in-out infinite;"></div>
    <div style="position: absolute; bottom: -50%; left: -50%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(93, 189, 213, 0.15) 0%, transparent 70%); border-radius: 50%; animation: float 10s ease-in-out infinite 2s;"></div>

    <div class="container-1440">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div style="
                    background: rgba(255, 255, 255, 0.08);
                    backdrop-filter: blur(15px);
                    border-radius: 20px;
                    padding: 60px 40px;
                    border: 1px solid rgba(255, 255, 255, 0.15);
                    text-align: center;
                    position: relative;
                    z-index: 1;
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                " onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(255, 255, 255, 0.25)'; this.style.boxShadow='0 16px 48px rgba(0, 0, 0, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.2)'">
                    
                    <!-- Icon -->
                    <div style="font-size: 64px; margin-bottom: 20px; color: #93bd93;">
                        <i class="las la-rocket"></i>
                    </div>

                    <!-- Title -->
                    <h2 style="
                        color: #ffffff;
                        font-size: 2.5rem;
                        font-weight: 700;
                        margin-bottom: 16px;
                        letter-spacing: -0.5px;
                    ">
                        {{ __('Prêt à commencer ?') }}
                    </h2>

                    <!-- Subtitle -->
                    <p style="
                        color: #b0b0b0;
                        font-size: 1.1rem;
                        margin-bottom: 32px;
                        line-height: 1.6;
                    ">
                        {{ __('Créez votre compte et commencez à publier vos annonces dès maintenant. C\'est gratuit et facile.') }}
                    </p>

                    <!-- CTA Buttons -->
                    <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                        <!-- Create Account Button -->
                        <a href="{{ route('user.register') }}" 
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 14px 40px;
                               background: linear-gradient(135deg, #93bd93, #7da97d);
                               color: white;
                               text-decoration: none;
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 16px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               box-shadow: 0 4px 12px rgba(147, 189, 147, 0.3);
                           "
                           onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(147, 189, 147, 0.5)'"
                           onmouseout="this.style.background='linear-gradient(135deg, #93bd93, #7da97d)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(147, 189, 147, 0.3)'">
                            <i class="las la-user-plus"></i>
                            <span>{{ __('Créer un compte') }}</span>
                        </a>

                        <!-- Browse Listings Button -->
                        <a href="{{ route('frontend.home.search') }}" 
                           style="
                               display: inline-flex;
                               align-items: center;
                               gap: 10px;
                               padding: 14px 40px;
                               background: rgba(255, 255, 255, 0.1);
                               color: white;
                               text-decoration: none;
                               border: 2px solid rgba(147, 189, 147, 0.5);
                               border-radius: 50px;
                               font-weight: 600;
                               font-size: 16px;
                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                           "
                           onmouseover="this.style.background='rgba(147, 189, 147, 0.15)'; this.style.borderColor='rgba(147, 189, 147, 0.8)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.transform='translateY(0)'">
                            <i class="las la-list"></i>
                            <span>{{ __('Parcourir les annonces') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
