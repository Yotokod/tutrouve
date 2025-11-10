@if($all_enquiries->count() > 0)
    <table class="table">
        <thead class="table-light">
        <tr>
            <th>{{ __('Id') }}</th>
            <th>{{ __('Nom') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Téléphone') }}</th>
            <th>{{ __('Méssage') }}</th>
            <th>{{ __('Created At') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_enquiries as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->message }}</td>
                <td>{{ $data->created_at->format('Y-m-d') ?? '' }} </td>
                <td class="action-table-cell">
                    <x-popup.delete-popup :url="route('user.enquiry.form.delete',$data->id)"/>
                    @if(!empty($data->listing))
                        <div class="btn-wrapper">
                            <a class="cmn-btn2 cmn-btn-info" href="{{ route('frontend.listing.details', $data->listing?->slug ?? 'x') }}" target="_blank">{{ __('Voir l\'annonce') }}</a>
                        </div>
                    @else
                        <span>{{ __('Pas encore d\'annonce') }}</span>
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="deposit-history-pagination mt-4">
        <x-pagination.laravel-paginate :allData="$all_enquiries"/>
    </div>
@else
    <x-pagination.empty-data-placeholder :title="__('Aucune demande pour le moment')"/>
@endif

