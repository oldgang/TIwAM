<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        if($data->user == 'rektor'
            && $data->pass == sha1(sha1('123') . $_SESSION['nonce'])
            && $data->key == $_SESSION['nonce'])
        {
            $result['code'] = 'OK';
        }
        else if($data->key != $_SESSION['nonce'])
        {
            $result['code'] = 'Bad session key';
        }
        else if($data->user != 'rektor')
        {
            $result['code'] = 'Bad username';
        }
        else
        {
        $result['code'] = 'Bad password';
        }
        // $result['user'] = $data->user;
        // $result['expected_user'] = 'rektor';
        // $result['pass'] = $data->pass;
        // $result['expected_pass'] = sha1(sha1('123') . $_SESSION['nonce']);
        // $result['nonce'] = $data->key;
        // $result['expected_nonce'] = $_SESSION['nonce'];
    }
else{
    $result['code'] = 'wrong type of request';
}

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
print(json_encode($result));