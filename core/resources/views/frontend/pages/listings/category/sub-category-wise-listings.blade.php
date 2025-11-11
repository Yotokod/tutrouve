@extends('frontend.layout.master')
@section('site-title')
    @if($subcategory !='')
        {{ $subcategory->name }}
    @endif
@endsection
@section('page-title')
    @if($subcategory !='')
        {{ $subcategory->name }}
    @endif
@endsection
@section('inner-title')
    @if($subcategory !='')
        {{ $subcategory->name }}
    @endif
@endsection
@section('page-meta-data')
    {!!  render_page_meta_data_for_subcategory($subcategory) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/category-listings-modern.css') }}">
@endsection
@section('content')
<div class="subcategory-wise-listing-modern">
    <!-- Page Header -->
    <div class="page-header-category">
        <div class="container-1440">
            <!-- Breadcrumb -->
            <nav class="breadcrumb-modern">
                <a href="{{ route('homepage') }}">{{ __('Accueil') }}</a>
                <i class="las la-angle-right"></i>
                <a href="{{ route('frontend.show.listing.by.category', $subcategory->category?->slug ?? 'x') }}">{{ $subcategory->category?->name }}</a>
                <i class="las la-angle-right"></i>
                <span>{{ $subcategory->name }}</span>
            </nav>

            <!-- Subcategory Title -->
            <h1 class="category-title">{{ $subcategory->name }}</h1>
            <div class="title-divider"></div>

            <!-- Subcategory Description -->
            @if(!is_null($subcategory->description))
                <div class="category-description">
                    {!! $subcategory->description !!}
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

                    <!-- Child Categories Filter -->
                    @if($child_category_under_category->count() > 0)
                    <div class="filter-group">
                        <div class="filter-group-header">
                            <i class="las la-tags"></i>
                            <h4>{{ __('Catégories spécifiques') }}</h4>
                        </div>
                        <div class="filter-group-content">
                            <div id="child_category_list">
                                @foreach($child_category_under_category->take(10) as $child_cat)
                                <a href="{{ route('frontend.show.listing.by.child.category', $child_cat->slug ?? 'x') }}" class="filter-item">
                                    <span class="filter-name">{{ $child_cat->name }}</span>
                                    <span class="filter-count">{{ $child_cat->total_listings ?? 0 }}</span>
                                </a>
                                @endforeach
                            </div>
                            @if($child_category_under_category->count() > 10)
                            <button class="show-more-btn" id="loadMoreChildCategories" data-total="10" data-subcategory="{{ $subcategory->id }}">
                                {{ __('Voir plus') }} <i class="las la-angle-down"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif
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
                <div class="listings-grid">
                    <x-listings.listing-single :listings="$all_listings"/>
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

            // Charger plus de child categories
            $(document).on('click','#loadMoreChildCategories',function(e){
                e.preventDefault();

                let totalNo = $(this).data('total');
                let subcatId = $(this).data('subcategory');
                let el = $(this);
                let container = $('#child_category_list');

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.listing.load.more.subcategories')}}",
                    beforeSend: function(e){
                        el.html('<i class="las la-spinner la-spin"></i> {{__("Chargement...")}}');
                    },
                    data : {
                        _token: "{{csrf_token()}}",
                        total: totalNo,
                        catId: subcatId
                    },
                    success: function(data){
                        el.html('{{__("Voir plus")}} <i class="las la-angle-down"></i>');
                        
                        if(data.markup === ''){
                            el.hide();
                            return;
                        }

                        $('#loadMoreChildCategories').data('total', data.total);
                        
                        // Ajouter les nouvelles child categories
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