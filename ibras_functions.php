<?php

//////////////////////////////////////////////////////////////// functions

function ibras_dellusers($ip, $username, $password) {
    $url = "http://" . $ip . "/cgi-bin/AccessUser.cgi?action=removeAll";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}


function ibras_addusers($ip, $username, $password, $userList) {

    $url = "http://" . $ip . "/cgi-bin/AccessUser.cgi?action=insertMulti";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['UserList' => $userList]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function ibras_addusers_ind($ip, $username, $password, $us_id, $us_nome, $us_qrcode) {

    $us_nome = str_replace(" %", "_", $us_nome);

    $url = "http://" . $ip . "/cgi-bin/recordUpdater.cgi?action=insert&name=AccessControlCard&CardName=$us_nome&CardNo=$us_qrcode&UserID=$us_id&CardStatus=0&ValidDateStart=20151022%20093811&ValidDateEnd=20451222%20093811";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}


function ibras_addface($ip, $username, $password, $faceList) {

    $url = "http://" . $ip . "/cgi-bin/AccessFace.cgi?action=insertMulti";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['FaceList' => $faceList]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function ibras_addcard($ip, $username, $password, $cardList) {

    $url = "http://" . $ip . "/cgi-bin/AccessCard.cgi?action=insertMulti";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['CardList' => $cardList]),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function ibras_getac($ip, $username, $password, $start) {

    $url = "http://" . $ip . "/cgi-bin/recordFinder.cgi?action=find&name=AccessControlCardRec&StartTime=".$start."";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 7, // timeout de 7 segundos
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
        CURLOPT_USERPWD => $username . ':' . $password,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;

}


?>
