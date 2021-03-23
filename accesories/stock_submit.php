<?php

include "connection.php";
session_start();

$remote_file_server_path = 'https://sanjeebkc.com.np/nepalnewsclient/nepalnewsbank/stock';

function ftp_remote($folder , $DestName , $sourceName)
{
    // $ftp = ftp_connect("ftp.offixservices.com");
    // ftp_login($ftp, "offix@offixservices.com", "Offix_(*(*");
    $ftp = ftp_connect("ftp.sanjeebkc.com.np");
    ftp_login($ftp, "nepalnewsbank@sanjeebkc.com.np", "nepalnewsbank");
    ftp_pasv($ftp, true);
    $file_status = ftp_put($ftp, "/$folder/$sourceName", "$DestName", FTP_BINARY); 
    // ftp_remote('videolong' , '../'.$videolong_full , $sourceName)
    ftp_close($ftp); 

    if(isset($file_status))
    {
        return 1 ;
    }
    else
    {
        return 0 ;
    }

    
}


if(isset($_POST['submit']))
{
    if( isset($_POST['title'])  ) 
    { 
        if( !empty($_POST['title']) )
        {
           
            
                $title = $_POST['title'];
                $title = mysqli_real_escape_string($connection, $title);


                $date = $_POST['date'];
                $date = mysqli_real_escape_string($connection, $date);



                
                $fileName = $_FILES['video']['name'] ;
                $fileExt = explode('.' , $fileName);
                $fileActualExt_videolong = strtolower(end($fileExt));

                $file_type = $_FILES['video']['type'] ;
                $file_type_explode = explode("/" , $file_type);
                $allowed = array('video'  );

                if (in_array($file_type_explode[0] , $allowed ))
                {
                    $video_long_status = true ;               
                }


                $fileName = $_FILES['thumb']['name'] ;
                $fileExt = explode('.' , $fileName);
                $fileActualExt_thumbImg = strtolower(end($fileExt));
    
                $file_type = $_FILES['thumb']['type'] ;
                $file_type_explode = explode("/" , $file_type);
                $allowed = array('image' );
    
                if (in_array($file_type_explode[0] , $allowed ))
                {
                    $thumbImg_status = true ;               
                }
                $thumbImg_status = true ; 
                $video_long_status = true;

                if( $video_long_status &&  $thumbImg_status )
                {                


                    $thum_name = $_FILES['thumb']['tmp_name'] ;
                    $fileName = $_FILES['thumb']['name'] ;
                    $thum_name_file = $date."_".time()."_".$fileName;
                    move_uploaded_file($thum_name, "holds/$thum_name_file") ;
                    $thumb_send_path = file_get_contents( "holds/$thum_name_file");              

                    $url = 'https://nepalnewsclient.sanjeebkc.com.np/wp-json/wp/v2/media';
                    $ch = curl_init();
                    curl_setopt( $ch, CURLOPT_URL, $url );
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch, CURLOPT_POST, 1 );
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $thumb_send_path );
                    curl_setopt( $ch, CURLOPT_HTTPHEADER, [

                        'Content-Disposition: form-data; filename="'.$thum_name_file.'"',
                        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTYzMzAzNTMsImlzcyI6Imh0dHBzOlwvXC9uZXBhbG5ld3NjbGllbnQuc2FuamVlYmtjLmNvbS5ucCIsImV4cCI6MTYxNzE5NDM0NCwianRpIjoiZmRlNzg1MzktODg2Ni00OTY5LTk3ZWYtOTMzMGRkNDNhZDAzIiwidXNlcklkIjoxLCJyZXZvY2FibGUiOnRydWUsInJlZnJlc2hhYmxlIjoidHJ1ZSJ9.AzjdzRURHhwqSV4pSIvioJrH__sOiYy7SmjzNe3-iCI' 
                      
                        ] );
                    
                    $result = curl_exec( $ch );
                    $result = json_decode($result);
                    $result = json_decode(json_encode($result) , true);    
                    $respCodess = curl_getinfo($ch, CURLINFO_HTTP_CODE);                    
                    curl_close( $ch );

                                      


                    $featured_media_id  = $result['id'];


                    $video_name = $_FILES['video']['tmp_name'] ;
                    $fileName_video = $_FILES['video']['name'] ;
                    $video_name_file = $date."_".time()."_".$fileName_video;
                    move_uploaded_file($video_name, "holds/$video_name_file") ;
                    $video_send_path = "holds/$video_name_file";


                    $ftp = ftp_connect("ftp.sanjeebkc.com.np");
                    ftp_login($ftp, "nepalnewsbank@sanjeebkc.com.np", "nepalnewsbank");
                    ftp_pasv($ftp, true);
                    ftp_put($ftp, "/stock/$video_name_file", "$video_send_path", FTP_BINARY); 
                    ftp_close($ftp);

                    unlink("holds/$thum_name_file"); 
                    unlink($video_send_path);       
                    




                    $video_link = "https://sanjeebkc.com.np/nepalnewsclient/nepalnewsbank/stock/".$video_name_file ;


                    $data_array =  array(
                        "status" => "publish" , 
                        "title" => "$title",                    
                        "featured_media" => $featured_media_id,
                        "video_category" => "168",
                        "cmb2" => array('haru_video_metabox' => array('haru_video_server' => 'selfhost',
                                                                        'haru_video_url_type'=> 'insert',
                                                                        'haru_video_url' => array('mp4' => $video_link , 'webm' => '')
                        )),
                       
                    
                     
                    
                        );

                    $data = json_encode($data_array);

                    $curl = curl_init();
                    curl_setopt_array($curl, array(                    
                    CURLOPT_URL => "https://nepalnewsclient.sanjeebkc.com.np/wp-json/wp/v2/haru_video/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $data ,
                        CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                            "content-type: application/json",
                            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTYzMzAzNTMsImlzcyI6Imh0dHBzOlwvXC9uZXBhbG5ld3NjbGllbnQuc2FuamVlYmtjLmNvbS5ucCIsImV4cCI6MTYxNzE5NDM0NCwianRpIjoiZmRlNzg1MzktODg2Ni00OTY5LTk3ZWYtOTMzMGRkNDNhZDAzIiwidXNlcklkIjoxLCJyZXZvY2FibGUiOnRydWUsInJlZnJlc2hhYmxlIjoidHJ1ZSJ9.AzjdzRURHhwqSV4pSIvioJrH__sOiYy7SmjzNe3-iCI' 
                        ),
                    ));
                
                    $response = curl_exec($curl);
                    $response = json_decode($response);
                    $response = json_decode(json_encode($response) , true);
                    $respCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    $err = curl_error($curl);                    
                    curl_close($curl);
                   

                   $_SESSION['notice'] = 'success';
                   
                  

                }
                else
                {
                    $_SESSION['notice'] = 'Error_check_file';
                }




        }
        else
        {
            $_SESSION['notice'] = 'Error_check_file';
        }


    }
    else
    {
        $_SESSION['notice'] = 'Error_check_file';
    }

}



header("Location: ". $_SERVER['HTTP_REFERER']);
exit();