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
@section('content')
<style>
    /* White Theme Design */
    body {
        background: #ffffff;
    }

    .page-header-modern {
        background: linear-gradient(135deg, #f8faf9 0%, #e8f4e9 100%);
        padding: 60px 0 40px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(147, 189, 147, 0.2);
    }

    .page-header-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
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

    .subcategory-card {
        background: #ffffff;
        border: 1px solid rgba(31, 62, 57, 0.1);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .subcategory-card:hover {
        transform: translateY(-4px);
        border-color: rgba(147, 189, 147, 0.4);
        background: #f8fdf8;
        box-shadow: 0 12px 32px rgba(147, 189, 147, 0.15);
    }

    .subcategory-card h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1F3E39;
    }

    .subcategory-card p {
        margin: 4px 0 0 0;
        font-size: 14px;
        color: #666666;
    }

    .subcategory-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #93bd93, #7da97d);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }
</style>

<div class="category-wise-listing-modern" style="padding: 0; background: #ffffff; min-height: 100vh;">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="container-1440" style="position: relative; z-index: 2;">
            <!-- Breadcrumb Modern -->
            <nav style="margin-bottom: 24px;">
                <ol style="display: flex; align-items: center; gap: 8px; list-style: none; padding: 0; margin: 0; font-size: 14px; color: #666666;">
                    <li><a href="{{ route('homepage') }}" style="color: #93bd93; text-decoration: none;">{{ __('Accueil') }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li style="color: #1F3E39; font-weight: 600;">{{ $category->name }}</li>
                </ol>
            </nav>

            <!-- Category Title -->
            <h1 style="color: #1F3E39; font-size: 2.5rem; font-weight: 700; margin-bottom: 12px; letter-spacing: -1px;">
                {{ $category->name }}
            </h1>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin-bottom: 20px;"></div>

            <!-- Category Description -->
            @if(!is_null($category->description))
                <div style="max-width: 800px; color: #555555; font-size: 16px; line-height: 1.7;">
                    {!! $category->description !!}
                </div>
            @endif
        </div>
    </div>

    <div class="container-1440" style="padding-bottom: 80px;">
        <x-validation.frontend-error/>

        <!-- Sous-catégories Section -->
        @if($subcategory_under_category->count() > 0)
            <div style="margin-bottom: 60px;">
                <div style="margin-bottom: 32px;">
                    <h2 style="color: #1F3E39; font-size: 2rem; font-weight: 700; margin-bottom: 12px;">
                        {{ __('Sous-catégories') }}
                    </h2>
                    <p style="color: #666666; font-size: 16px;">
                        {{ __('Explorez les différentes sous-catégories disponibles') }}
                    </p>
                </div>

                <div id="services_sub_category_load_wrap">
                    <div class="services_sub_category_load_wraper row g-3">
                        @foreach($subcategory_under_category as $sub_cat)
                            <div class="col-lg-4 col-md-6 col-12">
                                <a href="{{ route('frontend.show.listing.by.subcategory', $sub_cat->slug ?? 'x') }}" style="text-decoration: none; display: block;">
                                    <div class="subcategory-card">
                                        <div class="subcategory-icon">
                                            <i class="las la-folder-open"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h4>{{ $sub_cat->name }}</h4>
                                            <p>{{ __(':count annonces', ['count' => $sub_cat->total_listings ?? 0]) }}</p>
                                        </div>
                                        <i class="las la-arrow-right" style="color: #93bd93; font-size: 20px;"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($subcategory_under_category->count() >= 20)
                        <div style="text-align: center; margin-top: 32px;">
                            <button id="load_more_btn" data-total="20" style="
                                padding: 14px 40px;
                                background: linear-gradient(135deg, #93bd93, #7da97d);
                                color: white;
                                border: none;
                                border-radius: 50px;
                                font-weight: 600;
                                font-size: 16px;
                                cursor: pointer;
                                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                box-shadow: 0 4px 12px rgba(147, 189, 147, 0.3);
                            " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(147, 189, 147, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(147, 189, 147, 0.3)'">
                                {{ __('Charger plus') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Annonces disponibles Section -->
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

                <form id="filter_with_listing_page_category" action="{{ url('/') .'/'. get_static_option('listing_filter_page_url') ?? url('/listings') }}" method="get">
                    <input type="hidden" name="cat" value="{{ $category->id }}"/>
                    <button type="submit" id="submit_form_listing_filter_category" style="
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
                        <span>{{ __('Voir tout') }}</span>
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
@section('scripts')
    <script>
        (function($){
            "use strict";

            $(document).on('click','#load_more_btn',function(e){
                e.preventDefault();

                let totalNo = $(this).data('total');
                let el = $(this);
                let container = $('#services_sub_category_load_wrap > .row');

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.listing.load.more.subcategories')}}",
                    beforeSend: function(e){
                        el.text("{{__('loading...')}}")
                    },
                    data : {
                        _token: "{{csrf_token()}}",
                        total: totalNo,
                        catId: "{{$category->id}}"
                    },
                    success: function(data){

                        el.text("{{__('Load More')}}");
                        if(data.markup === ''){
                            el.hide();
                            container.append("<div class='col-lg-12'><div class='text-center text-warning mt-3'>{{__('no more subcategory found')}}</div></div>");
                            return;
                        }

                        $('#load_more_btn').data('total',data.total);

                        container.append(data.markup);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
