<?php
    header('Content-Type: application/javascript');

    include_once 'init.php';
    $settings = new SystemSettings();
    $systemSettings = $settings->getSettings();
?>
var bitress = {
    App: {
        lang: "en"
    },
    Http: {
        api_url: 'https://backend.ebasura.online'
    },
    Utils: {
        settings: <?= json_encode($systemSettings, JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
    }
};
