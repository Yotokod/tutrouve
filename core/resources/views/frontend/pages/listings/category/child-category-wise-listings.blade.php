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
@section('content')
<style>
    .page-header-modern {
        background: linear-gradient(135deg, #f8faf9 0%, #e8f4e9 100%);
        padding: 60px 0 40px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .page-header-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(147, 189, 147, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-30px); }
    }
</style>

<div class="child-category-wise-listing-modern" style="padding: 0; background: #ffffff; min-height: 100vh;">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="container-1440" style="position: relative; z-index: 2;">
            <!-- Breadcrumb Modern -->
            <nav style="margin-bottom: 24px;">
                <ol style="display: flex; align-items: center; gap: 8px; list-style: none; padding: 0; margin: 0; font-size: 14px; color: #666666; flex-wrap: wrap;">
                    <li><a href="{{ route('homepage') }}" style="color: #93bd93; text-decoration: none;">{{ __('Accueil') }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li><a href="{{ route('frontend.show.listing.by.category', $child_category->category?->slug ?? 'x') }}" style="color: #93bd93; text-decoration: none;">{{ $child_category->category?->name }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li><a href="{{ route('frontend.show.listing.by.subcategory', $child_category->subcategory?->slug ?? 'x') }}" style="color: #93bd93; text-decoration: none;">{{ $child_category->subcategory?->name }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li style="color: #1F3E39;">{{ $child_category->name }}</li>
                </ol>
            </nav>

            <!-- Category Title -->
            <h1 style="color: #1F3E39; font-size: 2.5rem; font-weight: 700; margin-bottom: 12px; letter-spacing: -1px;">
                {{ $child_category->name }}
            </h1>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin-bottom: 20px;"></div>

            <!-- Category Description -->
            @if(!is_null($child_category->description))
                <div style="max-width: 800px; color: #555555; font-size: 16px; line-height: 1.7;">
                    {!! $child_category->description !!}
                </div>
            @endif
        </div>
    </div>

    <div class="container-1440" style="padding-bottom: 80px;">
        <x-validation.frontend-error/>

        <!-- Available Listings Section -->
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h2 style="color: #1F3E39; font-size: 2rem; font-weight: 700; margin-bottom: 8px;">
                        {{ __('Annonces disponibles') }}
                    </h2>
                    <p style="color: #666666; font-size: 16px; margin: 0;">
                        {{ __(':count annonces trouvées', ['count' => $all_listings->total() ?? 0]) }}
                    </p>
                </div>

                <form id="filter_with_listing_page_subcategory" action="{{ url('/') .'/'. get_static_option('listing_filter_page_url') ?? url('/listings') }}" method="get">
                    <input type="hidden" name="cat" value="{{ $child_category->category_id }}"/>
                    <input type="hidden" name="subcat" value="{{ $child_category->sub_category_id }}"/>
                    <input type="hidden" name="child_cat" value="{{ $child_category->id }}"/>
                    <button type="submit" id="submit_form_listing_filter_subcategory" style="
                        display: inline-flex;
                        align-items: center;
                        gap: 8px;
                        padding: 12px 28px;
                        background: rgba(255, 255, 255, 0.1);
                        color: white;
                        border: 2px solid rgba(147, 189, 147, 0.5);
                        border-radius: 50px;
                        font-weight: 600;
                        font-size: 15px;
                        cursor: pointer;
                        text-decoration: none;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    " onmouseover="this.style.background='rgba(147, 189, 147, 0.15)'; this.style.borderColor='rgba(147, 189, 147, 0.8)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(147, 189, 147, 0.5)'">
                        <span>{{ __('Voir tout avec filtres') }}</span>
                        <i class="las la-arrow-right"></i>
                    </button>
                </form>
            </div>

            <x-listings.listing-single :listings="$all_listings"/>

            <!-- Pagination -->
            @if($all_listings->hasPages())
                <div style="margin-top: 48px; display: flex; justify-content: center;">
                    {{ $all_listings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
