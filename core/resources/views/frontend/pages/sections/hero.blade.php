<!-- Hero Section with Slider Background & Search Form -->
@php
    $sliders = App\Models\Slider::all();
    $categories = \App\Models\Backend\Category::where('status', 1)->get();
@endphp

<section class="hero-section">
    <!-- Background Slider -->
    <div class="hero-slider" id="heroSlider">
        @if($sliders->count() > 0)
            @foreach($sliders as $slide)
            <div class="hero-slide">
                <div class="hero-bg" style="background-image: url({{ asset('sliders/' . $slide->image) }});"></div>
                <div class="hero-overlay"></div>
            </div>
            @endforeach
        @else
            <!-- Fallback gradient if no sliders -->
            <div class="hero-slide active">
                <div class="hero-bg" style="background: linear-gradient(135deg, #FFA726 0%, #FB8C00 100%);"></div>
            </div>
        @endif
    </div>

    <!-- Hero Content (Fixed over slider) -->
    <div class="hero-content">
        <div class="container">
            <!-- Main Heading -->
            <h1 class="hero-title">
                {{ $sliders->first()->titre ?? __('Trouvez des objets d\'occasion') }}
            </h1>
            
            <!-- Subtitle -->
            <p class="hero-subtitle">
                {{ $sliders->first()->description ?? __('Explorez des milliers d\'annonces chaque semaine et dénichez des objets revendus par des vendeurs de confiance.') }}
            </p>
            
            <!-- Search Form -->
            <div class="hero-search-form">
                <form action="{{ route('frontend.home.search') }}" method="GET" class="search-form">
                    <!-- Category Filter -->
                    <div class="form-group category-group">
                        <div class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M3 7h18M3 12h18M3 17h18" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <select name="category" id="categorySelect" class="form-control">
                            <option value="">{{ __('Toutes catégories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Divider -->
                    <div class="form-divider"></div>
                    
                    <!-- Search Input -->
                    <div class="form-group search-group">
                        <div class="input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="8" stroke-width="2"/>
                                <path d="M21 21l-4.35-4.35" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="{{ __('Que recherchez-vous ?') }}"
                            autocomplete="off"
                        >
                    </div>
                    
                    <!-- Search Button -->
                    <button type="submit" class="btn-search">
                        {{ __('Rechercher') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Slider Navigation Arrows -->
    @if($sliders->count() > 1)
    <button class="hero-nav hero-prev" aria-label="Previous slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <button class="hero-nav hero-next" aria-label="Next slide">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    
    <!-- Slider Dots -->
    <div class="hero-dots">
        @foreach($sliders as $index => $slide)
        <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</section>

<style>
/* Hero Section - Design inspiré d'AdFox */
.hero-section {
    position: relative;
    width: 100%;
    min-height: 500px;
    height: 60vh;
    max-height: 600px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Background Slider */
.hero-slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1.2s ease-in-out;
}

.hero-slide.active {
    opacity: 1;
    visibility: visible;
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
    filter: brightness(0.85);
}

/* Frozen Glass Overlay */
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, 
        rgba(31, 62, 57, 0.75) 0%, 
        rgba(31, 62, 57, 0.65) 100%);
    backdrop-filter: blur(2px);
    z-index: 2;
}

/* Hero Content */
.hero-content {
    position: relative;
    z-index: 10;
    width: 100%;
    padding: 60px 20px;
    text-align: center;
}

.hero-content .container {
    max-width: 900px;
    margin: 0 auto;
}

/* Hero Title */
.hero-title {
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 16px 0;
    line-height: 1.2;
    text-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

/* Hero Subtitle */
.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.125rem);
    color: rgba(255, 255, 255, 0.95);
    margin: 0 0 40px 0;
    line-height: 1.6;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

/* Search Form Container */
.hero-search-form {
    max-width: 800px;
    margin: 0 auto;
}

.search-form {
    display: flex;
    align-items: stretch;
    background: #ffffff;
    border-radius: 50px;
    padding: 8px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    gap: 8px;
    flex-wrap: wrap;
}

/* Form Groups */
.form-group {
    position: relative;
    display: flex;
    align-items: center;
    flex: 1;
    min-width: 200px;
    transition: all 0.3s ease;
}

.form-group:hover {
    background: rgba(31, 62, 57, 0.02);
    border-radius: 50px;
}

.category-group {
    flex: 0 0 auto;
    min-width: 180px;
}

.search-group {
    flex: 1 1 auto;
    min-width: 250px;
}

/* Input Icon */
.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #95A5A6;
    display: flex;
    align-items: center;
    z-index: 1;
    pointer-events: none;
}

/* Form Controls */
.form-control {
    width: 100%;
    padding: 14px 16px 14px 48px;
    border: none;
    background: transparent;
    font-size: 15px;
    color: #2C3E50;
    outline: none;
    font-family: inherit;
}

.form-control::placeholder {
    color: #95A5A6;
}

.form-control:focus {
    color: #2C3E50;
}

/* Select Styling */
select.form-control {
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%2395A5A6' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
    border: none;
    outline: none;
}

select.form-control:focus {
    outline: none;
    border: none;
}

/* Style pour les options du select */
select.form-control option {
    padding: 10px;
    background: #ffffff;
    color: #2C3E50;
}

/* Divider */
.form-divider {
    width: 1px;
    height: 40px;
    background: #E0E0E0;
    flex-shrink: 0;
}

/* Search Button */
.btn-search {
    padding: 14px 40px;
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border: none;
    border-radius: 40px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(31, 62, 57, 0.3);
}

.btn-search:hover {
    background: linear-gradient(135deg, #2d5850 0%, #1F3E39 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(31, 62, 57, 0.4);
}

.btn-search:active {
    transform: translateY(0);
}

/* Navigation Arrows */
.hero-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(31, 62, 57, 0.8);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 12;
    opacity: 0;
    visibility: hidden;
}

.hero-section:hover .hero-nav {
    opacity: 1;
    visibility: visible;
}

.hero-prev {
    left: 20px;
}

.hero-next {
    right: 20px;
}

.hero-nav:hover {
    background: rgba(31, 62, 57, 1);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 20px rgba(31, 62, 57, 0.4);
}

.hero-nav:active {
    transform: translateY(-50%) scale(0.95);
}

.hero-nav svg {
    width: 24px;
    height: 24px;
}

/* Slider Dots */
.hero-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 11;
}

.hero-dot {
    width: 10px;
    height: 10px;
    background: rgba(255,255,255,0.5);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.hero-dot.active {
    background: #ffffff;
    width: 24px;
    border-radius: 5px;
}

.hero-dot:hover {
    background: rgba(255,255,255,0.8);
}

/* Responsive Design */
@media (max-width: 992px) {
    .search-form {
        flex-direction: column;
        padding: 12px;
        border-radius: 20px;
    }
    
    .form-group {
        width: 100%;
        min-width: auto;
    }
    
    .form-divider {
        display: none;
    }
    
    .btn-search {
        width: 100%;
        padding: 16px;
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 450px;
        height: auto;
    }
    
    .hero-content {
        padding: 40px 15px;
    }
    
    .hero-title {
        font-size: 1.75rem;
        margin-bottom: 12px;
    }
    
    .hero-subtitle {
        font-size: 0.95rem;
        margin-bottom: 30px;
    }
    
    .form-control {
        padding: 12px 12px 12px 40px;
        font-size: 14px;
    }
    
    .input-icon {
        left: 12px;
    }
    
    .input-icon svg {
        width: 18px;
        height: 18px;
    }
}

@media (max-width: 480px) {
    .hero-section {
        min-height: 400px;
    }
    
    .hero-title {
        font-size: 1.5rem;
    }
    
    .hero-subtitle {
        font-size: 0.875rem;
    }
    
    .search-form {
        padding: 10px;
    }
    
    .btn-search {
        padding: 14px;
        font-size: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;
    
    const slides = slider.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    let autoplayInterval;
    
    // Show specific slide
    function showSlide(index) {
        // Remove active class from all slides
        slides.forEach(slide => slide.classList.remove('active'));
        
        // Ensure index is within bounds
        if (index >= slides.length) currentSlide = 0;
        else if (index < 0) currentSlide = slides.length - 1;
        else currentSlide = index;
        
        // Add active class to current slide
        slides[currentSlide].classList.add('active');
        
        // Update dots
        if (dots.length > 0) {
            dots.forEach(dot => dot.classList.remove('active'));
            if (dots[currentSlide]) {
                dots[currentSlide].classList.add('active');
            }
        }
    }
    
    // Next slide
    function nextSlide() {
        showSlide(currentSlide + 1);
    }
    
    // Previous slide  
    function prevSlide() {
        showSlide(currentSlide - 1);
    }
    
    // Autoplay functionality
    function startAutoplay() {
        if (slides.length > 1) {
            autoplayInterval = setInterval(nextSlide, 6000);
        }
    }
    
    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
        }
    }
    
    // Dots navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            stopAutoplay();
            startAutoplay();
        });
    });
    
    // Arrow navigation
    const prevBtn = document.querySelector('.hero-prev');
    const nextBtn = document.querySelector('.hero-next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            showSlide(currentSlide - 1);
            stopAutoplay();
            startAutoplay();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            showSlide(currentSlide + 1);
            stopAutoplay();
            startAutoplay();
        });
    }
    
    // Pause autoplay when user interacts with form
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('mouseenter', stopAutoplay);
        searchForm.addEventListener('mouseleave', startAutoplay);
        
        // Pause on focus
        const formInputs = searchForm.querySelectorAll('input, select');
        formInputs.forEach(input => {
            input.addEventListener('focus', stopAutoplay);
            input.addEventListener('blur', () => {
                setTimeout(startAutoplay, 1000);
            });
        });
    }
    
    // Initialize
    showSlide(0);
    startAutoplay();
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', stopAutoplay);
});
</script>