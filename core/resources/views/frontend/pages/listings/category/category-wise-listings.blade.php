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
