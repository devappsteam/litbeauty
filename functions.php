<?php

require_once __DIR__ . '/vendor/autoload.php';

use DevApps\LitBeauty;

// Armazena a versão do tema a uma variável
$theme              = wp_get_theme('litbeauty');
$litbeauty_version = $theme['Version'];

$litbeauty = (object) array(
    'version' => $litbeauty_version,

    //Inicializa todos as classes e recursos do tema
    'main'          => new LitBeauty($litbeauty_version),
);