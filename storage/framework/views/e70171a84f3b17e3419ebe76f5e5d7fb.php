<style>
.slider, 
.slider > div {
    /* Images default to Center Center. Maybe try 'center top'? */
    background-position: center center;
    display: block;
    width: 100%;
    height: 300px;
    /* height: 100vh; *//* If you want fullscreen */
    position: relative;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: #000;
    overflow: hidden;
    -moz-transition: transform .4s;
    -o-transition: transform .4s;
    -webkit-transition: transform .4s;
    transition: transform .4s;
}

.slider > div {
    position: absolute;
}

.slider > i {
    color: rgba(91, 189, 114, 0.1); 
    position: absolute;
    font-size: 60px;
    margin: 20px;
    top: 40%;
    text-shadow: 0 10px 2px #223422;
    transition: .3s;
    width: 30px;
    padding: 10px 13px;
    background: #fff;
    background: rgba(255, 255, 255, .1);
    cursor: pointer;
    line-height: 0;
    box-sizing: content-box;
    border-radius: 3px;
    z-index: 4;
}

.slider > i svg {
    margin-top: 3px;
}

.slider > .left {
    left: -100px;
}
.slider > .right {
    right: -100px;
}
.slider:hover > .left {
    left: 0;
}
.slider:hover > .right {
    right: 0;
}

.slider > i:hover {
    background:#fff;
    background: rgba(255, 255, 255, .8);
    transform: translateX(-2px);
}

.slider > i.right:hover {
    transform: translateX(2px);
}

.slider > i.right:active,
.slider > i.left:active {
    transform: translateY(1px);
}

.slider:hover > div {
    transform: scale(1.01);
}

.hoverZoomOff:hover > div {
    transform: scale(1);
}

.slider > ul {
    position: absolute;
    bottom: 10px;
    left: 50%;
    z-index: 4;
    padding: 0;
    margin: 0;
    transform: translateX(-50%);
}

.slider > ul > li {
    padding: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    list-style: none;
    float: left;
    margin: 10px 10px 0;
    cursor: pointer;
    border: 1px solid #fff;
    -moz-transition: .3s;
    -o-transition: .3s;
    -webkit-transition: .3s;
    transition: .3s;
}

.slider > ul > .showli {
    background-color: #7EC03D;
    -moz-animation: boing .5s forwards;
    -o-animation: boing .5s forwards;
    -webkit-animation: boing .5s forwards;
    animation: boing .5s forwards;
}

.slider > ul > li:hover {
    background-color: #7EC03D;
}



.hideDots > ul {
    display: none;
}

.showArrows > .left {
    left: 0;
}

.showArrows > .right {
    right: 0;
}

.titleBar {
    z-index: 2;
    display: inline-block;
    background: rgba(0,0,0,.5);
    position: absolute;
    width: 100%;
    bottom: 0;
    transform: translateY(100%);
    padding: 20px 30px;
    transition: .3s;
    color: #fff;
}

.titleBar * {
    transform: translate(-20px, 30px);
    transition: all 700ms cubic-bezier(0.37, 0.31, 0.2, 0.85) 200ms;
    opacity: 0;
}

.titleBarTop .titleBar * {
    transform: translate(-20px, -30px);
}

.slider:hover .titleBar,
.slider:hover .titleBar * {
    transform: translate(0);
    opacity: 1;
}

.titleBarTop .titleBar {
    top: 0;
    bottom: initial;
    transform: translateY(-100%);
}

.slider > div .span {
    display: block;
    background: rgba(255,255,255,.5);
    position: absolute;
    top: 30%;
    left:20%;
    color: black;
    font-size:"Inter Tight", sans-serif;
    padding: 20px;
    max-width: 50%;

}
.slider > div .span h3{
    color: black;
    font-size:"Inter Tight", sans-serif;
}
.slider > div .span p{
    color: black;
    font-size:"Inter Tight", sans-serif;
}


@keyframes boing {
    0% {
        transform: scale(1.2);
    }
    40% {
        transform: scale(.6);
    }
    60% {
        transform: scale(1.2);
    }
    80% {
        transform: scale(.8);
    }
    100% {
        transform: scale(1);
    }
}

/* -------------------------------------- */

#slider2 {
    max-width: 30%;
    margin-right: 20px;
}

.row2Wrap {
    display: flex;
}

.content {
    padding: 50px;
    margin-bottom: 100px;
}



.content {
    padding: 10px 15vw;
}
@media (max-width: 768px) {
   .slider > div .span {
    display: block;
    background: rgba(255, 255, 255, 0.5);
    position: absolute;
    top: 10%; /* Contrôle la position verticale */
    left: 0;
    right: 0;
    margin: auto; /* Centre horizontalement */
    color: black;
    font-family: "Inter Tight", sans-serif; /* Corrigé */
    padding: 20px;
    max-width: 80%; /* Contrôle la largeur maximale */
    text-align: center; /* Optionnel : centre le texte à l'intérieur */
}
}

.slider > div .span h3 {
    display: inline-block;
    width: 100%; /* Prend toute la largeur de .span */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

 .slider > div .span p {
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limite de lignes */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

</style>
<div class="slider" id="slider3">
<?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div style="background-image:url(https://www.tutrouve.com/core/public/sliders/<?php echo e($slide->image); ?>); cursor:pointer;" <?php if($slide->link): ?> onclick="window.location.href='<?php echo e($slide->link); ?>'"  <?php endif; ?>>
<?php if($slide->titre || $slide->description): ?> <span class="span"><h3><?php echo e($slide->titre); ?></h3><p><?php echo e($slide->description); ?></p></span><?php endif; ?></div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- The Arrows
        <i class="left" class="arrows" style="z-index:2; position:absolute;"><svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path></svg></i>
        <i class="right" class="arrows" style="z-index:2; position:absolute;">
      <svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180) "></path></svg></i> -->
    </div>


<!--Banner part Start
<div class="home-banner" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>" <?php echo $background_image; ?>>
    <div class="container-1920 position-relative plr">
        <div class="letf-part-img">
            <div class="img-wraper">
                <?php if(isset($banner_left_images_01['banner_left_images_'])): ?>
                    <?php $__currentLoopData = $banner_left_images_01['banner_left_images_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner_left_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($banner_left_image)): ?>
                            <?php $image_key = $key+1  ?>
                            <div class="img<?php echo e($image_key); ?> imges">
                                <?php echo render_image_markup_by_attachment_id($banner_left_images_01['banner_left_images_'][$key]); ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="right-part-img">
            <div class="img-wraper">
                <?php if(isset($banner_right_images_02['banner_right_images_'])): ?>
                    <?php $__currentLoopData = $banner_right_images_02['banner_right_images_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner_right_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($banner_right_image)): ?>
                            <?php $image_right_key = $key+1  ?>
                            <div class="img<?php echo e($image_right_key); ?> imges">
                                <?php echo render_image_markup_by_attachment_id($banner_right_images_02['banner_right_images_'][$key]); ?>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="banner-wraper">
            <div class="banner-text">
                <div class="top-text text-center">
                    <?php echo $top_image; ?>

                    <?php echo e($top_title); ?>

                </div>
                <h1 class="banner-main-head text-center"> <?php echo e($title); ?> </h1>
                <p class="text text-center"><?php echo e($subtitle); ?></p>
            </div>
            <div class="banner-form">
                <form  action="<?php echo e(get_static_option('listing_filter_page_url') ?? '/listings'); ?>" class="d-flex align-items-center banner-search-location" method="get">
                    <div class="banner-form-wraper align-items-center">
                        <?php if(!empty(get_static_option('google_map_settings_on_off'))): ?>
                            <div class="new_banner__search__input">
                                <div class="new_banner__search__location_left" id="myLocationGetAddress">
                                    <i class="fa-solid fa-location-crosshairs fs-4"></i>
                                </div>
                                <input class="form--control" name="change_address_new" id="change_address_new" type="hidden" value="">
                                <input class="banner-input-field w-100" name="autocomplete" id="autocomplete" type="text" placeholder="<?php echo e(__('Search location here')); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="search-with-any-texts">
                            <input class="banner-input-field w-100" type="text" name="home_search" id="home_search" placeholder="<?php echo e(__('What are you looking for?')); ?>">
                            <span id="all_search_result" class="search_with_text_section"></span>
                        </div>
                    </div>
                    <div class="banner-btn">
                        <button type="submit" class="new-cmn-btn rounded-red-btn setLocation_btn border-0"><?php echo e(get_static_option('search_button_title') ?? __('Search')); ?> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>-->
<!--Banner part End-->

<?php /**PATH /home/tutreqhl/beta.tutrouve.com/core/app/Providers/../../plugins/PageBuilder/views/headers/style-one.blade.php ENDPATH**/ ?>