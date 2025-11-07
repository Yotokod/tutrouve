<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Abonnement gratuit utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour l\'abonnement gratuit de l\'utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.free.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Achat d\'abonnement utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour l\'abonnement utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.purchase.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Renouvellement d\'abonnement utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour le renouvellement d\'abonnement utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.renew.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Email d\'activation d\'abonnement à l\'utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour l\'activation de l\'abonnement utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.active.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Email d\'inactivation d\'abonnement à l\'utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour l\'inactivation de l\'abonnement utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.inactive.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Email de paiement manuel d\'abonnement complété à l\'utilisateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour le paiement manuel complété de l\'abonnement utilisateur.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.manual.payment.complete.template')"/>
    </td>
</tr>
<tr>
    <td><strong class="serial-number"></strong></td>
    <td>
        {{__('Email de paiement manuel d\'abonnement complété à l\'administrateur')}} <br>
        <span class="mt-2"><b class="text-info">{{__('Notes:')}}</b> {{ __('Pour le paiement manuel complété de l\'abonnement.') }}</span>
    </td>
    <td>
        <x-icon.edit-icon :url="route('admin.email.user.membership.manual.payment.complete.to.admin.template')"/>
    </td>
</tr>
