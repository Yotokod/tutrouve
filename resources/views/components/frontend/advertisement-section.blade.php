@props(['slot' => 'default'])

@php
    $advertisement = \App\Models\Backend\Advertisement::where('slot', $slot)
                        ->where('status', 1)
                        ->first();
@endphp

@if($advertisement)
    <div class="advertisement-area my-4">
        <div class="container-1440">
            @if($advertisement->type === 'image')
                <a href="{{ $advertisement->redirect_url }}" target="_blank" class="d-block text-center" id="home_advertisement_store">
                    <img src="{{ get_attachment_image_by_id($advertisement->image)['img_url'] }}" alt="Advertisement">
                    <input type="hidden" id="add_id" value="{{ $advertisement->id }}">
                </a>
            @elseif($advertisement->type === 'google_adsense')
                {!! $advertisement->embed_code !!}
            @else
                {!! $advertisement->embed_code !!}
            @endif
        </div>
    </div>
@endif