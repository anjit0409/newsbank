<?php


$title = "sanjeeb kc news";
$content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently 
            with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";


$data_array =  array(
    "title" => "$title" , 
    "data" => "$content",
    );

  $data = json_encode($data_array);


  $curl = curl_init();
  curl_setopt_array($curl, array(

    // CURLOPT_URL => "http://localhost/newsbank/accesories/endpoint.php",
    CURLOPT_URL => "https://sanjeebkc.com.np/test/test.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data ,
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);

  $response = json_decode($response);
  $response = json_decode(json_encode($response) , true);
  $respCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $err = curl_error($curl);

  $response = curl_exec($curl);
  curl_close($curl);


  
echo $response ;
//  print_r($response) ;