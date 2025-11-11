@extends('frontend.layout.master')
@section('site_title')
    {{ __('Listing Favorite') }}
@endsection
@section('content')
    <div class="profile-setting my-account section-padding2" style="background: linear-gradient(135deg, #f8faf9 0%, #e8f4f3 100%); min-height: 100vh;">
        <div class="container-1920 plr1">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="profile-setting-wraper modern-dashboard">
                      @include('frontend.user.layout.partials.user-profile-background-image')
                        <div class="down-body-wraper">
                            @include('frontend.user.layout.partials.sidebar')
                            <div class="main-body">
                                <x-frontend.user.responsive-icon/>
                                @if(moduleExists('Membership'))
                                    @if(membershipModuleExistsAndEnable('Membership'))
                                        @include('membership::frontend.user.membership.user-dashboard-membership-message')
                                    @endif
                                @endif
                                <!--Seller Part-->
                                <div class="seller-part">
                                    <div class="seller-part-inner style-01 box-shadow1">
                                        <div class="seller-details">
                                            <div class="seller-details-wraper">
                                                <div class="seller-img">
                                                    @if(!empty($user->image))
                                                        {!! render_image_markup_by_attachment_id($user->image) !!}
                                                    @else
                                                        <img src="{{ asset('assets/frontend/img/static/user-no-image.webp') }}" alt="No Image">
                                                    @endif
                                                </div>
                                                <div class="seller-name">
                                                    <div class="name">
                                                        <span>{{ $user->fullname }}</span>
                                                        <x-badge.user-verified-badge :user="$user"/>
                                                    </div>
                                                    <div class="member-listing">
                                                        <span class="listing">{{ $user_ads_posted }} {{ __('listing') }} </span>
                                                        <span class="dot"></span> {{ __('Member since') }} {{ optional($user->created_at)->format('Y') }}
                                                    </div>
                                                    <div class="seller-ratings mt-3">
                                                        @if($averageRating >=1)
                                                            <a href="javascript:void(0)" class="author_tag__review__star"> {!! ratting_star(round($averageRating, 1)) !!} </a>
                                                            <a href="javascript:void(0)" class="author_tag__review__para">  ({{ $user_review_count }}) </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edit-btn">
                                                <a href="{{ route('user.profile') }}">{{ __('Edit Profile') }}</a>
                                            </div>
                                        </div>
                                        <div class="devider"></div>

                                        <div class="seller-contact">
                                            @if(!empty($user->address) || !empty($user->country_id) || !empty($user->state_id) || !empty($user->city_id))
                                                <div class="locations">
                                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.49967 7.16667C5.49967 7.82971 5.76307 8.4656 6.23191 8.93444C6.70075 9.40328 7.33663 9.66667 7.99967 9.66667C8.66272 9.66667 9.2986 9.40328 9.76744 8.93444C10.2363 8.4656 10.4997 7.82971 10.4997 7.16667C10.4997 6.50363 10.2363 5.86774 9.76744 5.3989C9.2986 4.93006 8.66272 4.66667 7.99967 4.66667C7.33663 4.66667 6.70075 4.93006 6.23191 5.3989C5.76307 5.86774 5.49967 6.50363 5.49967 7.16667Z" stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12.7138 11.8808L9.17801 15.4167C8.8655 15.7289 8.44183 15.9042 8.00009 15.9042C7.55836 15.9042 7.13469 15.7289 6.82218 15.4167L3.28551 11.8808C2.3532 10.9485 1.71829 9.76058 1.46108 8.46739C1.20388 7.17419 1.33592 5.83376 1.84051 4.61561C2.34511 3.39745 3.19959 2.35628 4.29591 1.62376C5.39223 0.891229 6.68115 0.500244 7.99968 0.500244C9.31821 0.500244 10.6071 0.891229 11.7034 1.62376C12.7998 2.35628 13.6542 3.39745 14.1588 4.61561C14.6634 5.83376 14.7955 7.17419 14.5383 8.46739C14.2811 9.76058 13.6462 10.9485 12.7138 11.8808Z" stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <span>{!! userProfileLocation($user) !!}</span>
                                                </div>
                                            @endif

                                            <div class="emails">
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.5 2.83335C0.5 2.39133 0.675595 1.9674 0.988155 1.65484C1.30072 1.34228 1.72464 1.16669 2.16667 1.16669H13.8333C14.2754 1.16669 14.6993 1.34228 15.0118 1.65484C15.3244 1.9674 15.5 2.39133 15.5 2.83335M0.5 2.83335V11.1667C0.5 11.6087 0.675595 12.0326 0.988155 12.3452C1.30072 12.6578 1.72464 12.8334 2.16667 12.8334H13.8333C14.2754 12.8334 14.6993 12.6578 15.0118 12.3452C15.3244 12.0326 15.5 11.6087 15.5 11.1667V2.83335M0.5 2.83335L8 7.83335L15.5 2.83335" stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg> <span>{{ $user->email }}</span>
                                            </div>
                                            <div class="phones">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.16667 1.33331H5.5L7.16667 5.49998L5.08333 6.74998C5.9758 8.55959 7.44039 10.0242 9.25 10.9166L10.5 8.83331L14.6667 10.5V13.8333C14.6667 14.2753 14.4911 14.6993 14.1785 15.0118C13.866 15.3244 13.442 15.5 13 15.5C9.74939 15.3024 6.68346 13.9221 4.38069 11.6193C2.07792 9.31652 0.697541 6.25059 0.5 2.99998C0.5 2.55795 0.675595 2.13403 0.988155 1.82147C1.30072 1.50891 1.72464 1.33331 2.16667 1.33331Z" stroke="#1E293B" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span> {{ $user->phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Add Listing States-->
                                <div class="all-list-state mt-20">
                                    <div class="row g-3">
                                        <div class="col-md-3 col-md-3 col-6">
                                            <div class="list-state ad-posted">
                                                <h4 class="list-head">{{ $user_ads_posted }}</h4>
                                                <p class="post-state">{{ __('Ads Posted') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-md-3 col-6">
                                            <div class="list-state active-posted">
                                                <h4 class="list-head">{{ $user_active_listings }}</h4>
                                                <p class="post-state">{{ __('Active Listing') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-md-3 col-6">
                                            <div class="list-state deactivated-posted">
                                                <h4 class="list-head">{{  $user_deactivated_ads }}</h4>
                                                <p class="post-state">{{ __('Deactive Ads') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-md-3 col-6">
                                            <div class="list-state favorit-posted">
                                                <h4 class="list-head">{{ $user_favorite_ads }}</h4>
                                                <p class="post-state">{{ __('Favorite Ads') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--All Reviews-->
                                <div class="all-reviews box-shadow1 mt-20">
                                    <h4 class="dis-title">{{ __('All Reviews') }}</h4>
                                    <div class="review-tab-btn">
                                        <button class="review-recived me-4 active" data-target="#review-recived">{{ __('Reviews Received') }}</button>
                                        <button class="review-given" data-target="#review-given">{{ __('Reviews Given') }}</button>
                                    </div>
                                    <div class="review-wraper mt-20 active" id="review-recived">
                                        @if($user->reviews)
                                            @php
                                                $review_type = 'received';
                                            @endphp
                                            <x-user.user-reviews :reviews="$user->reviews" :user="$user" :reviewtype="$review_type"/>
                                        @endif
                                    </div>

                                    <div class="review-wraper mt-20" id="review-given">
                                        @if($user_given_reviews)
                                            @php
                                                $review_type = 'given';
                                            @endphp
                                            <x-user.user-reviews :reviews="$user_given_reviews" :user="$user" :reviewtype="$review_type"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
@endsection

<style>
/* ============================================
   MODERN DASHBOARD - DESIGN AMÉLIORÉ
   Fond clair, éléments foncés, bordures arrondies
   ============================================ */

/* Global Dashboard Styles */
.modern-dashboard {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Sidebar Menu Modern Design */
.sidebar-menu-wraper.box-shadow1 {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid rgba(31, 62, 57, 0.08);
    box-shadow: 0 8px 32px rgba(31, 62, 57, 0.08);
    padding: 24px 16px;
    backdrop-filter: blur(10px);
    animation: slideInLeft 0.5s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.sidebar-menu-wraper .menu-item {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    margin-bottom: 8px;
    border-radius: 14px;
    background: transparent;
    color: #475569;
    font-weight: 500;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid transparent;
    position: relative;
    overflow: hidden;
}

.sidebar-menu-wraper .menu-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(31, 62, 57, 0.05), transparent);
    transition: left 0.5s ease;
}

.sidebar-menu-wraper .menu-item:hover::before {
    left: 100%;
}

.sidebar-menu-wraper .menu-item:hover {
    background: rgba(31, 62, 57, 0.05);
    border-color: rgba(31, 62, 57, 0.1);
    transform: translateX(6px);
    box-shadow: 0 4px 12px rgba(31, 62, 57, 0.08);
}

.sidebar-menu-wraper .menu-item.active {
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border-color: #1F3E39;
    box-shadow: 0 6px 20px rgba(31, 62, 57, 0.25);
    transform: translateX(8px);
}

.sidebar-menu-wraper .menu-item.active svg path {
    stroke: #ffffff;
}

.sidebar-menu-wraper .menu-item svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.sidebar-menu-wraper .menu-item:hover svg {
    transform: scale(1.15) rotate(5deg);
}

.sidebar-menu-wraper .menu-item.active svg {
    transform: scale(1.1);
}

/* Main Body Content */
.main-body {
    animation: fadeInUp 0.6s ease-out 0.2s both;
}

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

/* Seller Part - Profile Card */
.seller-part .seller-part-inner.style-01.box-shadow1 {
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid rgba(31, 62, 57, 0.08);
    box-shadow: 0 12px 48px rgba(31, 62, 57, 0.1);
    padding: 32px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: scaleIn 0.5s ease-out 0.3s both;
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.seller-part .seller-part-inner:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 56px rgba(31, 62, 57, 0.15);
}

.seller-part .seller-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #1F3E39;
    box-shadow: 0 8px 24px rgba(31, 62, 57, 0.2);
    transition: all 0.3s ease;
    position: relative;
}

.seller-part .seller-img::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(31, 62, 57, 0.2), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.seller-part .seller-img:hover::after {
    opacity: 1;
}

.seller-part .seller-img:hover {
    transform: scale(1.08) rotate(3deg);
    box-shadow: 0 12px 32px rgba(31, 62, 57, 0.3);
}

.seller-part .seller-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.seller-part .seller-name .name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1F3E39;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.seller-part .member-listing {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

.seller-part .member-listing .dot {
    display: inline-block;
    width: 4px;
    height: 4px;
    background: #64748b;
    border-radius: 50%;
    margin: 0 8px;
    vertical-align: middle;
}

.seller-part .edit-btn a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border-radius: 14px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    border: 2px solid transparent;
    box-shadow: 0 6px 20px rgba(31, 62, 57, 0.2);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.seller-part .edit-btn a:hover {
    background: linear-gradient(135deg, #2d5850 0%, #1F3E39 100%);
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(31, 62, 57, 0.3);
}

.seller-part .devider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(31, 62, 57, 0.15), transparent);
    margin: 24px 0;
}

.seller-part .seller-contact > div {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    background: rgba(31, 62, 57, 0.03);
    border-radius: 12px;
    margin-bottom: 10px;
    color: #334155;
    font-weight: 500;
    transition: all 0.3s ease;
}

.seller-part .seller-contact > div:hover {
    background: rgba(31, 62, 57, 0.08);
    transform: translateX(6px);
}

.seller-part .seller-contact svg {
    flex-shrink: 0;
}

/* Statistics Cards */
.all-list-state {
    animation: fadeInUp 0.6s ease-out 0.4s both;
}

.all-list-state .list-state {
    background: #ffffff;
    border-radius: 20px;
    padding: 28px 24px;
    text-align: center;
    border: 1px solid rgba(31, 62, 57, 0.08);
    box-shadow: 0 8px 32px rgba(31, 62, 57, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.all-list-state .list-state::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #1F3E39, #2d5850);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.all-list-state .list-state:hover::before {
    opacity: 1;
}

.all-list-state .list-state:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 16px 48px rgba(31, 62, 57, 0.15);
    border-color: #1F3E39;
}

.all-list-state .list-state.ad-posted {
    background: linear-gradient(135deg, #ffffff 0%, #f0f9f4 100%);
}

.all-list-state .list-state.active-posted {
    background: linear-gradient(135deg, #ffffff 0%, #e8f5e9 100%);
}

.all-list-state .list-state.deactivated-posted {
    background: linear-gradient(135deg, #ffffff 0%, #fff3e0 100%);
}

.all-list-state .list-state.favorit-posted {
    background: linear-gradient(135deg, #ffffff 0%, #fce4ec 100%);
}

.all-list-state .list-head {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1F3E39;
    margin: 0 0 8px 0;
    line-height: 1;
    background: linear-gradient(135deg, #1F3E39, #2d5850);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: countUp 1s ease-out;
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.all-list-state .post-state {
    font-size: 0.9rem;
    font-weight: 600;
    color: #64748b;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Reviews Section */
.all-reviews.box-shadow1 {
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid rgba(31, 62, 57, 0.08);
    box-shadow: 0 12px 48px rgba(31, 62, 57, 0.1);
    padding: 32px;
    animation: fadeInUp 0.6s ease-out 0.5s both;
}

.all-reviews .dis-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1F3E39;
    margin: 0 0 24px 0;
}

.all-reviews .review-tab-btn {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    border-bottom: 2px solid rgba(31, 62, 57, 0.08);
    padding-bottom: 16px;
}

.all-reviews .review-tab-btn button {
    padding: 12px 24px;
    background: transparent;
    color: #64748b;
    border: 2px solid transparent;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.all-reviews .review-tab-btn button:hover {
    background: rgba(31, 62, 57, 0.05);
    color: #1F3E39;
}

.all-reviews .review-tab-btn button.active {
    background: linear-gradient(135deg, #1F3E39 0%, #2d5850 100%);
    color: #ffffff;
    border-color: #1F3E39;
    box-shadow: 0 6px 20px rgba(31, 62, 57, 0.2);
    transform: translateY(-2px);
}

.all-reviews .review-wraper {
    display: none;
    animation: fadeIn 0.4s ease-out;
}

.all-reviews .review-wraper.active {
    display: block;
}

/* Responsive Improvements */
@media (max-width: 768px) {
    .sidebar-menu-wraper.box-shadow1 {
        margin-bottom: 24px;
    }
    
    .seller-part .seller-part-inner.style-01.box-shadow1 {
        padding: 24px;
    }
    
    .seller-part .seller-details-wraper {
        flex-direction: column;
        text-align: center;
    }
    
    .all-list-state .list-state {
        margin-bottom: 16px;
    }
    
    .all-reviews.box-shadow1 {
        padding: 24px 16px;
    }
    
    .all-reviews .review-tab-btn {
        flex-direction: column;
    }
}

/* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading Animation */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.loading-overlay.hidden {
    opacity: 0;
    pointer-events: none;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(31, 62, 57, 0.1);
    border-top-color: #1F3E39;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Hover Effects on Icons */
svg {
    transition: all 0.3s ease;
}

.menu-item:hover svg,
.seller-contact > div:hover svg {
    transform: scale(1.1) rotate(5deg);
}

/* Badge Animations */
.badge {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

/* Success Messages */
.alert {
    border-radius: 16px;
    border: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    animation: slideDown 0.4s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom Scrollbar */
.main-body::-webkit-scrollbar {
    width: 8px;
}

.main-body::-webkit-scrollbar-track {
    background: rgba(31, 62, 57, 0.05);
    border-radius: 10px;
}

.main-body::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #1F3E39, #2d5850);
    border-radius: 10px;
}

.main-body::-webkit-scrollbar-thumb:hover {
    background: #1F3E39;
}

/* Shimmer Effect for Loading */
@keyframes shimmer {
    0% {
        background-position: -1000px 0;
    }
    100% {
        background-position: 1000px 0;
    }
}

.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}
</style>
