@extends('backend.admin-master')
@section('site-title')
    {{__('Modèle d\'e-mail pour l\'adhésion active d\'un utilisateur')}}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
@endsection
@section('content')
    <div class="row g-4 mt-0">
        <div class="col-xl-12 col-lg-12 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <div class="dashboard_orderDetails__header__flex">
                    <div class="dashboard_orderDetails__header__left">
                         <h2 class="dashboard__card__header__title mb-3">{{__('Modèle d\'e-mail pour l\'adhésion active d\'un utilisateur')}}</h2>
                    </div>
                    <div class="dashboard_orderDetails__header__right">
                        <a href="{{route('admin.email.template.all')}}" class="cmnBtn btn_5 btn_bg_info radius-5">{{__('Tous les modèles d\'e-mails')}}</a>
                    </div>
                </div>
                <x-validation.error/>
                <form action="{{route('admin.email.user.membership.active.template')}}" method="POST">
                    @csrf
                    <div class="form__input__single">
                        <label for="user_membership_active_email_subject" class="form__input__single__label">{{__('Sujet')}}</label>
                        <input type="text" class="form__control radius-5" name="user_membership_active_email_subject" value="{{get_static_option('user_membership_active_email_subject') ?? 'User Membership Active Email'}}">
                    </div>
                    <div class="form__input__single">
                        <label for="user_membership_active_message" class="form__input__single__label">{{__('User Membership Active Message')}}</label>
                        <textarea class="form__control summernote" name="user_membership_active_message">{!! get_static_option('user_membership_active_message') ?? 'Votre statut de membre est passé d\'inactif à actif. ID de membre : @membership_id'  !!} </textarea>
                    </div>
                    <div class="d-grid">
<small class="form-text"><strong class="text-danger"> @membership_id </strong>{{__('sera remplacé dynamiquement par membership_id.')}}</small>
<small class="form-text"><strong class="text-danger"> @membership_type </strong>{{__('sera remplacé dynamiquement par membership_type.')}}</small>
<small class="form-text"><strong class="text-danger"> @membership_price </strong>{{__('sera remplacé dynamiquement par membership_price.')}}</small>
<small class="form-text"><strong class="text-danger"> @membership_expire_date </strong>{{__('sera remplacé dynamiquement par membership_expire_date.')}}</small>
<small class="form-text"><strong class="text-danger"> @name </strong>{{__('sera remplacé dynamiquement par name.')}}</small>
<small class="form-text"><strong class="text-danger"> @email </strong>{{__('sera remplacé dynamiquement par email.')}}</small>

                    </div>
                    <div class="btn_wrapper mt-4">
                        <button type="submit" id="update" class="cmnBtn btn_5 btn_bg_blue radius-5">{{ __('Update Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <x-media.js />
    <x-summernote.js/>
@endsection
