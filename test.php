<?php
require_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$secret_key = "tu_clave_secreta";
$issuer_claim = "tu_issuer";
$audience_claim = "tu_audience";
$issuedat_claim = time();
$notbefore_claim = $issuedat_claim + 10; // Token válido después de 10 segundos
$expire_claim = $issuedat_claim + 3600; // Token expira en una hora

$token = array(
    "iss" => $issuer_claim,
    "aud" => $audience_claim,
    "iat" => $issuedat_claim,
    "nbf" => $notbefore_claim,
    "exp" => $expire_claim
);

$jwt = JWT::encode($token, $secret_key);
echo $jwt;