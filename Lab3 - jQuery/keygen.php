<?php
session_start();
$nonce = hash("sha1", uniqid(true));
$_SESSION['nonce'] = $nonce;
$key['nonce'] = $nonce;
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
$key_json = json_encode($key);
print($key_json);