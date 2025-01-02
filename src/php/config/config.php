<?php
session_set_cookie_params([
    'lifetime' => 0, // La session expire à la fermeture du navigateur
    'path' => '/',
    'domain' => '', // Remplissez si nécessaire, par exemple : 'example.com'
    'secure' => true, // Activez uniquement si vous utilisez HTTPS
    'httponly' => true, // Rend le cookie inaccessible via JavaScript
    'samesite' => 'Strict', // Empêche les fuites intersites
]);
session_start();
