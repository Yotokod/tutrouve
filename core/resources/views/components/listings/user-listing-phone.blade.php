<div class="seller-phone text-center">
    <p>{{ __('Phone') }}</p>
    <span type="text" id="default_phone_number_show" class="number">{{ __('+XX XXX XXX XX') }}</span>
    @if($listing->phone_hidden == 0)
         <div class="number" id="phoneNumber">{{ $listing->phone }}</div>
        <a href="#" class="show-number" id="userPhoneNumberBtn">{{ get_static_option('listing_show_phone_number_title') ?? __('Afficher') }}</a>
    @endif
</div>
