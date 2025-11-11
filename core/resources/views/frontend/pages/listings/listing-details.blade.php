@extends('frontend.layout.master')
@section('site-title')
    {{ $listing->title }}
@endsection
@section('page-title')
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    {{ __(ucwords(str_replace("-", " ", $page_info))) }}
@endsection
@section('inner-title')
    {{ $listing->title}}
@endsection
@section('page-meta-data')
    {!!  render_page_meta_data_for_listing($listing) !!}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/listing-details-modern.css') }}">
    <style>
        /* Styles additionnels spécifiques si nécessaire */

        /* Overlay Modal */
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
            z-index: 9999;
        }
        
        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            width: 30%;
            position: relative;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        
        .popup .close:hover {
            color: #06D85F;
        }
        
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px){
            .popup{
                width: 70%;
            }
        }

        /* Styles généraux */
        h5.disTittle {
            font-size: 18px;
            font-weight: 600;
            color: #1F3E39;
            margin-bottom: 20px;
            animation: fadeInUp 0.6s ease;
        }

        .recentImg {
            height: 72px !important;
            width: 72px !important;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .recentImg:hover {
            transform: scale(1.1);
        }

        .phone_number_hide_show {
            display: flex;
            flex-direction: row-reverse;
            font-size: 18px;
            font-weight: 600;
            justify-content: flex-end;
            gap: 7px;
        }

        .select2-container {
            z-index: 900000;
        }

        img.no-image {
            max-width: 400px;
            margin: auto;
        }

        .btn-group-sm>.btn, .btn-sm {
            padding: .25rem 0;
            font-size: .875rem;
            border-radius: .2rem;
        }

        /* Product Details Section */
        .proDetails {
            padding-top: 20px;
            animation: fadeInUp 0.8s ease;
        }

        .short-description {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .short-description:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .product-name {
            font-size: 28px;
            font-weight: 700;
            color: #1F3E39;
            margin-bottom: 12px;
            animation: slideIn 0.6s ease;
        }

        .price {
            font-size: 32px;
            font-weight: 800;
            color: #1F3E39;
            animation: pulse 2s infinite;
        }

        .token {
            display: inline-block;
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
            animation: pulse 2s infinite;
        }

        .date-location {
            display: flex;
            gap: 16px;
            font-size: 14px;
            color: #64748B;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .posted {
            font-weight: 600;
            color: #1F3E39;
        }

        .vartical-devider {
            width: 2px;
            height: 20px;
            background: #E2E8F0;
        }

        /* Image Slider */
        .product-view-wrap {
            margin-bottom: 24px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .single-main-image {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
        }

        .single-main-image img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .single-main-image:hover img {
            transform: scale(1.05);
        }

        .sliderArrow {
            position: relative;
        }

        .sliderArrow .prev-icon,
        .sliderArrow .next-icon {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
            width: 48px;
            height: 48px;
            background: rgba(31, 62, 57, 0.9);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .sliderArrow .prev-icon:hover,
        .sliderArrow .next-icon:hover {
            background: #1F3E39;
            transform: translateY(-50%) scale(1.1);
        }

        .sliderArrow .prev-icon {
            left: 16px;
        }

        .sliderArrow .next-icon {
            right: 16px;
        }

        .thumb-wrap {
            margin-top: 16px;
        }

        .single-thumb {
            padding: 4px;
            cursor: pointer;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .single-thumb:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .single-thumb img {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .single-thumb:hover img {
            transform: scale(1.1);
        }

        /* Description Box */
        .proDescription {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        /* Icon Container - Modern Design */
        .icon-container {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #1F3E39 0%, #2D5A4F 100%);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 12px;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(31, 62, 57, 0.2);
        }

        .icon-container:hover {
            transform: translateY(-4px) rotate(5deg);
            box-shadow: 0 8px 20px rgba(31, 62, 57, 0.3);
        }

        .icon-container i {
            font-size: 20px;
        }

        /* Description Content */
        .description-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .description-content p {
            margin: 0;
            font-weight: 500;
            color: #64748B;
            font-size: 13px;
        }

        .description-content span {
            margin-top: 4px;
            font-weight: 600;
            color: #1F3E39;
            font-size: 15px;
        }

        .rower {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 16px;
        }

        .col-4er {
            flex: 0 0 calc(33.333% - 11px);
            display: flex;
            align-items: center;
            padding: 16px;
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border-radius: 12px;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease;
            border: 1px solid #E2E8F0;
        }

        .col-4er:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: #1F3E39;
        }

        @media (max-width: 768px) {
            .col-4er {
                flex: 0 0 calc(50% - 8px);
            }
        }

        @media (max-width: 576px) {
            .col-4er {
                flex: 0 0 100%;
            }
        }

        /* Devider */
        .devider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #E2E8F0 50%, transparent 100%);
            margin: 32px 0;
        }

        /* Description Section */
        .descriptionMid {
            margin: 32px 0;
        }

        .descriptionMid h4 {
            font-size: 22px;
            font-weight: 700;
            color: #1F3E39;
            margin-bottom: 16px;
        }

        .descriptionMid .pera {
            line-height: 1.8;
            color: #475569;
            font-size: 15px;
        }

        .show-more-btn {
            background: linear-gradient(135deg, #1F3E39 0%, #2D5A4F 100%);
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            box-shadow: 0 4px 12px rgba(31, 62, 57, 0.3);
        }

        .show-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(31, 62, 57, 0.4);
        }

        /* Tags */
        .descriptionFooter {
            margin-top: 32px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .tags a {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            color: #1F3E39;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tags a:hover {
            background: linear-gradient(135deg, #1F3E39 0%, #2D5A4F 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(31, 62, 57, 0.3);
        }

        /* Transaction Box */
        .transaction-box {
            padding: 24px;
            color: #1F3E39;
            border: 2px solid #E2E8F0;
            border-radius: 16px;
            background: linear-gradient(135deg, #F8FAFC 0%, #FFFFFF 100%);
            margin-top: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .transaction-box h4 {
            color: #1F3E39;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .transaction-box ul {
            list-style: none;
            padding: 0;
            margin: 16px 0;
        }

        .transaction-box ul li {
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .transaction-box ul li i {
            font-size: 18px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 12px;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
        }

        .form-control-lg {
            border: 2px solid #E2E8F0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .form-control-lg:focus {
            border-color: #1F3E39;
            box-shadow: 0 0 0 4px rgba(31, 62, 57, 0.1);
        }

        /* Seller Part */
        .seller-part {
            position: sticky;
            top: 100px;
        }

        .box-shadow1 {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease;
        }

        .box-shadow1:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        /* Safety Tips */
        .safety-tips {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .safety-tips h3 {
            color: #92400E;
            font-weight: 700;
            margin-bottom: 16px;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .sliderArrow .prev-icon,
            .sliderArrow .next-icon {
                width: 36px;
                height: 36px;
            }
            
            .sliderArrow .prev-icon i,
            .sliderArrow .next-icon i {
                font-size: 18px;
            }

            .product-name {
                font-size: 22px;
            }

            .price {
                font-size: 24px;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.min.css')}}">
@endsection
@section('content')
    <div class="listing-details-modern">
        <!-- Breadcrumb -->
        <div class="breadcrumb-listing">
            <div class="container-1440">
                <nav>
                    <a href="{{ route('homepage') }}">{{ __('Accueil') }}</a>
                    <i class="las la-angle-right"></i>
                    @if($listing->category)
                        <a href="{{ route('frontend.show.listing.by.category', $listing->category->slug ?? 'x') }}">{{ $listing->category->name }}</a>
                        <i class="las la-angle-right"></i>
                    @endif
                    <span>{{ $listing->title }}</span>
                </nav>
                <x-validation.frontend-error/>
            </div>
        </div>

        <div class="container-1440">
            <!-- Layout Principal -->
            <div class="listing-content-wrapper">
                <!-- Colonne Principale (Gauche) -->
                <div class="listing-main-content">
                    <!-- Header avec titre et prix -->
                    <div class="listing-header">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 300px;">
                                <h1 class="listing-title">{{ $listing->title }}</h1>
                                <div class="listing-meta">
                                    <div class="listing-meta-item">
                                        <i class="las la-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($listing->created_at)->format('j F Y') }}</span>
                                    </div>
                                    <span class="meta-divider"></span>
                                    <div class="listing-meta-item">
                                        <i class="las la-map-marker"></i>
                                        <span>{{ userListingLocation($listing) }}</span>
                                    </div>
                                    <span class="meta-divider"></span>
                                    <div class="listing-meta-item">
                                        <i class="las la-eye"></i>
                                        <span>{{ $listing->views ?? 0 }} {{ __('vues') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="listing-price">
                                    {{ float_amount_with_currency_symbol($listing->price) }}
                                    @if($listing->negotiable == 1)
                                        <span class="negotiable-badge">{{ __('NÉGOCIABLE') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Galerie Photos Moderne -->
                    <div class="listing-gallery">
                        @php
                            $thumb_image = $listing->image;
                            $gallery_images = $listing->gallery_images ?? '';
                            $all_images_list = !empty($gallery_images) ? $thumb_image . '|' . $gallery_images : $thumb_image;
                            $images = explode("|", $all_images_list);
                            $images = array_filter($images);
                        @endphp

                        <!-- Image Principale -->
                        <div class="gallery-main-image">
                            @if(!empty($images[0]))
                                <img src="{{ get_image_url_id_wise($images[0]) }}" alt="{{ $listing->title }}" id="mainGalleryImage">
                            @else
                                <img src="{{ asset('assets/frontend/img/no-image.jpg') }}" alt="No image">
                            @endif
                            
                            @if(count($images) > 1)
                                <div class="gallery-nav-arrows">
                                    <button class="gallery-arrow prev" onclick="prevImage()">
                                        <i class="las la-angle-left"></i>
                                    </button>
                                    <button class="gallery-arrow next" onclick="nextImage()">
                                        <i class="las la-angle-right"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnails -->
                        @if(count($images) > 1)
                        <div class="gallery-thumbnails">
                            @foreach($images as $index => $img)
                                @if(!empty($img))
                                <div class="gallery-thumb {{ $index === 0 ? 'active' : '' }}" 
                                     onclick="changeGalleryImage({{ $index }}, '{{ get_image_url_id_wise($img) }}')">
                                    <img src="{{ get_image_url_id_wise($img) }}" alt="Thumbnail {{ $index + 1 }}">
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <script>
                            let currentImageIndex = 0;
                            const galleryImages = @json(array_map(function($img) {
                                return !empty($img) ? get_image_url_id_wise($img) : '';
                            }, array_values($images)));

                            function changeGalleryImage(index, imageSrc) {
                                currentImageIndex = index;
                                const mainImage = document.getElementById('mainGalleryImage');
                                mainImage.style.opacity = '0';
                                
                                setTimeout(() => {
                                    mainImage.src = imageSrc;
                                    mainImage.style.opacity = '1';
                                }, 200);

                                document.querySelectorAll('.gallery-thumb').forEach((thumb, i) => {
                                    thumb.classList.toggle('active', i === index);
                                });
                            }

                            function prevImage() {
                                currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
                                changeGalleryImage(currentImageIndex, galleryImages[currentImageIndex]);
                            }

                            function nextImage() {
                                currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
                                changeGalleryImage(currentImageIndex, galleryImages[currentImageIndex]);
                            }
                        </script>
                    </div>

                    <!-- Caractéristiques Modernes -->
                    <div class="listing-features">
                        <h2 class="section-title">
                            <i class="las la-list"></i>
                            {{ __('Caractéristiques') }}
                        </h2>
                        <div class="features-grid">
                            @if($listing->category && $listing->category->code != 1 && $listing->category->code != 2)
                                    @if(!empty($listing->condition))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Condition') }}</div>
                                                <div class="feature-value">{{ $listing->condition }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(!empty($listing->authenticity))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Authenticité') }}</div>
                                                <div class="feature-value">{{ $listing->authenticity }}</div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(!empty($listing->brand))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-copyright"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Marque') }}</div>
                                                <div class="feature-value">{{ $listing->brand?->title }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if($listing->category && $listing->category->code == 1)
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <div class="feature-content">
                                            <div class="feature-label">{{ __('Type de bien') }}</div>
                                            <div class="feature-value">{{ $listing->type_bien }}</div>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="feature-content">
                                            <div class="feature-label">{{ __('Genre de bien') }}</div>
                                            <div class="feature-value">{{ $listing->genre_bien }}</div>
                                        </div>
                                    </div>

                                    @if(!empty($listing->surface))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-ruler"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Surface') }}</div>
                                                <div class="feature-value">{{ $listing->surface }} m²</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->nbrs_piece))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-th"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Nombre de pièces') }}</div>
                                                <div class="feature-value">{{ $listing->nbrs_piece }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->nbrs_chambre))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-bed"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Nombre de chambres') }}</div>
                                                <div class="feature-value">{{ $listing->nbrs_chambre }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->nature_bien))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Nature du bien') }}</div>
                                                <div class="feature-value">{{ $listing->nature_bien }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->type_chambre))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-door-open"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Type de chambre') }}</div>
                                                <div class="feature-value">{{ $listing->type_chambre }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->nbrs_colocataire))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Nombre de colocataires') }}</div>
                                                <div class="feature-value">{{ $listing->nbrs_colocataire }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->salle_bain))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-bath"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Salles de bain') }}</div>
                                                <div class="feature-value">{{ $listing->salle_bain }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->classe_energie))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-bolt"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Classe énergie') }}</div>
                                                <div class="feature-value">{{ $listing->classe_energie }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->ges))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-leaf"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('GES') }}</div>
                                                <div class="feature-value">{{ $listing->ges }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->etage_bien))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Nombre d\'étages') }}</div>
                                                <div class="feature-value">{{ $listing->etage_bien }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->etage_batiment))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Étages du bâtiment') }}</div>
                                                <div class="feature-value">{{ $listing->etage_batiment }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->statut_fumeur))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-smoking"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Statut fumeur') }}</div>
                                                <div class="feature-value">{{ $listing->statut_fumeur }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($listing->animaux))
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="fas fa-paw"></i>
                                            </div>
                                            <div class="feature-content">
                                                <div class="feature-label">{{ __('Animaux') }}</div>
                                                <div class="feature-value">{{ $listing->animaux }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- attributes -->
                        @if($listing->listing_attributes->isNotEmpty())
                        <div style="margin-top: 20px;"></div>
                        <h2 class="section-title">
                            <i class="las la-check-circle"></i>
                            {{ get_static_option('listing_attribute_section_title') ?? __('Attributs supplémentaires') }}
                        </h2>
                        <div class="features-grid">
                                @foreach($listing->listing_attributes as $attribute)
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="feature-content">
                                            <div class="feature-label">{{ $attribute->title }}</div>
                                            <div class="feature-value">{{ $attribute->description }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        <div class="listing-description" style="margin-top: 30px;">
                            <h2 class="section-title">
                                <i class="las la-align-left"></i>
                                {{ get_static_option('listing_description_title') ?? __('Description') }}
                            </h2>
                            <div class="description-content" id="description">
                                {!! Str::limit(str_replace('&nbsp;', ' ', strip_tags($listing->description)), 20000) !!}
                            </div>
                            <button id="showMoreButton" class="show-more-btn">{{ __('Voir plus') }}</button>
                        </div>
                        
                        <!-- Tags -->
                        @if(isset($listing->tags) && count($listing->tags) > 0)
                            @if(!empty($listing->tags))
                                <div class="listing-tags" style="margin-top: 30px;">
                                    <h2 class="section-title">
                                        <i class="las la-tags"></i>
                                        {{ get_static_option('listing_tag_title') ?? __('Tags') }}
                                    </h2>
                                    <div class="tags-container">
                                        <form id="filter_with_listing_page_tag" action="{{ url(get_static_option('listing_filter_page_url') ?? '/listings') }}" method="get">
                                            <input type="hidden" name="tag_id" id="tag_id" value="" />
                                            @foreach($listing->tags as $tag)
                                                <a href="#" class="tag-item submit_form_listing_filter_tag" data-tag-id="{{ $tag->id }}">
                                                    <i class="las la-tag"></i>
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
                        
                        <!-- Transaction Escrow Box -->
                        <div class="escrow-transaction-box" style="margin-top: 30px;">
                            <div class="escrow-header">
                                <div class="escrow-icon">
                                    <i class="las la-shield-alt"></i>
                                </div>
                                <div>
                                    <h2 class="section-title" style="margin: 0;">
                                        {{ __('Paiement Sécurisé Escrow') }}
                                    </h2>
                                    <p style="margin: 8px 0 0 0; color: #64748B; font-size: 14px;">
                                        {{ __('Protégez vos transactions avec notre système de séquestre') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="escrow-features">
                                <div class="escrow-feature">
                                    <div class="feature-icon-small">
                                        <i class="las la-check-circle"></i>
                                    </div>
                                    <div class="feature-text">
                                        {{ __('L\'annonceur reçoit l\'argent seulement après la réception du colis') }}
                                    </div>
                                </div>
                                <div class="escrow-feature">
                                    <div class="feature-icon-small">
                                        <i class="las la-lock"></i>
                                    </div>
                                    <div class="feature-text">
                                        {{ __('Transactions 100% sécurisées et cryptées') }}
                                    </div>
                                </div>
                                <div class="escrow-feature">
                                    <div class="feature-icon-small">
                                        <i class="las la-user-shield"></i>
                                    </div>
                                    <div class="feature-text">
                                        {{ __('Protection acheteur et vendeur garantie') }}
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn-escrow-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="las la-shopping-cart"></i>
                                {{ __('Initier une transaction Escrow') }}
                            </button>
                            
                            <div class="collapse" id="collapseExample" style="margin-top: 20px;">
                                <div class="escrow-form-container">
                                    @auth
                                        <form method="post" action="{{ route('user.transaction.add') }}" id="forme" class="escrow-form">
                                            @csrf
                                            <div class="form-group-modern">
                                                <label for="amount" class="form-label-modern">
                                                    <i class="las la-money-bill-wave"></i>
                                                    {{ __('Montant de la transaction (FCFA)') }}
                                                </label>
                                                <input class="form-control-modern" 
                                                       type="number" 
                                                       name="amount" 
                                                       id="amount" 
                                                       placeholder="{{ __('Ex: 50000') }}" 
                                                       aria-label="Amount" 
                                                       required
                                                       min="1">
                                                <small class="form-hint">{{ __('Le montant sera bloqué jusqu\'à la confirmation de réception') }}</small>
                                            </div>
                                            
                                            <input type="hidden" name="ads" id="ads" value="{{ $listing->id }}">
                                            <input type="hidden" name="transaction_id" value="{{ $listing->id }}">
                                            
                                            <div class="payment-methods">
                                                <p class="payment-label">{{ __('Modes de paiement acceptés:') }}</p>
                                                <div class="payment-logos">
                                                    <img src="https://developers.paydunya.com/images/bouton-senegal-02.png" alt="PayDunya" style="height: 40px;">
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn-submit-escrow">
                                                <i class="las la-lock"></i>
                                                {{ __('Confirmer et payer de façon sécurisée') }}
                                            </button>
                                            
                                            <div class="escrow-info-box">
                                                <i class="las la-info-circle"></i>
                                                <div>
                                                    <strong>{{ __('Comment ça marche?') }}</strong>
                                                    <ol style="margin: 8px 0 0 0; padding-left: 20px; font-size: 13px;">
                                                        <li>{{ __('Vous payez le montant qui sera bloqué en séquestre') }}</li>
                                                        <li>{{ __('Le vendeur envoie l\'article') }}</li>
                                                        <li>{{ __('Vous confirmez la réception') }}</li>
                                                        <li>{{ __('Le vendeur reçoit le paiement') }}</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </form>
                                    @endauth
                                    @guest
                                        <div class="guest-message">
                                            <div class="guest-icon">
                                                <i class="las la-user-lock"></i>
                                            </div>
                                            <h4>{{ __('Connexion requise') }}</h4>
                                            <p>{{ __('Veuillez vous connecter afin d\'effectuer des transactions de façon sécurisée avec le système Escrow.') }}</p>
                                            <a href="{{ route('user.login') }}" class="btn-login">
                                                <i class="las la-sign-in-alt"></i>
                                                {{ __('Se connecter') }}
                                            </a>
                                        </div>
                                    @endguest
                                </div>
                            </div>  
                        </div>
                    </div>

                    <!--for mobile device user info -->
                    <div class="seller-part mt-3 d-md-none">
                        <x-listings.user-listing-phone-for-responsive :listing="$listing"/>
                        <x-listings.listing-details-page-user-info :listing="$listing" :userTotalListings="$user_total_listings"/>
                    </div>
                    
                    <!--Relevant Ads-->
                    @include('frontend.pages.listings.relevant-listing')
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="listing-sidebar">
                        <!-- Seller Card Modern -->
                        <div class="seller-card-modern d-none d-md-block">
                            @if(empty($listing->admin_id))
                                <!-- Seller Profile -->
                                <div class="seller-profile-header">
                                    @if($listing->user_id === 0)
                                        <div class="seller-avatar">
                                            {!! userProfileImageView(optional($listing->user)->image) !!}
                                        </div>
                                    @else
                                        <a href="{{ route('about.user.profile', $listing?->user?->username) }}">
                                            <div class="seller-avatar">
                                                {!! userProfileImageView(optional($listing->user)->image) !!}
                                            </div>
                                        </a>
                                    @endif
                                    
                                    <div class="seller-info">
                                        <div class="seller-name-wrapper">
                                            @if($listing->user_id === 0)
                                                <h3 class="seller-name">{{ $listing->guestListing?->guestfullname }}</h3>
                                            @else
                                                <a href="{{ route('about.user.profile', $listing?->user?->username) }}">
                                                    <h3 class="seller-name">{{ optional($listing->user)->fullname }}</h3>
                                                </a>
                                            @endif
                                            <x-badge.user-verified-badge :listing="$listing"/>
                                        </div>

                                        @if($listing->user_id != null && $listing->user_id != 0)
                                            <div class="seller-stats">
                                                <div class="stat-item">
                                                    <i class="las la-clipboard-list"></i>
                                                    <span>
                                                        @if($userTotalListings > 1)
                                                            {{ $userTotalListings }} {{ __('annonces') }}
                                                        @else
                                                            {{ $userTotalListings }} {{ __('annonce') }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="stat-divider"></div>
                                                <div class="stat-item">
                                                    <i class="las la-calendar"></i>
                                                    <span>{{ __('Membre depuis') }} {{ \Carbon\Carbon::parse(optional($listing->user)->created_at)->format('Y') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Phone Number Section -->
                                <div class="seller-phone-section">
                                    <div class="phone-label">
                                        <i class="las la-phone"></i>
                                        {{ __('Téléphone') }}
                                    </div>
                                    <div class="phone-number-display">
                                        <span type="text" id="default_phone_number_show" class="number-masked">{{ __('+XX XXX XXX XX') }}</span>
                                        @if($listing->phone_hidden == 0)
                                            <div class="number-full" id="phoneNumber" style="display: none;">{{ $listing->phone }}</div>
                                            <button class="btn-show-phone" id="userPhoneNumberBtn">
                                                <i class="las la-eye"></i>
                                                {{ get_static_option('listing_show_phone_number_title') ?? __('Afficher le numéro') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="seller-actions-modern">
                                    @if(moduleExists("Chat"))
                                        @if(is_null($listing->admin_id) && $listing->user_id != null && $listing->user_id != 0)
                                            @if(auth()->check() && Auth::guard('web')->user()->id !== $listing->user_id)
                                                <form action="{{ route('user.message.send') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="member_id" value="{{ $listing->user_id }}">
                                                    <input type="hidden" name="from_user" value="{{ Auth::guard('web')->user()->id }}">
                                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                                    <button type="submit" class="btn-action-primary">
                                                        <i class="las la-comment-dots"></i>
                                                        {{ __('Envoyer un message') }}
                                                    </button>
                                                </form>
                                            @elseif(!auth()->check())
                                                <a href="javascript:void(0)" class="btn-action-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                    <i class="las la-comment-dots"></i>
                                                    {{ __('Envoyer un message') }}
                                                </a>
                                            @endif
                                        @endif
                                    @endif

                                    @if($listing->user_id != null && $listing->user_id != 0)
                                        <a href="{{ route('about.user.profile', $listing?->user?->username) }}" class="btn-action-secondary">
                                            <i class="las la-user"></i>
                                            {{ __('Voir le profil') }}
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                        
                        <!--Adds left-->
                        @if(get_static_option('google_adsense_status') == 'on')
                            <div class="googleAdd-wraper">
                                <div class="add">
                                    <div class="text-{{$custom_container}} single-banner-ads ads-banner-box" id="home_advertisement_store">
                                        <input type="hidden" id="add_id" value="{{$add_id}}">
                                        {!! $add_markup !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(get_static_option('safety_tips_info') !== null)
                            <div class="safety-tips">
                                <h3 class="head5">{{ __('Conseils de sécurité') }}</h3>
                                <div class="safety-wraper">
                                    {!! get_static_option('safety_tips_info') !!}
                                </div>
                            </div>
                        @endif

                        <div class="share-on-wraper box-shadow1">
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <div class="text-center w-50 report-btn listing-details-page-favorite">
                                    <x-listings.favorite-item-add-remove-for-details-page :favorite="$listing->id ?? 0" />
                                </div>
                                <div class="report-btn w-50 text-center">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#reportModal">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 10H15L10.5 5.5L15 1H1V17" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="addReportModal">{{ __('Report') }}</span>
                                    </a>
                                </div>
                            </div>

                            <div class="share-on">
                                <span class="social-icons">
                                    @php
                                        $image_url = get_attachment_image_by_id($listing->image);
                                        $img_url = $image_url['img_url'] ?? '';
                                    @endphp
                                    {!! single_post_share(route('frontend.listing.details',$listing->slug), $listing->title, $img_url) !!}
                                </span>
                            </div>
                        </div>

                        @include('frontend.pages.listings.frontend-business-hours')
                        @include('frontend.pages.listings.frontend-enquiry-form')
                        
                        @if(!empty($listing->address))
                            <div class="map-wraper box-shadow1">
                                <h3 class="head5">{{ __('Adresse') }}</h3>
                                <p>{{ $listing->address }}</p>
                                <div class="map">
                                    @if (!empty(get_static_option("google_map_settings_on_off")))
                                        <div id="single-map-canvas" style="height: 230px; width: 100%; position: relative; overflow: hidden; border-radius: 12px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        @if(!empty($listing->video_url))
                            <div class="map-wraper box-shadow1">
                                <h3 class="head5">{{ __('Video') }}</h3>
                                <iframe width="100%" height="250" style="border-radius: 12px;"
                                        src="{{ 'https://www.youtube.com/embed/' . $listing->video_url }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.pages.listings.listing-report-add-modal')
    <x-frontend.login/>
@endsection

@section('scripts')
<!-- Modern Listing Details JS -->
<script src="{{ asset('js/listing-details-modern.js') }}"></script>

@if(!empty(get_static_option('google_map_settings_on_off')))
    <x-map.google-map-listing-details-page-js :lat="$listing->lat ?? 0" :lon="$listing->lon ?? 0"/>
@endif
@if($user_enquiry_form == true)
    <x-listings.enquiry-form-submit-js/>
@endif

<x-listings.listing-report-add-js/>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script>
    (function($){
        "use strict";

        $(document).ready(function(){

            // Initialize Magnific Popup
            $('.image-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out'
                }
            });

            let page = 1;
            $(document).on('click', '#load-more-ads', function() {
                page++;
                let listingId = $(this).data('listing-id');
                $.ajax({
                    url: "{{ route('frontend.listing.load-more-relevant') }}",
                    type: "POST",
                    data: {
                        page: page,
                        listing_id: listingId
                    },
                    success: function(response) {
                        if (response.html) {
                            $('.relevant-listing-wrapper').append(response.html);
                        }

                        if (response.total_relevant_items == 0) {
                            $('#load-more-ads').prop('disabled', true);
                            $('#load-more-ads').hide();
                        } else {
                            $('#load-more-ads').prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error loading more ads');
                    }
                });
            });

            // Toggle for business hour
            $(".hours-wraper").slideToggle(300);
            $(".business-hour .business-head").on('click', function(){
                $(".hours-wraper").slideToggle(300)
            });

            $(".enquiry-wraper").show();
            $(".enquiry-hour .enquiry-head").on('click', function() {
                $(".enquiry-wraper").slideToggle(300);
            });

            // Description Show More/Less
            let description = document.getElementById('description');
            let showMoreButton = document.getElementById('showMoreButton');
            $('#showMoreButton').show();
            let isExpanded = false;
            let originalContent = description.textContent;
            
            if (description.textContent.length > 700) {
                description.textContent = description.textContent.substring(0, 700) + '...';
            } else {
                $('#showMoreButton').hide();
            }
            
            showMoreButton.addEventListener('click', function() {
                if (!isExpanded) {
                    description.textContent = originalContent;
                    showMoreButton.textContent = '{{ __("Show Less") }}';
                } else {
                    description.textContent = description.textContent.substring(0, 700) + '...';
                    showMoreButton.textContent = '{{ __("Show More") }}';
                }
                isExpanded = !isExpanded;
            });

            // Phone number toggle - Desktop
            $('#phoneNumber').hide();
            $('#default_phone_number_show').show();
            $('.show-number').show();
            
            $(document).on('click', '#userPhoneNumberBtn', function(event) {
                event.preventDefault();
                $('#default_phone_number_show').hide();
                $('#phoneNumber').show();
                $('.show-number').hide();
            });

            // Phone number toggle - Mobile
            $('#phoneNumberForResponsive').hide();
            $('#default_phone_number_show_for_responsive').show();
            
            $(document).on('click', '#userPhoneNumberBtnForResponsive', function(event) {
                event.preventDefault();
                $('#default_phone_number_show_for_responsive').hide();
                $('#phoneNumberForResponsive').show();
                $('.show-number').hide();
            });

            // Call to number on mobile
            $(document).on('click', '#phoneNumberForResponsive', function(event) {
                event.preventDefault();
                let phoneNumber = $('#phoneNumber').text().trim();
                window.location.href = 'tel:' + phoneNumber;
            });

            // Form validation
            $('#forme').on('submit', function(e) {
                const amount = $('#amount').val().trim();
                const ads = $('#ads').val().trim();

                if (amount === '' || ads === '' || parseFloat(amount) <= 0) {
                    e.preventDefault();
                    alert('{{ __("Veuillez remplir tous les champs correctement avant de soumettre le formulaire.") }}');
                    return false;
                }
            });

            // Smooth scroll animations on page load
            $('.col-4er').each(function(index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
            });
        });
    })(jQuery);
</script>
@endsection