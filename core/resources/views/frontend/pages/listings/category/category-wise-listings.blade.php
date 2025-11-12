@extends('frontend.layout.master')
@section('site-title')
    @if($category !='')
        {{ $category->name }}
    @endif
@endsection
@section('page-title')
    @if($category !='')
        {{ $category->name }}
    @endif
@endsection
@section('inner-title')
    @if($category !='')
        {{ $category->name }}
    @endif
@endsection
@section('page-meta-data')
    {!!  render_page_meta_data_for_category($category) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/category-listings-modern.css') }}">
@endsection
@section('content')
<div class="category-wise-listing-modern"
    <!-- Page Header -->
    <div class="page-header-category">
        <div class="container-1440">
            <!-- Breadcrumb -->
            <nav class="breadcrumb-modern">
                <a href="{{ route('homepage') }}">{{ __('Accueil') }}</a>
                <i class="las la-angle-right"></i>
                <span>{{ $category->name }}</span>
            </nav>

            <!-- Category Title -->
            <h1 class="category-title">{{ $category->name }}</h1>
            <div class="title-divider"></div>

            <!-- Category Description -->
            @if(!is_null($category->description))
                <div class="category-description">
                    {!! $category->description !!}
                </div>
            @endif
        </div>
    </div>

    <div class="container-1440">
        <x-validation.frontend-error/>

        <!-- Layout avec Sidebar + Listings -->
        <div class="listings-layout">
            <!-- Sidebar Filtres -->
            <aside class="listings-sidebar">
                <!-- Mobile Toggle -->
                <button class="filter-toggle" id="filterToggle">
                    <i class="las la-filter"></i>
                    <span>{{ __('Filtres') }}</span>
                </button>

                <div class="sidebar-content" id="sidebarContent">
                    <!-- Header Sidebar -->
                    <div class="sidebar-header">
                        <h3>{{ __('Filtrer par') }}</h3>
                        <button class="sidebar-close" id="sidebarClose">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <!-- Sous-catégories Filter -->
                    @if($subcategory_under_category->count() > 0)
                    <div class="filter-group">
                        <div class="filter-group-header">
                            <i class="las la-folder-open"></i>
                            <h4>{{ __('Sous-catégories') }}</h4>
                        </div>
                        <div class="filter-group-content">
                            <div id="subcategory_list">
                                @foreach($subcategory_under_category->take(10) as $sub_cat)
                                <a href="{{ route('frontend.show.listing.by.subcategory', $sub_cat->slug ?? 'x') }}" class="filter-item">
                                    <span class="filter-name">{{ $sub_cat->name }}</span>
                                    <span class="filter-count">{{ $sub_cat->total_listings ?? 0 }}</span>
                                </a>
                                @endforeach
                            </div>
                            @if($subcategory_under_category->count() > 10)
                            <button class="show-more-btn" id="loadMoreSubcategories" data-total="10" data-category="{{ $category->id }}">
                                {{ __('Voir plus') }} <i class="las la-angle-down"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Autres filtres peuvent être ajoutés ici -->
                </div>
            </aside>

            <!-- Main Content - Listings -->
            <main class="listings-main">
                <!-- Header avec compteur -->
                <div class="listings-header">
                    <div>
                        <h2 class="listings-count">
                            <span class="count-number">{{ $all_listings->total() ?? 0 }}</span>
                            {{ __('annonces disponibles') }}
                        </h2>
                    </div>
                </div>

                <!-- Grille d'annonces -->

                <div class="row g-4">
                    @forelse($all_listings as $listing)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
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
                            " onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 16px 48px rgba(0, 0, 0, 0.2)'; this.style.borderColor='rgba(255, 255, 255, 0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)'; this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                                <!-- Image Container -->
                                <div style="position: relative; overflow: hidden; height: 200px; background: linear-gradient(135deg, #2a3f4a, #1f2d35); flex-shrink: 0;">
                                    <a href="{{ route('frontend.listing.details', $listing->slug) }}" style="display: block; height: 100%; position: relative;">
                                        {!! render_image_markup_by_attachment_id($listing->image, '', '', 'thumb') !!}
                                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.4) 100%); opacity: 0; transition: opacity 0.3s ease;" class="image-overlay"></div>
                                    </a>
                                    <!-- New Badge -->
                                    <div style="
                                        position: absolute;
                                        top: 12px;
                                        left: 12px;
                                        display: flex;
                                        align-items: center;
                                        gap: 6px;
                                        padding: 6px 14px;
                                        background: linear-gradient(135deg, #5b9bd5, #4a88c2);
                                        color: white;
                                        border-radius: 20px;
                                        font-size: 12px;
                                        font-weight: 600;
                                        box-shadow: 0 4px 12px rgba(91, 155, 213, 0.4);
                                        z-index: 2;
                                    ">
                                        <i class="las la-star"></i>
                                        <span>{{ __('Nouveau') }}</span>
                                    </div>
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
                    @empty
                        <div class="col-12">
                            <div style="
                                background: rgba(255, 255, 255, 0.05);
                                backdrop-filter: blur(10px);
                                border: 1px solid rgba(255, 255, 255, 0.15);
                                border-radius: 16px;
                                padding: 60px 20px;
                                text-align: center;
                                color: #b0b0b0;
                            ">
                                <p style="font-size: 18px; margin: 0;">{{ __('Aucune annonce disponible pour le moment') }}</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($all_listings->hasPages())
                <div class="listings-pagination">
                    {{ $all_listings->links() }}
                </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/category-listings-modern.js') }}"></script>
    <script>
        (function($){
            "use strict";

            // Charger plus de sous-catégories
            $(document).on('click','#loadMoreSubcategories',function(e){
                e.preventDefault();

                let totalNo = $(this).data('total');
                let catId = $(this).data('category');
                let el = $(this);
                let container = $('#subcategory_list');

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.listing.load.more.subcategories')}}",
                    beforeSend: function(e){
                        el.html('<i class="las la-spinner la-spin"></i> {{__("Chargement...")}}');
                    },
                    data : {
                        _token: "{{csrf_token()}}",
                        total: totalNo,
                        catId: catId
                    },
                    success: function(data){
                        el.html('{{__("Voir plus")}} <i class="las la-angle-down"></i>');
                        
                        if(data.markup === ''){
                            el.hide();
                            return;
                        }

                        $('#loadMoreSubcategories').data('total', data.total);
                        
                        // Ajouter les nouvelles sous-catégories
                        let items = $(data.markup).find('.col-lg-4, .col-md-6').map(function() {
                            let link = $(this).find('a').attr('href');
                            let name = $(this).find('h4').text();
                            let count = $(this).find('p').text().match(/\d+/)[0] || 0;
                            
                            return `<a href="${link}" class="filter-item">
                                <span class="filter-name">${name}</span>
                                <span class="filter-count">${count}</span>
                            </a>`;
                        }).get().join('');
                        
                        container.append(items);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
