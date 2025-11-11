<div class="admin-listings-table-modern">
<table class="dataTablesExample">
    <thead>
    @can('user-listing-bulk-delete')
        <th class="no-sort">
            <div class="mark-all-checkbox">
                <input type="checkbox" class="all-checkbox">
            </div>
        </th>
    @endcan
    <th>{{__('ID')}}</th>
    <th>{{__('Image')}}</th>
    <th>{{__('Titre')}}</th>
    <th>{{__('Catégorie')}}</th>
    @if(empty(get_static_option('google_map_settings_on_off')))
         <th>{{__('Pays')}}</th>
    @endif
    <th>{{__('Prix')}}</th>
    <th>{{__('Utilisateur')}}</th>
    <th>{{__('Date création')}}</th>
    <th>{{__('Date publication')}}</th>
    <th>{{__('Statut publication')}}</th>
    <th>
        {{__('Statut')}}
        @can('user-listing-approved')
        <span><x-status.all-status-change :url="route('admin.listings.user.all.approved')"/></span>
        @endcan
    </th>
    <th>{{__('Actions')}}</th>
    </thead>
    <tbody>
    @foreach($all_listings as $data)
        <tr>
            @can('user-listing-bulk-delete')
                <td>
                    <x-bulk-action.bulk-delete-checkbox :id="$data->id"/>
                </td>
            @endcan
            <td><strong>#{{$data->id}}</strong></td>
            <td>
                {!! render_image_markup_by_attachment_id($data->image,'','thumb') !!}
            </td>
            <td>
                <a href="{{route('admin.listings.details',$data->id)}}" style="color: #1F3E39; font-weight: 600; text-decoration: none;">
                    {{$data->title}}
                </a>
            </td>
            <td>{{optional($data->category)->name}}</td>
            @if(empty(get_static_option('google_map_settings_on_off')))
                <td>{{optional($data->country)->country}}</td>
            @endif
            <td><strong style="color: #1F3E39;">{{ float_amount_with_currency_symbol($data->price) }}</strong></td>
            <td>{{optional($data->user)->fullname}}</td>
            <td>
                <small style="color: #64748B;">{{ $data->created_at->diffForHumans() }}</small>
            </td>
            <!--Publish -->
            <td>
                <small style="color: #64748B;">
                    {{ $data->is_published == 1 ? \Carbon\Carbon::parse($data->published_at)->format('d/m/Y') : __('Non publié') }}
                </small>
            </td>

            <!--published -->
            <td>
                @if($data->is_published == 1)
                    <span class="status-badge-modern approved">
                        <i class="las la-check-circle"></i>
                        {{__('Publié')}}
                    </span>
                @else
                    <span class="status-badge-modern pending">
                        <i class="las la-clock"></i>
                        {{__('Non publié')}}
                    </span>
                @endif

                @can('user-listing-published-status-change')
                <div class="mt-2">
                    <x-status.admin-listing-published-change :url="route('admin.listings.published.status.change',$data->id)"/>
                </div>
                @endcan

            </td>

            <!--status -->
            <td>
                @if($data->status==1)
                    <span class="status-badge-modern approved">
                        <i class="las la-check-circle"></i>
                        {{__('Approuvé')}}
                    </span>
                @else
                    <span class="status-badge-modern pending">
                        <i class="las la-clock"></i>
                        {{__('En attente')}}
                    </span>
                @endif

               @can('user-listing-status-change')
                <div class="mt-2">
                    <x-status.status-change :url="route('admin.listings.status.change',$data->id)"/>
                </div>
               @endcan

            </td>

            <!--Action -->
            <td>
                <div class="admin-action-btns">
                    <a href="{{route('admin.listings.details',$data->id)}}" class="admin-action-btn view" title="{{__('Voir')}}">
                        <i class="las la-eye"></i>
                    </a>
                    @can('user-listing-delete')
                        <x-popup.delete-popup :url="route('admin.listings.delete',$data->id)"/>
                    @endcan
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<div class="custom_pagination mt-5 d-flex justify-content-end">
    {{ $all_listings->links() }}
</div>
