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
@section('content')
<style>
    .page-header-modern {
        background: linear-gradient(135deg, #1a1f3a 0%, #0f172a 100%);
        padding: 60px 0 40px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
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

    .child-category-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .child-category-card:hover {
        transform: translateY(-4px);
        border-color: rgba(147, 189, 147, 0.5);
        background: rgba(147, 189, 147, 0.1);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    .child-category-card h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: #ffffff;
    }

    .child-category-card p {
        margin: 4px 0 0 0;
        font-size: 14px;
        color: #b0b0b0;
    }

    .child-category-icon {
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

<div class="subcategory-wise-listing-modern" style="padding: 0; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 100%); min-height: 100vh;">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="container-1440" style="position: relative; z-index: 2;">
            <!-- Breadcrumb Modern -->
            <nav style="margin-bottom: 24px;">
                <ol style="display: flex; align-items: center; gap: 8px; list-style: none; padding: 0; margin: 0; font-size: 14px; color: #b0b0b0; flex-wrap: wrap;">
                    <li><a href="{{ route('homepage') }}" style="color: #93bd93; text-decoration: none;">{{ __('Accueil') }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li><a href="{{ route('frontend.show.listing.by.category', $subcategory->category?->slug ?? 'x') }}" style="color: #93bd93; text-decoration: none;">{{ $subcategory->category?->name }}</a></li>
                    <li><i class="las la-angle-right"></i></li>
                    <li style="color: #ffffff;">{{ $subcategory->name }}</li>
                </ol>
            </nav>

            <!-- Subcategory Title -->
            <h1 style="color: #ffffff; font-size: 2.5rem; font-weight: 700; margin-bottom: 12px; letter-spacing: -1px;">
                {{ $subcategory->name }}
            </h1>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #93bd93, #a8cca8); border-radius: 2px; margin-bottom: 20px;"></div>

            <!-- Subcategory Description -->
            @if(!is_null($subcategory->description))
                <div style="max-width: 800px; color: #d0d0d0; font-size: 16px; line-height: 1.7;">
                    {!! $subcategory->description !!}
                </div>
            @endif
        </div>
    </div>

    <div class="container-1440" style="padding-bottom: 80px;">
        <x-validation.frontend-error/>

        <!-- Child Categories Section -->
        @if($child_category_under_category->count() > 0)
            <div style="margin-bottom: 60px;">
                <div style="margin-bottom: 32px;">
                    <h2 style="color: #ffffff; font-size: 2rem; font-weight: 700; margin-bottom: 12px;">
                        {{ __('Catégories spécifiques') }}
                    </h2>
                    <p style="color: #b0b0b0; font-size: 16px;">
                        {{ __('Affinez votre recherche par catégorie spécifique') }}
                    </p>
                </div>

                <div id="services_sub_category_load_wrap">
                    <div class="services_sub_category_load_wraper row g-3">
                        @foreach($child_category_under_category as $child_cat)
                            <div class="col-lg-4 col-md-6 col-12">
                                <a href="{{ route('frontend.show.listing.by.child.category', $child_cat->slug ?? 'x') }}" style="text-decoration: none; display: block;">
                                    <div class="child-category-card">
                                        <div class="child-category-icon">
                                            <i class="las la-tags"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h4>{{ $child_cat->name }}</h4>
                                            <p>{{ __(':count annonces', ['count' => $child_cat->total_listings ?? 0]) }}</p>
                                        </div>
                                        <i class="las la-arrow-right" style="color: #93bd93; font-size: 20px;"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($child_category_under_category->count() >= 20)
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

        <!-- Available Listings Section -->
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h2 style="color: #ffffff; font-size: 2rem; font-weight: 700; margin-bottom: 8px;">
                        {{ __('Annonces disponibles') }}
                    </h2>
                    <p style="color: #b0b0b0; font-size: 16px; margin: 0;">
                        {{ __(':count annonces trouvées', ['count' => $all_listings->total() ?? 0]) }}
                    </p>
                </div>

                <form id="filter_with_listing_page_subcategory" action="{{ url('/') .'/'. get_static_option('listing_filter_page_url') ?? url('/listings') }}" method="get">
                    <input type="hidden" name="cat" value="{{ $subcategory->category_id }}"/>
                    <input type="hidden" name="subcat" value="{{ $subcategory->id }}"/>
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
                        </div>
                    </section>
                </div>
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
                        catId: "{{$subcategory->id}}"
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
