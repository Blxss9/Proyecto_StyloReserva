<?php

// Credenciales de PayPal
define('PAYPAL_CLIENT_ID', 'AUa62Zt1gzGinDA6u6Re7QiOwQdI-48mIPbt22UfSM75PfN99LlPkeNGrqNVqCEJHI4y2qRmP8feCMkH');
define('PAYPAL_CLIENT_SECRET', 'EAVbuyD0UUORvNXHw_QOR0G7mxDN5ulwo7Yn9IfQiQ-p7-aeTfjG8hNt_o-rsHcxS1P7YCwnJ-o2u4mZ');

// URL de la API (usa sandbox para pruebas)
define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com'); // Cambia a https://api-m.paypal.com en producción

// Función para obtener el token de acceso
function getPayPalAccessToken() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, PAYPAL_API_URL . '/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ':' . PAYPAL_CLIENT_SECRET);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    if (!$response) {
        throw new Exception('Error al obtener el token de PayPal');
    }
    
    $data = json_decode($response, true);
    if (!isset($data['access_token'])) {
        throw new Exception('Token de PayPal no encontrado en la respuesta');
    }
    
    return $data['access_token'];
}