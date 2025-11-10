<!-- Hero Slider Section - Keep Original Design -->
@php
    $sliders = App\Models\Slider::all();
@endphp

@if($sliders->count() > 0)
<div class="tutslider-wrapper">
    <div class="tutslider" id="tutslider3">
        @foreach($sliders as $slide)
        <div class="tutslider-slide" style="background-image:url({{ asset('sliders/' . $slide->image) }});" 
             @if($slide->link) onclick="window.location.href='{{ $slide->link }}'" @endif>
            @if($slide->titre || $slide->description) 
            <span class="tutslider-textbox">
                <h3>{{ $slide->titre }}</h3>
                <p>{{ $slide->description }}</p>
            </span>
            @endif
        </div>
        @endforeach
        
        <!-- Navigation Arrows -->
        <i class="tutslider-left tutslider-arrows">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z"></path>
            </svg>
        </i>
        <i class="tutslider-right tutslider-arrows">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50 L 70,10 L 60,0 Z" transform="translate(100, 100) rotate(180)"></path>
            </svg>
        </i>
    </div>
</div>
@endif
