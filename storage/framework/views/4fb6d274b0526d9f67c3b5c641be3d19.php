<style>
/* Namespace pour éviter les conflits - Préfixe tutslider */
.tutslider-wrapper {
    position: relative;
    width: 100%;
    margin: 0;
    padding: 0;
}

.tutslider, 
.tutslider > div {
    background-position: center center;
    display: block;
    width: 100%;
    height: 500px;
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: #1F3E39;
    overflow: hidden;
    transition: transform 0.4s ease;
}

.tutslider {
    border-radius: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.tutslider > div {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

/* Overlay gradient pour meilleur contraste */
.tutslider > div::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(31, 62, 57, 0.6) 0%, rgba(147, 189, 147, 0.3) 100%);
    z-index: 1;
    transition: opacity 0.5s ease;
}

.tutslider:hover > div::before {
    opacity: 0.8;
}

.tutslider:hover > div {
    transform: scale(1.03);
}

.tutslider.tutslider-no-zoom:hover > div {
    transform: scale(1);
}

/* Flèches de navigation modernisées */
.tutslider > i {
    color: #ffffff;
    position: absolute;
    font-size: 24px;
    top: 50%;
    transform: translateY(-50%);
    text-shadow: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    width: 50px;
    height: 50px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    cursor: pointer;
    border-radius: 50%;
    z-index: 10;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.tutslider > i svg {
    width: 20px;
    height: 20px;
    fill: #ffffff;
    margin: 0;
    transition: transform 0.3s ease;
}

.tutslider > i.tutslider-left {
    left: -80px;
}

.tutslider > i.tutslider-right {
    right: -80px;
}

.tutslider:hover > i.tutslider-left {
    left: 20px;
    animation: tutsliderSlideInLeft 0.5s ease;
}

.tutslider:hover > i.tutslider-right {
    right: 20px;
    animation: tutsliderSlideInRight 0.5s ease;
}

.tutslider > i:hover {
    background: #93bd93;
    border-color: #93bd93;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 8px 20px rgba(147, 189, 147, 0.4);
}

.tutslider > i.tutslider-left:hover svg {
    transform: translateX(-3px);
}

.tutslider > i.tutslider-right:hover svg {
    transform: translateX(3px);
}

.tutslider > i:active {
    transform: translateY(-50%) scale(0.95);
}

/* Indicateurs (dots) modernisés */
.tutslider > ul {
    position: absolute;
    bottom: 30px;
    left: 50%;
    z-index: 10;
    padding: 0;
    margin: 0;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 12px 20px;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    list-style: none;
}

.tutslider > ul > li {
    padding: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    list-style: none;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.4);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    margin: 0;
    float: none;
}

.tutslider > ul > li.tutslider-active {
    background-color: #93bd93;
    box-shadow: 0 0 12px rgba(147, 189, 147, 0.6);
    animation: tutsliderDotPulse 0.6s ease;
    width: 32px;
    border-radius: 10px;
}

.tutslider > ul > li:hover {
    background-color: #93bd93;
    transform: scale(1.2);
}

/* Zone de texte avec effet glassmorphism (frozen/frosted glass) */
.tutslider > div .tutslider-textbox {
    display: block;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px) saturate(150%);
    -webkit-backdrop-filter: blur(8px) saturate(150%);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);
    color: #ffffff;
    font-family: "Inter Tight", -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    padding: 40px 50px;
    max-width: 600px;
    width: 90%;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 
                inset 0 0 0 1px rgba(255, 255, 255, 0.3);
    z-index: 5;
    opacity: 0;
    animation: tutsliderFadeInScale 0.8s ease forwards 0.3s;
    border: 1px solid rgba(255, 255, 255, 0.25);
}

.tutslider > div .tutslider-textbox h3 {
    color: #ffffff;
    font-family: "Inter Tight", -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    line-height: 1.2;
    display: block;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
    padding-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.tutslider > div .tutslider-textbox h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #93bd93, rgba(255, 255, 255, 0.5));
    border-radius: 2px;
    animation: tutsliderExpandWidth 0.8s ease forwards 1s;
}

.tutslider > div .tutslider-textbox p {
    color: rgba(255, 255, 255, 0.95);
    font-family: "Inter Tight", -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
}

/* Animation au survol de la textbox */
.tutslider:hover > div .tutslider-textbox {
    transform: translate(-50%, -50%) scale(1);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4),
                inset 0 0 0 1px rgba(255, 255, 255, 0.4);
}

/* Indicateur de clic pour les slides cliquables */
.tutslider > div[onclick] {
    cursor: pointer;
}

.tutslider > div[onclick]::after {
    content: '→';
    position: absolute;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: #93bd93;
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    opacity: 0;
    transform: scale(0.5);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 6;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.tutslider:hover > div[onclick]::after {
    opacity: 1;
    transform: scale(1);
    animation: tutsliderBounce 1s ease infinite;
}

/* Classes utilitaires */
.tutslider.tutslider-hide-dots > ul {
    display: none;
}

.tutslider.tutslider-show-arrows > i.tutslider-left {
    left: 20px;
}

.tutslider.tutslider-show-arrows > i.tutslider-right {
    right: 20px;
}

/* Animations */
@keyframes tutsliderFadeInScale {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.9);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

@keyframes tutsliderDotPulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
}

@keyframes tutsliderExpandWidth {
    from {
        width: 0;
    }
    to {
        width: 60px;
    }
}

@keyframes tutsliderSlideInLeft {
    from {
        left: -80px;
        opacity: 0;
    }
    to {
        left: 20px;
        opacity: 1;
    }
}

@keyframes tutsliderSlideInRight {
    from {
        right: -80px;
        opacity: 0;
    }
    to {
        right: 20px;
        opacity: 1;
    }
}

@keyframes tutsliderBounce {
    0%, 100% {
        transform: scale(1) translateY(0);
    }
    50% {
        transform: scale(1.1) translateY(-5px);
    }
}

/* Effet de particules subtil (optionnel) */
.tutslider::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(147, 189, 147, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(31, 62, 57, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: 2;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.tutslider:hover::before {
    opacity: 1;
}

/* Badge pour indiquer qu'un slide est cliquable */
.tutslider > div[onclick] .tutslider-textbox::before {
    content: 'Cliquez pour en savoir plus';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: #93bd93;
    color: #ffffff;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    opacity: 0;
    transition: all 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(147, 189, 147, 0.3);
}

.tutslider:hover > div[onclick] .tutslider-textbox::before {
    opacity: 1;
    bottom: -25px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .tutslider,
    .tutslider > div {
        height: 400px;
    }

    .tutslider > div .tutslider-textbox {
        padding: 30px 35px;
        max-width: 500px;
    }

    .tutslider > div .tutslider-textbox h3 {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .tutslider,
    .tutslider > div {
        height: 350px;
    }

    .tutslider > div .tutslider-textbox {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 25px 30px;
        max-width: 85%;
        text-align: center;
    }

    .tutslider > div .tutslider-textbox h3 {
        font-size: 1.5rem;
        padding-bottom: 12px;
        white-space: normal;
    }

    .tutslider > div .tutslider-textbox h3::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .tutslider > div .tutslider-textbox p {
        font-size: 0.9rem;
    }

    .tutslider > i {
        width: 45px;
        height: 45px;
        font-size: 20px;
    }

    .tutslider:hover > i.tutslider-left {
        left: 15px;
    }

    .tutslider:hover > i.tutslider-right {
        right: 15px;
    }

    .tutslider > ul {
        bottom: 20px;
        padding: 10px 16px;
        gap: 10px;
    }

    .tutslider > ul > li.tutslider-active {
        width: 28px;
    }

    .tutslider > div[onclick]::after {
        width: 45px;
        height: 45px;
        font-size: 20px;
        bottom: 20px;
        right: 20px;
    }
}

@media (max-width: 576px) {
    .tutslider,
    .tutslider > div {
        height: 300px;
    }

    .tutslider > div .tutslider-textbox {
        padding: 20px 25px;
        max-width: 90%;
    }

    .tutslider > div .tutslider-textbox h3 {
        font-size: 1.25rem;
        margin-bottom: 12px;
    }

    .tutslider > div .tutslider-textbox p {
        font-size: 0.85rem;
        -webkit-line-clamp: 2;
    }

    .tutslider > i {
        width: 40px;
        height: 40px;
    }

    .tutslider > ul {
        padding: 8px 14px;
    }

    .tutslider > ul > li {
        width: 10px;
        height: 10px;
    }

    .tutslider > ul > li.tutslider-active {
        width: 24px;
    }
}

/* Amélioration de l'accessibilité */
.tutslider > i:focus,
.tutslider > ul > li:focus {
    outline: 3px solid #93bd93;
    outline-offset: 3px;
}
</style>

<div class="tutslider-wrapper">
    <div class="tutslider" id="tutslider3">
        <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="background-image:url(https://www.tutrouve.com/core/public/sliders/<?php echo e($slide->image); ?>); cursor:pointer;" 
             <?php if($slide->link): ?> onclick="window.location.href='<?php echo e($slide->link); ?>'" <?php endif; ?>>
            <?php if($slide->titre || $slide->description): ?> 
            <span class="tutslider-textbox">
                <h3><?php echo e($slide->titre); ?></h3>
                <p><?php echo e($slide->description); ?></p>
            </span>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <!-- Flèches de navigation -->
        <i class="tutslider-left tutslider-arrows">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z"></path>
            </svg>
        </i>
        <i class="tutslider-right tutslider-arrows">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180)"></path>
            </svg>
        </i>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    // Namespace pour éviter les conflits
    const TutrouveSlider = {
        slider: null,
        slides: [],
        currentIndex: 0,
        interval: null,
        autoPlayDelay: 5000,

        init: function() {
            this.slider = document.getElementById('tutslider3');
            if (!this.slider) return;

            this.slides = Array.from(this.slider.querySelectorAll('div[style*="background-image"]'));
            if (this.slides.length === 0) return;

            this.setupDots();
            this.setupArrows();
            this.setupAutoPlay();
            this.setupKeyboard();
            this.showSlide(0);
        },

        setupDots: function() {
            if (this.slides.length <= 1) return;

            const ul = document.createElement('ul');
            this.slides.forEach((_, index) => {
                const li = document.createElement('li');
                if (index === 0) li.classList.add('tutslider-active');
                li.addEventListener('click', () => this.goToSlide(index));
                li.setAttribute('tabindex', '0');
                li.setAttribute('role', 'button');
                li.setAttribute('aria-label', `Aller au slide ${index + 1}`);
                ul.appendChild(li);
            });
            this.slider.appendChild(ul);
        },

        setupArrows: function() {
            const leftArrow = this.slider.querySelector('.tutslider-left');
            const rightArrow = this.slider.querySelector('.tutslider-right');

            if (leftArrow) {
                leftArrow.addEventListener('click', () => this.prevSlide());
                leftArrow.setAttribute('tabindex', '0');
                leftArrow.setAttribute('role', 'button');
                leftArrow.setAttribute('aria-label', 'Slide précédent');
            }

            if (rightArrow) {
                rightArrow.addEventListener('click', () => this.nextSlide());
                rightArrow.setAttribute('tabindex', '0');
                rightArrow.setAttribute('role', 'button');
                rightArrow.setAttribute('aria-label', 'Slide suivant');
            }
        },

        setupAutoPlay: function() {
            this.startAutoPlay();
            
            this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
            this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
        },

        setupKeyboard: function() {
            const controls = this.slider.querySelectorAll('.tutslider-arrows, ul > li');
            controls.forEach(control => {
                control.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        control.click();
                    }
                });
            });

            document.addEventListener('keydown', (e) => {
                if (!this.isSliderInView()) return;
                
                if (e.key === 'ArrowLeft') {
                    this.prevSlide();
                } else if (e.key === 'ArrowRight') {
                    this.nextSlide();
                }
            });
        },

        isSliderInView: function() {
            const rect = this.slider.getBoundingClientRect();
            return rect.top < window.innerHeight && rect.bottom > 0;
        },

        showSlide: function(index) {
            this.slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
                slide.style.zIndex = i === index ? '3' : '1';
            });

            const dots = this.slider.querySelectorAll('ul > li');
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('tutslider-active');
                } else {
                    dot.classList.remove('tutslider-active');
                }
            });

            this.currentIndex = index;
        },

        goToSlide: function(index) {
            this.showSlide(index);
            this.resetAutoPlay();
        },

        nextSlide: function() {
            const nextIndex = (this.currentIndex + 1) % this.slides.length;
            this.goToSlide(nextIndex);
        },

        prevSlide: function() {
            const prevIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            this.goToSlide(prevIndex);
        },

        startAutoPlay: function() {
            if (this.slides.length <= 1) return;
            this.interval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
        },

        stopAutoPlay: function() {
            clearInterval(this.interval);
        },

        resetAutoPlay: function() {
            this.stopAutoPlay();
            this.startAutoPlay();
        }
    };

    // Initialisation au chargement du DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            TutrouveSlider.init();
        });
    } else {
        TutrouveSlider.init();
    }
})();
</script><?php /**PATH /home/tutreqhl/public_html/core/app/Providers/../../plugins/PageBuilder/views/headers/style-one.blade.php ENDPATH**/ ?>