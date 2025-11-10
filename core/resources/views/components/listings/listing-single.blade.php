@if($listings->count() >0)
    <div class="row g-4">
        @foreach($listings as $listing)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="listing-card-glass" style="
                    background: rgba(255, 255, 255, 0.08);
                    backdrop-filter: blur(10px);
                    border-radius: 16px;
                    overflow: hidden;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.15);
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    cursor: pointer;
                " onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 16px 48px rgba(0, 0, 0, 0.2)'; this.style.borderColor='rgba(255, 255, 255, 0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'; this.style.borderColor='rgba(255, 255, 255, 0.15)'">
                    
                    <!-- Image Container -->
                    <div style="position: relative; overflow: hidden; height: 200px; background: linear-gradient(135deg, #2a3f4a, #1f2d35); flex-shrink: 0;">
                        <a href="{{ route('frontend.listing.details', $listing->slug) }}" style="display: block; height: 100%; position: relative;">
                            {!! render_image_markup_by_attachment_id($listing->image, '', '', 'thumb') !!}
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.4) 100%); opacity: 0; transition: opacity 0.3s ease;" class="image-overlay"></div>
                        </a>

                        <!-- Featured Badge -->
                        @if($listing->is_featured == 1)
                            <div style="
                                position: absolute;
                                top: 12px;
                                left: 12px;
                                display: flex;
                                align-items: center;
                                gap: 6px;
                                padding: 6px 14px;
                                background: linear-gradient(135deg, #FFB800, #FF8C00);
                                color: white;
                                border-radius: 20px;
                                font-size: 12px;
                                font-weight: 600;
                                box-shadow: 0 4px 12px rgba(255, 184, 0, 0.4);
                                z-index: 2;
                                animation: pulse 2s ease-in-out infinite;
                            ">
                                <svg width="12" height="14" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 0V3.88889H7L3 10V6.11111H0L4 0Z" fill="currentColor"/>
                                </svg>
                                <span>{{ __('En vedette') }}</span>
                            </div>
                        @endif

                        <!-- Favorite Button -->
                        <div style="position: absolute; top: 12px; right: 12px; z-index: 2; opacity: 0; transform: scale(0.8); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);" class="favorite-btn-wrapper">
                            <x-listings.favorite-item-add-remove :favorite="$listing->id ?? 0" />
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div style="padding: 20px; display: flex; flex-direction: column; flex: 1; color: #ffffff;">
                        <!-- Price and Date Meta -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
                            <span style="font-size: 1.5rem; font-weight: 700; color: #93bd93; letter-spacing: -0.5px;">
                                {{ amount_with_currency_symbol($listing->price) }}
                            </span>
                            @if(!empty($listing->published_at))
                                <span style="display: flex; align-items: center; gap: 4px; font-size: 13px; color: #b0b0b0;">
                                    <i class="las la-clock"></i>
                                    {{ \Carbon\Carbon::parse($listing->published_at)->diffForHumans() }}
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h3 style="margin: 0 0 12px 0; font-size: 1.1rem; font-weight: 600; line-height: 1.4; min-height: 50px;">
                            <a href="{{ route('frontend.listing.details', $listing->slug) }}" style="color: #ffffff; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s ease;">
                                {{ $listing->title }}
                            </a>
                        </h3>

                        <!-- Location -->
                        <div style="margin-bottom: 16px; color: #b0b0b0; font-size: 14px; display: flex; align-items: center; gap: 6px; min-height: 22px; overflow: hidden; text-overflow: ellipsis;">
                            <i class="las la-map-marker" style="color: #93bd93;"></i>
                            <x-listings.listing-location :listing="$listing"/>
                        </div>

                        <!-- View Details Button -->
                        <a href="{{ route('frontend.listing.details', $listing->slug) }}" 
                           style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; background: linear-gradient(135deg, #93bd93, #7da97d); color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); margin-top: auto; width: 100%;"
                           onmouseover="this.style.background='linear-gradient(135deg, #7da97d, #6b9769)'; this.style.transform='translateX(4px)'; this.style.boxShadow='0 4px 12px rgba(147, 189, 147, 0.4)'"
                           onmouseout="this.style.background='linear-gradient(135deg, #93bd93, #7da97d)'; this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                            <span>{{ __('Voir') }}</span>
                            <i class="las la-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div style="
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 60px 20px;
        text-align: center;
        color: #b0b0b0;
    ">
        <i class="las la-inbox" style="font-size: 48px; margin-bottom: 20px; color: #93bd93;"></i>
        <p style="font-size: 18px; margin: 0;">{{ __('Aucune annonce disponible pour le moment') }}</p>
    </div>
@endif

<style>
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .listing-card-glass:hover .image-overlay {
        opacity: 1;
    }

    .listing-card-glass:hover .favorite-btn-wrapper {
        opacity: 1 !important;
        transform: scale(1) !important;
    }

    .listing-card-glass a:hover {
        color: #93bd93;
    }
</style>
