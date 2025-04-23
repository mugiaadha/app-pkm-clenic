<?php

include 'heder.php';

// $url = 'https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials';

$url = 'https://api-satusehat.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials';
// https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1




// 100065218
// EAvWGAaT06bDoGUU0F3RVUgKr9Ac7WgjTK0yauHqZbtkixM6
// r066lGdModB6PY1QIoVQlnk1lIFEGF9R75fu8qI08rwtndmY7DWfBfkR14StWqXC


$headers = [
              
                "Content-Type: application/x-www-form-urlencoded"
            ];
$data = [ 
            "client_id" => 'ff69UrGLngrcjJ00Awj5BKn5IqjK8gIGWITKwQBGHMo4nDZv',
            "client_secret" => 'siijMGQVmRwWpaMU0lacaie9bnIPbKfNkMb5HmTYYOe4GQgsa2X6iqKS1IRVMmGW',
            
        ];            
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data) 
));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($curl);
$errno = curl_errno($curl);

curl_close($curl);
print_r($response);


// $nokontrolbpjs  = $daribpjs[ 'noSPRI' ];







?>