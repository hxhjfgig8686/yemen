<?php

$username = "asmeralselwi103@gmail.com";
$password = "Mohammed Saeed 123";

$login_url = "https://ivasms.com/login";
$messages_url = "https://www.ivasms.com/portal/sms/received";

$cookie_file = "cookie.txt";


function request($url,$post=null){

    global $cookie_file;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

    curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0");

    if($post){
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
    }

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}


# فتح صفحة تسجيل الدخول
$html = request($login_url);


# تسجيل الدخول
$post = http_build_query([
    "email"=>$username,
    "password"=>$password
]);

request($login_url,$post);


# جلب الرسائل
$html = request($messages_url);


preg_match_all('/\+?\d{7,15}/',$html,$numbers);
preg_match_all('/\b\d{4,6}\b/',$html,$codes);


$result = [];

for($i=0;$i<count($codes[0]);$i++){

    $number = $numbers[0][$i] ?? "unknown";
    $code = $codes[0][$i];

    $result[]=[
        "number"=>$number,
        "sms"=>"Your code is ".$code
    ];
}

echo json_encode([
    "success"=>true,
    "codes"=>$result
]);