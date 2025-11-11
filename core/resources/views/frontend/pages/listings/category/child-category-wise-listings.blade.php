@extends('frontend.layout.master')
@section('site-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection
@section('page-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection
@section('inner-title')
    @if($child_category !='')
        {{ $child_category->name }}
    @endif
@endsection
@section('page-meta-data')
    {!!  render_page_meta_data_for_child_category($child_category) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/category-listings-modern.css') }}">
@endsection
@section('content')
<div class="child-category-wise-listing-modern">
    <!-- Page Header -->
    <div class="page-header-category">
        <div class="container-1440">
            <!-- Breadcrumb -->
            <nav class="breadcrumb-modern">
                <a href="{{ route('homepage') }}">{{ __('Accueil') }}</a>
                <i class="las la-angle-right"></i>
                <a href="{{ route('frontend.show.listing.by.category', $child_category->category?->slug ?? 'x') }}">{{ $child_category->category?->name }}</a>
                <i class="las la-angle-right"></i>
                <a href="{{ route('frontend.show.listing.by.subcategory', $child_category->subcategory?->slug ?? 'x') }}">{{ $child_category->subcategory?->name }}</a>
                <i class="las la-angle-right"></i>
                <span>{{ $child_category->name }}</span>
            </nav>

            <!-- Category Title -->
            <h1 class="category-title">{{ $child_category->name }}</h1>
            <div class="title-divider"></div>

            <!-- Category Description -->
            @if(!is_null($child_category->description))
                <div class="category-description">
                    {!! $child_category->description !!}
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
                        <h3>{{ __('Navigation') }}</h3>
                        <button class="sidebar-close" id="sidebarClose">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <!-- Navigation rapide -->
                    <div class="filter-group">
                        <div class="filter-group-header">
                            <i class="las la-sitemap"></i>
                            <h4>{{ __('Catégories parentes') }}</h4>
                        </div>
                        <div class="filter-group-content">
                            @if($child_category->category)
                            <a href="{{ route('frontend.show.listing.by.category', $child_category->category->slug) }}" class="filter-item">
                                <span class="filter-name">{{ $child_category->category->name }}</span>
                                <i class="las la-external-link-alt"></i>
                            </a>
                            @endif
                            @if($child_category->subcategory)
                            <a href="{{ route('frontend.show.listing.by.subcategory', $child_category->subcategory->slug) }}" class="filter-item">
                                <span class="filter-name">{{ $child_category->subcategory->name }}</span>
                                <i class="las la-external-link-alt"></i>
                            </a>
                            @endif
                        </div>
                    </div>
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
@endsection
