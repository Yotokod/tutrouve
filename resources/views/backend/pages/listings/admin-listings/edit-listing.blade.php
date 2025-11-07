@extends('backend.admin-master')
@section('site-title')
    {{__('Edit Listing')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <x-summernote.css/>
    <x-media.css/>
    <style>
        input#pac-input {
            background-color: ghostwhite;
        }
        .select2-container .select2-selection--single {
            background-color: var(--white-bg);
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            position: relative;
            padding: 10px 5px;
        }

        span.select2.select2-container.select2-container--default.select2-container--focus {
            width: 100% !important;
        }
        .select-itms span.select2{
            width: 100% !important;
        }


        .close{ border: none;  }
        .dashboard-switch-single{
            font-size: 20px;
        }
        .swal_delete_button{
            color: #da0000 !important;
        }
        /* Default styles for the input box */
        #pac-input {
            height: 3em;
            width:75%;
            margin-left: 140px;
            border: 1px solid;
            top: 4px;
            font-size: 16px;
        }

        /* Media query for screens smaller than 768px */
        @media (max-width: 1499px) {
            #pac-input {
                width: 100%;
                margin-left: 0;
            }
        }

        /*select tags start css*/
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #e3e3e3;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 23px;
        }
        .select2-selection__choice__display {
            font-size: 15px;
            color: #000;
            font-weight: 400;
        }
        /*select tags end css*/

        /* price and number css start   */
        label.infoTitle.position-absolute {
            top: 0;
            background-color: whitesmoke;
            left: 0;
            padding: 10px 15px;
        }
        .checkBox {
            margin-top: 10px;
            border: 1px solid whitesmoke;
            border-radius: 8px;
            padding: 10px 15px;
            display: inline-block;
        }
        input#price, input#phone {
            padding: 5px 0 5px 76px;
        }
        input.effectBorder.checkBox__input {
            border: 2px solid #a3a3a3;
        }
        /* price and number css end   */

        .condition {
            padding: 13px;
            border: 2px solid #e9e9e9;
            border-radius: 6px;
        }

        .radio input {
            height: 20px;
            width: 20px;
        }
        .form__input__single {
            flex: 1;
        }

        .flex_0 {
            flex-shrink: 0;
        }
    </style>
    <x-css.phone-number-css/>
@endsection
@section('content')
    <div class="row g-4 mt-0">
        <div class="col-xl-12 col-lg-12 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="header-wrap d-flex justify-content-between mb-4">
                    <div class="left-content">
                        <h4 class="header-title">{{__('Edit Listing')}}   </h4>
                    </div>
                    <div class="right-content">
                        <a class="cmnBtn btn_5 btn_bg_info radius-5" href="{{route('admin.all.listings')}}">{{__('All Listings')}}</a>
                    </div>
                </div>
                <x-validation.error/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="add-listing-wrapper mt-4">
                                <!--Nav Bar Tabs markup start -->
                                <div class="nav nav-pills d-none" id="add-listing-tab"
                                     role="tablist" aria-orientation="vertical">

                                    <a class="nav-link  stepIndicator active stepForm_btn__previous"
                                       id="listing-info-tab"
                                       data-bs-toggle="pill"
                                       href="#listing-info"
                                       role="tab"
                                       aria-controls="listing-info"
                                       aria-selected="true">
                                        <span class="nav-link-number">{{ __('1') }}</span>
                                        {{__('Listing Info')}}
                                    </a>
                                    <a class="nav-link  stepIndicator" id="location-tab"
                                       data-bs-toggle="pill"
                                       href="#location" role="tab"
                                       aria-controls="location"
                                       aria-selected="false">
                                        <span class="nav-link-number">{{ __('2') }}</span>
                                        {{__('Location')}}
                                    </a>
                                </div>
                                <form action="{{route('admin.edit.listing', $listing->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div  class="add-listing-content-wrapper mt-4">
                                        <div class="tab-content add-listing-content" id="add-listing-tabContent">
                                            <!-- listing Info start-->
                                            <div  class="tab-pane fade step active show" id="listing-info" role="tabpanel" aria-labelledby="listing-info-tab">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <!-- Title -->
                                                        <div class="form__input__single">
                                                            <label class="form__input__single__label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form__control radius-5"  name="title" id="title" value="{{$listing->title}}" placeholder="{{__('Add title')}}">
                                                        </div>

                                                        <div class="form__input__single mt-3">
                                                            <div class="input-form input-form2 permalink_label">
                                                                <label for="title" class="form__input__single__label text-dark"> {{__('Permalink')}}  <span class="text-danger">*</span>  </label>
                                                                <span id="slug_show" class="display-inline"></span>
                                                                <span id="slug_edit" class="display-inline d-inline">
                                                                        <button class="btn btn-warning btn-sm slug_edit_button">  <i class="las la-edit"></i> </button>
                                                                        <input class="listing_slug form__control radius-5" name="slug" value="{{$listing->slug}}" id="slug" style="display: none" type="text">
                                                                        <button class="btn btn-info btn-sm slug_update_button mt-2" style="display: none">{{__('Update')}}</button>
                                                                    </span>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-wrap justify-content-between gap-3 mt-4">
                                                            <div class="form__input__single">
                                                                <label class="form__input__single__label">{{ __('Category') }}  <span class="text-danger">*</span> </label>
                                                                <select name="category_id" id="category" class="select-itms select2_activation">
                                                                    <option value="">{{__('Select Category')}}</option>
                                                                    @foreach($categories as $cat)
                                                                        <option value="{{ $cat->id }}" data-code="{{ $cat->code }}" @if($cat->id == $listing->category_id) selected @endif>{{ $cat->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form__input__single" id="sub_category">
                                                                <label for="subcategory" class="form__input__single__label"> {{__('Sub Category')}} </label>
                                                                <select  name="sub_category_id" id="subcategory" class="subcategory select2_activation">
                                                                    <option value="">{{__('Select Sub Category')}}</option>
                                                                    @foreach($sub_categories as $sub_cat)
                                                                        <option value="{{$sub_cat->id}}" @if($sub_cat->id == $listing->sub_category_id) selected @endif> {{ $sub_cat->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form__input__single child_category_wrapper w-100">
                                                                <label for="child_category" class="form__input__single__label"> {{__('Child Category')}} </label>
                                                                <select  name="child_category_id" id="child_category" class="select2_activation">
                                                                    <option value="">{{__('Select Child Category')}}</option>
                                                                    @if(!empty($listing->child_category_id))
                                                                        @foreach($child_categories as $child_cat)
                                                                            <option value="{{ $child_cat->id }}"  @if($child_cat->id == $listing->child_category_id) selected @endif>{{ $child_cat->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
 <div class="row" id="autre" >
                                                            <div class="col-sm-12">
                                                                <div class="item-condition-wraper input-filed p-24 mb-sm-0 mb-3">
                                                                    <center><p>Critères concernant votre bien immobilliers: </p></center><br>
                                                                    <div class="row">
  <div class="col-md-12">
    <label for="type_bien">{{ __('Type de bien') }}</label>
    <select name="type_bien" id="type_bien" class="input-filed w-100">
        <option value="">{{ __('Sélectionner un type de bien') }}</option>
        <option value="Appartement" {{ (old('type_bien', $listing->type_bien) == 'Appartement') ? 'selected' : '' }}>Appartement</option>
        <option value="Villa" {{ (old('type_bien', $listing->type_bien) == 'Villa') ? 'selected' : '' }}>Villa</option>
        <option value="Maison" {{ (old('type_bien', $listing->type_bien) == 'Maison') ? 'selected' : '' }}>Maison</option>
        <option value="Studio" {{ (old('type_bien', $listing->type_bien) == 'Studio') ? 'selected' : '' }}>Studio</option>
        <option value="Duplex" {{ (old('type_bien', $listing->type_bien) == 'Duplex') ? 'selected' : '' }}>Duplex</option>
    </select>
</div>



</div>

<div class="row">
    <div class="col-md-6">
        <label for="genre_bien">{{ __('Style de bien') }}</label>
        <select name="genre_bien" id="genre_bien" class="input-filed w-100">
            <option value="">{{ __('Sélectionner') }}</option>
            <option value="Meublé" {{ (old('genre_bien', $listing->genre_bien) == 'Meublé') ? 'selected' : '' }}>Meublé</option>
            <option value="Non meublé" {{ (old('genre_bien', $listing->genre_bien) == 'Non meublé') ? 'selected' : '' }}>Non meublé</option>
            <option value="Chambre d\'étudiant" {{ (old('genre_bien', $listing->genre_bien) == "Chambre d'étudiant") ? 'selected' : '' }}>Chambre d'étudiant</option>
            <option value="Colocation" {{ (old('genre_bien', $listing->genre_bien) == 'Colocation') ? 'selected' : '' }}>Colocation</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="surface">{{ __('Surface (m2)') }}</label>
        <input type="number" step="0.2" name="surface" id="surface" value="{{ old('surface', $listing->surface) }}" class="input-filed w-100" placeholder="{{ __('Surface') }}">
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <label for="nbrs_piece">{{ __('Nombre de pièces') }}</label>
        <input type="number" name="nbrs_piece" id="nbrs_piece" value="{{ old('nbrs_piece', $listing->nbrs_piece) }}" class="input-filed w-100" placeholder="{{ __('Nombre de pièces') }}">
    </div>

    <div class="col-md-6">
        <label for="nbrs_chambre">{{ __('Nombre de chambres') }}</label>
        <input type="number" name="nbrs_chambre" id="nbrs_chambre" value="{{ old('nbrs_chambre', $listing->nbrs_chambre ?? 0) }}" class="input-filed w-100" placeholder="{{ __('Nombre de chambres') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="nature_bien">{{ __('Nature du bien') }}</label>
        <select name="nature_bien" id="nature_bien" class="input-filed w-100">
            <option value="">{{ __('Sélectionner la nature du bien') }}</option>
            <option value="Résidentiel" {{ (old('nature_bien', $listing->nature_bien) == 'Résidentiel') ? 'selected' : '' }}>Résidentiel</option>
            <option value="Commercial" {{ (old('nature_bien', $listing->nature_bien) == 'Commercial') ? 'selected' : '' }}>Commercial</option>
            <option value="Industriel" {{ (old('nature_bien', $listing->nature_bien) == 'Industriel') ? 'selected' : '' }}>Industriel</option>
            <option value="Terrain" {{ (old('nature_bien', $listing->nature_bien) == 'Terrain') ? 'selected' : '' }}>Terrain</option>
            <option value="Autre" {{ (old('nature_bien', $listing->nature_bien) == 'Autre') ? 'selected' : '' }}>Autre</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="type_chambre">{{ __('Type de chambre') }}</label>
        <select name="type_chambre" id="type_chambre" class="input-filed w-100">
            <option value="">{{ __('Sélectionner le type de chambre') }}</option>
            <option value="Chambre privée" {{ (old('type_chambre', $listing->type_chambre) == 'Chambre privée') ? 'selected' : '' }}>Chambre privée</option>
            <option value="Chambre partagée" {{ (old('type_chambre', $listing->type_chambre) == 'Chambre partagée') ? 'selected' : '' }}>Chambre partagée</option>
            <option value="Autre" {{ (old('type_chambre', $listing->type_chambre) == 'Autre') ? 'selected' : '' }}>Autre</option>
        </select>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <label for="nbrs_colocataire">{{ __('Nombre de colocataires') }}</label>
        <input type="number" name="nbrs_colocataire" id="nbrs_colocataire" value="{{ old('nbrs_colocataire', $listing->nbrs_colocataire ?? 0) }}" class="input-filed w-100" placeholder="{{ __('Nombre de colocataires') }}">
    </div>

    <div class="col-md-6">
        <label for="salle_bain">{{ __('Nombre de salle de bain') }}</label>
        <input type="number" name="salle_bain" id="salle_bain" value="{{ old('salle_bain', $listing->salle_bain) }}" class="input-filed w-100" placeholder="{{ __('Salle de bain') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="classe_energie">{{ __('Classe énergie') }}</label>
        <select name="classe_energie" id="classe_energie" class="input-filed w-100">
            <option value="">{{ __('Sélectionner la classe énergie') }}</option>
            <option value="A" {{ old('classe_energie', $listing->classe_energie) == 'A' ? 'selected' : '' }}>A - Très performant</option>
            <option value="B" {{ old('classe_energie', $listing->classe_energie) == 'B' ? 'selected' : '' }}>B - Performant</option>
            <option value="C" {{ old('classe_energie', $listing->classe_energie) == 'C' ? 'selected' : '' }}>C - Bon</option>
            <option value="D" {{ old('classe_energie', $listing->classe_energie) == 'D' ? 'selected' : '' }}>D - Moyen</option>
            <option value="E" {{ old('classe_energie', $listing->classe_energie) == 'E' ? 'selected' : '' }}>E - Énergivore</option>
            <option value="F" {{ old('classe_energie', $listing->classe_energie) == 'F' ? 'selected' : '' }}>F - Très énergivore</option>
            <option value="G" {{ old('classe_energie', $listing->classe_energie) == 'G' ? 'selected' : '' }}>G - Extrêmement énergivore</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="ges">{{ __('GES (Gaz à Effet de Serre)') }}</label>
        <select name="ges" id="ges" class="input-filed w-100">
            <option value="">{{ __('Sélectionner le niveau GES') }}</option>
            <option value="A" {{ old('ges', $listing->ges) == 'A' ? 'selected' : '' }}>A - Faibles émissions</option>
            <option value="B" {{ old('ges', $listing->ges) == 'B' ? 'selected' : '' }}>B - Basses émissions</option>
            <option value="C" {{ old('ges', $listing->ges) == 'C' ? 'selected' : '' }}>C - Émissions modérées</option>
            <option value="D" {{ old('ges', $listing->ges) == 'D' ? 'selected' : '' }}>D - Émissions élevées</option>
            <option value="E" {{ old('ges', $listing->ges) == 'E' ? 'selected' : '' }}>E - Fortes émissions</option>
            <option value="F" {{ old('ges', $listing->ges) == 'F' ? 'selected' : '' }}>F - Très fortes émissions</option>
            <option value="G" {{ old('ges', $listing->ges) == 'G' ? 'selected' : '' }}>G - Émissions extrêmes</option>
        </select>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <label for="etage_bien">{{ __('Nombre d\'étage') }}</label>
        <input type="number" name="etage_bien" id="etage_bien" value="{{ old('etage_bien', $listing->etage_bien ?? 0) }}" class="input-filed w-100" placeholder="{{ __('Étage du bien') }}">
    </div>
    <div class="col-md-6">
        <label for="etage_batiment">{{ __('Nombre d\'étages du bâtiment') }}</label>
        <input type="number" name="etage_batiment" id="etage_batiment" value="{{ old('etage_batiment', $listing->etage_batiment ?? 0) }}" class="input-filed w-100" placeholder="{{ __('Étage du bâtiment') }}">
    </div>
</div>



<div class="row">
   <div class="col-md-6">
        <label for="statut_fumeur">{{ __('Statut fumeur') }}</label>
        <select name="statut_fumeur" id="statut_fumeur" class="input-filed w-100">
            <option value="">{{ __('Sélectionner le statut fumeur') }}</option>
            <!-- Vérifie si l'ancienne valeur (old) est égale à l'option pour le marquer comme sélectionné -->
            <option value="Interdit" {{ old('statut_fumeur', $listing->statut_fumeur ?? '') == 'Interdit' ? 'selected' : '' }}>Interdit</option>
            <option value="Accepté" {{ old('statut_fumeur', $listing->statut_fumeur ?? '') == 'Accepté' ? 'selected' : '' }}>Accepté</option>
            <option value="Sous négociation" {{ old('statut_fumeur', $listing->statut_fumeur ?? '') == 'Sous négociation' ? 'selected' : '' }}>Sous négociation</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="animaux">{{ __('Animaux') }}</label>
        <select name="animaux" id="animaux" class="input-filed w-100">
            <option value="">{{ __('Sélectionner l\'autorisation des animaux') }}</option>
            <!-- Vérifie si l'ancienne valeur (old) est égale à l'option pour le marquer comme sélectionné -->
            <option value="Autorisé" {{ old('animaux', $listing->animaux ?? '') == 'Autorisé' ? 'selected' : '' }}>Autorisé</option>
            <option value="Non autorisé" {{ old('animaux', $listing->animaux ?? '') == 'Non autorisé' ? 'selected' : '' }}>Non autorisé</option>
            <option value="Chien uniquement" {{ old('animaux', $listing->animaux ?? '') == 'Chien uniquement' ? 'selected' : '' }}>Chien uniquement</option>
            <option value="Chat uniquement" {{ old('animaux', $listing->animaux ?? '') == 'Chat uniquement' ? 'selected' : '' }}>Chat uniquement</option>
            <option value="Chien et Chat uniquement" {{ old('animaux', $listing->animaux ?? '') == 'Chien et Chat uniquement' ? 'selected' : '' }}>Chien et Chat uniquement</option>
        </select>
    </div>
</div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="car">
    <div class="col-sm-12">
        <div class="item-condition-wraper input-filed p-24 mb-sm-0 mb-3">
            <center><p>Caractéristique de la voiture:</p></center><br>
            <div class="row">  
                <div class="col-md-6">
                    <label for="car_brand">{{ __('Marque de voiture') }}</label>
                    <select name="car_brand" id="car_brand" class="input-filed w-100">
                        <option value="">{{ __('Sélectionner une marque') }}</option>
                        @php
                            $car_brands = ['Toyota', 'Honda', 'Mercedes-Benz', 'BMW', 'Audi', 'Volkswagen', 'Ford', 'Nissan', 'Peugeot', 'Renault', 'Chevrolet', 'Hyundai', 'Kia', 'Mazda', 'Subaru', 'Fiat', 'Jeep', 'Tesla', 'Volvo', 'Mitsubishi', 'Land Rover', 'Jaguar', 'Porsche', 'Ferrari', 'Lamborghini', 'Bugatti', 'Rolls-Royce', 'Bentley', 'Aston Martin', 'Alfa Romeo', 'Chrysler', 'Dodge', 'RAM', 'GMC', 'Acura', 'Infiniti', 'Lexus', 'Citroën', 'Suzuki', 'Opel', 'Seat', 'Skoda'];
                        @endphp
                        @foreach ($car_brands as $brand)
                            <option value="{{ $brand }}" {{ old('car_brand', $listing->car_brand) == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="model">{{ __('Modèle') }}</label>
                    <input type="text" name="model" id="model" value="{{ old('model', $listing->model) }}" class="input-filed w-100" placeholder="{{ __('Modèle de la voiture') }}">
                </div>   
            </div> 

            <div class="row">      
                <div class="col-md-6">
                    <label for="transmission">{{ __('Type de transmission') }}</label>
                    <select name="transmission" id="transmission" class="input-filed w-100">
                        <option value="">{{ __('Sélectionner un type de transmission') }}</option>
                        @php
                            $transmissions = ['Manuelle', 'Automatique', 'Semi-automatique'];
                        @endphp
                        @foreach ($transmissions as $transmission)
                            <option value="{{ $transmission }}" {{ old('transmission', $listing->transmission) == $transmission ? 'selected' : '' }}>{{ $transmission }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="kilometer">{{ __('Kilométrage') }}</label>
                    <input type="number" name="kilometer" id="kilometer" value="{{ old('kilometer', $listing->kilometer) }}" class="input-filed w-100" placeholder="{{ __('Kilométrage') }}">
                </div>   
            </div>

            <div class="row">      
                <div class="col-md-6">
                    <label for="carburant">{{ __('Type de carburant') }}</label>
                    <select name="carburant" id="carburant" class="input-filed w-100">
                        <option value="">{{ __('Sélectionner un type de carburant') }}</option>
                        @php
                            $carburants = ['Essence', 'Diesel', 'Électrique', 'Hybride'];
                        @endphp
                        @foreach ($carburants as $carburant)
                            <option value="{{ $carburant }}" {{ old('carburant', $listing->carburant) == $carburant ? 'selected' : '' }}>{{ $carburant }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="portiere">{{ __('Portières') }}</label>
                    <input type="number" name="portiere" id="portiere" value="{{ old('portiere', $listing->portiere) }}" class="input-filed w-100" placeholder="{{ __('Nombre de portières') }}">
                </div>   
            </div>
        </div>
    </div>
</div>
                                                        <div class="d-flex flex-wrap justify-content-between gap-3 mt-4" id="cri1">
                                                            <div class="form__input__single">
                                                                <div class="condition">
                                                                    <input type="checkbox" class="custom-check-box  me-2" id="item-condition">
                                                                    <label for="item-condition" class="form__input__single__label">{{ __('Il s\'agit d\'un produit:') }}</label>
                                                                    <input type="hidden" id="hiddenCondition" name="hiddenCondition" value="{{ $listing->condition }}">
                                                                    <div class="cs_radio_btn d-flex gap-3 conditions condition_disable_enable">
                                                                        <div class="radio d-flex align-items-center gap-2">
                                                                            <input id="condition-1" name="condition"  value="Occasion" type="radio" tabindex="0" class="radio_disable_color" {{ $listing->condition == 'Occasion' ? 'checked' : '' }}>
                                                                            <label for="condition-1" class="radio-label">{{ __('Occasion') }}</label>
                                                                        </div>
                                                                        <div class="radio d-flex align-items-center gap-2">
                                                                            <input id="condition-2" name="condition"  value="Neuf" type="radio" tabindex="0" class="radio_disable_color" {{ $listing->condition == 'Neuf' ? 'checked' : '' }}>
                                                                            <label for="condition-2" class="radio-label">{{ __('Neuf') }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form__input__single">
                                                                <div class="condition">
                                                                    <input type="checkbox" class="custom-check-box me-2" id="item-authenticity">
                                                                    <label for="item-authenticity" class="form__input__single__label">{{ __('Ce produit est:') }}</label>
                                                                    <input type="hidden" id="hiddenAuthenticity" name="hiddenAuthenticity" value="{{ $listing->authenticity }}">
                                                                    <div class="cs_radio_btn d-flex gap-3 conditions authenticity_disable_enable">
                                                                        <div class="radio d-flex align-items-center gap-2">
                                                                            <input id="authenticity-1" name="authenticity"  value="original" type="radio" tabindex="0"
                                                                                   class="radio_disable_color" {{ $listing->authenticity == 'Original' ? 'checked' : '' }}>
                                                                            <label for="authenticity-1" class="radio-label">{{ __('Original') }}</label>
                                                                        </div>
                                                                        <div class="radio d-flex align-items-center gap-2">
                                                                            <input id="authenticity-2" name="authenticity"  value="Reconditionné(e)" type="radio"
                                                                                   tabindex="0" class="radio_disable_color" {{ $listing->authenticity == 'Reconditionné(e)' ? 'checked' : '' }}>
                                                                            <label for="authenticity-2" class="radio-label">{{ __('Reconditionné(e)') }}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                            <!--Brand -->
                                                            <div class="form__input__single mt-4" id="cri2">
                                                                <label class="form__input__single__label">{{ __('Marque') }}</label>
                                                                <div class="select-itms">
                                                                    <select name="brand_id" id="brand_id" class="select2_activation">
                                                                        <option  value="">{{ __('Select Brand') }}</option>
                                                                        @foreach($brands as $brand)
                                                                            <option value="{{$brand->id}}" @if($brand->id == $listing->brand_id) selected @endif>{{ $brand->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        <div class="attribute-box box-shadow1 p-24 mt-4">
                                                            <h5 class="collapse_wrapper__header__title mb-3">{{get_static_option('listing_attribute_section_title') ?? __('Attributes') }}</h5>
                                                            <div id="attribute-container">
                                                                <!-- Initial Attribute Fields -->
                                                                @if($listing->listing_attributes->isNotEmpty())
                                                                    @foreach($listing->listing_attributes as $attribute)
                                                                        <div class="attribute-item mb-3 position-relative">
                                                                            <label for="attributes_title" class="form-label mt-3">{{ __('Title') }}</label>
                                                                            <input type="text" class="form-control mb-2" name="attributes_title[]" value="{{ $attribute->title }}" placeholder="{{ __('Enter title') }}">
                                                                            <label for="attributes_description" class="form-label">{{ __('Description') }}</label>
                                                                            <input type="text" class="form-control" name="attributes_description[]" value="{{ $attribute->description }}" placeholder="{{ __('Enter description') }}">
                                                                            <button type="button" class="btn btn-danger btn-sm remove-attribute position-absolute top-0 end-0 mt-0 me-2">
                                                                                <i class="las la-times-circle"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <!-- Default empty fields if no attributes exist -->
                                                                    <div class="attribute-item mb-3">
                                                                        <label for="attributes_title" class="form-label">{{ __('Title') }}</label>
                                                                        <input type="text" class="form-control mb-2" name="attributes_title[]" placeholder="{{ __('Enter title') }}">

                                                                        <label for="attributes_description" class="form-label">{{ __('Description') }}</label>
                                                                        <input type="text" class="form-control" name="attributes_description[]" placeholder="{{ __('Enter description') }}">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <!-- Add More Button -->
                                                            <button type="button" id="add-more-attributes" class="cmnBtn btn_5 btn_bg_blue radius-5 d-block">
                                                                <i class="las la-plus-circle"></i>{{ __('Add More') }}
                                                            </button>
                                                        </div>

                                                            <!-- Description -->
                                                            <div class="form__input__single mt-4">
                                                                <label class="form__input__single__label">{{ __('Description') }} <span class="text-danger">*</span> <span class="text-danger">{{ __('minimum 150 characters.') }}</span> </label>
                                                                <div class="input-form input-form2">
                                                                    <textarea class="textarea--form summernote" name="description" placeholder="{{__('Type Description')}}">{{ $listing->description }}</textarea>
                                                                </div>
                                                            </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <!-- Price -->
                                                        <div class="col-lg-12 col-md-12 mt-5">
                                                            <div class="form__input__single position-relative">
                                                                <label class="infoTitle position-absolute">{{ __('Price') }} <span class="text-danger">*</span></label>
                                                                <div class="input-form input-form2">
                                                                    <input type="number" class="form__control radius-5" name="price" id="price" value="{{ $listing->price }}" placeholder="{{__('0.00')}}">
                                                                </div>
                                                                <div class="checkBox">
                                                                    <label class="negotiable d-flex flex-row-reverse gap-3">{{ __('Negotiable') }}
                                                                        <input class="effectBorder checkBox__input" type="checkbox" id="negotiable" value="{{$listing->negotiable}}"  @if($listing->negotiable == 1) checked @endif name="negotiable">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Phone -->
                                                        <div class="form__input__single position-relative mt-4">
                                                            <input type="hidden" id="country-code" name="country_code" value="{{$listing->phone}}">
                                                            <input type="tel" class="form__control radius-5 w-100" name="phone" id="phone"  value="{{$listing->phone}}" placeholder="{{__('Phone')}}">

                                                            <span id="phone_availability"></span>
                                                            <div class="d-none">
                                                                <span id="error-msg" class="hide"></span>
                                                                <p id="result" class="d-none"></p>
                                                            </div>
                                                            <br>
                                                            <div class="checkBox">
                                                                <label class="phone_hidden  d-flex flex-row-reverse gap-2">{{ __('Hide Phone Number') }}
                                                                    <input class="effectBorder checkBox__input" id="phone_hidden" type="checkbox" value="{{$listing->phone_hidden}}" @if($listing->phone_hidden == 1) checked @endif name="phone_hidden">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <!--single image -->
                                                        <div class="col-lg-12 mt-3">
                                                            <div class="upload-img">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_attachment_preview_for_admin($listing->image ?? '') !!}
                                                                    </div>
                                                                    <input type="hidden" name="image" value="{{$listing->image ?? ''}}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#media_upload_modal">
                                                                        {{__('Upload Main Image')}}
                                                                    </button>
                                                                    <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
                                                                    <small>{{ __('recommended size 810x450') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 mt-3">
                                                            <div class="upload-img">
                                                                <div class="media-upload-btn-wrapper">
                                                                    <div class="img-wrap">
                                                                        {!! render_gallery_image_attachment_preview($listing->gallery_images ?? '') !!}
                                                                    </div>
                                                                    <input type="hidden" name="gallery_images" value="{{ $listing->gallery_images }}">
                                                                    <button type="button" class="btn btn-info media_upload_form_btn"
                                                                            data-btntitle="{{__('Select Image')}}"
                                                                            data-modaltitle="{{__('Upload Image')}}"
                                                                            data-mulitple="true"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#media_upload_modal">
                                                                        {{__('Upload Gallery Images')}}
                                                                    </button>
                                                                    <small>{{ __('image format: jpg,jpeg,png,gif,webp')}}</small> <br>
                                                                    <small>{{ __('recommended size 810x450') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- start previous / next buttons -->
                                                        <div  class="col-lg-12 mt-5">
                                                            <div class="btn_wrapper d-flex justify-content-end gap-3">
                                                                <button class="cmnBtn btn_5 btn_bg_blue radius-5" id="nextBtn" type="button">{{__('Next')}}</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- listing Info end-->

                                            <!-- Location start-->
                                            <div class="tab-pane fade step" id="location" role="tabpanel" aria-labelledby="location-tab">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="single-dashboard-input mb-3">
                                                               @if(get_static_option('google_map_settings_on_off') == null)
                                                                   <div class="d-flex justify-content-between gap-3">
                                                                       <div class="input-form input-form2 w-100">
                                                                           <label class="form__input__single__label">{{ __('Select Your Country') }}</label>
                                                                           <select name="country_id" id="country_id" class="select2_activation">
                                                                               <option value="">{{ __('Select Country') }}</option>
                                                                               @foreach($all_countries as $country)
                                                                                   <option value="{{ $country->id }}" @if($country->id == $listing->country_id) selected @endif>{{ $country->country }}</option>
                                                                               @endforeach
                                                                           </select><br>
                                                                           <span class="country_info"></span>
                                                                       </div>

                                                                       <div class="input-form input-form2 w-100">
                                                                           <label class="form__input__single__label">{{ __('Select Your State') }}</label>
                                                                           <select name="state_id" id="state_id" class="get_country_state select2_activation">
                                                                               <option value="">{{ __('Select State') }}</option>
                                                                               @foreach($all_states as $state)
                                                                                   <option value="{{ $state->id }}" @if($state->id == $listing->state_id) selected @endif>{{ $state->state }}</option>
                                                                               @endforeach
                                                                           </select> <br>
                                                                           <span class="state_info"></span>
                                                                       </div>

                                                                       <div class="input-form input-form2 w-100">
                                                                           <label class="form__input__single__label">{{ __('Select Your City') }}</label>
                                                                           <select name="city_id" id="city_id" class="get_state_city select2_activation">
                                                                               <option value="">{{ __('Select City') }}</option>
                                                                               @if(!empty($listing->city_id))
                                                                                   @foreach($all_cities as $city)
                                                                                       <option value="{{ $city->id }}" @if($city->id == $listing->city_id) selected @endif>{{ $city->city }}</option>
                                                                                   @endforeach
                                                                               @endif
                                                                           </select><br>
                                                                           <span class="city_info"></span>
                                                                       </div>
                                                                   </div>
                                                               @else
                                                                   <!--Google Map -->
                                                                   <div class="form__input__single">
                                                                       <label class="form__input__single__label">{{ __('Google Map Location') }}
                                                                           <a href="https://drive.google.com/file/d/1BwDAjSLAeb4LaxzOkrdsgGO_Io2jM6S6/view?usp=sharing" target="_blank">
                                                                               <strong class="text-warning">{{__('Video link')}}</strong>
                                                                           </a><small class="text-info">{{__('Search your location, pick a location')}} </small>
                                                                       </label>
                                                                       <div class="input-form input-form2">
                                                                           <div class="map-warper dark-support rounded overflow-hidden">
                                                                               <input id="pac-input" class="controls rounded" type="text" placeholder="{{ __('Search your location')}}"/>
                                                                               <div id="map_canvas" style="height: 480px"></div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               @endif
                                                               <!-- Address -->
                                                               <div class="form__input__single">
                                                                   <input type="hidden" name="latitude" id="latitude" value="{{$listing->lon}}">
                                                                   <input type="hidden" name="longitude" id="longitude" value="{{$listing->lat}}">
                                                                   <label class="form__input__single__label">{{ __('Address') }}</label>
                                                                   <div class="input-form input-form2">
                                                                       <input  type="text" class="form__control radius-5" name="address" id="user_address" value="{{$listing->address}}" placeholder="{{__('Address')}}">
                                                                   </div>
                                                               </div>
                                                               <!-- video url -->
                                                               <div class="form__input__single">
                                                                   <label class="form__input__single__label">{{ __('Video Url') }} </label>
                                                                   <div class="input-form input-form2">
                                                                       <input type="text" class="form__control radius-5" name="video_url" id="video_url" value="{{ $listing->video_url}}" placeholder="{{__('youtube embed code')}}">
                                                                   </div>
                                                                   <small class="text-danger video_url_design">{{ __('Example:') }} https://www.youtube.com/embed/VIDEO_ID </small>
                                                               </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <!-- featured listings -->
                                                        <div class="form__input__single">
                                                            <div class="checkBox">
                                                                <label class="is_featured form__input__single__label d-flex gap-2">
                                                                    <input class="checkBox__input effectBorder" type="checkbox" name="is_featured" id="is_featured" value="{{$listing->is_featured}}" @if($listing->is_featured == 1) checked @endif>
                                                                    {{ __('Is Featured') }}
                                                                </label>
                                                            </div>
                                                        </div>


                                                        <!-- Tags -->
                                                        <div class="form__input__single">
                                                            <label class="form__input__single__label">{{ __('Tags') }}</label>
                                                            <select name="tags[]" id="tags" class="select2_activation" multiple>
                                                                @foreach($tags as $tag)
                                                                    <option value="{{ $tag->id }}" @if($listing->tags->contains($tag->id)) selected @endif>{{ $tag->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <small>{{ __('Select Your tags name or new tag name type') }}</small>
                                                        </div>

                                                        <!-- start previous / next buttons -->
                                                        <div  class="col-lg-12 mt-5">
                                                            <div class="btn_wrapper d-flex justify-content-end gap-3">
                                                                <button class="cmnBtn btn_5 btn_bg_info radius-5" id="prevBtn" type="button">{{__('Previous')}}</button>
                                                                <button class="cmnBtn btn_5 btn_bg_primary radius-5" id="submitBtn" type="submit">{{__('Submit')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Location end-->
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('scripts')
    <x-frontend.js.listing-attribute-js/>
    <x-frontend.js.phone-number-check-for-listing/>
    <x-media.js />
    <x-summernote.js/>
    <x-frontend.js.new-tag-add-js/>
    @if(!empty(get_static_option('google_map_settings_on_off')))
        <x-map.google-map-api-key-set/>
        <x-map.google-map-listing-js/>
    @endif
    <script src="{{asset('assets/frontend/js/multi-step.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <x-listings.edit-condition-authenticity :condition="$listing->condition" :authenticity="$listing->authenticity"/>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                // is featured
                $(document).on('click', '.is_featured', function () {
                    $('#is_featured').val($('#is_featured').is(':checked') ? '1' : '');
                });

                // Radio button change event
                $(document).on('click', 'input[name="condition"]', function() {
                    $('#hiddenCondition').val($(this).val());
                });

                // phone hidden
                $(document).on('change','#negotiable',function(e) {
                    if ($(this).is(':checked')) {
                        let negotiable = 1;
                        $('#negotiable').val(negotiable);
                    }else{
                        let negotiable = 0;
                        $('#negotiable').val(negotiable);
                    }
                });

                // phone hidden
                $(document).on('change','#phone_hidden',function(e) {
                    e.preventDefault();
                    if ($(this).is(':checked')) {
                        let phone_hidden = 1;
                        $('#phone_hidden').val(phone_hidden);
                    }else{
                        let phone_hidden = 0;
                        $('#phone_hidden').val(phone_hidden);
                    }
                });

                //Permalink Code
                let slug = $('.listing_slug').val();
                let url = "{{url('/listing/')}}/" + slug;
                let data = $('#slug_show').text(url).css('color', '#3c3cf7');


                function converToSlug(slug){
                    let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                    //remove multiple space to single
                    finalSlug = slug.replace(/  +/g, ' ');
                    // remove all white spaces single or multiple spaces
                    finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                    return finalSlug;
                }

                //Slug Edit Code
                $(document).on('click', '.slug_edit_button', function (e) {
                    e.preventDefault();
                    $('.listing_slug').show();
                    $(this).hide();
                    $('.slug_update_button').show();
                });

                //Slug Update Code
                $(document).on('click', '.slug_update_button', function (e) {
                    e.preventDefault();
                    $(this).hide();
                    $('.slug_edit_button').show();
                    var update_input = $('.listing_slug').val();
                    var slug = converToSlug(update_input);
                    var url = `{{url('/listing/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.listing_slug').hide();
                });

                $('#category').on('change',function(){
                    let category_id = $(this).val();
                    $.ajax({
                        method:'post',
                        url:"{{route('get.subcategory')}}",
                        data:{category_id:category_id},
                        success:function(res){
                            if(res.status=='success'){
                                let alloptions = "<option value=''>{{__('Select Sub Category')}}</option>";
                                let allSubCategory = res.sub_categories;
                                $.each(allSubCategory,function(index,value){
                                    alloptions +="<option value='" + value.id + "' data-code='" + value.code + "'>" + value.name + "</option>";
                                });
                                $(".subcategory").html(alloptions);
                                $('#subcategory').niceSelect('update');
                            }
                        }
                    })
                });

                // listing sub category and child category
                $(document).on('change','#subcategory', function() {
                    var sub_cat_id = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('get.subcategory.with.child.category') }}",
                        data: {
                            sub_cat_id: sub_cat_id
                        },
                        success: function(res) {

                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Child Category')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Child Category')}}</li>";
                                var allChildCategory = res.child_category;

                                $.each(allChildCategory, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "' data-code='" + value.code + "'>" + value.name + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.name + "</li>";
                                });

                                $("#child_category").html(alloptions);
                                $(".child_category_wrapper ul.list").html(allList);
                                $(".child_category_wrapper").find(".current").html("Select Child Category");
                            }
                        }
                    });
                });

                // change country and get state
                $(document).on('change','#country_id', function() {
                    let country = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.state.all') }}",
                        data: {
                            country: country
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select State')}}</option>";
                                let all_state = res.states;
                                $.each(all_state, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.state + "</option>";
                                });
                                $(".get_country_state").html(all_options);
                                $(".state_info").html('');
                                if(all_state.length <= 0){
                                    $(".state_info").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                                }
                            }
                        }
                    })
                })

                // change state and get city
                $('#state_id').on('change', function() {
                    let state = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.city.all') }}",
                        data: {
                            state: state
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select City')}}</option>";
                                let all_city = res.cities;
                                $.each(all_city, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.city + "</option>";
                                });
                                $(".get_state_city").html(all_options);

                                $(".city_info").html('');
                                if(all_city.length <= 0){
                                    $(".city_info").html('<span class="text-danger"> {{ __('No city found for selected state!') }} <span>');
                                }
                            }
                        }
                    })
                });

            });
        })(jQuery)
    </script>
    <script>
   
        function toggleAutreDiv() {
            var selectedOption = $("#category option:selected");
            var dataCode = selectedOption.data("code");

            if (dataCode == 1) {
                $("#autre").show();
                  $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            } else if(dataCode == 2){
                 $("#autre").hide();
                $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            }else if(dataCode == 4){
                 $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").hide();
                  $("#car").show();
            }else {
                $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").show();
                 $("#car").hide();
            }
        }
          function toggleAutreDiv1() {
            var selectedOption = $("#subcategory option:selected");
            var dataCode = selectedOption.data("code");

             if (dataCode == 1) {
                $("#autre").show();
                  $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            } else if(dataCode == 2){
                 $("#autre").hide();
                $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            }else if(dataCode == 4){
                 $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").hide();
                  $("#car").show();
            }else {
                $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").show();
                 $("#car").hide();
            }
        }
          function toggleAutreDiv2() {
            var selectedOption = $("#child_category option:selected");
            var dataCode = selectedOption.data("code");

             if (dataCode == 1) {
                $("#autre").show();
                  $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            } else if(dataCode == 2){
                 $("#autre").hide();
                $("#cri1").hide();
                 $("#cri2").hide();
                  $("#car").hide();
            }else if(dataCode == 4){
                 $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").hide();
                  $("#car").show();
            }else {
                $("#autre").hide();
                $("#cri1").show();
                 $("#cri2").show();
                 $("#car").hide();
            }
        }

        // Vérifier au chargement de la page
        toggleAutreDiv();

       
   
</script>

@endsection
