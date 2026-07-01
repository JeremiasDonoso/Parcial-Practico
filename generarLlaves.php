<?php

$configArgs = array(
    'config' => 'C:\xampp\php\extras\ssl\openssl.cnf',
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
);

$resourceNewKeyPair = openssl_pkey_new($configArgs);

if (!$resourceNewKeyPair) {
    echo openssl_error_string();
    exit;
}

$details = openssl_pkey_get_details($resourceNewKeyPair);
$publicKeyPem = $details['key'];

if (!openssl_pkey_export($resourceNewKeyPair, $privateKeyPem, null, $configArgs)) {
    echo openssl_error_string();
    exit;
}

file_put_contents("private.pem", $privateKeyPem);
file_put_contents("public.pem", $publicKeyPem);

echo "Llaves generadas correctamente.";