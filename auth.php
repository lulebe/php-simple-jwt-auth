<?php
require 'jwt_helper.php';


function authenticate () {
    $db_usr = "testuser";
    $db_usr_pw = "mypw";
    $db_usr_id = 187;
    $secret_key = 'some_test_key';
    $valid_for = '3600';
    if ($_POST['usr'] && $_POST['pw']) {
        $usr = $_POST['usr'];
        $pw = $_POST['pw'];
        if ($usr == $db_usr && $pw == hash('sha256', $db_usr_pw)) {
            $token = array();
            $token['id'] = $db_usr_id;
            $token['exp'] = time() + $valid_for;
            echo json_encode(array('token' => JWT::encode($token, $secret_key)));
            return false;
        } else {
            http_response_code(401);
            return false;
        }
    } else {
        $headers = getallheaders();
        if (array_key_exists('Authorization', $headers)) {
            $jwt = $headers['Authorization'];
            $token = JWT::decode($jwt, $secret_key);
            if ($token->exp >= time()) {
                //loggedin
                return $token->id;
            } else {
                http_response_code(401);
                return false;
            }
        } else {
            http_response_code(401);
            return false;
        }
    }
}
?>