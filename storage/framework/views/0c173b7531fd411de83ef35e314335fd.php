
<?php $__env->startSection('site-title'); ?>
    <?php echo e($listing->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php
    $page_info = request()->url();
    $str = explode("/",request()->url());
    $page_info = $str[count($str)-2];
    ?>
    <?php echo e(__(ucwords(str_replace("-", " ", $page_info)))); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('inner-title'); ?>
    <?php echo e($listing->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_listing($listing); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        /* Animations globales */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

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
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!--Listing Details-->
    <div class="proDetails" style="padding-top:20px;">
        <div class="container-1310">
            <div class="bradecrumb-wraper-div">
                <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => '','innerTitle' => __('Listing Details'),'subInnerTitle' => '','chidInnerTitle' => '','routeName' => '#','subRouteName' => '#']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Listing Details')),'subInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'chidInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'routeName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('#'),'subRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('#')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $attributes = $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4)): ?>
<?php $component = $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4; ?>
<?php unset($__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc04996af13f0d779852114b39ea43e16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04996af13f0d779852114b39ea43e16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation.frontend-error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('validation.frontend-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $attributes = $__attributesOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__attributesOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04996af13f0d779852114b39ea43e16)): ?>
<?php $component = $__componentOriginalc04996af13f0d779852114b39ea43e16; ?>
<?php unset($__componentOriginalc04996af13f0d779852114b39ea43e16); ?>
<?php endif; ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-8 ">
                    <div class="short-description">
                        <div class="left-part mb-4">
                            <div class="product-name-price">
                                <div class="product-name"><?php echo e($listing->title); ?> </div>
                                <div class="right-part text-right">
                                    <div class="price text-end"><span><?php echo e(float_amount_with_currency_symbol($listing->price)); ?></span>
                                        <?php if($listing->negotiable == 1): ?>
                                            <div class="token"><?php echo e(__('NEGOTIABLE')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="date-location">
                                <span><?php echo e(__('Date de publication')); ?>  <span class="posted"><?php echo e(\Carbon\Carbon::parse($listing->created_at)->format('j F Y')); ?></span></span>
                                <span class="vartical-devider"></span>
                                <span><?php echo e(('Localisation')); ?>

                                     <span class="posted"> <?php echo e(userListingLocation($listing)); ?> </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Image Slider -->
                    <div class="product-view-wrap" id="myTabContent">
                        <div class="shop-details-gallery-slider global-slick-init slider-inner-margin sliderArrow"
                             data-asNavFor=".shop-details-gallery-nav"
                             data-infinite="true"
                             data-arrows="true"
                             data-dots="false"
                             data-slidesToShow="1"
                             data-swipeToSlide="true"
                             data-fade="true"
                             data-autoplay="false"
                             data-autoplaySpeed="3000"
                             data-prevArrow='<div class="prev-icon"><i class="las la-angle-left"></i></div>'
                             data-nextArrow='<div class="next-icon"><i class="las la-angle-right"></i></div>'
                             data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 1}},{"breakpoint": 1600,"settings": {"slidesToShow": 1}},{"breakpoint": 1400,"settings": {"slidesToShow": 1}},{"breakpoint": 1200,"settings": {"slidesToShow": 1}},{"breakpoint": 991,"settings": {"slidesToShow": 1}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"slidesToShow": 1}}]'>

                        <?php if(!is_null($listing->gallery_images)): ?>
                                <?php
                                    $thumb_image = $listing->image;
                                    $gallery_images = $listing->gallery_images;
                                    $all_images_list = $thumb_image . '|' . $gallery_images;
                                    $images = explode("|", $all_images_list);
                                ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($img)): ?>
                                        <div class="single-main-image">
                                            <a href="#"
                                               data-mfp-src="<?php echo e(get_image_url_id_wise($img)); ?>"
                                               class="long-img image-link" tabindex="-1">
                                                <?php echo render_image_markup_by_attachment_id($img); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="single-main-image">
                                    <a href="#" class="long-img">
                                        <?php echo render_image_markup_by_attachment_id($listing->image); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Nav -->
                        <?php if(!is_null($listing->gallery_images)): ?>
                        <div class="thumb-wrap">
                            <div class="shop-details-gallery-nav global-slick-init slider-inner-margin sliderArrow"
                                 data-asNavFor=".shop-details-gallery-slider"
                                 data-focusOnSelect="true"
                                 data-infinite="false"
                                 data-arrows="false"
                                 data-dots="false"
                                 data-slidesToShow="6"
                                 data-autoplay="false"
                                 data-swipeToSlide="true"
                                 data-prevArrow='<div class="prev-icon"><i class="las la-angle-left"></i></div>'
                                 data-nextArrow='<div class="next-icon"><i class="las la-angle-right"></i></div>'
                                 data-responsive='[{"breakpoint": 1200,"settings": {"slidesToShow": 5}}, {"breakpoint": 992,"settings": {"slidesToShow": 4}}, {"breakpoint": 450,"settings": {"slidesToShow": 3}}, {"breakpoint": 350,"settings": {"slidesToShow": 2}}]'>

                                <?php
                                    $thumb_image = $listing->image;
                                    $gallery_images = $listing->gallery_images;
                                    $all_images_list = $thumb_image . '|' . $gallery_images;
                                    $images = explode("|", $all_images_list);
                                ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($img)): ?>
                                        <div class="single-thumb">
                                            <a class="thumb-link"
                                               data-mfp-src="<?php echo e(get_image_url_id_wise($img)); ?>"
                                               data-toggle="tab"
                                               href="#image-<?php echo e($img); ?>">
                                                <?php echo render_image_markup_by_attachment_id($img); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Google Adds left-->
                    <div class="googleAdd-wraper after-product-slider">
                        <div class="add">
                            <div class="text-<?php echo e($right_custom_container); ?> single-banner-ads ads-banner-box" id="home_advertisement_store">
                                <input type="hidden" id="add_id" value="<?php echo e($right_add_id); ?>">
                                <?php echo $right_add_markup; ?>

                            </div>
                        </div>
                    </div>

                    <!-- proDescription -->
                    <div class="proDescription box-shadow1">
                        <!-- Top -->
                        <div class="descriptionTop">
                            <div class="rower">
                                <?php if($listing->category && $listing->category->code != 1 && $listing->category->code != 2): ?>
                                    <?php if(!empty($listing->condition)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Condition:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->condition); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($listing->authenticity)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Authenticité:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->authenticity); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if(!empty($listing->brand)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-copyright"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Brand:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->brand?->title); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if($listing->category && $listing->category->code == 1): ?>
                                    <div class="col-4er">
                                        <div class="icon-container">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <div class="description-content">
                                            <p><?php echo e(__('Type de bien:')); ?></p>
                                            <span class="text-bold"><?php echo e($listing->type_bien); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-4er">
                                        <div class="icon-container">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="description-content">
                                            <p><?php echo e(__('Genre de bien:')); ?></p>
                                            <span class="text-bold"><?php echo e($listing->genre_bien); ?></span>
                                        </div>
                                    </div>

                                    <?php if(!empty($listing->surface)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-ruler"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Surface (m²):')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->surface); ?> m²</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->nbrs_piece)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-th"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nombre de pièces:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->nbrs_piece); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->nbrs_chambre)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-bed"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nombre de chambres:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->nbrs_chambre); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->nature_bien)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nature du bien:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->nature_bien); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->type_chambre)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-door-open"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Type de chambre:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->type_chambre); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->nbrs_colocataire)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nombre de colocataires:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->nbrs_colocataire); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->salle_bain)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-bath"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nombre de salles de bain:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->salle_bain); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->classe_energie)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-bolt"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Classe énergie:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->classe_energie); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->ges)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-leaf"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('GES:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->ges); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->etage_bien)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Nombre d\'étages:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->etage_bien); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->etage_batiment)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Étages du bâtiment:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->etage_batiment); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->statut_fumeur)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-smoking"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Statut fumeur:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->statut_fumeur); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($listing->animaux)): ?>
                                        <div class="col-4er">
                                            <div class="icon-container">
                                                <i class="fas fa-paw"></i>
                                            </div>
                                            <div class="description-content">
                                                <p><?php echo e(__('Animaux:')); ?></p>
                                                <span class="text-bold"><?php echo e($listing->animaux); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- attributes -->
                        <?php if($listing->listing_attributes->isNotEmpty()): ?>
                        <div class="devider"></div>
                        <div class="descriptionTop">
                            <h5 class="disTittle"><?php echo e(get_static_option('listing_attribute_section_title') ?? __('Attributes')); ?></h5>
                            <div class="rower">
                                <?php $__currentLoopData = $listing->listing_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-4er">
                                        <div class="icon-container">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="description-content">
                                            <p><?php echo e($attribute->title); ?></p>
                                            <span class="text-bold"><?php echo e($attribute->description); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="devider"></div>
                        
                        <!-- Mid -->
                        <div class="descriptionMid">
                            <h4 class="disTittle"><?php echo e(get_static_option('listing_description_title') ?? __('Description')); ?></h4>
                            <p class="pera" id="description"><?php echo Str::limit(str_replace('&nbsp;', ' ', strip_tags($listing->description)), 20000); ?></p>
                            <button id="showMoreButton" class="show-more-btn"><?php echo e(__('Show More')); ?></button>
                        </div>
                        
                        <!-- Footer -->
                        <div class="descriptionFooter">
                            <h4 class="disTittle"><?php echo e(get_static_option('listing_tag_title') ?? __('Tags')); ?></h4>
                            
                            <?php if(isset($listing->tags) && count($listing->tags) > 0): ?>
                                <?php if(!empty($listing->tags)): ?>
                                    <div class="tags">
                                        <form id="filter_with_listing_page_tag" action="<?php echo e(url(get_static_option('listing_filter_page_url') ?? '/listings')); ?>" method="get">
                                            <input type="hidden" name="tag_id" id="tag_id" value="" />
                                            <?php $__currentLoopData = $listing->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="#" class="submit_form_listing_filter_tag" data-tag-id="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Transaction Box -->
                        <div class="transaction-box">
                            <h4 class="disTittle"><?php echo e(__('Effectuer une transaction')); ?></h4> 
                            <p><?php echo e(__('Veuillez contacter l\'annonceur avant d\'effectuer une commande')); ?></p>
                            <ul> 
                                <li>
                                    <i class="fa fa-check-square" aria-hidden="true" style="color:#22C55E;"></i>
                                    <?php echo e(__('L\'annonceur reçoit l\'argent seulement après la réception du colis')); ?>

                                </li>
                                <li>
                                    <i class="fa fa-lock" aria-hidden="true" style="color:#22C55E;"></i>
                                    <?php echo e(__('Transactions sécurisées')); ?>

                                </li>
                            </ul>
                            
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <?php echo e(__('Passer à la commande')); ?>

                            </a>
                            
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body" style="border: none; background: transparent; padding: 16px 0;">
                                    <?php if(auth()->guard()->check()): ?>
                                        <form method="post" action="<?php echo e(route('user.transaction.add')); ?>" id="forme">
                                            <?php echo csrf_field(); ?>
                                            <input class="form-control form-control-lg" type="number" name="amount" id="amount" placeholder="<?php echo e(__('Montant de la transaction')); ?>" aria-label="Amount" required>
                                            <input type="hidden" name="ads" id="ads" value="<?php echo e($listing->id); ?>">
                                            <input type="hidden" name="transaction_id" value="<?php echo e($listing->id); ?>">
                                            <img src="https://developers.paydunya.com/images/bouton-senegal-02.png" width="150" alt="Payment">
                                            <button type="submit" class="btn btn-success"><?php echo e(__('Effectuer la transaction')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if(auth()->guard()->guest()): ?>
                                        <p><?php echo e(__('Veuillez vous connecter afin d\'effectuer des transactions de façon sécurisée.')); ?></p>
                                        <a href="<?php echo e(route('user.login')); ?>" class="btn btn-primary"><?php echo e(__('Se connecter')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>  
                        </div>
                    </div>

                    <!--for mobile device user info -->
                    <div class="seller-part mt-3 d-md-none">
                        <?php if (isset($component)) { $__componentOriginal2ba418b9da4fcd4a34a66694deaceae8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ba418b9da4fcd4a34a66694deaceae8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.user-listing-phone-for-responsive','data' => ['listing' => $listing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.user-listing-phone-for-responsive'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ba418b9da4fcd4a34a66694deaceae8)): ?>
<?php $attributes = $__attributesOriginal2ba418b9da4fcd4a34a66694deaceae8; ?>
<?php unset($__attributesOriginal2ba418b9da4fcd4a34a66694deaceae8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ba418b9da4fcd4a34a66694deaceae8)): ?>
<?php $component = $__componentOriginal2ba418b9da4fcd4a34a66694deaceae8; ?>
<?php unset($__componentOriginal2ba418b9da4fcd4a34a66694deaceae8); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalf0bb86bd9624b0e75536001cbc881705 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0bb86bd9624b0e75536001cbc881705 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.listing-details-page-user-info','data' => ['listing' => $listing,'userTotalListings' => $user_total_listings]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.listing-details-page-user-info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing),'userTotalListings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_total_listings)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0bb86bd9624b0e75536001cbc881705)): ?>
<?php $attributes = $__attributesOriginalf0bb86bd9624b0e75536001cbc881705; ?>
<?php unset($__attributesOriginalf0bb86bd9624b0e75536001cbc881705); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0bb86bd9624b0e75536001cbc881705)): ?>
<?php $component = $__componentOriginalf0bb86bd9624b0e75536001cbc881705; ?>
<?php unset($__componentOriginalf0bb86bd9624b0e75536001cbc881705); ?>
<?php endif; ?>
                    </div>
                    
                    <!--Relevant Ads-->
                    <?php echo $__env->make('frontend.pages.listings.relevant-listing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="seller-part">
                        <!--user info -->
                        <div class="d-none d-md-block">
                            <?php if (isset($component)) { $__componentOriginal21bbe37eea4f1ad1b015cea13499d16a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal21bbe37eea4f1ad1b015cea13499d16a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.user-listing-phone','data' => ['listing' => $listing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.user-listing-phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal21bbe37eea4f1ad1b015cea13499d16a)): ?>
<?php $attributes = $__attributesOriginal21bbe37eea4f1ad1b015cea13499d16a; ?>
<?php unset($__attributesOriginal21bbe37eea4f1ad1b015cea13499d16a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal21bbe37eea4f1ad1b015cea13499d16a)): ?>
<?php $component = $__componentOriginal21bbe37eea4f1ad1b015cea13499d16a; ?>
<?php unset($__componentOriginal21bbe37eea4f1ad1b015cea13499d16a); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalf0bb86bd9624b0e75536001cbc881705 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0bb86bd9624b0e75536001cbc881705 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.listing-details-page-user-info','data' => ['listing' => $listing,'userTotalListings' => $user_total_listings]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.listing-details-page-user-info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing),'userTotalListings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user_total_listings)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0bb86bd9624b0e75536001cbc881705)): ?>
<?php $attributes = $__attributesOriginalf0bb86bd9624b0e75536001cbc881705; ?>
<?php unset($__attributesOriginalf0bb86bd9624b0e75536001cbc881705); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0bb86bd9624b0e75536001cbc881705)): ?>
<?php $component = $__componentOriginalf0bb86bd9624b0e75536001cbc881705; ?>
<?php unset($__componentOriginalf0bb86bd9624b0e75536001cbc881705); ?>
<?php endif; ?>
                        </div>
                        
                        <!--Adds left-->
                        <?php if(get_static_option('google_adsense_status') == 'on'): ?>
                            <div class="googleAdd-wraper">
                                <div class="add">
                                    <div class="text-<?php echo e($custom_container); ?> single-banner-ads ads-banner-box" id="home_advertisement_store">
                                        <input type="hidden" id="add_id" value="<?php echo e($add_id); ?>">
                                        <?php echo $add_markup; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(get_static_option('safety_tips_info') !== null): ?>
                            <div class="safety-tips">
                                <h3 class="head5"><?php echo e(__('Conseils de sécurité')); ?></h3>
                                <div class="safety-wraper">
                                    <?php echo get_static_option('safety_tips_info'); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="share-on-wraper box-shadow1">
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <div class="text-center w-50 report-btn listing-details-page-favorite">
                                    <?php if (isset($component)) { $__componentOriginal3dfd35d741f1194aaa8a383da050a48b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3dfd35d741f1194aaa8a383da050a48b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.favorite-item-add-remove-for-details-page','data' => ['favorite' => $listing->id ?? 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.favorite-item-add-remove-for-details-page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['favorite' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing->id ?? 0)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3dfd35d741f1194aaa8a383da050a48b)): ?>
<?php $attributes = $__attributesOriginal3dfd35d741f1194aaa8a383da050a48b; ?>
<?php unset($__attributesOriginal3dfd35d741f1194aaa8a383da050a48b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3dfd35d741f1194aaa8a383da050a48b)): ?>
<?php $component = $__componentOriginal3dfd35d741f1194aaa8a383da050a48b; ?>
<?php unset($__componentOriginal3dfd35d741f1194aaa8a383da050a48b); ?>
<?php endif; ?>
                                </div>
                                <div class="report-btn w-50 text-center">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#reportModal">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 10H15L10.5 5.5L15 1H1V17" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span id="addReportModal"><?php echo e(__('Report')); ?></span>
                                    </a>
                                </div>
                            </div>

                            <div class="share-on">
                                <span class="social-icons">
                                    <?php
                                        $image_url = get_attachment_image_by_id($listing->image);
                                        $img_url = $image_url['img_url'] ?? '';
                                    ?>
                                    <?php echo single_post_share(route('frontend.listing.details',$listing->slug), $listing->title, $img_url); ?>

                                </span>
                            </div>
                        </div>

                        <?php echo $__env->make('frontend.pages.listings.frontend-business-hours', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('frontend.pages.listings.frontend-enquiry-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <?php if(!empty($listing->address)): ?>
                            <div class="map-wraper box-shadow1">
                                <h3 class="head5"><?php echo e(__('Adresse')); ?></h3>
                                <p><?php echo e($listing->address); ?></p>
                                <div class="map">
                                    <?php if(!empty(get_static_option("google_map_settings_on_off"))): ?>
                                        <div id="single-map-canvas" style="height: 230px; width: 100%; position: relative; overflow: hidden; border-radius: 12px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($listing->video_url)): ?>
                            <div class="map-wraper box-shadow1">
                                <h3 class="head5"><?php echo e(__('Video')); ?></h3>
                                <iframe width="100%" height="250" style="border-radius: 12px;"
                                        src="<?php echo e('https://www.youtube.com/embed/' . $listing->video_url); ?>"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('frontend.pages.listings.listing-report-add-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if (isset($component)) { $__componentOriginal964501a75ad6a8827e19b34c3befa121 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal964501a75ad6a8827e19b34c3befa121 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.login','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.login'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal964501a75ad6a8827e19b34c3befa121)): ?>
<?php $attributes = $__attributesOriginal964501a75ad6a8827e19b34c3befa121; ?>
<?php unset($__attributesOriginal964501a75ad6a8827e19b34c3befa121); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal964501a75ad6a8827e19b34c3befa121)): ?>
<?php $component = $__componentOriginal964501a75ad6a8827e19b34c3befa121; ?>
<?php unset($__componentOriginal964501a75ad6a8827e19b34c3befa121); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php if(!empty(get_static_option('google_map_settings_on_off'))): ?>
    <?php if (isset($component)) { $__componentOriginal3e936750d9b778705f3e18f41b1357de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3e936750d9b778705f3e18f41b1357de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.map.google-map-listing-details-page-js','data' => ['lat' => $listing->lat ?? 0,'lon' => $listing->lon ?? 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('map.google-map-listing-details-page-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['lat' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing->lat ?? 0),'lon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing->lon ?? 0)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3e936750d9b778705f3e18f41b1357de)): ?>
<?php $attributes = $__attributesOriginal3e936750d9b778705f3e18f41b1357de; ?>
<?php unset($__attributesOriginal3e936750d9b778705f3e18f41b1357de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3e936750d9b778705f3e18f41b1357de)): ?>
<?php $component = $__componentOriginal3e936750d9b778705f3e18f41b1357de; ?>
<?php unset($__componentOriginal3e936750d9b778705f3e18f41b1357de); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($user_enquiry_form == true): ?>
    <?php if (isset($component)) { $__componentOriginalcce2eb7d32c2bdd3ff8383067f270fb4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcce2eb7d32c2bdd3ff8383067f270fb4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.enquiry-form-submit-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.enquiry-form-submit-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcce2eb7d32c2bdd3ff8383067f270fb4)): ?>
<?php $attributes = $__attributesOriginalcce2eb7d32c2bdd3ff8383067f270fb4; ?>
<?php unset($__attributesOriginalcce2eb7d32c2bdd3ff8383067f270fb4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcce2eb7d32c2bdd3ff8383067f270fb4)): ?>
<?php $component = $__componentOriginalcce2eb7d32c2bdd3ff8383067f270fb4; ?>
<?php unset($__componentOriginalcce2eb7d32c2bdd3ff8383067f270fb4); ?>
<?php endif; ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal2722c5bff683d0b160c99671b96c7145 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2722c5bff683d0b160c99671b96c7145 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.listing-report-add-js','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.listing-report-add-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2722c5bff683d0b160c99671b96c7145)): ?>
<?php $attributes = $__attributesOriginal2722c5bff683d0b160c99671b96c7145; ?>
<?php unset($__attributesOriginal2722c5bff683d0b160c99671b96c7145); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2722c5bff683d0b160c99671b96c7145)): ?>
<?php $component = $__componentOriginal2722c5bff683d0b160c99671b96c7145; ?>
<?php unset($__componentOriginal2722c5bff683d0b160c99671b96c7145); ?>
<?php endif; ?>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.min.js')); ?>"></script>
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
                    url: "<?php echo e(route('frontend.listing.load-more-relevant')); ?>",
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
                    showMoreButton.textContent = '<?php echo e(__("Show Less")); ?>';
                } else {
                    description.textContent = description.textContent.substring(0, 700) + '...';
                    showMoreButton.textContent = '<?php echo e(__("Show More")); ?>';
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
                    alert('<?php echo e(__("Veuillez remplir tous les champs correctement avant de soumettre le formulaire.")); ?>');
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/frontend/pages/listings/listing-details.blade.php ENDPATH**/ ?>