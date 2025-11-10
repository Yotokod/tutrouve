@extends('backend.admin-master')
@section('site-title')
    {{__('Slider')}}
@endsection

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Liste des transactions</h3>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    @if($transactions->isEmpty())
        <div class="alert alert-info">Aucune transaction pour le moment.</div>
    @else
        <div class="tableStyle_three mt-4">
                    <div class="table_wrapper custom_Table">
                        <div class="search_category_result">
                           <table class="dataTablesExample">
    <thead>
  
    <th>{{__('No')}}</th>
    <th>{{__('Vendeur')}}</th>
    <th>{{__('Acheteur')}}</th>
    <th>{{__('Annonce')}}</th> 
    <th>{{__('Montant de la transaction')}}</th>
    <th>{{__('ID de la transaction')}}</th>
    <th>{{__('Statut')}}</th>
    <th>{{__('Statut acheteur')}}</th>
    <th>{{__('Statut vendeur')}}</th>
    <th>{{__('Méssage')}}</th>
     <th>{{__('Montant de retrait')}}</th>
     <th>{{__('Méthode de retrait')}}</th>
     <th>{{__('Détails de retrait')}}</th>
    <th>{{__('Create Date')}}</th>
    <th>{{__('Action')}}</th>
    </thead>
    <tbody>
        @php
        $n = 0;
        @endphp
        @foreach($transactions as $data)
        @php
        $n++;
        @endphp
            <tr>
              
                <td>{{$n}}</td>
                <td>{{$data->seller_id}}</td>
                <td>{{$data->buyer_id}}</td>
                <td>{{$data->ads_id}}</td>
                <td>{{$data->amount}} FCFA</td>
                <td>{{$data->transaction_id}}</td>
                 <td>
                    @if($data->admin_statut==1)
                        <span class="alert alert-success">{{__('Validé')}}</span>
                    @else
                        <span class="alert alert-danger">{{__('En attente')}}</span>
                    @endif
                  
                </td>
                  <td>
                    @if($data->buyer_statut==1)
                        <span class="alert alert-success">{{__('Colis reçu')}}</span>
                    @else
                        <span class="alert alert-danger">{{__('En attente')}}</span>
                    @endif
                  
                </td>
                 <td>
                    @if($data->seller_statut==1)
                        <span class="alert alert-success">{{__('Colis envoyé')}}</span>
                    @else
                        <span class="alert alert-danger">{{__('En attente')}}</span>
                    @endif
                  
                </td>
               
                <td>{{$data->message}}</td>
                <td>{{$data->withdraw_amount}} FCFA</td>
                <td>{{$data->withdraw_methods}}</td>
                <td>{{$data->withdraw_details}}</td>
                <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                <td>
                  
                </td>
            </tr>
        @endforeach
  
    </tbody>
</table>
<div class="custom_pagination mt-5 d-flex justify-content-end">
    {{ $transactions->links() }}
</div>

                        </div>
                    </div>
                </div>
    @endif
</div>
@endsection
