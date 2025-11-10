<?php
namespace App\Helpers;

/**
 * this class will contain all Flash Message helper method
 *
 * */
    class FlashMsg{

      public static function item_cloned($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Élément cloné avec succès')
    ];
}

public static function item_new($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Élément ajouté avec succès')
    ];
}

public static function item_update($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Élément mis à jour avec succès')
    ];
}

public static function item_delete($msg = null){
    return [
        'type' => 'danger',
        'msg' => $msg ?? __('Élément supprimé avec succès')
    ];
}

public static function item_clone($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Élément cloné avec succès')
    ];
}

public static function settings_update($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Paramètres mis à jour avec succès')
    ];
}

public static function settings_new($msg = null){
    return [
        'type' => 'success',
        'msg' => $msg ?? __('Paramètres ajoutés avec succès')
    ];
}

public static function settings_delete($msg = null){
    return [
        'type' => 'danger',
        'msg' => $msg ?? __('Paramètres supprimés avec succès')
    ];
}

public static function error($msg = null){
    return [
        'type' => 'danger',
        'msg' => $msg ?? __('Élément supprimé avec succès')  // Note : L'erreur mentionne la suppression d'un élément ici, ce qui pourrait être un message par défaut à adapter selon le contexte.
    ];
}

    }
?>
