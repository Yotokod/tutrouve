<?php $__env->startSection('site-title'); ?>
    <?php if($child_category !=''): ?>
        <?php echo e($child_category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php if($child_category !=''): ?>
        <?php echo e($child_category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('inner-title'); ?>
    <?php if($child_category !=''): ?>
        <?php echo e($child_category->name); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <?php echo render_page_meta_data_for_child_category($child_category); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="catagory-wise-listing section-padding2">
        <div class="container-1440">
            <?php if (isset($component)) { $__componentOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1886b76dac2bd4a55dfc12d1a06ee6e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb.user-profile-breadcrumb','data' => ['title' => '','innerTitle' => $child_category->category?->name,'subInnerTitle' => $child_category->subcategory?->name,'chidInnerTitle' => $child_category->name,'routeName' => route('frontend.show.listing.by.category', $child_category->category?->slug ?? 'x'),'subRouteName' => route('frontend.show.listing.by.subcategory', $child_category->subcategory?->slug ?? 'x')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('breadcrumb.user-profile-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'innerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child_category->category?->name),'subInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child_category->subcategory?->name),'chidInnerTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($child_category->name),'routeName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.show.listing.by.category', $child_category->category?->slug ?? 'x')),'subRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('frontend.show.listing.by.subcategory', $child_category->subcategory?->slug ?? 'x'))]); ?>
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

            <?php if(!is_null($child_category->description)): ?>
            <div class="row g-4 mt-4">
                <div class="col-12">
                    <div class="category_info_new mb-5 mt-2">
                        <?php echo $child_category->description; ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <section class="featureListing mb-5 mt-5">
                        <div class="container-1440">
                            <div class="titleWithBtn d-flex justify-content-between align-items-center mb-40">
                                <h3 class="catagory-wise-title"><?php echo e(sprintf(__('Available Listings in :child_category', ['child_category' => $child_category->name]))); ?></h3>
                                <form id="filter_with_listing_page_subcategory" action="<?php echo e(url('/') .'/'. get_static_option('listing_filter_page_url') ?? url('/listings')); ?>" method="get">
                                    <input type="hidden" name="cat" value="<?php echo e($child_category->category_id); ?>"/>
                                    <input type="hidden" name="subcat" value="<?php echo e($child_category->sub_category_id); ?>"/>
                                    <input type="hidden" name="child_cat" value="<?php echo e($child_category->id); ?>"/>
                                    <a href="#" id="submit_form_listing_filter_subcategory" class="see-all"><?php echo e(__('See All')); ?><i class="las la-angle-right"></i></a>
                                </form>
                            </div>
                            <div class="slider-inner-margin">
                                <?php if (isset($component)) { $__componentOriginal5d6be7b7c18d78de17591c73d7917c83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d6be7b7c18d78de17591c73d7917c83 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.listings.listing-single','data' => ['listings' => $all_listings]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listings.listing-single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_listings)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d6be7b7c18d78de17591c73d7917c83)): ?>
<?php $attributes = $__attributesOriginal5d6be7b7c18d78de17591c73d7917c83; ?>
<?php unset($__attributesOriginal5d6be7b7c18d78de17591c73d7917c83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d6be7b7c18d78de17591c73d7917c83)): ?>
<?php $component = $__componentOriginal5d6be7b7c18d78de17591c73d7917c83; ?>
<?php unset($__componentOriginal5d6be7b7c18d78de17591c73d7917c83); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
         </div>
     </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tutreqhl/public_html/core/resources/views/frontend/pages/listings/category/child-category-wise-listings.blade.php ENDPATH**/ ?>