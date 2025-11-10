@extends('frontend.layout.master')

@section('content')
    <!-- Hero Section - Garder le design existant -->
    @include('frontend.pages.sections.hero')

    <!-- Top Annonces / Featured Listings Section -->
    @include('frontend.pages.sections.top-listings')

    <!-- Categories Browse Section -->
    @include('frontend.pages.sections.browse-categories')

    <!-- Recent Listings Section -->
    @include('frontend.pages.sections.recent-listings')

    <!-- Call To Action Section -->
    @include('frontend.pages.sections.cta')

@endsection
