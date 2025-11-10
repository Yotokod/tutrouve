@props(['title', 'subtitle' => null, 'sectionBg' => 'linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%)', 'showExploreButton' => false, 'exploreText' => null, 'exploreUrl' => null])

<div class="section-header-modern" style="
    padding: 0 0 40px;
    margin-bottom: 40px;
">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div class="section-title-wrapper">
            <h2 class="section-title-modern" style="
                color: #ffffff;
                margin-bottom: 12px;
                font-size: 2.5rem;
                font-weight: 700;
                letter-spacing: -0.5px;
            ">
                {{ $title }}
            </h2>
            <div style="
                width: 60px;
                height: 4px;
                background: linear-gradient(90deg, #93bd93, #a8cca8);
                border-radius: 2px;
            "></div>
            @if($subtitle)
                <p style="color: #b0b0b0; font-size: 1rem; margin-top: 12px; margin-bottom: 0;">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        @if($showExploreButton && $exploreUrl)
            <a href="{{ $exploreUrl }}" 
               class="btn-explore-modern" 
               style="
                   display: inline-flex;
                   align-items: center;
                   gap: 8px;
                   padding: 12px 28px;
                   background: #1F3E39;
                   color: white;
                   border: none;
                   border-radius: 50px;
                   font-weight: 600;
                   font-size: 15px;
                   cursor: pointer;
                   text-decoration: none;
                   box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                   transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
               "
               onmouseover="this.style.background='#2a534d'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.12)'"
               onmouseout="this.style.background='#1F3E39'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'">
                <span>{{ $exploreText ?? __('Explorer tous') }}</span>
                <i class="las la-arrow-right"></i>
            </a>
        @endif
    </div>
</div>

<style>
    @media (max-width: 991px) {
        .section-header-modern {
            flex-direction: column;
            align-items: flex-start !important;
        }
    }

    @media (max-width: 768px) {
        .section-title-modern {
            font-size: 2rem !important;
        }
    }

    @media (max-width: 576px) {
        .section-title-modern {
            font-size: 1.75rem !important;
        }
    }
</style>
