<!-- Modern Hero Section -->
@php
    $sliders = App\Models\Slider::all();
@endphp

@if($sliders->count() > 0)
<section class="hero-section">
    <div class="hero-slider" id="heroSlider">
        @foreach($sliders as $slide)
        <div class="hero-slide" data-link="{{ $slide->link ?? '#' }}">
            <!-- Background Image with Overlay -->
            <div class="hero-bg" style="background-image: url({{ asset('sliders/' . $slide->image) }});"></div>
            <div class="hero-overlay"></div>
            
            <!-- Content -->
            <div class="hero-content">
                <div class="container">
                    <div class="hero-text">
                        @if($slide->titre)
                        <h1 class="hero-title" data-aos="fade-up">{{ $slide->titre }}</h1>
                        @endif
                        
                        @if($slide->description)
                        <p class="hero-description" data-aos="fade-up" data-aos-delay="100">{{ $slide->description }}</p>
                        @endif
                        
                        @if($slide->link)
                        <div class="hero-cta" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ $slide->link }}" class="btn-primary">
                                Découvrir
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        <!-- Navigation -->
        <div class="hero-nav">
            <button class="hero-arrow hero-prev" aria-label="Précédent">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="hero-arrow hero-next" aria-label="Suivant">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <!-- Dots Pagination -->
        <div class="hero-dots">
            @foreach($sliders as $index => $slide)
            <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Hero Section Styles */
.hero-section {
    position: relative;
    width: 100%;
    height: 60vh;
    min-height: 500px;
    max-height: 650px;
    overflow: hidden;
    background: #0a0a0a;
}

.hero-slider {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease, visibility 0.8s ease;
}

.hero-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 1;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transform: scale(1);
    transition: transform 8s ease;
}

.hero-slide.active .hero-bg {
    transform: scale(1.08);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
}

.hero-content .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero-text {
    max-width: 700px;
}

.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 20px 0;
    line-height: 1.2;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
}

.hero-description {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: rgba(255,255,255,0.9);
    margin: 0 0 30px 0;
    line-height: 1.6;
    text-shadow: 0 1px 10px rgba(0,0,0,0.3);
}

.hero-cta {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: #ffffff;
    color: #000000;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(255,255,255,0.2);
}

.btn-primary:hover {
    background: #f0f0f0;
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(255,255,255,0.3);
}

.btn-primary svg {
    transition: transform 0.3s ease;
}

.btn-primary:hover svg {
    transform: translateX(5px);
}

/* Navigation Arrows */
.hero-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 3;
    pointer-events: none;
}

.hero-arrow {
    pointer-events: all;
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #ffffff;
}

.hero-arrow:hover {
    background: rgba(255,255,255,0.2);
    transform: scale(1.1);
}

.hero-arrow:active {
    transform: scale(0.95);
}

/* Dots Pagination */
.hero-dots {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 3;
}

.hero-dot {
    width: 10px;
    height: 10px;
    background: rgba(255,255,255,0.4);
    border: 2px solid rgba(255,255,255,0.6);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.hero-dot.active,
.hero-dot:hover {
    background: #ffffff;
    width: 30px;
    border-radius: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        height: 50vh;
        min-height: 400px;
    }
    
    .hero-arrow {
        width: 40px;
        height: 40px;
    }
    
    .hero-nav {
        padding: 0 10px;
    }
    
    .hero-dots {
        bottom: 20px;
    }
}

@media (max-width: 480px) {
    .hero-section {
        height: 45vh;
        min-height: 350px;
    }
    
    .btn-primary {
        padding: 12px 24px;
        font-size: 14px;
    }
}

/* AOS Animation Support */
[data-aos] {
    opacity: 0;
    transition-property: opacity, transform;
}

[data-aos].aos-animate {
    opacity: 1;
}

[data-aos="fade-up"] {
    transform: translateY(30px);
}

[data-aos="fade-up"].aos-animate {
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;
    
    const slides = slider.querySelectorAll('.hero-slide');
    const dots = slider.querySelectorAll('.hero-dot');
    const prevBtn = slider.querySelector('.hero-prev');
    const nextBtn = slider.querySelector('.hero-next');
    
    let currentSlide = 0;
    let autoplayInterval;
    
    // Show slide
    function showSlide(index) {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        
        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;
        
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
        
        // Trigger AOS animations
        const activeSlide = slides[currentSlide];
        activeSlide.querySelectorAll('[data-aos]').forEach(el => {
            el.classList.remove('aos-animate');
            setTimeout(() => el.classList.add('aos-animate'), 100);
        });
    }
    
    // Next slide
    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) currentSlide = 0;
        showSlide(currentSlide);
    }
    
    // Previous slide
    function prevSlide() {
        currentSlide--;
        if (currentSlide < 0) currentSlide = slides.length - 1;
        showSlide(currentSlide);
    }
    
    // Autoplay
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', () => {
        nextSlide();
        stopAutoplay();
        startAutoplay();
    });
    
    if (prevBtn) prevBtn.addEventListener('click', () => {
        prevSlide();
        stopAutoplay();
        startAutoplay();
    });
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
            stopAutoplay();
            startAutoplay();
        });
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
    });
    
    // Pause on hover
    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);
    
    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) nextSlide();
        if (touchEndX > touchStartX + 50) prevSlide();
    }
    
    // Initialize
    showSlide(currentSlide);
    startAutoplay();
});
</script>
@endif