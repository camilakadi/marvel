<?php
/**colocando hash = ts + privatekey + publickey **/
$ts = time();
$public_key = '';
$private_key = '';
$hash = md5($ts . $private_key . $public_key);

$query_params = [
    'apikey' => $public_key,
    'ts' => $ts,
    'hash' => $hash
];

//convert array into query parameters
$query = http_build_query($query_params);
?>