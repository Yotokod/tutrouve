@props(['category'])

<a href="{{ route('frontend.show.listing.by.category', $category->slug) }}" 
   class="category-card-glass"
   style="
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       padding: 40px 20px;
       background: rgba(147, 189, 147, 0.1);
       backdrop-filter: blur(10px);
       border-radius: 16px;
       border: 1px solid rgba(147, 189, 147, 0.3);
       text-decoration: none;
       transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
       min-height: 200px;
       cursor: pointer;
       position: relative;
       overflow: hidden;
   "
   onmouseover="this.style.background='rgba(147, 189, 147, 0.2)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'; this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 16px 48px rgba(147, 189, 147, 0.2)'"
   onmouseout="this.style.background='rgba(147, 189, 147, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.3)'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'">
    
    <!-- Background Animation Element -->
    <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(147, 189, 147, 0.3) 0%, transparent 70%); animation: float 6s ease-in-out infinite;"></div>

    <!-- Category Icon -->
    @if(!empty($category->icon))
        <div style="font-size: 48px; margin-bottom: 16px; color: #93bd93; z-index: 1; position: relative;">
            {!! $category->icon !!}
        </div>
    @else
        <i class="las la-folder" style="font-size: 48px; margin-bottom: 16px; color: #93bd93; z-index: 1;"></i>
    @endif

    <!-- Category Name -->
    <h3 style="
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        text-align: center;
        z-index: 1;
        position: relative;
    ">
        {{ $category->name }}
    </h3>

    <!-- Item Count -->
    <p style="
        color: #b0b0b0;
        font-size: 14px;
        margin: 8px 0 0 0;
        z-index: 1;
        position: relative;
    ">
        {{ $category->listings_count ?? 0 }} {{ __('annonces') }}
    </p>
</a>

<style>
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(2deg);
        }
    }

    .category-card-glass {
        animation: slideInUp 0.6s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
