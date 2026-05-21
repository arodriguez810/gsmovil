<?php

return [

    /*
    |--------------------------------------------------------------------------
    | URL del WebView
    |--------------------------------------------------------------------------
    |
    | La URL que carga el WebView al abrir la app.
    |
    | - URL externa: WEBVIEW_URL=https://tudominio.com
    | - Rutas internas de Laravel: dejar vacío (usa NATIVEPHP_START_URL)
    |
    | ⚠️  Siempre usar HTTPS en producción.
    |
    */
    'url' => env('WEBVIEW_URL'),

    /*
    |--------------------------------------------------------------------------
    | User Agent
    |--------------------------------------------------------------------------
    |
    | Texto que se añade al User Agent del WebView.
    | Tu servidor puede detectar que la petición viene de la app con este valor.
    |
    | Ejemplo de UA resultante:
    |   "Mozilla/5.0 (Linux; Android 14) ... WebKit/537.36 GSMovilApp/1.0"
    |
    | Para detectarlo en PHP:
    |   str_contains(request()->userAgent(), 'GSMovilApp')
    |
    */
    'user_agent_suffix' => env('WEBVIEW_UA_SUFFIX', 'NativePHPApp/1.0'),

    /*
    |--------------------------------------------------------------------------
    | Comportamiento del WebView
    |--------------------------------------------------------------------------
    |
    | Controla cómo se comporta el WebView para que parezca una app nativa.
    |
    */
    'behavior' => [

        // Permite hacer zoom con dos dedos (false = más nativo)
        'zoom_enabled' => env('WEBVIEW_ZOOM_ENABLED', false),

        // Efecto "glow" al llegar al final del scroll (false = más nativo)
        'overscroll_effect' => env('WEBVIEW_OVERSCROLL', false),

    ],

];
